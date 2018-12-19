<!DOCTYPE>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
<!--
        <script>
            $(document).ready(function(){
                $("#foto1").live("change", function(){
                    $("#visualizar_foto1").html("<img src=imagens/ajax-loader.gif>");
                    setTimeout(function(){
                        $("#frmfoto").ajaxForm({
                            target:'#visualizar_foto1'
                        }).submit();
                    },2000);
                });
                $("#foto2").live("change", function(){
                    $("#visualizar_foto2").html("<img src=imagens/ajax-loader.gif>");
                    setTimeout(function(){
                        $("frmfoto2").ajaxForm({
                            target:'#visualizar_foto2'
                        }).submit();
                    },2000);
                });
                $("#btn").click(function(){
                    $("#visualizar").html("<img src=imagens/ajax-salvando.gif>");
                    setTimeout(function(){
                        $("frmcadastro").submit();
                    },2000);
                });
            });
        </script>
-->
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
                        <a href="home2.php">
                            <img src="imagens/padaria2.png" alt="Logo da Padaria" id="img_header">
                        </a>
                    </div>
                </div>
            </header>
            <div id="menu">
                <div id="div_item_menu">
                    <a href="conteudo.php" class="link_menu">
                        <div class="item_menu">
                            <div class="image_item_menu">
                                <img src="imagens/conteudo.png" alt="Página de usuários" class="img_menu">
                            </div>
                            <div class="text_item_menu">
                                Admin. Conteúdo
                            </div>
                        </div>
                    </a>
                    <a href="fale_conosco.php" class="link_menu">
                        <div class="item_menu">
                            <div class="image_item_menu">
                                <img src="imagens/fale_conosco.png" alt="Página de usuários" class="img_menu">
                            </div>
                            <div class="text_item_menu">
                                Admin. Fale Conosco
                            </div>
                        </div>
                    </a>
                    <div class="item_menu">
                        <div class="image_item_menu">
                            <img src="imagens/produtos.png" alt="Página de usuários" class="img_menu">
                        </div>
                        <div class="text_item_menu">
                            Admin. Produtos
                        </div>
                    </div>
                    <a href="usuario_nivel.php" class="link_menu">
                        <div class="item_menu">
                            <div class="image_item_menu">
                                <img src="imagens/usuario.png" alt="Página de usuários" class="img_menu">
                            </div>
                            <div class="text_item_menu">
                                Admin. Usuários
                            </div>
                        </div>
                    </a>
                </div>
                <div id="usuario_menu">
                    <div id="nome_usuario">
                        Bem-vindo, <span>Gabriel Santos</span>
                    </div>
                    <div id="div_logout">
                        <a href="../home2.php" id="link_logout">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
            <div id="content_add_ambiente">
                <div id="div_add_ambiente">
                    <div id="title_add_ambiente">
                        Adicionar Produto do mês
                    </div>
                    <div id="voltar_para_conteudo">
                        <a href="adm_produto_mes.php">
                            <img src="imagens/return.png" alt="Voltar para Administração de ambientes">
                        </a>
                    </div>
                </div>
                <div id="cadastrar_ambiente">
                    <div class="divisao_cadastro">
<!--
                        <form name="frmfoto" method="post" action="upload_foto1_ambiente.php" enctype="multipart/form-data" id="frmfoto">
                            <div class="label_cadastro_ambiente">
                                Imagem 1:
                            </div>
                            <div class="div_imagem_selecionada" id="visualizar_foto1">

                            </div>
                            <div class="arquivo_foto">
                                <input type="file" name="fleFoto1" id="foto1">
                            </div>
                        </form>
                        <form name="frmfoto2" method="post" action="upload_foto2_ambiente.php" enctype="multipart/form-data" id="frmfoto2">
                            <div class="label_cadastro_ambiente">
                                Imagem 2:
                            </div>
                            <div class="div_imagem_selecionada" id="visualizar_foto2">

                            </div>
                            <div class="arquivo_foto">
                                <input type="file" name="fleFoto2" id="foto2">
                            </div>
                        </form>
-->
                    </div>
                    <div class="divisao_cadastro">
<!--
                        <form name="frmcadastro" method="post" action="adicionar_ambiente.php" id="frmcadastro">
                            <div class="label_cadastro_ambiente">
                                Titulo: 
                            </div>
                            <div id="div_input">
                                <input name="txt_titulo" type="text" class="input">
                            </div>
                            <div class="label_cadastro_ambiente">
                                Texto: 
                            </div>
                            <div id="div_textarea">
                                <textarea name="txt_texto" class="input5"></textarea>
                            </div>
                            <div id="btn_add_ambiente">
                                <input type="button" name="btncadastrar" value="CADASTRAR" id="btn">
                            </div>
                        </form>
-->
                    </div>
                </div>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>