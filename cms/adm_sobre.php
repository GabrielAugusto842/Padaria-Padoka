<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$texto = "";
$imagem = "";
$status = 0;

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
    if ($modo == "excluir"){
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_sobre where id_sobre=".$id;
        mysqli_query($conexao, $sql);
        header("location:adm_sobre.php");
    }
}

if (isset($_GET['status'])){
    $status = $_GET['status'];
    $id_sobre = $_GET['id'];
    if ($status == 1) {
        $status = 0;
    } else if ($status == 0) {
        $status = 1;
    }
    $sql = "UPDATE tbl_sobre set status='".$status."' where id_sobre='".$id_sobre."'";
    mysqli_query($conexao, $sql);
    header("location:adm_sobre.php");
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
            <div id="content_adm_sobre">
                <div id="administracao_conteudo">
                    <div id="title_administracao">
                        Administração Sobre
                    </div>
                    <div id="div_adicionar_sobre">
                        <a href="adicionar_sobre.php">
                            <img src="imagens/add.png" alt="Adicionar ambiente">
                        </a>
                    </div>
                </div>
                <div id="div_table_sobre">
                    <div id="table_sobre">
                        <div id="titulos_tabela_sobre">
                            <div id="imagem_sobre">
                                Imagem
                            </div>
                            <div id="texto_sobre">
                                Texto
                            </div>
                            <div id="itens_tabela_sobre">
                                Funções
                            </div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM tbl_sobre";
                        $select = mysqli_query($conexao, $sql);
                        $cont = 0;
                        while ($rsSobre = mysqli_fetch_array($select)){
                            if ($cont % 2 == 0) {
                                $cor = "#ffd993";
                            } else {
                                $cor = "#ffffff";
                            }
                            $foto = $rsSobre['imagem'];
                        
                        ?>
                        <div id="valores_tabela_sobre">
                            <div id="valor_imagem_sobre" style="background-color:<?php echo($cor)?>">
                                <img src="<?php echo($foto) ?>" alt="Imagem sobre" class="img_sobre">
                            </div>
                            <div id="valor_texto_sobre" style="background-color:<?php echo($cor)?>">
                                <?php echo($rsSobre['texto']) ?>
                            </div>
                            <div id="valor_itens_tabela_sobre" style="background-color:<?php echo($cor)?>">
                                <div class="icone_funcao">
                                    <a href="adm_sobre.php?status=<?php echo($rsSobre['status'])?>&id=<?php echo($rsSobre['id_sobre'])?>">
                                    <?php
                                    if ($rsSobre['status']==1){
                                    ?>
                                        <img src="imagens/active.png" alt="desativar informação sobre" class="icone" id="img_desativar">
                                        <?php
                                    } else if($rsSobre['status']==0) {
                                    ?>
                                        <img src="imagens/disable.png" alt="ativar informação sobre" class="icone" id="img_ativar">
                                    <?php
                                    }
                                    ?>
                                    </a>
                                </div>
                                <div class="icone_funcao">
                                    <a href="adicionar_sobre.php?modo=editar&id=<?php echo($rsSobre['id_sobre'])?>">
                                        <img src="imagens/edit.png" alt="alterar" class="icone">
                                    </a>
                                </div>
                                <div class="icone_funcao">
                                    <a href="adm_sobre.php?modo=excluir&id=<?php echo($rsSobre['id_sobre'])?>" onclick="return confirm('Deseja realmente excluir a informação da página sobre?')">
                                        <img src="imagens/delete.png" alt="deletar" class="icone">
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