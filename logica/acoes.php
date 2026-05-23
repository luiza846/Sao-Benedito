<?php

session_start();

require_once __DIR__ . '/../conexao/conexao.php';
mysqli_set_charset($conexao, "utf8mb4");

// cadastrar preciso ajuda

if (isset($_POST['create_usuario'])) {

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
    $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
    $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
    $tipo_ajuda = mysqli_real_escape_string($conexao, trim($_POST['tipo_ajuda']));
    $descricao = mysqli_real_escape_string($conexao, trim($_POST['descricao']));
    $protocolo = 'AJUD' . date('y') . str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
    $status = 'Em Andamento';

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

    $sqlSolicitacao = "INSERT INTO solicitacoes (id_solicitante, tipo_ajuda, descricao, foto,  protocolo, status_solicitacao) VALUES ('$id_solicitante', '$tipo_ajuda', '$descricao', '$foto', '$protocolo','$status')";
    mysqli_query($conexao, $sqlSolicitacao);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['sucesso'] = true;
        $_SESSION['protocolo'] = $protocolo; // para imprimir o protocolo
        header('Location: /index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi criado';
        header('Location: /index.php');
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
    $status = 'Em Andamento';

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

    $sqlIndicador = "INSERT INTO indicadores (nome_indicador, telefone_indicador) VALUES ('$nomeIndicador', '$telefoneIndicador')";
    mysqli_query($conexao, $sqlIndicador);
    $id_indicador = mysqli_insert_id($conexao);

    $sqlSolicitante = " INSERT INTO solicitantes (nome_solicitante, endereco_solicitante, cidade_solicitante) VALUES ('$nome', '$endereco', '$cidade')";
    mysqli_query($conexao, $sqlSolicitante);
    $id_solicitante = mysqli_insert_id($conexao);

    $sqlSolicitacao = "INSERT INTO solicitacoes (id_solicitante, tipo_ajuda, descricao, foto,  protocolo, status_solicitacao) VALUES ('$id_solicitante', '$tipo_ajuda', '$descricao', '$foto', '$protocolo','$status')";
    mysqli_query($conexao, $sqlSolicitacao);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['sucesso'] = true;
        $_SESSION['protocolo'] = $protocolo; // para imprimir o protocolo
        header('Location: /index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi criado';
        header('Location: /index.php');
        exit;
    }
}

// criar ajuda parte do adm

if (isset($_POST['create_ajuda'])) {

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
    $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
    $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
    $tipo_ajuda = mysqli_real_escape_string($conexao, trim($_POST['tipo_ajuda']));
    $descricao = mysqli_real_escape_string($conexao, trim($_POST['descricao']));
    $protocolo = 'AJUD' . date('y') . str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
    $status = 'Aprovada - Criada pela Igreja';

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

    $sqlSolicitacao = "INSERT INTO solicitacoes (id_solicitante, tipo_ajuda, descricao, foto,  protocolo, status_solicitacao) VALUES ('$id_solicitante', '$tipo_ajuda', '$descricao', '$foto', '$protocolo','$status')";
    mysqli_query($conexao, $sqlSolicitacao);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Solicitação criada com sucesso';
        header('Location: ../administrador/solicitacoes.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Solicitação não foi criada';
        header('Location: ../administrador/solicitacoes.php');
        exit;
    }
}


// aprovar solicitacao
if (isset($_POST['aprovar_solicitante'])) {

    $id_solicitacao = mysqli_real_escape_string($conexao, $_POST['aprovar_solicitante']);

    $status = 'Aprovada';

    $sql = "UPDATE solicitacoes SET status_solicitacao = '$status' WHERE id_solicitacao = '$id_solicitacao'";

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Solicitação aprovada com sucesso';
        header('Location: ../administrador/solicitacoes.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Erro ao aprovar a solicitação';
        header('Location: ../administrador/solicitacoes.php');
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
        header('Location: /index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi atualizado';
        header('Location: /index.php');
        exit;
    }
}

// reprovar solicitacao

if (isset($_POST['delete_solicitante'])) {

    $id_solicitacao = mysqli_real_escape_string($conexao, $_POST['delete_solicitante']);

    $sql = "DELETE FROM solicitacoes WHERE id_solicitacao = '$id_solicitacao'";

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Solicitação reprovada';
        header('Location: ../administrador/solicitacoes.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Solicitação não foi reprovada';
        header('Location: ../administrador/solicitacoes.php');
        exit;
    }
}
