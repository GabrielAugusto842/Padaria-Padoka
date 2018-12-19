<?php

if(isset($_POST)){
    $nome_arquivo = basename($_FILES['fleFoto2']['name']);
    $extensao = strrchr($nome_arquivo,".");
    $nome_foto = pathinfo($nome_arquivo, PATHINFO_FILENAME);
    
    $nome_arquivo = md5(uniqid(time()).$nome_foto).$extensao;

    $tamanho_arquivo = round(($_FILES['fleFoto2']['size'])/1024);

    $upload_dir = "arquivos/";

    $arquivos_permitidos = array(".jpg",".png",".gif",".svg","jpeg");

    $caminho_imagem = $upload_dir.$nome_arquivo;

    if (in_array($extensao, $arquivos_permitidos)) {
        if ($tamanho_arquivo <= 5120) {
            $arquivo_tmp = $_FILES['fleFoto2']['tmp_name'];

            if(move_uploaded_file($arquivo_tmp, $caminho_imagem)) {
                echo ("<img src='".$caminho_imagem."' alt='imagem'>");
                echo ("
                    <script>
                        frmcadastro.txtfoto2.value = '$caminho_imagem';
                    </script>
                ");
            } else {
                echo("Erro ao enviar o arquivo para o servidor.");
            }
        } else {
            echo("tamanho de arquivo inválido");
        }
    } else {
        echo("Arquivo não permitido");
    }
}

?>