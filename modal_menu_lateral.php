<?php
$conexao = require_once("cms/conexao.php");
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
                $(".fechar_modal_lateral").click(function(){
                    $(".container3").fadeOut(500);
                });
            });
            function abrirSubitem(id){
                $(id).slideToggle(500);
            }
        </script>
    </head>
    <body>
        <div id="modal_menu_lateral">
            <div id="div_fechar_modal_lateral">
                <div id="title_fechar_modal_lateral">
                    Categorias
                </div>
                <div class="fechar_modal_lateral">
                    <img src="imagens/delete.png" class="img_fechar" alt="Fechar Modal">
                </div>
            </div>
            <div id="modal_categoria">
                <?php
                $sql = "SELECT * FROM tbl_categoria";
                $select = mysqli_query($conexao, $sql);
                while ($rsCategoria = mysqli_fetch_array($select)){
                    $id_categoria = $rsCategoria['id_categoria'];
                    $nome_categoria = $rsCategoria['nome_categoria'];
                    $id_div = "'#".$id_categoria."'";
                ?>
                <div class="item_menu_lateral" onclick="abrirSubitem(<?php echo($id_div) ?>)">
                    <?php echo($nome_categoria) ?>
                    <div class="subitem_menu_lateral" id="<?php echo($id_categoria) ?>">
                        <?php
                        $sql2 = "SELECT * FROM tbl_subcategoria WHERE id_categoria = ".$id_categoria;
                        $select2 = mysqli_query($conexao, $sql2);
                        while ($rsSubcategoria = mysqli_fetch_array($select2)){
                            $id_subcategoria = $rsSubcategoria['id_subcategoria'];
                            $nome_subcategoria = $rsSubcategoria['nome_subcategoria'];
                        ?>
                        <div class="subitem_lateral">
                            <a href="index.php?id_subcategoria=<?php echo($id_subcategoria) ?>" class="link_menu_lateral">
                                <?php echo($nome_subcategoria) ?>
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </body>
</html>