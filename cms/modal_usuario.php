<?php

$id = "";
$nome = "";
$email = "";
$usuario = "";
$senha = "";
$nivel = "";
$status = "";

$conexao = require_once("conexao.php");

$id = $_POST['id'];

$sql = "SELECT * FROM tbl_usuario WHERE id_usuario=".$id;
$select = mysqli_query($conexao, $sql);

if ($rs = mysqli_fetch_array($select)){
    $nome = $rs['nome'];
    $email = $rs['email'];
    $usuario = $rs['usuario'];
    $senha = $rs['senha'];
    $nivel = $rs['id_nivel'];
    $status = $rs['status'];
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modal Usuário</title>
        <meta charset="utf-8">
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".fechar_modal_usuario").hover(function(){
                    $(this).css('background-color', 'gray');
                    $(this).css('cursor', 'pointer');
                }, function(){
                    $(this).css('background-color', '#242424');
                });
                $(".fechar_modal_usuario").click(function(){
                    $(".container").fadeOut(500);
                });
            });
        </script>
    </head>
    <body>
        <div id="div_titulo_modal_usuario">
            <div id="titulo_modal_usuario">
                Visualizar Sugestões/Criticas
            </div>
            <div class="fechar_modal_usuario">
                <img src="imagens/delete.png" class="icone" alt="Fechar Modal">
            </div>
        </div>
        <div id="informacoes_modal_usuario">
            <div class="section_informacao">
                <div class="divisao_section_modal">
                    <div class="label_modal_usuario">
                        Nome:
                    </div>
                    <div class="div_input_modal_usuario">
                        <input type="text" value="<?php echo($nome); ?>" class="input_modal_usuario" disabled>
                    </div>
                </div>
                <div class="divisao_section_modal">
                    <div class="label_modal_usuario">
                        E-mail:
                    </div>
                    <div class="div_input_modal_usuario">
                        <input type="text" value="<?php echo($email); ?>" class="input_modal_usuario" disabled>
                    </div>
                </div>
            </div>
            <div class="section_informacao">
                <div class="divisao_section_modal">
                    <div class="label_modal_usuario">
                        Usuário:
                    </div>
                    <div class="div_input_modal_usuario">
                        <input type="text" value="<?php echo($usuario); ?>" class="input_modal_usuario" disabled>
                    </div>
                </div>
                <div class="divisao_section_modal">
                    <div class="label_modal_usuario">
                        Senha:
                    </div>
                    <div class="div_input_modal_usuario">
                        <input type="password" value="<?php echo($senha); ?>" class="input_modal_usuario" disabled>
                    </div>
                </div>
            </div>
            <div class="section_informacao">
                <div class="divisao_section_modal">
                    <div class="label_modal_usuario">
                        Nível:
                    </div>
                    <div class="div_input_modal_usuario">
                        <?php
                        $sql = "select * from tbl_nivel where id_nivel = ".$nivel;
                        $resultado = mysqli_query($conexao, $sql);
                        if ($rsNivel = mysqli_fetch_array($resultado)) {
                        ?>
                        <input type="text" value="<?php echo($rsNivel['nome']); ?>" class="input_modal_usuario" disabled>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="divisao_section_modal">
                    <div id="div_ativo_modal">
                        <div id="label_ativo_modal">
                            Ativo:
                        </div>
                        <div id="imagem_ativo_modal">
                            <?php
                            if ($status == 1){
                            ?>
                            <img src="imagens/active.png">
                            <?php
                            } else if ($status == 0) {
                            ?>
                            <img src="imagens/disable.png">
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>