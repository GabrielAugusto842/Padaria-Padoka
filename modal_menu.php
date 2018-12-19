<html>
    <head>
        <title>Modal Menu</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="utf-8">
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".fechar_modal").click(function(){
                    $(".container").fadeOut(500);
                });
            });
        </script>
    </head>
    <body>
        <div id="modal_menu">
            <div id="div_fechar_modal">
                <div class="fechar_modal">
                    <img src="imagens/delete.png" class="img_fechar" alt="Fechar Modal">
                </div>
            </div>
            <div id="link_modal">
                <a href="index.php" class="link_responsivo">
                    <div class="item_menu_responsivo">
                        Home
                    </div>
                </a>
                <a href="promocoes.php" class="link_responsivo">
                    <div class="item_menu_responsivo">
                        Promoções
                    </div>
                </a>
                <a href="sobre.php" class="link_responsivo">
                    <div class="item_menu_responsivo">
                        Sobre
                    </div>
                </a>
                <a href="nossas_lojas.php" class="link_responsivo">
                    <div class="item_menu_responsivo">
                        Nossas Lojas
                    </div>
                </a>
                <a href="produto_do_mes.php" class="link_responsivo">
                    <div class="item_menu_responsivo">
                        Produto do mês
                    </div>
                </a>
                <a href="ambiente.php" class="link_responsivo">
                    <div class="item_menu_responsivo">
                        Ambientes
                    </div>
                </a>
                <a href="Fale_conosco.php" class="link_responsivo">
                    <div class="item_menu_responsivo">
                        Fale Conosco 
                    </div>
                </a>
            </div>
        </div>
    </body>
</html>