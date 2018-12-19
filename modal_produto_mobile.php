<?php

$id_produto = "";
$nome = "";
$descricao = "";
$preco = "";
$imagem = "";
$status = "";
$produto_mes = "";
$id_subcategoria = "";
$clique = "";

$conexao = require_once("cms/conexao.php");

$id_produto = $_POST['id'];

$sql = "UPDATE tbl_produto SET clique = clique + 1 WHERE id_produto = ".$id_produto;

mysqli_query($conexao, $sql);

$sql = "SELECT * FROM tbl_produto WHERE id_produto = ".$id_produto;

$select = mysqli_query($conexao, $sql);

if ($rsModalProduto = mysqli_fetch_array($select)){
    $nome = $rsModalProduto['nome_produto'];
    $descricao = $rsModalProduto['descricao'];
    $preco = $rsModalProduto['preco'];
    $imagem = $rsModalProduto['imagem'];
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modal Menu</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="utf-8">
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".fechar_modal_detalhes_mobile").click(function(){
                    $(".container4").fadeOut(500);
                });
            });
        </script>
    </head>
    <body>
        <div id="modal_detalhes_mobile">
            <div id="faixa_fechar_modal_produto_mobile">
                <div id="title_modal_produto_mobile">
                    Produto
                </div>
                <div id="div_fechar_modal">
                    <div class="fechar_modal_detalhes_mobile">
                        <img src="imagens/delete.png" class="img_fechar" alt="Fechar Modal">
                    </div>
                </div>
            </div>
            <div class="item_produto_detalhes">
                <div class="image_produto">
                    <img src="cms/<?php echo($imagem) ?>" alt="coxinha" class="img_produto_home">
                </div>
                <div class="name_produto">
                    <?php echo($nome) ?>
                </div>
                <div class="descricao_produto_detalhes">
                    <?php echo($descricao) ?>
                </div>
                <div class="valor_produto">
                    <?php echo("R$ ".str_replace(".", ",", $preco)) ?>
                </div>
            </div>
        </div>
    </body>
</html>