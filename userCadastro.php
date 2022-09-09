<?php require_once("conexao/conexao.php"); ?>

<?php
    //inserçao
    if (isset($_POST["email"])){
        $nome     = $_POST["nomecliente"];
        $email    = $_POST["email"];
        $usuario  = $_POST["usuario"];
        $senha    = $_POST["senha"];

        $inserir = "INSERT INTO cliente (nomecliente, email, usuario, senha) VALUES ('$nome','$email','$usuario','$senha')";

        $operacao_inserir = mysqli_query($conecta,$inserir);

        if (!$operacao_inserir){
            die("falha na inserção");
        }else{
            header("location:login.php");
        }

    }


    //selecao
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de usuario</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/crud.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        <?php include_once("_incluir/funcoes.php"); ?> 
        
        <main>  
            <div id="janela_formulario">
                <form action="userCadastro.php" method="post">
                    <input type="text" name="nomecliente" placeholder="Nome">
                    <input type="text" name="email" placeholder="Email">
                    <input type="text" name="usuario" placeholder="Nome de usuario">
                    <input type="password" name="senha" placeholder="Senha">
                    <input type="submit" value="inserir">

                </form>
            </div>
        </main>

        <?php include_once("_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>