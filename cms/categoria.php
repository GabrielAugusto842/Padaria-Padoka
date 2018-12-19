<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$id = "";
$id_categoria = "";
$nome_categoria = "";
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

if(isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if($modo == "excluir"){
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_categoria WHERE id_categoria=".$id;
        mysqli_query($conexao, $sql);
        header("location: categoria.php");
    } else if ($modo == "editar"){
        $id = $_GET['id'];
        $_SESSION['id_categoria'] = $id;
        $sql = "SELECT * FROM tbl_categoria WHERE id_categoria=".$id;
        $select = mysqli_query($conexao, $sql);
        if ($rsCategoria = mysqli_fetch_array($select)){
            $id_categoria = $rsCategoria['id_categoria'];
            $nome_categoria = $rsCategoria['nome_categoria'];
            $botao = "ALTERAR";
        }
    }
}

if(isset($_POST['btncadastrar'])){
    $nome_categoria = $_POST['txt_categoria'];
    
    if($_POST['btncadastrar']=="CADASTRAR"){
        $sql = "INSERT INTO tbl_categoria (nome_categoria) VALUES ('".$nome_categoria."')";
    } else if ($_POST['btncadastrar']=="ALTERAR"){
        $sql = "UPDATE tbl_categoria SET nome_categoria='".$nome_categoria."' WHERE id_categoria = ".$_SESSION['id_categoria'];
    }
    mysqli_query($conexao, $sql);
    header("location: categoria.php");
    
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
            <div id="content_categoria">
                <div id="title_categoria">
                    Administração de Categorias
                </div>
                <div id="cadastro_categoria">
                    <form name="frmcadastro" action="categoria.php" method="post">
                        <div id="title_cadastro_categoria">
                            Cadastro de Categoria
                        </div>
                        <div id="label_cadastro_categoria">
                            Nome da Categoria:
                        </div>
                        <div id="div_input_categoria">
                            <input type="text" name="txt_categoria" id="input_categoria" placeholder="Ex: Bebidas" value="<?php echo($nome_categoria) ?>">
                        </div>
                        <div id="div_btn_categoria">
                            <input type="submit" name="btncadastrar" value="<?php echo($botao) ?>" id="btn_categoria">
                        </div>
                    </form>
                </div>
                <div id="div_table_categoria">
                    <div id="titulos_tabela_categoria">
                        <div id="nome_categoria">
                            Nome
                        </div>
                        <div id="atualizar_categoria">
                            Atualizar
                        </div>
                        <div id="excluir_categoria">
                            Excluir
                        </div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM tbl_categoria";
                    $select = mysqli_query($conexao, $sql);
                    $cont = 0;
                    while($rsCategoria = mysqli_fetch_array($select)){
                        if ($cont % 2 == 0) {
                            $cor = "#ffd993";
                        } else {
                            $cor = "#ffffff";
                        }
                    ?>
                    <div id="valores_tabela_categoria" style="background-color:<?php echo($cor) ?>">
                        <div id="valor_nome_categoria">
                            <?php echo($rsCategoria['nome_categoria']) ?>
                        </div>
                        <div id="valor_editar_categoria">
                            <a href="categoria.php?modo=editar&id=<?php echo($rsCategoria['id_categoria'])?>">
                                <img src="imagens/edit.png" alt="Editar" class="icone">
                            </a>
                        </div>
                        <div id="valor_excluir_categoria">
                            <a href="categoria.php?modo=excluir&id=<?php echo($rsCategoria['id_categoria'])?>" onclick="return confirm('Deseja realmente excluir a Categoria?')">
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