<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$id_sobre = "";
$texto = "";
$imagem = "";
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

if(isset($_POST['txttexto'])){
    $texto = $_POST['txttexto'];
    $imagem = $_POST['txtfoto'];
    $status = 1;
    
    if($_GET['botao'] == "CADASTRAR"){
        $sql = "INSERT INTO tbl_sobre (texto, imagem, status)
        VALUES ('".$texto."', '".$imagem."', ".$status.")";
    } else if($_GET['botao'] == "ALTERAR"){
        $sql = "UPDATE tbl_sobre SET texto = '".$texto."', imagem = '".$imagem."', status = ".$status." WHERE id_sobre = ".$_SESSION['id_sobre'];
    }
    
    mysqli_query($conexao, $sql);
    header("location:adm_sobre.php");
    
}

if (isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if ($modo == "editar") {
        $id = $_GET['id'];
        $_SESSION['id_sobre'] = $id;
        $sql = "SELECT * FROM tbl_sobre WHERE id_sobre = ".$id;
        $select = mysqli_query($conexao, $sql);
        if($rsSobre = mysqli_fetch_array($select)){
            $id_sobre = $rsSobre['id_sobre'];
            $texto = $rsSobre['texto'];
            $imagem = $rsSobre['imagem'];
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
                $("#foto").live("change", function(){
                    $("#visualizar_imagem").html("<img src=imagens/ajax-loader.gif>");
                    setTimeout(function(){
                        $("#frmfoto").ajaxForm({
                            target:'#visualizar_imagem'
                        }).submit();
                        $("#visualizar_imagem").css("background-color", "#1f1f1f");
                    },2000);
                });
                $("#btn_sobre").click(function(){
                    $("#visualizar_imagem").html("<img src=imagens/ajax-salvando.gif>");
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
            <div id="content_add_sobre">
                <div id="div_add_sobre">
                    <div id="title_add_sobre">
                        Adicionar Sobre
                    </div>
                    <div id="voltar_para_conteudo">
                        <a href="adm_sobre.php">
                            <img src="imagens/return.png" alt="Voltar para Administração da página sobre">
                        </a>
                    </div>
                </div>
                <div id="cadastrar_sobre">
                    <div class="divisao_cadastro_sobre">
                        <form name="frmfoto" method="post" action="upload_foto_sobre.php" enctype="multipart/form-data" id="frmfoto">
                            <div class="label_cadastro_sobre">
                                Imagem:
                            </div>
                            <div class="div_imagem_selecionada" id="visualizar_imagem">
                                <img src="<?php echo($imagem) ?>">
                                <?php
                                if($botao == "ALTERAR"){
                                    echo("<script>$('#visualizar_imagem').css('background-color', '#1f1f1f');</script>");
                                }
                                ?>
                            </div>
                            <div class="arquivo_foto_sobre">
                                <input type="file" name="fleFoto" id="foto">
                            </div>
                        </form>
                    </div>
                    <div class="divisao_cadastro_sobre">
                        <form name="frmcadastro" method="post" action="adicionar_sobre.php?botao=<?php echo($botao) ?>" id="frmcadastro">
                            <div class="label_cadastro_sobre">
                                Texto:
                            </div>
                            <div id="div_textarea_sobre">
                                <textarea name="txttexto" id="textarea_sobre" placeholder="Digite o texto da página"><?php echo($texto) ?></textarea>
                            </div>
                            <input name="txtfoto" type="text" id="txtfoto" value="<?php echo($imagem) ?>">
                        </form>
                    </div>
                    <div id="button_sobre">
                        <input type="button" name="btncadastrar" value="<?php echo($botao)?>" id="btn_sobre">
                    </div>
                </div>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>