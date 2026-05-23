<?php
session_start();
require './conexao/conexao.php';
mysqli_set_charset($conexao, "utf8mb4");
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- FIM GOOGLE FONTES -->
    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- BOOSTRAP FIM -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="logica/menu.js" defer></script>
    <script src="logica/carrossel.js" defer></script>

    <title>São Sebastião</title>
</head>

<body>
    <?php
    include './telas/sucesso.php';
    ?>
    <header>
        <div class="interface">
            <div class="logo">
                <a href="#">
                    <img src="images/logo.png" alt="Logo do portfólio">
                </a>
            </div><!--logo-->

            <!--usar a clase menu-desktop para torná-lo responsivo-->
            <nav class="menu-desktop">
                <ul>
                    <li><a href="index.php">INÍCIO</a></li>
                    <li><a href="telas/doacao.html">DOAÇÕES</a></li>
                    <li><a href="telas/ajuda.html">PEDIR DE AJUDA</a></li>
                    <li><a href="#quem-somos">QUEM SOMOS</a></li>
                    <li><a href="#quem-somos">MISSÃO E VISÃO</a></li>
                    <li><a href="telas/contato.html">CONTATO</a></li>
                </ul>
            </nav>

            <div class="btn-abrir-menu" id="btn-menu">
                <i class="bi bi-list"></i>
            </div>

            <!-- MENU PARA CELULAR -->
            <div class="menu-mobile" id="menu-mobile">
                <div class="btn-fechar">
                    <i class="bi bi-x"></i>
                </div>
                <nav>
                    <ul>
                        <li><a href="index.php">INÍCIO</a></li>
                        <li><a href="telas/doacao.html">DOAÇÕES</a></li>
                        <li><a href="#">PEDIR DE AJUDA</a></li>
                        <li><a href="#quem-somos">QUEM SOMOS</a></li>
                        <li><a href="#quem-somos">MISSÃO E VISÃO</a></li>
                        <li><a href="telas/contato.html">CONTATO</a></li>

                    </ul>
                </nav>

            </div>
            <!-- MENU PARA CELULAR -->

            <div class="overlay-menu" id="overlay-menu"></div>

        </div><!--interface-->
    </header>

    <main>
        <section class="topo-do-site">
            <div class="interface">
                <div class="flex">
                    <div class="txt-topo-site">
                        <h1>CONSTRUA UMA NOVA HISTÓRIA PARA UMA FAMÍLIA <span>HOJE</span></h1>
                        <div class="btn">
                            <a href="telas/doacao.html">
                                <button>DOE AGORA</button>
                            </a>
                        </div>
                    </div>
                    <!-- txt-topo-site -->

                </div>
            </div>
            <!-- interface -->
        </section>
        <!-- topo do site -->

        <section class="ajudar-pessoas">
            <h2 class="titulo">CONHEÇA HISTÓRIA DE QUEM PRECISA DA <span>SUA AJUDA</span></h2>

            <div class="carousel-container">
                <button class="nav prev"><i class="bi bi-chevron-compact-left"></i></button>

                <div class="carousel-viewport">

                    <div class="carousel-track">
                        <?php

                        $sql = "SELECT 
                    so.id_solicitacao,
                    so.tipo_ajuda,
                    so.descricao,
                    so.protocolo,
                    so.foto,
                    so.data_solicitacao,
                    so.status_solicitacao,

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
                WHERE so.status_solicitacao IN 
                    ('Aprovada', 'Aprovada - Criada pela Igreja')
                ORDER BY so.data_solicitacao DESC
                ";

                        $query = mysqli_query($conexao, $sql);

                        if (!$query) {
                            echo "<p>Erro na consulta</p>";
                        } elseif (mysqli_num_rows($query) > 0) {
                            while ($solicitacao = mysqli_fetch_assoc($query)) {

                        ?>

                                <div class="card">

                                    <div class="img-ajuda">
                                        <img src="/upload/<?= basename($solicitacao['foto']) ?>">
                                    </div>
                                    <div class="historia">
                                        <h3>Ajude <?= $solicitacao['nome_solicitante']; ?></h3>
                                        <p><?= $solicitacao['descricao']; ?></p>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<h5>solicitacao não encontrada</h5>";
                        }

                        ?>


                    </div>
                </div>

                <button class="nav next"><i class="bi bi-chevron-compact-right"></i></button>
            </div>


        </section>

        <section class="doacao">
            <div class="interface">
                <h2 class="titulo">O QUE VOCÊ PODE <span>DOAR PARA IGREJA</span></h2>

                <div class="flex">
                    <div class="doacao-box">
                        <div class="icon">
                            <img src="images/comida.png" alt="Alimentos não perecíveis">
                        </div>
                        <h3 class="titulo-doacao">Alimentos não perecíveis</h3>
                    </div>

                    <div class="doacao-box">
                        <div class="icon">
                            <img src="images/roupas.png" alt="Roupas (agasalhos)">
                        </div>
                        <h3 class="titulo-doacao">Roupas (agasalhos)</h3>
                    </div>

                    <div class="doacao-box">
                        <div class="icon">
                            <img src="images/cobertor.png" alt="Cobertores">
                        </div>
                        <h3 class="titulo-doacao">Cobertores</h3>
                    </div>
                    <div class="doacao-box">
                        <div class="icon">
                            <img src="images/higiene.png" alt="Itens para higiene pessoal">
                        </div>
                        <h3 class="titulo-doacao">Itens para higiene pessoal</h3>
                    </div>
                    <!-- doacao box -->
                </div>
                <!-- flex -->
            </div>
            <!-- interface -->
        </section>
        <!-- doacao -->
        <section class="localizacao">
            <div class="mapa">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3331.7150370371123!2d-45.014910325054366!3d-22.66627702931913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9d8a7e285049c9%3A0x30b223c736acc0d6!2zUGFyw7NxdWlhIFPDo28gU2ViYXN0acOjbw!5e1!3m2!1spt-BR!2sbr!4v1778862434423!5m2!1spt-BR!2sbr"
                    width="500" height="430" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="infos">
                <h2 class="titulo">ONDE<span> ESTAMOS?</span></h2>
                <h5>Estamos aqui para receber você, caso queira fazer sua doação pessoalmente e conhecer nossa igreja.
                </h5>
            </div>
        </section>

        <section class="quem-somos" id="quem-somos">
            <div class="interface">
                <div class="flex">
                    <div class="img-quem-somos">
                        <img src="images/paroquia.jpg" alt="">
                    </div>
                    <div class="txt-quem-somos">
                        <h2>QUEM <span>SOMOS</span></h2>
                        <p> A Paróquia São Sebastião em Cachoeira Paulista, SP, teve origem em uma pequena capela
                            fundada em 1825. O templo atual, localizado no centro da cidade, foi construído após a
                            demolição da antiga capela em 1951 e inaugurado em 1956, tornando-se um marco da fé local e
                            abrigando uma imagem secular do santo.</p>
                        <div class="btn-social-qs">
                            <a href="#"><button><i class="bi bi-instagram"></i></button></a>
                            <a href="#"><button><i class="bi bi-facebook"></i></i></button></a>
                            <a href="#"><button><i class="bi bi-whatsapp"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- interface -->
        </section>
        <!-- quem-somos -->

        <section class="missao-visao" id="missao-visao">
            <div class="interface">
                <div class="flex">
                    <div class="missao-visao-box">
                        <h3>Missão</h3>
                        <p>Utilizar a tecnologia para promover solidariedade e facilitar doações para a comunidade.</p>
                    </div>
                    <div class="missao-visao-box">
                        <h3>Visão</h3>
                        <p>Ser um projeto que impacta positivamente a sociedade através da inovação e colaboração.</p>
                    </div>
                </div>
                <!-- flex -->
            </div>
            <!-- interface -->
        </section>
        <!-- portifolio -->

        <footer>
            <div class="interface">
                <div class="line-footer">
                    <div class="flex">
                        <div class="logo-footer">
                            <img src="images/logo.png" alt="">
                        </div>
                        <!-- logo footer -->
                        <div class="btn-social">
                            <a href="#"><button><i class="bi bi-instagram"></i></button></a>
                            <a href="#"><button><i class="bi bi-facebook"></i></i></button></a>
                            <a href="#"><button><i class="bi bi-whatsapp"></i></button></a>
                        </div>
                        <!-- btn social -->
                    </div>
                    <!-- flex -->
                </div>
                <!-- line-footer -->
                <div class="line-footer borda">
                    <p><i class="bi bi-envelope"></i> <a href="mailto:teste@gmail.com">teste@gmail.com</a></p>
                </div>
                <!-- line-footer -->
            </div>
            <!-- interface -->
        </footer>

    </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</html>