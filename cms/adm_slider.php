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

if(isset($_POST['txtfoto'])){
    $imagem = $_POST['txtfoto'];
    $sql = "INSERT INTO tbl_slider (imagem) VALUES ('".$imagem."')";
    mysqli_query($conexao, $sql);
    header("location: adm_slider.php");
}

if (isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if ($modo == "excluir"){
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_slider WHERE id_imagem = ".$id;
        mysqli_query($conexao, $sql);
        header("location: adm_slider.php");
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
                    $("#visualizar_foto").html("<img src=imagens/ajax-loader.gif>");
                    setTimeout(function(){
                        $("#frmfoto").ajaxForm({
                            target:'#visualizar_foto'
                        }).submit();
                        $("#visualizar_foto").css("background-color", "#1f1f1f");
                    },2000);
                });
                $("#btn_slider").click(function(){
                    $("#visualizar_foto").html("<img src=imagens/ajax-salvando.gif>");
                    setTimeout(function(){
                        $("#frmslider").submit();
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
            <div id="content_slider">
                <div id="title_slider">
                    Administração do Slider
                </div>
                <div id="cadastro_imagem_slider">
                    <form name="frmfoto" method="post" action="upload_foto_slider.php" enctype="multipart/form-data" id="frmfoto">
                        <div class="label_cadastro_slider">
                            Imagem: 
                        </div>
                        <div class="div_imagem_selecionada_slider" id="visualizar_foto">
                            
                        </div>
                        <div class="arquivo_foto_slider">
                            <input type="file" name="fleFoto" id="foto">
                        </div>
                    </form>
                    <form name="frmcadastro" method="post" action="adm_slider.php" id="frmslider">
                        <input type="text" name="txtfoto" id="txtfoto">
                        <div id="div_btn_categoria">
                            <input type="button" name="btncadastrar" value="CADASTRAR" id="btn_slider">
                        </div>
                    </form>
                </div>
                <div id="div_table_slider">
                    <div id="table_slider">
                        <div id="titulos_tabela_slider">
                            <div id="imagem_slider">
                                Imagem
                            </div>
                            <div id="excluir_slider">
                                Excluir
                            </div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM tbl_slider";
                        $select = mysqli_query($conexao, $sql);
                        $cont = 0;
                        while ($rsSlider = mysqli_fetch_array($select)){
                            if ($cont % 2 == 0) {
                                $cor = "#ffd993";
                            } else {
                                $cor = "#ffffff";
                            }
                            $id_slider = $rsSlider['id_imagem'];
                            $imagem = $rsSlider['imagem'];
                        ?>
                        <div id="valores_tabela_slider" style="background-color: <?php echo($cor) ?>">
                            <div id="valor_imagem_slider">
                                <img src="<?php echo($imagem) ?>" class="img_slider">
                            </div>
                            <div id="valor_excluir_slider">
                                <div id="div_icone_excluir_slider">
                                    <a href="adm_slider.php?modo=excluir&id=<?php echo($id_slider) ?>" onclick="return confirm('Deseja excluir a imagem que aparecerá no slider?')">
                                        <img src="imagens/delete.png" alt="Excluir imagem do slider cadastrada" class="icone_slider">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                            $cont++;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>