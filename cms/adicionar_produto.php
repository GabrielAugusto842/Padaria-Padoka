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

$nome_produto = "";
$descricao_produto = "";
$preco_produto_input = "";
$preco_produto = "";
$preco = "";
$imagem_produto = "";
$status = "";
$produto_mes = "";
$subcategoria_produto = "";
$clique = "";
$botao = "CADASTRAR";

if (isset($_POST['txtproduto'])){
    $nome_produto = $_POST['txtproduto'];
    $descricao_produto = $_POST['txtdescricao'];
    
    $preco_produto_input = $_POST['txtpreco'];
    $preco_produto = str_replace("R$", "", $preco_produto_input);
    $preco = str_replace(",", ".", $preco_produto);
    $preco = str_replace(" ", "", $preco);
    
    $imagem_produto = $_POST['txtfoto'];
    $status = 1;
    $produto_mes = 0;
    $subcategoria_produto = $_POST['slc_subcategoria'];
    $clique = 0;
    
    if($_GET['botao'] == "CADASTRAR"){
        $sql = "INSERT INTO tbl_produto (nome_produto, descricao, preco, imagem, status, produto_mes, id_subcategoria, clique)
        VALUES ('".$nome_produto."', '".$descricao_produto."', '".$preco."', '".$imagem_produto."', ".$status.", ".$produto_mes.", ".$subcategoria_produto.", ".$clique.")";
    } else if ($_GET['botao'] == "ALTERAR") {
        $sql = "UPDATE tbl_produto SET nome_produto = '".$nome_produto."', descricao = '".$descricao_produto."', preco = '".$preco."', imagem = '".$imagem_produto."', status = ".$status.", produto_mes = ".$produto_mes.", id_subcategoria = ".$subcategoria_produto." WHERE id_produto = ".$_SESSION['id_produto'];
    }
    
    mysqli_query($conexao, $sql);
    header("location: adm_produto.php");
    
}

if(isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if ($modo == "editar"){
        $id = $_GET['id'];
        $_SESSION['id_produto'] = $id;
        $sql = "SELECT * FROM tbl_produto WHERE id_produto=".$id;
        $select = mysqli_query($conexao, $sql);
        if ($rsProduto = mysqli_fetch_array($select)){
            $nome_produto = $rsProduto['nome_produto'];
            $descricao_produto = $rsProduto['descricao'];
            $preco_produto = $rsProduto['preco'];
            $preco = "R$ ".str_replace(".", ",", $preco_produto);
            $imagem_produto = $rsProduto['imagem'];
            $subcategoria_produto = $rsProduto['id_subcategoria'];
            $botao = "ALTERAR";
        }
    }
}

?>

<!DOCTYPE html>
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
                $("#btn_produto").click(function(){
                    $("#visualizar_foto").html("<img src=imagens/ajax-salvando.gif>");
                    setTimeout(function(){
                        $("#frmproduto").submit();
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
            <div id="content_add_produto">
                <div id="div_add_produto">
                    <div id="title_add_produto">
                        Adicionar Produto
                    </div>
                    <div id="voltar_para_adm_produto">
                        <a href="adm_produto.php">
                            <img src="imagens/return.png" alt="Voltar para Administração de Produtos">
                        </a>
                    </div>
                </div>
                <div id="cadastrar_produto">
                    <form name="frmfoto" method="post" action="upload_foto_produto.php" enctype="multipart/form-data" id="frmfoto">
                        <div class="label_cadastro_produto">
                            Imagem: 
                        </div>
                        <div class="div_imagem_selecionada_produto" id="visualizar_foto">
                            <img src="<?php echo($imagem_produto) ?>" alt="Imagem Produto">
                            <?php
                            if ($botao == "ALTERAR"){
                                echo("<script>$('#visualizar_foto').css('background-color', '#1f1f1f');</script>");
                            }
                            ?>
                        </div>
                        <div class="arquivo_foto_produto">
                            <input type="file" name="fleFoto" id="foto">
                        </div>
                    </form>
                    <form name="frmcadastro" method="post" action="adicionar_produto.php?botao=<?php echo($botao) ?>" id="frmproduto">
                        <div class="label_cadastro_produto">
                            Nome do produto:
                        </div>
                        <div class="div_input_cadastro_produto">
                            <input name="txtproduto" type="text" class="input_produto" placeholder="Ex: pão" value="<?php echo($nome_produto) ?>">
                        </div>
                        <div class="label_cadastro_produto">
                            Descrição: 
                        </div>
                        <div id="div_textarea_produto">
                            <textarea name="txtdescricao" id="textarea_produto" placeholder="Ex: Esse produto é..."><?php echo($descricao_produto) ?></textarea>
                        </div>
                        <div class="label_cadastro_produto">
                            Subcategoria:
                        </div>
                        <div class="div_input_cadastro_produto">
                            <select name="slc_subcategoria" id="select_produto_subcategoria">
                                <option>Selecione...</option>
                                <?php
                                $sql = "SELECT * FROM tbl_subcategoria";
                                $select = mysqli_query($conexao, $sql);
                                while($rsProduto = mysqli_fetch_array($select)){
                                    $id = $rsProduto['id_subcategoria'];
                                    $nome = $rsProduto['nome_subcategoria'];
                                    if ($subcategoria_produto == $id){
                                        $ref = "selected";
                                    } else {
                                        $ref = "";
                                    }
                                ?>
                                <option value="<?php echo($id) ?>" <?php echo($ref) ?>><?php echo($nome) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="label_cadastro_produto">
                            Preço:
                        </div>
                        <div class="div_input_cadastro_produto">
                            <input name="txtpreco" type="text" class="input_produto" placeholder="Ex: R$ 20,00" value="<?php echo($preco) ?>">
                        </div>
                        <input name="txtfoto" id="txtfoto" type="text" value="<?php echo($imagem_produto) ?>">
                        <div id="div_btn_produto">
                            <input name="btncadastro" type="button" value="<?php echo($botao) ?>" id="btn_produto">
                        </div>
                    </form>
                </div>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>