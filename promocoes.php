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
        echo("<script>alert('$msg_erro'); location.href='promocoes.php';</script>");
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
            <form name="frmlogin" method="post" action="promocoes.php">
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
        <section id="content_promocoes">
            <div class="titulo_pagina">
                Promoções
            </div>
            <?php
            $sql = "SELECT p.imagem as imagem, p.nome_produto as nome, p.descricao as descricao, p.preco as preco, pr.* from tbl_produto as p inner join tbl_promocao as pr on p.id_produto = pr.id_produto WHERE pr.status=1;";
            $select = mysqli_query($conexao, $sql);
            while ($rsPromocao = mysqli_fetch_array($select)){
                $imagem = $rsPromocao['imagem'];
                $nome = $rsPromocao['nome'];
                $descricao = $rsPromocao['descricao'];
                $preco_promocao = $rsPromocao['preco'];
                $preco_antigo = str_replace(".", ",", $preco_promocao);
                $preco = (float) $preco_antigo;
                $desconto = floatval(intval($rsPromocao['desconto']));
                $valor_desconto = $preco - $preco*$desconto/100;
                $novo_valor = number_format($valor_desconto, 2, ",", "");
            ?>
            <div class="produtos_promocao">
                <div class="image_promocao">
                    <img src="cms/<?php echo($imagem) ?>" alt="Imagem Promoção" class="img_promocao">
                </div>
                <div class="informacoes_promocao">
                    <div class="titulo_promocao">
                        <?php echo($nome) ?>
                    </div>
                    <div class="descricao_promocao">
                        <?php echo($descricao) ?>
                    </div>
                    <div class="preco_promocao">
                        <div class="preco_promocao_antigo">
                            De: <span style="text-decoration: line-through;">R$<?php echo($preco_antigo) ?></span>
                        </div>
                        <div class="preco_promocao_novo">
                            Por: R$<?php echo($novo_valor) ?>
                        </div> 
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
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