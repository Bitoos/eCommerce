<?php require_once("conexao/conexao.php"); ?>
<?php
    session_start();

    if (!isset($_SESSION["user_portal"])){
        header("location:login.php");
    }

    if ( isset($_GET["codigo"]) ) {
        $produto_id = $_GET["codigo"];
    } else {
        Header("Location: inicial.php");
    }

    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM produto ";
    $consulta .= "WHERE idProduto = {$produto_id} ";
    $detalhe    = mysqli_query($conecta,$consulta);

    // Testar erro
    if ( !$detalhe ) {
        die("Falha no Banco de dados");
    } else {
        $dados_detalhe = mysqli_fetch_assoc($detalhe);
        $produtoID      = $dados_detalhe["idProduto"];
        $nomeproduto    = $dados_detalhe["nomeproduto"];
        $descricao      = $dados_detalhe["descproduto"];
        $imagem         = $dados_detalhe["imagem"];
        $valorproduto   = $dados_detalhe["valorproduto"];
        $statusproduto  = $dados_detalhe["statusproduto"];
        $estoque        = $dados_detalhe["estoque"];
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>eCommerce</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/produto_detalhe.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        <?php include_once("_incluir/funcoes.php"); ?>
        
        <main>  
            <div id="detalhe_produto">
                <ul>
                    <li class="imagem"><img src="<?php echo $imagem ?>"></li>
                    <li><h2><?php echo $nomeproduto ?></h2></li>
                    <li><b>Descrição: </b><?php echo $descricao ?></li>
                    <li><b>Preço Revenda: </b><?php echo real_format($valorproduto) ?></li>
                    <li><b>Estoque: </b><?php echo $estoque ?></li>
                </ul>
               
            </div>
        </main>

        <?php include_once("_incluir/rodape.php"); ?>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>