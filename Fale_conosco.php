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
        echo("<script>alert('$msg_erro'); location.href='Fale_conosco.php';</script>");
    }
    
}


//Estabelece a conexão com o DB
$conexao = mysqli_connect('localhost','root','bcd127', 'db_padaria');

$nome = "";
$telefone = "";
$celular = "";
$email = "";
$homepage = "";
$linkfacebook = "";
$sugestaocritica = "";
$informacao = "";
$sexo = "";
$profissao = "";

if (isset($_POST['btnenviar'])) {
    $nome = $_POST['txtnome'];
    $telefone = $_POST['txttelefone'];
    $celular = $_POST['txtcelular'];
    $email = $_POST['txtemail'];
    $homepage = $_POST['txthomepage'];
    $linkfacebook = $_POST['txtlinkfacebook'];
    $sugestaocritica = $_POST['txtsugestaocritica'];
    $informacao = $_POST['txtinformacao'];
    $sexo = $_POST['rdosexo'];
    $profissao = $_POST['txtprofissao'];
    
    $sql = "INSERT INTO tbl_fale_conosco                       (nome,telefone,celular,email,home_page,
    link_facebook, sugestao_critica, informacao, sexo, profissao)
            VALUES ('".$nome."', '".$telefone."', '".$celular."', '".$email."', '".$homepage."', '".$linkfacebook."', '".$sugestaocritica."', '".$informacao."', '".$sexo."', '".$profissao."')";
    
    
    //Executa o script no BD
    mysqli_query($conexao, $sql);
    
    //Redireciona para uma nova página
    header('location:Fale_conosco.php');

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
            function validar(caracter, blockType) {
                caracter.target.style="border:0px;"
                if (window.event) {
                    var letra = caracter.charCode;
                } else {
                    var letra = caracter.which;
                }
                
                if (blockType=='caracter') {
                    if (letra<48 || letra>57) {
                        if (letra != 8 && letra != 32 && letra != 40 && letra != 41 && letra != 45) {
                            caracter.target.style="border: solid 2px red; box-shadow: 0px 0px 10px red;"
                            return false;
                        }
                    }
                } else if (blockType=='number') {
                    if (letra>=48 && letra<=57) {
                        caracter.target.style="border: solid 2px red; box-shadow: 0px 0px 10px red;"
                        return false;
                    }
                }
                
            }
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
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.mask.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="modal">
                
            </div>
        </div>
        <header>
            <form name="frmlogin" method="post" action="Fale_conosco.php">
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
        <div id="content_fale_conosco">
            
            <form name="frmfaleconosco" method="post" action="Fale_conosco.php" style="margin-bottom:40px;">
                <div id="panel">
                    <div id="title_fale_conosco">
                        Fale Conosco
                    </div>
                    <div id="pos_title">
                        <div class="item_cadastro_text">
                            <div class="title_cadastro">
                                Nome:*
                            </div>
                            <div class="item_cadastro">
                                <input type="text" name="txtnome" class="caixa" required placeholder="Ex: Padoka" onkeypress="return validar(event,'number')">
                            </div>
                        </div>
                        <div class="item_cadastro_text">
                            <div class="title_cadastro">
                                Telefone:
                            </div>
                            <div class="item_cadastro">
                                <input type="text" name="txttelefone" class="caixa" id="txttelefone" placeholder="Ex: (11)0000-0000" onkeypress="return validar(event, 'caracter')" title="Digitar conforme exemplo!">
                                <script type="text/javascript">$("#txttelefone").mask("(00) 0000-0000")</script>
                            </div>
                        </div>
                        <div class="item_cadastro_text">
                            <div class="title_cadastro">
                                Celular:*
                            </div>
                            <div class="item_cadastro">
                                <input type="text" name="txtcelular" class="caixa" id="txtcelular" required placeholder="Ex: (11)90000-0000" onkeypress="return validar(event, 'caracter')" >
                                <script type="text/javascript">$("#txtcelular").mask("(00) 90000-0000")</script>
                            </div>
                        </div>
                        <div class="item_cadastro_text">
                            <div class="title_cadastro">
                                E-mail:*
                            </div>
                            <div class="item_cadastro">
                                <input type="email" name="txtemail" class="caixa" placeholder="Ex: padoka@padoka.com" required>
                            </div>
                        </div>
                        <div class="item_cadastro_text">
                            <div class="title_cadastro">
                                Home Page:
                            </div>
                            <div class="item_cadastro">
                                <input type="url" name="txthomepage" class="caixa" placeholder="Ex: www.padoka.com">
                            </div>
                        </div>
                        <div class="item_cadastro_text">
                            <div class="title_cadastro">
                                Link no facebook:
                            </div>
                            <div class="item_cadastro">
                                <input type="url" name="txtlinkfacebook" class="caixa" placeholder="Ex: www.facebook.com/padoka">
                            </div>
                        </div>
                        <div class="item_cadastro_textarea">
                            <div class="title_cadastro">
                                Sugestões/críticas:
                            </div>
                            <div class="item_caixa_textarea">
                                <textarea class="caixa_textarea" name="txtsugestaocritica" placeholder="Ex: A padaria Padoka Hill Valley..."></textarea>
                            </div>
                        </div>
                        <div class="item_cadastro_textarea">
                            <div class="title_cadastro">
                                Informações de produtos:
                            </div>
                            <div class="item_caixa_textarea">
                                <textarea class="caixa_textarea" name="txtinformacao" placeholder="Ex: Gostaria de saber sobre o produto..."></textarea>
                            </div>
                        </div>
                        <div class="item_cadastro_text">
                            <div class="title_cadastro">
                                Sexo:*
                            </div>
                            <div class="item_cadastro">
                                <div class="radio"><input type="radio" name="rdosexo" value="F" required class="radio_button">Feminino</div>
                                <div class="radio"><input type="radio" name="rdosexo" value="M" required class="radio_button">Masculino</div>
                            </div>
                        </div>
                        <div class="item_cadastro_text">
                            <div class="title_cadastro">
                                Profissão:*
                            </div>
                            <div class="item_cadastro">
                                <input type="text" name="txtprofissao" class="caixa" required placeholder="Ex: Padeiro" onkeypress="return validar(event,'number')">
                            </div>
                        </div>
                        <div id="botoes">
                            <input type="submit" name="btnenviar" value="ENVIAR" class="botao">
                            <input type="reset" name="btnlimpar" value="LIMPAR" class="botao" id="botao_limpar">
                        </div>
                    </div>
                </div>
            </form>
            <div id="text_contato">
                Você pode utilizar o fomulário acima para nos enviar sugestões, críticas, comentários, etc.
                <p>Se preferir pode entrar em contato por outros meios</p>
                <p>+55 11 4002-8922</p>
                <p>+55 21 8922-4002</p>
                padoka.hill.valley@outlook.com
            </div>
        </div>
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