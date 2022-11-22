<?php
include_once "../conexao/conexao.php";
include_once "../model/jogo.php";
include_once "../dao/jogodao.php";

//instancia as classes
$jogo = new Jogo();
$jogodao = new JogoDAO();

//pega todos os dados passado por POST

$d = filter_input_array(INPUT_POST);

//se a operação for gravar entra nessa condição
if(isset($_POST['cadastrar'])){

    $jogo->setTitulo($d['titulo']);
    $jogo->setGenero($d['genero']);
    $jogo->setLancamento($d['lancamento']);
    $jogo->setDescricao($d['descricao']);

    $jogodao->create($jogo);

    header("Location: ../../");
} 
// se a requisição for editar
else if(isset($_POST['editar'])){

    $jogo->setTitulo($d['titulo']);
    $jogo->setGenero($d['genero']);
    $jogo->setLancamento($d['lancamento']);
    $jogo->setDescricao($d['descricao']);
    $jogo->setId($d['id']);

    $jogodao->update($jogo);

    header("Location: ../../");
}
// se a requisição for deletar
else if(isset($_GET['del'])){

    $jogo->setId($_GET['del']);

    $jogodao->delete($jogo);

    header("Location: ../../");
}else{
    header("Location: ../../");
}