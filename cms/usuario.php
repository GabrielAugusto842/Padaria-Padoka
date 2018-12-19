<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$status = "";
$sql = "";

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

if (isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if ($modo == "excluir") {
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_usuario where id_usuario=".$id;
        mysqli_query($conexao, $sql);
        header ("location:usuario.php");
    }
}

if (isset($_GET['status'])){
    $status = $_GET['status'];
    $id_usuario = $_GET['id'];
    if ($id_usuario == 1) {
        echo("<script> alert('Você não pode desativar o administrador');</script>");
    } else {
        if ($status == 1) {
            $status = 0;
        } else if ($status == 0) {
            $status = 1;
        }
        $sql = "UPDATE tbl_usuario set status='".$status."' where id_usuario ='".$id_usuario."'";
        mysqli_query($conexao, $sql);
        header ("location:usuario.php");
    }
}

?>

<!DOCTYPE>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".visualizar").click(function(){
                    $(".container").fadeIn(500);
                });
            });
            
            function modal(idItem) {
                $.ajax({
                    type: "POST",
                    url: "modal_usuario.php",
                    data: {id:idItem},
                    success: function(dados) {
                        $(".modal_usuario").html(dados);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="modal_usuario">
                
            </div>
        </div>
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
                            <img src="imagens/padaria.jpg" alt="Logo da Padaria" id="img_header">
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
            <div id="caixa_botao">
                <div class="button">
                    <a href="usuario.php">
                        <img src="imagens/reload.png" alt="atualizar" title="Atualizar a tabela">
                    </a>
                </div>
                <div class="button">
                    <a href="cadastro_usuario.php">
                        <img src="imagens/add.png" alt="Adicionar usuário" title="Adicionar usuário">
                    </a>
                </div>
            </div>
            <div id="content_usuario">
                <form name="frm_usuario" action="usuario.php" method="post">
                    <div id="table_usuario">
                        <div id="titulos_tabela">
                            <div class="campo_tabela">
                                Usuário
                            </div>
                            <div class="campo_tabela">
                                Nível
                            </div>
                            <div class="item_tabela_usuario">
                                Status
                            </div>
                            <div class="item_tabela_usuario">
                                Visualizar
                            </div>
                            <div class="item_tabela">
                                Atualizar
                            </div>
                            <div class="segundo_item_tabela">
                                Excluir
                            </div>
                        </div>
                        <?php
                        $sql = "select u.*, n.nome as nome_nivel from tbl_usuario as u inner join tbl_nivel as n on u.id_nivel = n.id_nivel order by u.id_usuario;";
                        $resultado = mysqli_query($conexao, $sql);
                        $cont = 0;
                        while ($rsUsuario = mysqli_fetch_array($resultado)) {
                            if ($cont % 2 == 0) {
                                $cor = "#ffd993";
                            } else {
                                $cor = "#ffffff";
                            }
                        ?>
                            <div id="valores_tabela">
                                <div class="campo_valor" style="background-color:<?php echo($cor)?>;">
                                    <?php echo($rsUsuario['usuario'])?>
                                </div>
                                <div class="campo_sugestao" style="background-color:<?php echo($cor)?>;">
                                    <?php
                                        echo($rsUsuario['nome_nivel']);
                                    ?>
                                </div>
                                <a href="usuario.php?status=<?php echo($rsUsuario['status'])?>&id=<?php echo($rsUsuario['id_usuario'])?>">
                                    <div class="item_valor_usuario" style="background-color:<?php echo($cor)?>; ">
                                        <?php
                                        if ($rsUsuario['status']==1) {
                                        ?>
                                        <img src="imagens/active.png" alt="desativar usuário" class="icone" id="img_desativar">
                                        <?php
                                        } else if ($rsUsuario['status']==0){
                                        ?>
                                        <img src="imagens/disable.png" alt="ativar usuário" class="icone" id="img_ativar">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </a>
                                <div class="item_valor_usuario" style="background-color:<?php echo($cor)?>;">
                                    <img src="imagens/look.png" alt="visualizar" id="icone_visualizar" class="visualizar" onclick="modal(<?php echo($rsUsuario['id_usuario'])?>);">
                                </div>
                                <div class="item_valor" style="background-color:<?php echo($cor)?>; ">
                                    <a href="cadastro_usuario.php?modo=editar&id=<?php echo($rsUsuario['id_usuario'])?>">
                                        <img src="imagens/edit.png" alt="deletar" class="icone">
                                    </a>
                                </div>
                                <div class="segundo_item_valor" style="background-color:<?php echo($cor)?>;">
                                    <a href="usuario.php?modo=excluir&id=<?php echo($rsUsuario['id_usuario'])?>" onclick="return confirm('Deseja realmente excluir o usuário?')">
                                        <img src="imagens/delete.png" alt="deletar" class="icone">
                                    </a>
                                </div>
                            </div>
                        <?php
                            $cont++;
                        }
                        ?>
                    </div>
                </form>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>