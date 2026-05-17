<?php

session_start();
require 'conexao.php';
mysqli_set_charset($conexao, "utf8mb4");

// cadastrar ajuda

if (isset($_POST['create_usuario'])) {

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
    $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
    $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
    $tipo_ajuda = mysqli_real_escape_string($conexao, trim($_POST['tipo_ajuda']));
    $descricao = mysqli_real_escape_string($conexao, trim($_POST['descricao']));
    $protocolo = 'AJUD' . date('y') . str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);

    // Salvar imagem
    $foto = null;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

        $diretorio = __DIR__ . '/../upload/';
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0755, true);
        }

        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nomeFoto = uniqid() . "." . $extensao;

        $foto = $diretorio . $nomeFoto;

        move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
    }

    $sqlSolicitante = " INSERT INTO solicitantes (nome_solicitante, endereco_solicitante, cidade_solicitante, telefone_solicitante) VALUES ('$nome', '$endereco', '$cidade', '$telefone')";
    mysqli_query($conexao, $sqlSolicitante);
    $id_solicitante = mysqli_insert_id($conexao);

    $sqlSolicitacao = "INSERT INTO solicitacoes (id_solicitante, tipo_ajuda, descricao, foto,  protocolo) VALUES ('$id_solicitante', '$tipo_ajuda', '$descricao', '$foto', '$protocolo')";
    mysqli_query($conexao, $sqlSolicitacao);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Usuário criado com sucesso';
        header('Location: solicitacoes.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi criado';
        header('Location: solicitacoes.php');
        exit;
    }
}

// cadastrar indicacao

if (isset($_POST['create_indicacao'])) {

    $nomeIndicador = mysqli_real_escape_string($conexao, trim($_POST['nome_indicador']));
    $telefoneIndicador = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
    $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
    $tipo_ajuda = mysqli_real_escape_string($conexao, trim($_POST['tipo_ajuda']));
    $descricao = mysqli_real_escape_string($conexao, trim($_POST['descricao']));
    $protocolo = 'AJUD' . date('y') . str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);


    $sqlIndicador = "INSERT INTO indicadores (nome_indicador, telefone_indicador) VALUES ('$nomeIndicador', '$telefoneIndicador')";
    mysqli_query($conexao, $sqlIndicador);
    $id_indicador = mysqli_insert_id($conexao);

    $sqlSolicitante = " INSERT INTO solicitantes (nome_solicitante, endereco_solicitante, cidade_solicitante) VALUES ('$nome', '$endereco', '$cidade')";
    mysqli_query($conexao, $sqlSolicitante);
    $id_solicitante = mysqli_insert_id($conexao);

    $sqlSolicitacao = "INSERT INTO solicitacoes (id_solicitante, id_indicador, tipo_ajuda, descricao, protocolo) VALUES ('$id_solicitante', '$id_indicador', '$tipo_ajuda', '$descricao', '$protocolo')";
    mysqli_query($conexao, $sqlSolicitacao);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Usuário criado com sucesso';
        header('Location: solicitacoes.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi criado';
        header('Location: solicitacoes.php');
        exit;
    }
}

// atualizar dados

if (isset($_POST['update_usuario'])) {

    $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
    $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', data_nascimento = '$data_nascimento'";

    if (!empty($senha)) {
        $sql .= ", senha='" . password_hash($senha, PASSWORD_DEFAULT) . "'";
    }

    $sql .= " WHERE id = '$usuario_id'";

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Usuário atualizado com sucesso';
        header('Location: solicitacoes.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi atualizado';
        header('Location: solicitacoes.php');
        exit;
    }
}

// excluir usuario

if (isset($_POST['delete_usuario'])) {

    $usuario_id = mysqli_real_escape_string($conexao, $_POST['delete_usuario']);

    $sql = "DELETE FROM usuarios WHERE id = '$usuario_id'";

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Usuário deletado com sucesso';
        header('Location: solicitacoes.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi deletado';
        header('Location: solicitacoes.php');
        exit;
    }
}
