<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$id = '';
$nome = '';
$email = '';
$usuario = '';
$senha = '';
$status = '';
$nivel = '';
$botao = 'CADASTRAR';

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

if (isset($_POST['btncadastrar'])) {
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $usuario = $_POST['txtusuario'];
    $senha = $_POST['txtsenha'];
    $status = 1;
    $nivel = $_POST['slcnivel'];
    
    if($_POST['btncadastrar']=="CADASTRAR"){
        $sql = "INSERT INTO tbl_usuario (nome, email, usuario, senha, status, id_nivel)
        VALUES ('".$nome."', '".$email."', '".$usuario."', '".$senha."', '".$status."', '".$nivel."')";
    } else if ($_POST['btncadastrar']=="ALTERAR") {
        $sql = "UPDATE tbl_usuario SET nome='".$nome."', 
        email='".$email."', usuario='".$usuario."', senha='".$senha."', status='".$status."', id_nivel='".$nivel."' WHERE id_usuario=".$_SESSION['id_usuario'];
    }
    
    $resultado = mysqli_query($conexao, $sql);
    
    header('location:usuario.php');
    
}

if (isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if ($modo == "editar") {
        $id = $_GET['id'];
        $_SESSION['id_usuario'] = $id;
        $sql = "SELECT * FROM tbl_usuario WHERE id_usuario=".$id;
        $resultado = mysqli_query($conexao, $sql);
        if ($rsUsuario = mysqli_fetch_array($resultado)) {
            $id = $rsUsuario['id_usuario'];
            $nome = $rsUsuario['nome'];
            $email = $rsUsuario['email'];
            $usuario = $rsUsuario['usuario'];
            $senha = $rsUsuario['senha'];
            $nivel = $rsUsuario['id_nivel'];
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
                            <img src="imagens/padaria.jpg" alt="Logo da Padaria" id="img_header">
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
            <div id="content_cadastro_usuario">
                <form name="frm_cadastro_usuario" action="cadastro_usuario.php" method="post">
                    <section id="div_titulo">
                        <div id="titulo_pagina">
                            Cadastro de Usuário
                        </div>
                        <a href="usuario.php">
                            <img src="imagens/return.png" alt="Voltar" title="Voltar">
                        </a>
                    </section>
                    <div id="div_cadastro_usuario">
                        <div class="div_item_cadastro">
                            <div class="label_usuario">
                                Nome:
                            </div>
                            <div class="item_cadastro">
                                 <input name="txtnome" type="text" class="input" placeholder="Digite o nome..." value="<?php echo($nome)?>">
                            </div>
                        </div>
                        <div class="div_item_cadastro">
                            <div class="label_usuario">
                                E-mail:
                            </div>
                            <div class="item_cadastro">
                                 <input name="txtemail" type="email" class="input" placeholder="Digite o e-mail do usuário..." value="<?php echo($email)?>">
                            </div>
                        </div>
                        <div class="div_item_cadastro">
                            <div class="label_usuario">
                                Usuário:
                            </div>
                            <div class="item_cadastro">
                                 <input name="txtusuario" type="text" class="input" placeholder="Digite o nome de usuário..." value="<?php echo($usuario)?>">
                            </div>
                        </div>
                        <div class="div_item_cadastro">
                            <div class="label_usuario">
                                Senha:
                            </div>
                            <div class="item_cadastro">
                                 <input name="txtsenha" type="password" class="input" placeholder="********" value="<?php echo($senha)?>">
                            </div>
                        </div>
                        <div class="div_item_cadastro">
                            <div class="label_usuario">
                                Nível:
                            </div>
                            <div class="item_cadastro">
                                <select name="slcnivel" class="input">
                                    <?php
                                    $sql = "select * from tbl_nivel where status = 1";
                                    $resultado = mysqli_query($conexao, $sql);
                                    
                                    while ($rsNivel = mysqli_fetch_array($resultado)){
                                        $id = $rsNivel['id_nivel'];
                                        $status = $rsNivel['status'];
                                        if ($nivel == $id){
                                            $ref = "selected";
                                        }else {
                                            $ref = "";
                                        }
                                        $nivelUsuario = $rsNivel['nome'];
                                    ?>
                                    <option value="<?php echo($id)?>" <?php echo($ref)?>><?php echo($nivelUsuario)?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="div_botao_cadastro">
                            <input type="submit" name="btncadastrar" class="botao" value="<?php echo($botao)?>">
                            <input type="reset" class="botao" value="LIMPAR">
                        </div>
                    </div>
                </form>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>