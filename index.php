<?php

session_start();

$login = true;
$usuario = "";
$login = "";
$select = "";

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
        echo("<script>alert('$msg_erro'); location.href='index.php';</script>");
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
                $(".detalhes_produto").click(function(){
                    $(".container2").fadeIn(500);
                });
                $("#menu_lateral_mobile").click(function(){
                    $(".container3").fadeIn(500);
                });
                $(".detalhes_produto_mobile").click(function(){
                    $(".container4").fadeIn(500);
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
            function modal_lateral() {
                $.ajax({
                    type: "POST",
                    url: "modal_menu_lateral.php",
                    success: function(dados) {
                        $(".modal3").html(dados);
                    }
                });
            }
            function modal_produto(idItem){
                $.ajax({
                    type: "POST",
                    url: "modal_produto.php",
                    data: {id:idItem},
                    success: function(dados) {
                        $(".modal2").html(dados);
                    }
                });
            }
            function modal_produto_mobile(idItem){
                $.ajax({
                    type: "POST",
                    url: "modal_produto_mobile.php",
                    data: {id:idItem},
                    success: function(dados) {
                        $(".modal4").html(dados);
                    }
                });
            }
            function abrirSubitem(id){
                $(id).slideToggle(500);
            }
        </script>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.cycle.all.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#slider ul').cycle ( {
                    fx: 'fade',
                    speed: 1000,
                    timeout: 2000,
                    prev: '#previous',
                    next: '#next',
                })
            })
        </script>
    </head>
    <body>
        <div class="container">
            <div class="modal">
                
            </div>
        </div>
        <div class="container2">
            <div class="modal2">
                
            </div>
        </div>
        <div class="container3">
            <div class="modal3">
                
            </div>
        </div>
        <div class="container4">
            <div class="modal4">
                
            </div>
        </div>
        <header>
            <form name="frmlogin" method="post" action="index.php">
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
        <section id="content">
            <section id="div_slider">
                <div id="previous">
                    <img src="imagens/seta_esquerda.png" alt="Ir para imagem da esquerda" class="img_orientation_slider">
                </div>
                <div id="slider">
                    <ul>
                        <?php
                        $sql = "SELECT * FROM tbl_slider";
                        $select = mysqli_query($conexao, $sql);
                        while ($rsSlider = mysqli_fetch_array($select)){
                            $imagem = $rsSlider['imagem'];
                        ?>
                        <li><img alt="Imagem slider" src="cms/<?php echo($imagem) ?>" class="image_slide"></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div id="div_image_slide_mobile">
                    <img src="imagens/paes.jpg" class="image_slide_mobile" alt="Imagem Padaria">
                </div>
                <div id="next">
                    <img src="imagens/seta_direita.png" alt="Ir para imagem da direita" class="img_orientation_slider">
                </div>
            </section>
            <section id="pos_slider">
                <nav id="menu_lateral">
                    <?php
                    $sql = "SELECT * FROM tbl_categoria";
                    $select = mysqli_query($conexao, $sql);
                    while ($rsCategoria = mysqli_fetch_array($select)){
                        $id_categoria = $rsCategoria['id_categoria'];
                        $nome_categoria = $rsCategoria['nome_categoria'];
                        $id_div = "'#".$id_categoria."'";
                    ?>
                    <div class="item" onclick="abrirSubitem(<?php echo($id_div) ?>)">
                        <?php echo($nome_categoria) ?>
                        <div class="menu_subitem" id="<?php echo($id_categoria) ?>">
                            <?php
                            $sql2 = "SELECT * FROM tbl_subcategoria     WHERE id_categoria = ".$id_categoria;
                            $select2 = mysqli_query($conexao, $sql2);
                            while ($rsSubcategoria = mysqli_fetch_array($select2)){
                                $id_subcategoria = $rsSubcategoria['id_subcategoria'];
                                $nome_subcategoria = $rsSubcategoria['nome_subcategoria'];
                            ?>
                            <div class="subitem">
                                <a href="index.php?id_subcategoria=<?php echo($id_subcategoria) ?>" class="link_menu">
                                    <?php echo($nome_subcategoria) ?>
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </nav>
                <nav id="menu_lateral_mobile" onclick="modal_lateral()">
                    <img src="imagens/seta_direita.png" alt="Menu Lateral" class="img_menu_lateral">
                </nav>
                <div id="div_pesquisa_produtos">
                    <form name="frmpesquisa" action="index.php" method="get">
                        <div id="div_pesquisa">
                            <input type="text" name="txtpesquisa" id="txtpesquisa" placeholder="Busque...">
                            <input type="submit" name="btnpesquisa" id="btnpesquisa" value="">
                        </div>
                    </form>
                </div>
                <div id="produtos">
                    <?php
                    $sql = "SELECT * FROM tbl_produto WHERE status = 1 ORDER BY rand() limit 6";
                    
                    if (isset($_GET['btnpesquisa'])){
                        $busca = $_GET['txtpesquisa'];
                        $sql = "SELECT * FROM tbl_produto WHERE nome_produto like '%".$busca."%' OR descricao like '%".$busca."%' AND status = 1";
                    }
                    
                    if (isset($_GET['id_subcategoria'])){
                        $id_sub = $_GET['id_subcategoria'];
                        $sql = "SELECT * FROM tbl_produto WHERE id_subcategoria = ".$id_sub." AND status = 1";
                    }
                    
                    $select = mysqli_query($conexao, $sql);
                    while ($rsProduto = mysqli_fetch_array($select)){
                        $id_produto = $rsProduto['id_produto'];
                        
                    ?>
                    <div class="item_produto">
                        <div class="image_produto">
                            <img src="cms/<?php echo($rsProduto['imagem']) ?>" alt="coxinha" class="img_produto_home">
                        </div>
                        <div class="name_produto">
                            <?php echo($rsProduto['nome_produto']) ?>
                        </div>
                        <div class="descricao_produto">
                            <?php echo($rsProduto['descricao']) ?>
                        </div>
                        <div class="valor_produto">
                            <?php echo("R$ ".str_replace(".", ",",  $rsProduto['preco'])) ?>
                        </div>
                        <div class="detalhes_produto" onclick="modal_produto(<?php echo($id_produto) ?>)">
                            Detalhes
                        </div>
                        <div class="detalhes_produto_mobile" onclick="modal_produto_mobile(<?php echo($id_produto) ?>)">
                            Detalhes
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </section>
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