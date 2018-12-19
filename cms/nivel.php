<?php
$conexao = require_once("conexao.php");

session_start();

if(!isset($_SESSION['login'])){
    header("location:../index.php");
}

$conteudo_nivel = "";
$fale_conosco_nivel = "";
$produtos_nivel = "";
$usuario_nivel = "";

$id_nivel = $_SESSION['login']['id_nivel'];
$sql = "SELECT * FROM tbl_nivel WHERE id_nivel = ".$id_nivel;
$select = mysqli_query($conexao, $sql);
if ($rsNivel = mysqli_fetch_array($select)){
    $conteudo_nivel = $rsNivel['conteudo'];
    $fale_conosco_nivel = $rsNivel['fale_conosco'];
    $produtos_nivel = $rsNivel['produtos'];
    $usuario_nivel = $rsNivel['usuario'];
}

$id = '';
$id_nivel = '';
$nome = '';
$status = '';
$conteudo = '';
$fale_conosco = '';
$produto = '';
$usuario = '';
$ckbconteudo = 0;
$chkconteudo = '';
$ckbfaleconosco = 0;
$chkfaleconosco = '';
$ckbproduto = 0;
$chkproduto = '';
$ckbusuario = 0;
$chkusuario = '';
$botao = "CADASTRAR";
$aviso = false;

if (isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if ($modo == 'excluir'){
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_usuario";
        $select = mysqli_query($conexao, $sql);
        while ($rs = mysqli_fetch_array($select)) {
            $id_nivel = $rs['id_nivel'];
            if ($id == $id_nivel){
                $aviso = true;
            }
        }
        
        if($aviso){
            echo("<script>alert('Não é possivel excluir o nível, porque ele tem um usuário atrelado')</script>");
        } else {
            $sql = "DELETE from tbl_nivel where id_nivel=".$id;
            mysqli_query ($conexao, $sql);
            header ("location:nivel.php");
        }
    }
}

if (isset($_GET['modo'])){
    $modo = $_GET['modo'];
    if ($modo == 'editar'){
        $id = $_GET['id'];
        $_SESSION['id_nivel'] = $id;
        $sql = "SELECT * FROM tbl_nivel WHERE id_nivel=".$id;
        $resultado = mysqli_query ($conexao, $sql);
        if ($rsNivel = mysqli_fetch_array($resultado)){
            $id_nivel = $rsNivel['id_nivel'];
            $nome = $rsNivel['nome'];
            $ckbconteudo = $rsNivel['conteudo'];
            $ckbfaleconosco = $rsNivel['fale_conosco'];
            $ckbproduto = $rsNivel['produtos'];
            $ckbusuario = $rsNivel['usuario'];
            if ($ckbconteudo==1){
                $chkconteudo = "checked";
            }
            if ($ckbfaleconosco==1){
                $chkfaleconosco = "checked";
            }
            if ($ckbproduto==1){
                $chkproduto = "checked";
            }
            if ($ckbusuario==1){
                $chkusuario = "checked";
            }
            $botao = "ALTERAR";
        }
    }
}

if (isset($_POST['btncadastrar'])) {
    $nome = $_POST['txtnome'];
    if (isset($_POST['ckbconteudo'])){
        $ckbconteudo = 1;
    }
    if (isset($_POST['ckbfaleconosco'])){
        $ckbfaleconosco = 1;
    }
    if (isset($_POST['ckbproduto'])){
        $ckbproduto = 1;
    }
    if (isset($_POST['ckbusuario'])){
        $ckbusuario = 1;
    }
    $status = 1;
    
    if ($_POST['btncadastrar']=="CADASTRAR"){
        $sql = "INSERT INTO tbl_nivel (nome, status, conteudo, fale_conosco, produtos, usuario)
        VALUES ('".$nome."', '".$status."', '".$ckbconteudo."', '".$ckbfaleconosco."', '".$ckbproduto."', '".$ckbusuario."')";
    } else if ($_POST['btncadastrar']=="ALTERAR"){
        $sql = "UPDATE tbl_nivel SET nome='".$nome."', status='".$status."', conteudo='".$ckbconteudo."', fale_conosco='".$ckbfaleconosco."', produtos='".$ckbproduto."', usuario='".$ckbusuario."' WHERE id_nivel=".$_SESSION['id_nivel'];
    }
    mysqli_query($conexao, $sql);
    header ("location:nivel.php");
}

