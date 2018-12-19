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

if (isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if ($modo == "excluir"){
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_promocao where id_promocao=".$id;
        mysqli_query($conexao, $sql);
        header("location: adm_promocoes.php");
    }
}

if (isset($_GET['status'])){
    $status = $_GET['status'];//1
    $id_promocao = $_GET['id_promocao'];//13
    $id_produto = $_GET['id_produto'];//3
    $sql = "UPDATE tbl_promocao set status = 0 where id_produto = ".$id_produto;
    mysqli_query($conexao, $sql);
    if ($status == 1){
        $status = 0;
    } else if ($status == 0){
        $status = 1;
    }
    $sql = "UPDATE tbl_promocao set status = ".$status." WHERE id_promocao = ".$id_promocao;
    mysqli_query($conexao, $sql);
    header("location: adm_promocoes.php");
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
            <div id="content_adm_promocao">
                <div id="administracao_conteudo">
                    <div id="title_administracao">
                        Administração de Promoções
                    </div>
                    <div id="div_adicionar_promocao">
                        <a href="adicionar_promocao.php">
                            <img src="imagens/add.png" alt="Adicionar ambiente">
                        </a>
                    </div>
                </div>
                <div id="div_table_promocao">
                    <div id="table_promocao">
                        <div id="titulos_tabela_promocao">
                            <div id="imagem_promocao">
                                Imagem
                            </div>
                            <div id="nome_promocao">
                                Nome
                            </div>
                            <div id="preco_promocao">
                                Preço
                            </div>
                            <div id="desconto_promocao">
                                Desconto
                            </div>
                            <div id="itens_tabela_promocao">
                                Funções
                            </div>
                        </div>
                        <?php
                        $sql = "SELECT p.imagem as imagem, p.nome_produto as nome, p.preco as preco, pr.* from tbl_produto as p inner join tbl_promocao as pr on p.id_produto = pr.id_produto;";
                        $select = mysqli_query($conexao, $sql);
                        $cont = 0;
                        while ($rsPromocao = mysqli_fetch_array($select)){
                            if ($cont % 2 == 0) {
                                $cor = "#ffd993";
                            } else {
                                $cor = "#ffffff";
                            }
                            $imagem = $rsPromocao['imagem'];
                            $nome = $rsPromocao['nome'];
                            $preco = $rsPromocao['preco'];
                            $desconto = $rsPromocao['desconto'];
                        ?>
                        <div id="valores_tabela_promocao" style="background-color: <?php echo($cor) ?>;">
                            <div id="valor_imagem_promocao">
                                <img src="<?php echo($imagem) ?>" alt="Imagem produto" class="img_promocao">
                            </div>
                            <div id="valor_nome_promocao">
                                <?php echo($nome) ?>
                            </div>
                            <div id="valor_preco_promocao">
                                <?php echo(str_replace(".", ",", $preco)) ?>
                            </div>
                            <div id="valor_desconto_promocao">
                                <?php echo($desconto."%") ?>
                            </div>
                            <div id="valor_itens_tabela_promocao">
                                <div class="icone_funcao_promocao">
                                    <a href="adm_promocoes.php?status=<?php echo($rsPromocao['status']) ?>&id_promocao=<?php echo($rsPromocao['id_promocao']) ?>&id_produto=<?php echo($rsPromocao['id_produto']) ?>">
                                        <?php
                                        if($rsPromocao['status']==1){
                                        ?>
                                        <img src="imagens/active.png" alt="Desativar Promoção">
                                        <?php
                                        } else if ($rsPromocao['status']==0){
                                        ?>
                                        <img src="imagens/disable.png" alt="Ativar Promoção" class="icone">
                                        <?php
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div class="icone_funcao_promocao">
                                    <a href="adicionar_promocao.php?modo=editar&id=<?php echo($rsPromocao['id_promocao']) ?>">
                                        <img src="imagens/edit.png" alt="Editar promoção" class="icone">
                                    </a>
                                </div>
                                <div class="icone_funcao_promocao">
                                    <a href="adm_promocoes.php?modo=excluir&id=<?php echo($rsPromocao['id_promocao'])?>" onclick="return confirm('Deseja realmente excluir a Promoção?')">
                                        <img src="imagens/delete.png" alt="Excluir Promoção" class="icone">
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