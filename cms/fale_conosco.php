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

if(isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if($modo = "excluir"){
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_fale_conosco WHERE id=".$id;
        mysqli_query($conexao, $sql);
        header("location:fale_conosco.php");
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
                    url: "modal_fale_conosco.php",
                    data: {id:idItem},
                    success: function(dados) {
                        $(".modal").html(dados);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="modal">
                
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
                    
                </div>
                <div class="button">
                    <a href="fale_conosco.php">
                        <img src="imagens/reload.png" alt="atualizar" title="Atualizar a tabela">
                    </a>
                </div>
            </div>
            <div id="content_fale_conosco">
                <form name="frm_fale_conosco" action="fale_conosco.php" method="post">
                    <div id="table">
                        <div id="titulos_tabela">
                            <div class="campo_tabela">
                                Nome
                            </div>
                            <div class="campo_tabela">
                                E-mail
                            </div>
                            <div class="campo_tabela">
                                Sugestão/Crítica
                            </div>
                            <div class="item_tabela">
                                Visualizar
                            </div>
                            <div class="segundo_item_tabela">
                                Excluir
                            </div>
                        </div>
                        <?php
                        $sql = "select * from tbl_fale_conosco order by id desc";
                        $resultado = mysqli_query($conexao, $sql);
                        $cont = 0;
                        while ($rsSugestao = mysqli_fetch_array($resultado)) {
                            if ($cont % 2 == 0) {
                                $cor = "#ffd993";
                            } else {
                                $cor = "#ffffff";
                            }
                        ?>
                            <div id="valores_tabela">
                                <div class="campo_valor" style="background-color:<?php echo($cor)?>;">
                                    <?php echo($rsSugestao['nome'])?>
                                </div>
                                <div class="campo_valor" style="background-color:<?php echo($cor)?>;">
                                    <?php echo($rsSugestao['email'])?>
                                </div>
                                <div class="campo_sugestao" style="background-color:<?php echo($cor)?>;">
                                    <?php echo($rsSugestao['sugestao_critica'])?>
                                </div>
                                <div class="item_valor" style="background-color:<?php echo($cor)?>;">
                                    <img src="imagens/look.png" alt="visualizar sugestão" id="icone_visualizar" class="visualizar" onclick="modal(<?php echo($rsSugestao['id'])?>);">
                                </div>
                                <div class="segundo_item_valor" style="background-color:<?php echo($cor)?>;">
                                    <a href="fale_conosco.php?modo=excluir&id=<?php echo($rsSugestao['id'])?>" onclick="return confirm('Deseja realmente excluir a sugestão de clientes?')">
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