<?php
include_once "./app/conexao/conexao.php";
include_once "./app/dao/jogodao.php";
include_once "./app/model/jogo.php";

//instancia as classes
$jogo = new  Jogo();
$jogodao = new JogoDAO();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Biblioteca Jogos</title>
    <style>
        .menu,
        thead {
            background-color: #bbb !important;
        }

        .row {
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light menu">
        <div class="container">
            <a class="navbar-brand" href="#">
                Biblioteca de jogos
            </a>
        </div>
    </nav>
    <div class="container">
        <form action="app/controller/jogocontroller.php" method="POST">
            <div class="row">
                <div class="col-md-5">
                    <label>Título</label>
                    <input type="text" name="titulo" value="" autofocus class="form-control" required />
                </div>
                <div class="inputBox">
                    <br>
                    <label>Gênero</label>
                    <select class="form-select" name="genero" aria-label="Default select example" required>
                            <option value="">Gênero do jogo</option>
                            <option value="Corrida">Corrida</option>
                            <option value="Ação">Ação</option>
                            <option value="RPG">RPG</option>
                            <option value="Aventura">Aventura</option>
                            <option value="Estratégia">Estratégia</option>
                            <option value="Esporte">Esporte</option>
                            <option value="On-Line">On-Line</option>
                            <option value="Simulação">Simulação</option>
                            <option value="Mundo Aberto">Mundo Aberto</option>
                        </select>
                </div>
                <div class="col-md-5">
                    <label>Lançamento</label>
                    <input type="date" name="lancamento" value="" class="form-control" required />
                </div>
                <div class="col-md-5">
                    <label>Descrição</label>
                    <input type="text" name="descricao" value="" class="form-control" required />
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-primary" type="submit" name="cadastrar">Cadastrar</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Gênero</th>
                        <th>Lançamento</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jogodao->read() as $jogo) : ?>
                        <tr>
                            
                            <td><?= $jogo->getTitulo() ?></td>
                            <td><?= $jogo->getGenero() ?></td>
                            <td><?= $jogo->getLancamento() ?></td>
                            <td><?= $jogo->getDescricao()?></td>
                            <td class="text-center">
                                <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $jogo->getId() ?>">
                                    Editar
                                </button>
                                <a href="app/controller/jogocontroller.php?del=<?= $jogo->getId() ?>">
                                <button class="btn  btn-danger btn-sm" type="button">Excluir</button>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editar><?= $jogo->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="app/controller/jogocontroller.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Título</label>
                                                    <input type="text" name="titulo" value="<?= $jogo->getTitulo() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Gênero</label>                  
                                                    <select class="form-select" name="genero" value="<?= $jogo->getGenero() ?>" aria-label="Default select example" required>
                                                    <option selected value="<?= $jogo->getGenero() ?>" required><?php echo $jogo->getGenero(); ?></option>
                                                        <option value="Corrida">Corrida</option>
                                                        <option value="Ação">Ação</option>
                                                        <option value="RPG">RPG</option>
                                                        <option value="Aventura">Aventura</option>
                                                        <option value="Estratégia">Estratégia</option>
                                                        <option value="Esporte">Esporte</option>
                                                        <option value="On-Line">On-Line</option>
                                                        <option value="Simulação">Simulação</option>
                                                        <option value="Mundo Aberto">Mundo Aberto</option>
                                                        <option value="Outros">Outros</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Lançamento</label>
                                                    <input type="date" name="lancamento" value="<?= $jogo->getLancamento() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Descrição</label>
                                                    <input type="text" name="descricao" value="<?= $jogo->getDescricao() ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="id" value="<?= $jogo->getId() ?>" />
                                                    <button class="btn btn-primary" type="submit" name="editar">Cadastrar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>