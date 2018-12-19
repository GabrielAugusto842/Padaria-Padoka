<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$conexao = require_once("conexao.php");

$conteudo = "";
$fale_conosco = "";
$produtos = "";
$usuario = "";

$id_nivel = $_SESSION['login']['id_nivel'];
$sql = "SELECT * FROM tbl_nivel WHERE id_nivel = ".$id_nivel;
$select = mysqli_query($conexao, $sql);
if ($rsNivel = mysqli_fetch_array($select)){
    $conteudo = $rsNivel['conteudo'];
    $fale_conosco = $rsNivel['fale_conosco'];
    $produtos = $rsNivel['produtos'];
    $usuario = $rsNivel['usuario'];
}

?>

<!DOCTYPE>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <main>
            <header>
                <div id="titulo_header">
                    <div id="titulo_cms">
                        <span style="font-size:36px; font-weight: bold;">CMS</span> - Sistema de Gerenciamento do Site
                    </div>
                </div>
                <div id="div_image_header">
                    <div id="image_header">
                        <a href="home.php">
                            <img src="imagens/padaria2.png" alt="Logo da Padaria" id="img_header">
                        </a>
                    </div>
                </div>
            </header>
            <div id="menu">
                <div id="div_item_menu">
                    <a href="conteudo.php" class="link_menu">
                        <?php
                        if ($conteudo == 1){
                        ?>
                        <div class="item_menu">
                            <div class="image_item_menu">
                                <img src="imagens/conteudo.png" alt="Página de usuários" class="img_menu">
                            </div>
                            <div class="text_item_menu">
                                Admin. Conteúdo
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </a>
                    <a href="fale_conosco.php" class="link_menu">
                        <?php
                        if ($fale_conosco == 1){
                        ?>
                        <div class="item_menu">
                            <div class="image_item_menu">
                                <img src="imagens/fale_conosco.png" alt="Página de usuários" class="img_menu">
                            </div>
                            <div class="text_item_menu">
                                Admin. Fale Conosco
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </a>
                    <a href="administracao_produto.php" class="link_menu">
                        <?php
                        if ($produtos == 1){
                        ?>
                        <div class="item_menu">
                            <div class="image_item_menu">
                                <img src="imagens/produtos.png" alt="Página de usuários" class="img_menu">
                            </div>
                            <div class="text_item_menu">
                                Admin. Produtos
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </a>
                    <a href="usuario_nivel.php" class="link_menu">
                        <?php
                        if ($usuario == 1){
                        ?>
                        <div class="item_menu">
                            <div class="image_item_menu">
                                <img src="imagens/usuario.png" alt="Página de usuários" class="img_menu">
                            </div>
                            <div class="text_item_menu">
                                Admin. Usuários
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </a>
                </div>
                <div id="usuario_menu">
                    <div id="nome_usuario">
                        Bem-vindo, <?php echo($_SESSION['login']['nome']) ?>
                    </div>
                    <div id="div_logout">
                        <a href="logout.php" id="link_logout">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
            <div id="content_conteudo">
                <div class="divisao_div_conteudo">
                    <div class="item_conteudo">
                        <a href="adm_slider.php" class="link_menu">
                            <div class="image_conteudo">
                                 <img src="imagens/home.png" alt="Home" class="icone_img">
                            </div>
                            <div class="label_conteudo">
                                Home - slider
                            </div>
                        </a>
                    </div>
                    <div class="item_conteudo">
                        <a href="adm_promocoes.php" class="link_menu">
                            <div class="image_conteudo">
                                 <img src="imagens/promocao.png" alt="Promoções" class="icone_img">
                            </div>
                            <div class="label_conteudo">
                                Promoções
                            </div>
                        </a>
                    </div>
                    <div class="item_conteudo">
                        <a href="adm_sobre.php" class="link_menu">
                            <div class="image_conteudo">
                                 <img src="imagens/sobre.png" alt="Sobre" class="icone_img">
                            </div>
                            <div class="label_conteudo">
                                Sobre
                            </div>
                        </a>
                    </div>
                </div>
                <div class="divisao_div_conteudo">
                    <div class="item_conteudo">
                        <a href="adm_nossas_lojas.php" class="link_menu">
                            <div class="image_conteudo">
                                 <img src="imagens/nossas_lojas.png" alt="Nossas lojas" class="icone_img">
                            </div>
                            <div class="label_conteudo">
                               Nossas lojas
                            </div>
                        </a>
                    </div>
                    <div class="item_conteudo">
                        <a href="adm_produto_mes.php" class="link_menu">
                            <div class="image_conteudo">
                                 <img src="imagens/produto_mes.png" alt="Produto do Mês" class="icone_img">
                            </div>
                            <div class="label_conteudo">
                                Produto do mês
                            </div>
                        </a>
                    </div>
                    <div class="item_conteudo">
                        <a href="adm_ambientes.php" class="link_menu">
                            <div class="image_conteudo">
                                 <img src="imagens/ambientes.png" alt="Ambientes" class="icone_img">
                            </div>
                            <div class="label_conteudo">
                                Ambientes
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>