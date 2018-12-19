<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$id = "";
$id_subcategoria = "";
$id_categoria = "";
$nome_subcategoria = "";
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

if(isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if($modo == "excluir"){
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_subcategoria WHERE id_subcategoria=".$id;
        mysqli_query($conexao, $sql);
        header("location: subcategoria.php");
    } else if ($modo == "editar"){
        $id = $_GET['id'];
        $_SESSION['id_subcategoria'] = $id;
        $sql = "SELECT * FROM tbl_subcategoria WHERE id_subcategoria=".$id;
        $select = mysqli_query($conexao, $sql);
        if ($rsSubcategoria = mysqli_fetch_array($select)){
            $id_subcategoria = $rsSubcategoria['id_subcategoria'];
            $nome_subcategoria = $rsSubcategoria['nome_subcategoria'];
            $id_categoria = $rsSubcategoria['id_categoria'];
            $botao = "ALTERAR";
        }
    }
}

if(isset($_POST['btncadastrar'])){
    $nome_subcategoria = $_POST['txt_subcategoria'];
    $id_categoria = $_POST['slc_subcategoria'];
    
    if($_POST['btncadastrar']=="CADASTRAR"){
        $sql = "INSERT INTO tbl_subcategoria (nome_subcategoria, id_categoria) VALUES ('".$nome_subcategoria."', ".$id_categoria.")";
    } else if ($_POST['btncadastrar']=="ALTERAR"){
        $sql = "UPDATE tbl_subcategoria SET nome_subcategoria='".$nome_subcategoria."', id_categoria = ".$id_categoria." WHERE id_subcategoria = ".$_SESSION['id_subcategoria'];
    }
    mysqli_query($conexao, $sql);
    header("location: subcategoria.php");
    
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
            <div id="content_subcategoria">
                <div id="title_subcategoria">
                    Administração de Subcategorias
                </div>
                <div id="cadastro_subcategoria">
                    <form name="frmcadastro" action="subcategoria.php" method="post">
                        <div id="title_cadastro_subcategoria">
                            Cadastro de Subcategoria
                        </div>
                        <div class="label_cadastro_subcategoria">
                            Nome da Subcategoria:
                        </div>
                        <div class="div_input_subcategoria">
                            <input type="text" name="txt_subcategoria" id="input_subcategoria" placeholder="Ex: Doce de leite" value="<?php echo($nome_subcategoria) ?>">
                        </div>
                        <div class="label_cadastro_subcategoria">
                            Categoria:
                        </div>
                        <div class="div_input_subcategoria">
                            <select name="slc_subcategoria" id="select_subcategoria">
                                <option>Selecione...</option>
                                <?php
                                $sql = "SELECT * FROM tbl_categoria";
                                $select = mysqli_query($conexao, $sql);
                                while ($rs = mysqli_fetch_array($select)){
                                    $id = $rs['id_categoria'];
                                    $nome = $rs['nome_categoria'];
                                    if ($id == $id_categoria){
                                        $ref = "selected";
                                    } else {
                                        $ref = "";
                                    }
                                ?>
                                <option value="<?php echo($id) ?>" <?php echo($ref) ?> ><?php echo($nome) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div id="div_btn_subcategoria">
                            <input type="submit" name="btncadastrar" value="<?php echo($botao) ?>" id="btn_subcategoria">
                        </div>
                    </form>
                </div>
                <div id="div_table_subcategoria">
                    <div id="titulos_tabela_subcategoria">
                        <div id="nome_subcategoria">
                            Nome
                        </div>
                        <div id="nome_categoria">
                            Categoria
                        </div>
                        <div id="atualizar_subcategoria">
                            Atualizar
                        </div>
                        <div id="excluir_subcategoria">
                            Excluir
                        </div>
                    </div>
                    <?php
                    $sql = "SELECT c.nome_categoria AS nome_categoria, s.* FROM tbl_subcategoria AS s INNER JOIN tbl_categoria AS c ON s.id_categoria = c.id_categoria";
                    $select = mysqli_query($conexao, $sql);
                    $cont = 0;
                    while($rsSubcategoria = mysqli_fetch_array($select)){
                        if ($cont % 2 == 0) {
                            $cor = "#ffd993";
                        } else {
                            $cor = "#ffffff";
                        }
                    ?>
                    <div id="valores_tabela_subcategoria" style="background-color:<?php echo($cor) ?>">
                        <div id="valor_nome_subcategoria">
                            <?php echo($rsSubcategoria['nome_subcategoria']) ?>
                        </div>
                        <div id="valor_nome_categoria">
                            <?php echo($rsSubcategoria['nome_categoria']) ?>
                        </div>
                        <div id="valor_editar_subcategoria">
                            <a href="subcategoria.php?modo=editar&id=<?php echo($rsSubcategoria['id_subcategoria'])?>">
                                <img src="imagens/edit.png" alt="Editar" class="icone">
                            </a>
                        </div>
                        <div id="valor_excluir_subcategoria">
                            <a href="subcategoria.php?modo=excluir&id=<?php echo($rsSubcategoria['id_subcategoria'])?>" onclick="return confirm('Deseja realmente excluir a Subcategoria?')">
                                <img src="imagens/delete.png" alt="deletar" class="icone">
                            </a>
                        </div>
                    </div>
                    <?php
                        $cont++;
                    }
                    ?>
                </div>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>