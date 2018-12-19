<?php

$id = "";
$nome = "";
$telefone = "";
$celular = "";
$email = "";
$home_page = "";
$link_facebook = "";
$sugestao_critica = "";
$informacao = "";
$sexo = "";
$profissao = "";
$masculino = "";
$feminino = "";

$conexao = require_once("conexao.php");

$id = $_POST['id'];

$sql = "SELECT * FROM tbl_fale_conosco WHERE id=".$id;

$select = mysqli_query($conexao, $sql);

if ($rs = mysqli_fetch_array($select)){
    $nome = $rs['nome'];
    $telefone = $rs['telefone'];
    $celular = $rs['celular'];
    $email = $rs['email'];
    $home_page = $rs['home_page'];
    $link_facebook = $rs['link_facebook'];
    $sugestao_critica = $rs['sugestao_critica'];
    $informacao = $rs['informacao'];
    $sexo = $rs['sexo'];
    if ($sexo == "M") {
        $masculino = "checked";
    } else if ($sexo == "F") {
        $feminino = "checked";
    }
    $profissao = $rs['profissao'];
}

?>

<html>
    <head>
        <title>Modal Fale Conosco</title>
        <meta charset="utf-8">
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".fechar_modal").hover(function(){
                    $(this).css('background-color', 'gray');
                    $(this).css('cursor', 'pointer');
                }, function(){
                    $(this).css('background-color', '#242424');
                });
                $(".fechar_modal").click(function(){
                    $(".container").fadeOut(500);
                });
            });
        </script>
    </head>
    <body>
        <div id="div_titulo_modal">
            <div id="titulo_modal">
                Visualizar Sugestões/Criticas
            </div>
            <div class="fechar_modal">
                <img src="imagens/delete.png" class="icone" alt="Fechar Modal">
            </div>
        </div>
        <div id="informacoes_modal">
            <div id="nome_email">
                <div id="div_nome">
                    <div class="label_item">
                        Nome:
                    </div>
                    <div class="input_item">
                        <input type="text" name="txtnome" class="input1" disabled value="<?php echo($nome) ?>">
                    </div>
                </div>
                <div id="div_email">
                    <div class="label_item">
                        E-mail:
                    </div>
                    <div class="input_item">
                        <input type="email" name="txtemail" class="input1" disabled value="<?php echo($email) ?>">
                    </div>
                </div>
            </div>
            <div id="fone_sexo_page">
                <div id="div_telefone">
                    <div class="label_item2">
                        Telefone:
                    </div>
                    <div class="input_item2">
                        <input type="tel" name="txttelefone" class="input2" disabled value="<?php echo($telefone) ?>">
                    </div>
                </div>
                <div id="div_sexo">
                    <div class="label_item2">
                        Sexo:
                    </div>
                    <div class="input_item2">
                        <input type="radio" name="rdoSexo" class="input_radio" disabled <?php echo($feminino) ?>><span class="text_radio">Feminino</span>
                        <input type="radio" name="rdoSexo" class="input_radio" disabled <?php echo($masculino) ?>><span class="text_radio">Masculino</span>
                    </div>
                </div>
                <div id="div_homepage">
                    <div class="label_item">
                        Homepage:
                    </div>
                    <div class="input_item">
                        <input type="url" name="txthomepage" class="input1" disabled value="<?php echo($home_page) ?>">
                    </div>
                </div>
            </div>
            <div id="cell_profissao_face">
                <div id="div_celular">
                    <div class="label_item2">
                        Celular:
                    </div>
                    <div class="input_item2">
                        <input type="tel" name="txtcelular" class="input2" disabled value="<?php echo($celular) ?>">
                    </div>
                </div>
                <div id="div_profissao">
                    <div class="label_item3">
                        Profissão:
                    </div>
                    <div class="input_item3">
                        <input type="text" name="txtprofissao" class="input3" disabled value="<?php echo($profissao) ?>">
                    </div>
                </div>
                <div id="div_facebook">
                    <div class="label_item4">
                        Facebook:
                    </div>
                    <div class="input_item4">
                        <input type="url" name="txtfacebook" class="input4" disabled value="<?php echo($link_facebook) ?>">
                    </div>
                </div>
            </div>
            <div id="sugestao_informacao">
                <div id="div_sugestao">
                    <div class="label_item">
                        Sugestão/Crítica:
                    </div>
                    <div class="input_item5">
                        <textarea class="input5" disabled><?php echo($sugestao_critica) ?></textarea>
                    </div>
                </div>
                <div id="div_informacao">
                    <div class="label_item">
                        Informação:
                    </div>
                    <div class="input_item5">
                        <textarea class="input5" disabled><?php echo($informacao) ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>