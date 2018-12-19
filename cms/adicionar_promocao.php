<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$nome_produto = "";
$desconto = "";
$desconto_produto = "";
$status = 0;
$botao = "CADASTRAR";
$ref = "";

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

if (isset($_POST['btncadastrar'])){
    $nome_produto = $_POST['slc_produto'];
    $desconto_produto = $_POST['txtdesconto'];
    $status = 1;
    
    $desconto = str_replace("%", "", $desconto_produto);
    
    $sql = "UPDATE tbl_promocao set status = 0 where id_produto=".$nome_produto;
    mysqli_query($conexao, $sql);
    
    if($_POST['btncadastrar'] == "CADASTRAR"){
        $sql = "INSERT INTO tbl_promocao (id_produto, desconto, status) VALUES (".$nome_produto.", '".$desconto."', ".$status.")";   
    } else if ($_POST['btncadastrar'] == "ALTERAR"){
        $sql = "UPDATE tbl_promocao SET id_produto=".$nome_produto.", desconto='".$desconto."', status=".$status." WHERE id_promocao=".$_SESSION['id_promocao'];
    }
    mysqli_query($conexao, $sql);
    header("location: adm_promocoes.php");
    
}

if (isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if($modo == "editar"){
        $id = $_GET['id'];
        $_SESSION['id_promocao'] = $id;
        $sql = "SELECT * FROM tbl_promocao where id_promocao=".$id;
        $select = mysqli_query($conexao, $sql);
        if ($rsPromocao = mysqli_fetch_array($select)){
            $nome_produto = $rsPromocao['id_produto'];
            $desconto = $rsPromocao['desconto'];
            $desconto_produto = $desconto."%";
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
            <div id="content_add_promocao">
                <div id="div_add_promocao">
                    <div id="title_add_promocao">
                        Adicionar Promoção
                    </div>
                    <div id="voltar_para_conteudo">
                        <a href="adm_promocoes.php">
                            <img src="imagens/return.png" alt="Voltar para Administração de ambientes">
                        </a>
                    </div>
                </div>
                <div id="cadastrar_promocao">
                    <form name="frmcadastro" method="post" action="adicionar_promocao.php">
                        <div class="divisao_cadastro_promocao">
                            <div class="label_cadastro_promocao">
                                Produto:
                            </div>
                            <div id="div_input_promocao">
                                <select name="slc_produto" id="select_produto">
                                    <option>Selecione...</option>
                                    <?php
                                    $sql = "SELECT * FROM tbl_produto WHERE status=1";
                                    $select = mysqli_query($conexao, $sql);
                                    while($rsProduto = mysqli_fetch_array($select)){
                                        $id_produto = $rsProduto['id_produto'];
                                        $nome = $rsProduto['nome_produto'];
                                        if ($id_produto == $nome_produto){
                                            $ref = "selected";
                                        } else {
                                            $ref = "";
                                        }
                                    ?>
                                    <option value="<?php echo($id_produto); ?>" <?php echo($ref) ?>><?php echo($nome); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="divisao_desconto_promocao">
                            <div class="label_cadastro_promocao">
                                Desconto:
                            </div>  
                            <div id="div_input_promocao">
                                <input name="txtdesconto" id="input_desconto" placeholder="Ex: 20%" value="<?php echo($desconto_produto) ?>">
                            </div>
                        </div>
                        <div class="divisao_botao_promocao">
                            <input type="submit" name="btncadastrar" value="<?php echo($botao) ?>" id="btn_promocao">
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