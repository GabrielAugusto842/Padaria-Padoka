<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$id = "";
$cidade = "";
$logradouro = "";
$numero = "";
$bairro = "";
$telefone1 = "";
$telefone2 = "";
$status = 0;
$botao = "CADASTRAR";

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

if(isset($_POST['btncadastrar'])){
    $cidade = $_POST['txtcidade'];
    $logradouro = $_POST['txtlogradouro'];
    $numero = $_POST['txtnumero'];
    $bairro = $_POST['txtbairro'];
    $telefone1 = $_POST['txttelefone1'];
    $telefone2 = $_POST['txttelefone2'];
    $status = 1;
    
    if($_POST['btncadastrar'] == "CADASTRAR"){
        $sql = "INSERT INTO tbl_lojas (cidade, logradouro, numero, bairro, telefone1, telefone2, status) VALUES ('".$cidade."', '".$logradouro."', ".$numero.", '".$bairro."', '".$telefone1."', '".$telefone2."', ".$status.")";
    } else if($_POST['btncadastrar']=="ALTERAR"){
        $sql = "UPDATE tbl_lojas set cidade = '".$cidade."', logradouro = '".$logradouro."', numero = '".$numero."', bairro = '".$bairro."', telefone1 = '".$telefone1."', telefone2 = '".$telefone2."', status = ".$status." where id_loja = ".$_SESSION['id_loja'];
    }
    
    mysqli_query($conexao, $sql);
    header("location:adm_nossas_lojas.php");
    
}

if(isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if ($modo == "editar") {
        $id = $_GET['id'];
        $_SESSION['id_loja'] = $id;
        $sql = "SELECT * FROM tbl_lojas WHERE id_loja = ".$id;
        $select = mysqli_query($conexao, $sql);
        if($rsLoja = mysqli_fetch_array($select)){
            $id_loja = $rsLoja['id_loja'];
            $cidade = $rsLoja['cidade'];
            $logradouro = $rsLoja['logradouro'];
            $numero = $rsLoja['numero'];
            $bairro = $rsLoja['bairro'];
            $telefone1 = $rsLoja['telefone1'];
            $telefone2 = $rsLoja['telefone2'];
            $botao = "ALTERAR";
        }
    }
}

?>

<!DOCTYPE>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
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
            <div id="content_add_loja">
                <div id="div_add_loja">
                    <div id="title_add_loja">
                        Adicionar Loja
                    </div>
                    <div id="voltar_para_nossas_lojas">
                        <a href="adm_nossas_lojas.php">
                            <img src="imagens/return.png" alt="Voltar para Administração de lojas">
                        </a>
                    </div>
                </div>
                <div id="cadastrar_loja">
                    <form name="frmcadastro" method="post" action="adicionar_loja.php">
                        <div class="div_input_loja">
                            <div id="div_input_cidade">
                                <div class="label_cadastro_loja">
                                    Cidade:
                                </div>
                                <div id="input_cidade">
                                    <input name="txtcidade" type="text" id="txtcidade" value="<?php echo($cidade) ?>">
                                </div>
                            </div>
                            <div id="div_input_bairro">
                                <div class="label_cadastro_loja">
                                    Bairro:
                                </div>
                                <div id="input_bairro">
                                    <input name="txtbairro" type="text" id="txtcidade" value="<?php echo($bairro) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="div_input_loja">
                            <div id="div_input_logradouro">
                                <div class="label_cadastro_loja">
                                    Logradouro:
                                </div>
                                <div id="input_logradouro">
                                    <input name="txtlogradouro" type="text" id="txtlogradouro" value="<?php echo($logradouro) ?>">
                                </div>
                            </div>
                            <div id="div_input_numero">
                                <div class="label_cadastro_loja">
                                    Número:
                                </div>
                                <div id="input_numero">
                                    <input name="txtnumero" type="text" id="txtnumero" value="<?php echo($numero) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="div_input_loja">
                            <div class="div_input_telefones">
                                <div class="label_cadastro_loja">
                                    Telefone 1:
                                </div>
                                <div id="input_telefone1">
                                    <input name="txttelefone1" type="text" id="txttelefone1" value="<?php echo($telefone1) ?>">
                                </div>
                            </div>
                            <div class="div_input_telefones">
                                <div class="label_cadastro_loja">
                                    Telefone 2:
                                </div>
                                <div id="input_telefone2">
                                    <input name="txttelefone2" type="text" id="txttelefone2" value="<?php echo($telefone2) ?>">
                                </div>
                            </div>
                        </div>
                        <div id="div_button_loja">
                            <input type="submit" name="btncadastrar" value="<?php echo($botao) ?>" class="btn_loja">
                            <input type="reset" name="btnlimpar" value="LIMPAR" class="btn_loja">
                        </div>
                    </form>
                </div>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>