if (isset($_GET['status'])){
    $status = $_GET['status'];
    $id_nivel = $_GET['id'];
    if ($id_nivel == 1) {
//        echo ("<script> alert('Você não pode desativar o administrador') </script>");
    } else {
        if ($status == 1) {
            $status = 0;
        } else if ($status == 0) {
            $status = 1;
        }
        $sql = "UPDATE tbl_nivel set status='".$status."' where id_nivel='".$id_nivel."'";
        mysqli_query($conexao, $sql);
        header("location:nivel.php");
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
                        if ($conteudo_nivel == 1){
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
                        if ($fale_conosco_nivel == 1){
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
                        if ($produtos_nivel == 1){
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
                        if ($usuario_nivel == 1){
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
            <div id="content_nivel">
                <form name="frm_nivel" action="nivel.php" method="post">
                    <div id="cadastro_nivel">
                        <div id="title_cadastro_nivel">
                            Cadastro de Níveis
                        </div>
                        <div id="div_cadastro_nivel">
                            <div class="div_item_cadastro_nivel">
                                <div class="label_nivel">
                                    Nome do nível:
                                </div>
                                <div class="item_cadastro">
                                     <input name="txtnome" type="text" class="input_nivel" placeholder="Digite o nome..." value="<?php echo($nome); ?>">
                                </div>
                            </div>
                            <div class="div_item_cadastro_nivel">
                                <div class="label_nivel">
                                    Privilégios do nível:
                                </div>
                                <div class="privilegio_nivel">
                                    <div class="privilegio_left">
                                        <input type="checkbox" name="ckbconteudo" class="checkbox" <?php echo($chkconteudo) ?>><span class="txtckb">Contéudo</span>
                                        <input type="checkbox" name="ckbfaleconosco" class="checkbox" <?php echo($chkfaleconosco) ?>><span class="txtckb">Fale Conosco</span>
                                    </div>
                                    <div class="privilegio_right">
                                        <input type="checkbox" name="ckbproduto" class="checkbox" <?php echo($chkproduto) ?>><span class="txtckb">Produtos</span>
                                        <input type="checkbox" name="ckbusuario" class="checkbox" <?php echo($chkusuario) ?>><span class="txtckb">Usuários</span>
                                    </div>
                                </div>
                            </div>
                            <div class="div_botao_cadastro_nivel">
                                <input type="submit" name="btncadastrar" class="botao_nivel" value="<?php echo($botao)?>">
                                <input type="reset" class="botao_nivel" value="LIMPAR">
                            </div>
                        </div>
                    </div>
                    <div id="table_nivel">
                        <div id="titulos_tabela_nivel">
                            <div class="campo_tabela">
                                Nível
                            </div>
                            <div class="campo_tabela_privilegios">
                                Privilégios
                            </div>
                            <div class="item_tabela_usuario">
                                Status
                            </div>
                            <div class="item_tabela">
                                Atualizar
                            </div>
                            <div class="segundo_item_tabela">
                                Excluir
                            </div>
                        </div>
                        <?php
                        $sql = "select * from tbl_nivel order by id_nivel";
                        $resultado = mysqli_query($conexao, $sql);
                        $cont = 0;
                        while ($rsNivel = mysqli_fetch_array($resultado)) {
                            if ($cont % 2 == 0) {
                                $cor = "#ffd993";
                            } else {
                                $cor = "#ffffff";
                            }
                        ?>
                        <div id="valores_tabela_nivel">
                            <div class="campo_valor" style="background-color:<?php echo($cor)?>;">
                                <?php echo($rsNivel['nome'])?>
                            </div>
                            <div class="campo_valor_privilegios" style="background-color:<?php echo($cor)?>;">
                                <?php 
                                if ($rsNivel['conteudo']==1){
                                    $conteudo = "Conteúdo";
                                    echo ($conteudo."   ");
                                }
                                if ($rsNivel['fale_conosco']==1){
                                    $fale_conosco = "Fale Conosco";
                                    echo ($fale_conosco."   ");
                                }
                                if ($rsNivel['produtos']==1){
                                    $produto = "Produto";
                                    echo ($produto."   ");
                                }
                                if ($rsNivel['usuario']==1){
                                    $usuario = "Usuário";
                                    echo ($usuario."   ");
                                }
                                ?>
<!--                                Conteúdo | Fale Conosco | Produtos | Usuários-->
                            </div>
                            <a href="nivel.php?status=<?php echo($rsNivel['status'])?>&id=<?php echo($rsNivel['id_nivel'])?>">
                                <div class="item_valor_usuario" style="background-color:<?php echo($cor)?>; ">
                                    <?php
                                    if ($rsNivel['status']==1){
                                    ?>
                                        <img src="imagens/active.png" alt="desativar usuário" class="icone" id="img_desativar">
                                    <?php
                                    } else if($rsNivel['status']==0) {
                                    ?>
                                        <img src="imagens/disable.png" alt="ativar usuário" class="icone" id="img_ativar">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <div class="item_valor" style="background-color:<?php echo($cor)?>; ">
                                <a href="nivel.php?modo=editar&id=<?php echo($rsNivel['id_nivel'])?>">
                                    <img src="imagens/edit.png" alt="deletar" class="icone">
                                </a>
                            </div>
                            <div class="segundo_item_valor" style="background-color:<?php echo($cor)?>;">
                                <a href="nivel.php?modo=excluir&id=<?php echo($rsNivel['id_nivel'])?>" onclick="return confirm('Deseja realmente excluir o nível?')">
                                    <img src="imagens/delete.png" alt="deletar" class="icone">
                                </a>
                            </div>
                        </div>
                        <?php
                            $cont++;
                        }
                        ?>
                    </div>
                </form>
            </div>
            <footer>
                Desenvolvido por: Gabriel Santos
            </footer>
        </main>
    </body>
</html>