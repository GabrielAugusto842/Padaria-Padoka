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
    if ($modo == "excluir"){
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_lojas where id_loja=".$id;
        mysqli_query($conexao, $sql);
        header("location:adm_nossas_lojas.php");
    }
}

if (isset($_GET['status'])){
    $status = $_GET['status'];
    $id_loja = $_GET['id'];
    if ($status == 1) {
        $status = 0;
    } else if ($status == 0) {
        $status = 1;
    }
    $sql = "UPDATE tbl_lojas set status='".$status."' where id_loja='".$id_loja."'";
    mysqli_query($conexao, $sql);
    header("location:adm_nossas_lojas.php");
}

?>

<!DOCTYPE>

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
            <div id="content_adm_lojas">
                <div id="administracao_conteudo">
                    <div id="title_administracao">
                        Administração Nossas lojas
                    </div>
                    <div id="div_adicionar_loja">
                        <a href="adicionar_loja.php">
                            <img src="imagens/add.png" alt="Adicionar ambiente">
                        </a>
                    </div>
                </div>
                <div id="div_table_loja">
                    <div id="table_loja">
                        <div id="titulos_tabela_loja">
                            <div id="cidade_loja">
                                Cidade
                            </div>
                            <div id="logradouro_loja">
                                Logradouro
                            </div>
                            <div id="complemento_loja">
                                Nº
                            </div>
                            <div id="bairro_loja">
                                Bairro
                            </div>
                            <div id="telefone_loja">
                                Telefone
                            </div>
                            <div id="itens_tabela_loja">
                                Funções
                            </div>
                        </div>
                        <?php
                        
                        $sql = "SELECT * FROM tbl_lojas";
                        $select = mysqli_query($conexao, $sql);
                        $cont = 0;
                        while ($rsLoja = mysqli_fetch_array($select)){
                            if($cont % 2 == 0){
                                $cor = "#ffd993";
                            } else {
                                $cor = "#ffffff";
                            }
                        ?>
                        <div id="valores_tabela_loja">
                            <div id="valor_cidade_loja" style="background-color:<?php echo($cor)?>;">
                                <?php echo($rsLoja['cidade']); ?>
                            </div>
                            <div id="valor_logradouro_loja" style="background-color:<?php echo($cor)?>;">
                                <?php echo($rsLoja['logradouro']); ?>
                            </div>
                            <div id="valor_complemento_loja" style="background-color:<?php echo($cor)?>;">
                                <?php echo($rsLoja['numero']); ?>
                            </div>
                            <div id="valor_bairro_loja" style="background-color:<?php echo($cor)?>;">
                                <?php echo($rsLoja['bairro']); ?>
                            </div>
                            <div id="valor_telefone_loja" style="background-color:<?php echo($cor)?>;">
                                <?php echo($rsLoja['telefone1']); ?>
                                <?php echo($rsLoja['telefone2']); ?>
                            </div>
                            <div id="valor_itens_tabela_loja" style="background-color:<?php echo($cor)?>;">
                                <div class="icone_funcao_loja">
                                    <a href="adm_nossas_lojas.php?status=<?php echo($rsLoja['status'])?>&id=<?php echo($rsLoja['id_loja'])?>">
                                        <?php
                                    if ($rsLoja['status']==1){
                                    ?>
                                        <img src="imagens/active.png" alt="desativar Loja" class="icone" id="img_desativar">
                                        <?php
                                    } else if($rsLoja['status']==0) {
                                    ?>
                                        <img src="imagens/disable.png" alt="ativar Loja" class="icone" id="img_ativar">
                                    <?php
                                    }
                                    ?>
                                    </a>
                                </div>
                                <div class="icone_funcao_loja">
                                    <a href="adicionar_loja.php?modo=editar&id=<?php echo($rsLoja['id_loja'])?>">
                                        <img src="imagens/edit.png" alt="deletar" class="icone">
                                    </a>
                                </div>
                                <div class="icone_funcao_loja">
                                    <a href="adm_nossas_lojas.php?modo=excluir&id=<?php echo($rsLoja['id_loja'])?>" onclick="return confirm('Deseja realmente excluir a Loja?')">
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