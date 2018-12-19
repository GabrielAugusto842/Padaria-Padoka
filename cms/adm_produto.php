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
        $sql = "DELETE FROM tbl_produto WHERE id_produto = ".$id;
        mysqli_query($conexao, $sql);
        header("location: adm_produto.php");
    }
}

if (isset($_GET['status'])){
    $status = $_GET['status'];
    $id = $_GET['id'];
    if ($status == 1) {
        $status = 0;
    } else if ($status == 0) {
        $status = 1;
    }
    $sql = "UPDATE tbl_produto SET status = ".$status." WHERE id_produto = ".$id;
    mysqli_query ($conexao, $sql);
    header("location: adm_produto.php");
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
            <div id="content_adm_produto">
                <div id="administracao_conteudo">
                    <div id="title_administracao">
                        Administração de Produtos
                    </div>
                    <div id="div_adicionar_produto">
                        <a href="adicionar_produto.php">
                            <img src="imagens/add.png" alt="Adicionar produto">
                        </a>
                    </div>
                </div>
                <div id="div_table_produto">
                    <div id="table_produto">
                        <div id="titulos_tabela_produto">
                            <div id="imagem_produto">
                                Imagem
                            </div>
                            <div id="nome_produto">
                                Nome
                            </div>
                            <div id="preco_produto">
                                Preço
                            </div>
                            <div id="subcategoria_produto">
                                Subcategoria
                            </div>
                            <div id="itens_tabela_produto">
                                Funções
                            </div>
                        </div>
                        <?php
                        $sql = "SELECT p.*, s.nome_subcategoria AS subcategoria FROM tbl_produto AS p INNER JOIN tbl_subcategoria AS s ON p.id_subcategoria = s.id_subcategoria";
                        $select = mysqli_query($conexao, $sql);
                        $cont = 0;
                        while ($rsProduto = mysqli_fetch_array($select)){
                            if ($cont % 2 == 0) {
                                $cor = "#ffd993";
                            } else {
                                $cor = "#ffffff";
                            }
                            $imagem = $rsProduto['imagem'];
                            $nome = $rsProduto['nome_produto'];
                            $preco_produto = $rsProduto['preco'];
                            $preco = "R$ ".str_replace(".", ",", $preco_produto);
                            $subcategoria = $rsProduto['subcategoria'];
                        ?>
                        <div id="valores_tabela_produto" style="background-color: <?php echo($cor) ?>;">
                            <div id="valor_imagem_produto">
                                <img src="<?php echo($imagem) ?>" alt="Imagem produto" class="img_produto">
                            </div>
                            <div id="valor_nome_produto">
                                <?php echo($nome) ?>
                            </div>
                            <div id="valor_preco_produto">
                                <?php echo($preco) ?>
                            </div>
                            <div id="valor_subcategoria_produto">
                                <?php echo($subcategoria) ?>
                            </div>
                            <div id="valor_itens_tabela_produto">
                                <div class="icone_funcao_produto">
                                    <a href="adm_produto.php?status=<?php echo($rsProduto['status']) ?>&id=<?php echo($rsProduto['id_produto']) ?>">
                                        <?php
                                        if($rsProduto['status']==1){
                                        ?>
                                        <img src="imagens/active.png" alt="Desativar Produto">
                                        <?php
                                        } else if ($rsProduto['status']==0){
                                        ?>
                                        <img src="imagens/disable.png" alt="Ativar Promoção" class="icone">
                                        <?php
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div class="icone_funcao_produto">
                                    <a href="adicionar_produto.php?modo=editar&id=<?php echo($rsProduto['id_produto']) ?>">
                                        <img src="imagens/edit.png" alt="Editar produto" class="icone">
                                    </a>
                                </div>
                                <div class="icone_funcao_produto">
                                    <a href="adm_produto.php?modo=excluir&id=<?php echo($rsProduto['id_produto']) ?>" onclick="return confirm('Deseja excluir o Produto?')">
                                        <img src="imagens/delete.png" alt="Excluir Produto" class="icone">
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