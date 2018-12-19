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
        <title>Modal Produto</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <meta charset="utf-8">
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".fechar_modal_produto").click(function(){
                    $(".container2").fadeOut(500);
                });
            });
        </script>
    </head>
    <body>
        <div id="faixa_fechar_modal_produto">
            <div id="title_modal">
                Produto
            </div>
            <div class="fechar_modal_produto">
                <img src="imagens/delete.png" class="icone_fechar_modal" alt="Fechar modal">
            </div>
        </div>
        <div id="div_imagem_produto">
            <img src="cms/<?php echo($imagem) ?>" alt="Imagem do Produto" class="imagem_produto">
        </div>
        <div id="div_nome_produto">
            <?php echo($nome) ?>
        </div>
        <div id="div_descricao_produto">
            <?php echo($descricao) ?>
        </div>
        <div id="div_preco_produto">
            <?php echo("R$ ".str_replace(".", ",", $preco)) ?>
        </div>
    </body>
</html>