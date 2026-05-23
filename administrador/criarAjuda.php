<?php
require 'conexao.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Adicionar usuario
                            <a href="solicitacoes.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="../logica/acoes.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Endereço</label>
                                <input type="text" name="endereco" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Cidade</label>
                                <input type="text" name="cidade" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Telefone</label>
                                <input type="text" name="telefone" class="form-control">
                            </div>
                            <!-- <div class="mb-3">
                                <label>Tipo de Ajuda</label>
                                <input type="text" name="tipo_ajuda" class="form-control">
                            </div> -->
                            <div class="mb-3">
                                <label for="opcoes" class="form-label">Tipo de ajuda necessária:</label>

                                <select id="tipo_ajuda" name="tipo_ajuda" class="form-select">
                                    <option value="Cesta básica">Cesta básica</option>
                                    <option value="Roupas (agasalhos)">Roupas (agasalhos)</option>
                                    <option value="Cobertores">Cobertores</option>
                                    <option value="Itens para higiene pessoal">Itens para higiene pessoal</option>
                                    <option value="Outros">Outros</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Envie sua foto</label>
                                <input class="form-control" type="file" name="foto" accept="image/*" onchange="previewImagem(event)" required>
                            </div>

                            <img id="preview" class="img-thumbnail d-none" width="200">
                            <div class="mb-3">
                                <label>Descrição</label>
                                <input type="text" name="descricao" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="create_ajuda" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>

<script>
    function previewImagem(event) {
        const img = document.getElementById('preview');
        img.src = URL.createObjectURL(event.target.files[0]);
        img.classList.remove('d-none');
    }
</script>