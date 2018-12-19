<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$id = "";
$id_categoria = "";
$nome_categoria = "";
$botao = "CADASTRAR";
$total_clique = "";
$porcetagem = "";
$clique = "";

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

$sql = "SELECT sum(clique) AS total_clique FROM tbl_produto";
$select = mysqli_query($conexao, $sql);
if ($rsClique = mysqli_fetch_array($select)){
    $total_clique = $rsClique['total_clique'];
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
            <div id="content_estatisticas">
                <div id="title_estatisticas">
                    Estatísticas dos Produtos mais clicados
                </div>
                <div id="div_grafico">
                    <?php
                    $sql = "SELECT nome_produto, clique FROM tbl_produto ORDER BY clique desc limit 5";
                    $select = mysqli_query($conexao, $sql);
                    $cores = ['rgb(237, 28, 36)', 'rgb(34, 177, 76)', 'rgb(255, 242, 0)', 'rgb(0, 162, 232)', 'rgb(163, 73, 164)'];
                    $cont = 0;
                    while ($rsMaisClicados = mysqli_fetch_array($select)){
                        $nome = $rsMaisClicados['nome_produto'];
                        $clique = $rsMaisClicados['clique'];
                        $cor = $cores[$cont];
                        $porcetagem = ($clique * 100 / $total_clique)."%";
                    ?>
                    <div class="faixa_grafico">
                        <div class="nome_produto_grafico" style="background-color:<?php echo($cor); ?>">
                            <?php echo($nome) ?> (<?php echo($clique) ?>)
                        </div>
                        <div class="grafico">
                            <div class="linha_grafico" style="background-color: <?php echo($cor) ?>; width: <?php echo($porcetagem) ?>">
                                
                            </div>
                        </div>
                    </div>
                    <?php
                        $cont++;
                    }
                    ?>
                    <div id="linha_inferior_grafico">
                        
                    </div>
                </div>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>