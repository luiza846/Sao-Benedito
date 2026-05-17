<?php
require 'conexao.php';
mysqli_set_charset($conexao, "utf8mb4");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>solicitacao - Visualização</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar solicitação
                            <a href="solicitacoes.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $id = mysqli_real_escape_string($conexao, $_GET['id']);
                            $sql = "SELECT 
                            so.id_solicitacao,
                            so.tipo_ajuda,
                            so.descricao,
                            so.protocolo,
                            so.foto,
                            so.data_solicitacao,

                            s.nome_solicitante,
                            s.cidade_solicitante,
                            s.endereco_solicitante,
                            s.telefone_solicitante,

                            i.nome_indicador,
                            i.telefone_indicador

                        FROM solicitacoes so
                        INNER JOIN solicitantes s 
                            ON s.id_solicitante = so.id_solicitante
                        LEFT JOIN indicadores i 
                            ON i.id_indicador = so.id_indicador

                        WHERE so.id_solicitacao = '$id'
                        LIMIT 1
                    ";
                            $query = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $solicitacao = mysqli_fetch_array($query);


                        ?>

                                <div class="mb-3">
                                    <p class="form-control">
                                        <img src="/upload/<?= basename($solicitacao['foto']) ?>" width="300">
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Nome</label>
                                    <p class="form-control">
                                        <?= $solicitacao['nome_solicitante']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Endereço</label>
                                    <p class="form-control">
                                        <?= $solicitacao['endereco_solicitante']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Cidade</label>
                                    <p class="form-control">
                                        <?= $solicitacao['cidade_solicitante']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Telefone</label>
                                    <p class="form-control">
                                        <?= $solicitacao['telefone_solicitante']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Endereço</label>
                                    <p class="form-control">
                                        <?= $solicitacao['endereco_solicitante']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Nome do Indicador</label>
                                    <p class="form-control">
                                        <?= $solicitacao['nome_indicador']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Telefone do Indicador</label>
                                    <p class="form-control">
                                        <?= $solicitacao['telefone_indicador']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Tipo de Ajuda</label>
                                    <p class="form-control">
                                        <?= $solicitacao['tipo_ajuda']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Descrição</label>
                                    <p class="form-control">
                                        <?= $solicitacao['descricao']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Protocolo</label>
                                    <p class="form-control">
                                        <?= $solicitacao['protocolo']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Data da Solicitação</label>
                                    <p class="form-control">
                                        <?= date('d/m/Y', strtotime($solicitacao['data_solicitacao'])) ?>
                                    </p>
                                </div>

                        <?php
                            } else {
                                echo "<h5>solicitacao não encontrada</h5>";
                            }
                        }
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>