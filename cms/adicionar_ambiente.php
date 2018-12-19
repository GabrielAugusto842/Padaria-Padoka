<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$id_ambiente = "";
$titulo = "";
$texto = "";
$img1 = "";
$img2 = "";
$status = 0;
$botao = "CADASTRAR";

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

if (isset($_POST['txt_texto'])){
    $titulo = $_POST['txt_titulo'];
    $texto = $_POST['txt_texto'];
    $img1 = $_POST['txtfoto'];
    $img2 = $_POST['txtfoto2'];
    $status = 1;
    
    if($_GET['botao'] == "CADASTRAR"){
        $sql = "INSERT INTO tbl_ambientes (titulo_ambiente, texto_ambiente, img_1, img_2, status) VALUES ('".$titulo."', '".$texto."', '".$img1."', '".$img2."', ".$status.")";
    } else if($_GET['botao'] == "ALTERAR"){
        $sql = "UPDATE tbl_ambientes SET titulo_ambiente = '".$titulo."', texto_ambiente = '".$texto."', img_1 = '".$img1."', img_2 = '".$img2."', status = ".$status." WHERE id_ambiente = ".$_SESSION['id_ambiente'];
    }
    
    mysqli_query($conexao, $sql);
    header("location:adm_ambientes.php");
    
}

if (isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if ($modo == "editar") {
        $id = $_GET['id'];
        $_SESSION['id_ambiente'] = $id;
        $sql = "SELECT * FROM tbl_ambientes WHERE id_ambiente = ".$id;
        $select = mysqli_query($conexao, $sql);
        if($rsAmbiente = mysqli_fetch_array($select)){
            $id_ambiente = $rsAmbiente['id_ambiente'];
            $titulo = $rsAmbiente['titulo_ambiente'];
            $texto = $rsAmbiente['texto_ambiente'];
            $img1 = $rsAmbiente['img_1'];
            $img2 = $rsAmbiente['img_2'];
            $botao = "ALTERAR";
        }
    }
}

?>

<!DOCTYPE>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script>
            $(document).ready(function(){
                $("#foto1").live("change", function(){
                    $("#visualizar_foto1").html("<img src=imagens/ajax-loader.gif>");
                    setTimeout(function(){
                        $("#frmfoto").ajaxForm({
                            target:'#visualizar_foto1'
                        }).submit();
                    },2000);
                });
                $("#foto2").live("change", function(){
                    $("#visualizar_foto2").html("<img src=imagens/ajax-loader.gif>");
                    setTimeout(function(){
                        $("#frmfoto2").ajaxForm({
                            target:'#visualizar_foto2'
                        }).submit();
                    },2000);
                });
                $("#btn_ambiente").click(function(){
                    $("#visualizar_foto1").html("<img src=imagens/ajax-salvando.gif>");
                    $("#visualizar_foto2").html("<img src=imagens/ajax-salvando.gif>");
                    setTimeout(function(){
                        $("#frmcadastro").submit();
                    },2000);
                });
            });
        </script>
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
            <div id="content_add_ambiente">
                <div id="div_add_ambiente">
                    <div id="title_add_ambiente">
                        Adicionar Ambiente
                    </div>
                    <div id="voltar_para_conteudo">
                        <a href="adm_ambientes.php">
                            <img src="imagens/return.png" alt="Voltar para Administração de ambientes">
                        </a>
                    </div>
                </div>
                <div id="cadastrar_ambiente">
                    <div id="cadastro_left">
                        <form name="frmfoto" method="post" action="upload_foto1_ambiente.php" enctype="multipart/form-data" id="frmfoto">
                            <div class="label_cadastro_ambiente">
                                Imagem 1:
                            </div>
                            <div class="div_imagem_selecionada" id="visualizar_foto1">
                                <img src="<?php echo($img1) ?>" alt="Imagem Ambiente">
                                <?php
                                if($botao == "ALTERAR"){
                                    echo("<script>$('#visualizar_foto1').css('background-color', '#1f1f1f');</script>");
                                }
                                ?>
                            </div>
                            <div class="arquivo_foto">
                                <input type="file" name="fleFoto1" id="foto1">
                            </div>
                        </form>
                        <form name="frmfoto2" method="post" action="upload_foto2_ambiente.php" enctype="multipart/form-data" id="frmfoto2">
                            <div class="label_cadastro_ambiente">
                                Imagem 2:
                            </div>
                            <div class="div_imagem_selecionada" id="visualizar_foto2">
                                <img src="<?php echo($img2) ?>" alt="Imagem Ambiente">
                                <?php
                                if($botao == "ALTERAR"){
                                    echo("<script>$('#visualizar_foto2').css('background-color', '#1f1f1f');</script>");
                                }
                                ?>
                            </div>
                            <div class="arquivo_foto">
                                <input type="file" name="fleFoto2" id="foto2">
                            </div>
                        </form>
                    </div>
                    <div id="cadastro_right">
                        <form name="frmcadastro" method="post" action="adicionar_ambiente.php?botao=<?php echo($botao) ?>" id="frmcadastro">
                            <div class="label_cadastro_ambiente">
                                Titulo: 
                            </div>
                            <div id="div_input">
                                <input name="txt_titulo" type="text" id="input_titulo" value="<?php echo($titulo)?>">
                            </div>
                            <div class="label_cadastro_ambiente">
                                Texto: 
                            </div>
                            <div id="div_textarea">
                                <textarea name="txt_texto" id="textarea_ambiente"><?php echo($texto) ?></textarea>
                            </div>
                            <input type="text" name="txtfoto" id="txtfoto" value="<?php echo($img1) ?>">
                            <input type="text" name="txtfoto2" id="txtfoto2" value="<?php echo($img2) ?>">
                            <div id="btn_add_ambiente">
                                <input type="button" name="btncadastrar" value="<?php echo($botao) ?>" id="btn_ambiente">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>