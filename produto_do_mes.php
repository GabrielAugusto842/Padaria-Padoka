<?php

session_start();

$login = false;
$usuario = "";
$login = "";

$conexao = require_once("cms/conexao.php");

if(isset($_POST['btnok'])){
    $usuario_login = $_POST['txtusuario'];
    $senha_login = $_POST['txtsenha'];

    $sql = "SELECT * FROM tbl_usuario where status = 1 AND usuario = '".$usuario_login."' AND senha = '".$senha_login."'";
    
    $select = mysqli_query($conexao, $sql);
    
    if($rsLogin = mysqli_fetch_array($select)){
        $_SESSION['login'] = $rsLogin;
        header("location:cms/home.php");
    } else {
        $msg_erro = "Usuário ou senha incorretos";
        $login = false;
    }
    
    if ($login==false){
        echo("<script>alert('$msg_erro'); location.href='produto_do_mes.php';</script>");
    }
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Padoka Hill Valley</title>
        <meta charset="utf-8">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $("#menu_mobile").click(function(){
                    $(".container").fadeIn(500);
                });
            });
            function modal() {
                $.ajax({
                    type: "POST",
                    url: "modal_menu.php",
                    success: function(dados) {
                        $(".modal").html(dados);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="modal">
                
            </div>
        </div>
       <header>
            <form name="frmlogin" method="post" action="produto_do_mes.php">
                <div id="cabecalho">
                    <div id="logo">
                        <a href="index.php">
                            <img alt="logo" src="imagens/padaria.jpg" id="image_logo">
                        </a>
                    </div>
                    <div id="menu_mobile" onclick="modal()">
                        <img src="imagens/menu.png" alt="Menu" id="img_logo">
                    </div>
                    <div id="menu">
                        <a href="index.php" class="link_menu">
                            <div class="item_menu_home">
                                Home
                            </div>
                        </a>
                        <div class="item_menu_informacoes">
                            Informações
                            <div class="sub_menu_informacoes">
                                <a href="promocoes.php" class="link_menu">
                                    <div class="item_sub_menu_informacoes">
                                        Promoções
                                    </div>
                                </a>
                                <a href="sobre.php" class="link_menu">
                                    <div class="item_sub_menu_informacoes">
                                        Sobre
                                    </div>
                                </a>
                                <a href="nossas_lojas.php">
                                    <div class="item_sub_menu_informacoes">
                                        Nossas lojas
                                    </div>
                                </a>
                                <a href="produto_do_mes.php" class="link_menu">
                                    <div class="item_sub_menu_informacoes">
                                        Produto do mês
                                    </div>
                                </a>
                            </div>
                        </div>
                        <a href="ambiente.php" class="link_menu">
                            <div class="item_menu_ambientes">
                                Ambientes
                            </div>
                        </a>
                        <a href="Fale_conosco.php" class="link_menu">
                            <div class="item_menu_fale_conosco">
                                Fale conosco
                            </div>
                        </a>
                    </div>
                    <div id="div_login">
                        <div id="login">
                            <div class="divisaologin">
                                <div class="up_login">
                                    Usuário:
                                </div>
                                <div class="down_login">
                                    <input name="txtusuario" type="text" placeholder="ex: lucas" required class="caixa_texto">
                                </div>
                            </div>
                            <div class="divisaologin">
                                <div class="up_login">
                                    Senha:
                                </div>
                                <div class="down_login">
                                    <input name="txtsenha" type="password" placeholder="******" required class="caixa_texto">
                                </div>
                            </div>
                        </div>
                        <div id="button">
                            <input type="submit" name="btnok" value="OK" id="botaook">
                        </div>

                    </div>
                </div>
            </form>
        </header>
        <div id="div_atras">
            <div id="caixa_rede_social">
                <div id="rede_social">
                    <a href="https://pt-br.facebook.com/" target="_blank">
                        <div id="face">
                            <img src="imagens/facebook.png" class="icone_rede_social" alt="Facebook">
                        </div>
                    </a>
                    <a href="https://twitter.com/login?lang=pt" target="_blank">
                        <div id="twitter">
                            <img src="imagens/twitter.png" class="icone_rede_social" alt="Twitter">
                        </div>
                    </a>
                    <a href="https://www.google.com/intl/pt/gmail/about/#" target="_blank">
                        <div id="gmail">
                            <img src="imagens/gmail.png" class="icone_rede_social" alt="Gmail">
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <section id="content_produto_mes">
            <div class="titulo_pagina">
                Produto do mês
            </div>
            <div class="produto_do_mes">
                <?php
                $sql = "SELECT * FROM tbl_produto WHERE produto_mes=1";
                $select = mysqli_query($conexao, $sql);
                while($rs = mysqli_fetch_array($select)){
                ?>
                <div class="image_produto_mes">
                    <img alt="Imagem Produto do Mês" src="cms/<?php echo($rs['imagem']) ?>" id="img_bolo">
                </div>
                <div class="informacoes_produto_mes">
                    <div class="name_produto_mes">
                        <?php echo($rs['nome_produto']) ?>
                    </div>
                    <div class="descricao_produto_mes">
                        <?php echo($rs['descricao']) ?>
                    </div>
                    <div class="preco_produto_mes">
                        R$<?php echo(str_replace(".", ",", $rs['preco'])) ?>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </section>
        <footer>
            <div id="image_footer">
                <img src="imagens/time-left.png" alt="Imagem do rodapé" id="img_footer">
            </div>
            <div id="text_footer">
                <div id="titulo_footer">
                    Contato:
                </div>
                <p>Av. Luis Carlos Berrini, nº 666</p>
                <p>+55 11 4002-8922 | +55 21 8922-4002</p>
                <p>padoka.hill.valley@outlook.com</p>
                Desenvolvido por Gabriel, estudante do SENAI Profº Vicente Amato
            </div>
            <div id="div_rede_social_responsivo">
                <div id="caixa_rede_social_responsivo">
                    <div id="rede_social_responsivo">
                        <a href="https://pt-br.facebook.com/" target="_blank">
                            <div id="face_responsivo">
                                <img src="imagens/facebook.png" class="icone_rede_social" alt="Facebook">
                            </div>
                        </a>
                        <a href="https://twitter.com/login?lang=pt" target="_blank">
                            <div id="twitter_responsivo">
                                <img src="imagens/twitter.png" class="icone_rede_social" alt="Twitter">
                            </div>
                        </a>
                        <a href="https://www.google.com/intl/pt/gmail/about/#" target="_blank">
                            <div id="gmail_responsivo">
                                <img src="imagens/gmail.png" class="icone_rede_social" alt="Gmail">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>