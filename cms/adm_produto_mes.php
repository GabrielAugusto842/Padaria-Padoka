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

if (isset($_GET['status'])){
    $status = $_GET['status'];
    $id_produto_mes = $_GET['id'];
    $sql = "UPDATE tbl_produto set produto_mes = 0";
    mysqli_query($conexao, $sql);
    if ($status == 1) {
        $status = 0;
    } else if ($status == 0) {
        $status = 1;
    }
    $sql = "UPDATE tbl_produto set produto_mes='".$status."' where id_produto='".$id_produto_mes."'";
    mysqli_query($conexao, $sql);
    header("location:adm_produto_mes.php");
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
            <div id="content_adm_produto_mes">
                <div id="administracao_conteudo">
                    <div id="title_administracao">
                        Administração Produto do Mês
                    </div>
                </div>
                <div id="div_table_produto_mes">
                    <div id="table_produto_mes">
                        <div id="titulos_tabela_produto_mes">
                            <div id="imagem_produto_mes">
                                Imagem
                            </div>
                            <div id="nome_produto_mes">
                                Nome
                            </div>
                            <div id="descricao_produto_mes">
                                Descrição
                            </div>
                            <div id="preco_produto_mes">
                                Preço
                            </div>
                            <div id="itens_tabela_produto_mes">
                                Funções
                            </div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM tbl_produto";
                        $select = mysqli_query($conexao, $sql);
                        $cont = 0;
                        while($rs = mysqli_fetch_array($select)){
                            if ($cont % 2 == 0) {
                                $cor = "#ffd993";
                            } else {
                                $cor = "#ffffff";
                            }
                            $foto = $rs['imagem'];
                        ?>
                        <div id="valores_tabela_produto_mes">
                            <div id="valor_imagem_produto_mes" style="background-color:<?php echo($cor)?>;">
                                <img src="<?php echo($foto) ?>" class="img_produto_mes">
                            </div>
                            <div id="valor_nome_produto_mes" style="background-color:<?php echo($cor)?>;">
                                <?php echo($rs['nome_produto']) ?>
                            </div>
                            <div id="valor_descricao_produto_mes" style="background-color:<?php echo($cor)?>;">
                                <?php echo($rs['descricao']) ?>
                            </div>
                            <div id="valor_preco_produto_mes" style="background-color:<?php echo($cor)?>;">
                                R$<?php echo(str_replace(".", ",", $rs['preco'])) ?>
                            </div>
                            <div id="valor_itens_tabela_produto_mes" style="background-color:<?php echo($cor)?>;">
                                <div class="icone_funcao_produto_mes">
                                    <a href="adm_produto_mes.php?status=<?php echo($rs['produto_mes'])?>&id=<?php echo($rs['id_produto'])?>">
                                    <?php
                                    if ($rs['produto_mes']==1){
                                    ?>
                                        <img src="imagens/active.png" alt="desativar Produto do mês" class="icone" id="img_desativar">
                                        <?php
                                    } else if($rs['produto_mes']==0) {
                                    ?>
                                        <img src="imagens/disable.png" alt="ativar Produto do mês" class="icone" id="img_ativar">
                                    <?php
                                    }
                                    ?>
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