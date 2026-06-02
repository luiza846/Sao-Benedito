<?php
session_start();
require 'conexao.php';
mysqli_set_charset($conexao, "utf8mb4");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>solicitantes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <!-- carregar os icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
  <?php include('navbar.php'); ?>

  <div class="container mt-4">
    <!-- msg de sucesso erro ao criar user -->
    <?php
    require 'mensagem.php';
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            <h4>Lista de solicitantes
              <a href="solicitacoes.php" class="btn btn-danger float-end">Voltar</a>
            </h4>

          </div>

          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Cidade</th>
                  <th>Endereço</th>
                  <th>Tipo de Ajuda</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT 
                      so.id_solicitacao,
                      s.nome_solicitante,
                      s.cidade_solicitante,
                      s.endereco_solicitante,
                      so.tipo_ajuda
                  FROM solicitacoes so
                  INNER JOIN solicitantes s 
                      ON s.id_solicitante = so.id_solicitante
                  WHERE so.status_solicitacao IN 
                    ('Aprovada', 'Aprovada - Criada pela Igreja')
                ORDER BY so.data_solicitacao DESC
                ";
                $solicitantes = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($solicitantes) > 0) {
                  foreach ($solicitantes as $solicitante) {

                ?>
                    <tr>
                      <td><?= $solicitante['nome_solicitante'] ?></td>
                      <td><?= $solicitante['cidade_solicitante'] ?></td>
                      <td><?= $solicitante['endereco_solicitante'] ?></td>
                      <td><?= $solicitante['tipo_ajuda'] ?></td>
                      <td>
                        <a href="solicitante-view.php?id=<?= $solicitante['id_solicitacao'] ?>" class="btn btn-secondary btn-sm"><span class="bi-eye-fill"></span>&nbsp;Visualizar</a>
                        <form action="../logica/acoes.php" method="POST" class="d-inline">
                          <button onClick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_solicitante" value="<?= $solicitante['id_solicitacao'] ?>" class="btn btn-danger btn-sm">
                            <span class="bi bi-x-lg"></span>&nbsp;Não exibir mais no site
                          </button>
                        </form>
                      </td>
                    </tr>
                <?php
                  }
                } else {
                  echo '<h5>Nenhum usuário encontrado</h5>';
                }
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>