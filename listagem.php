<?php require_once("conexao/conexao.php"); ?>

<?php

    session_start();

    if (!isset($_SESSION["user_portal"])){
        header("location:login.php");
    }

    // Consulta ao banco de dados
    $produtos = "SELECT idProduto, nomeproduto, descproduto, imagem, statusproduto, valorproduto ";
    $produtos .= "FROM produto ";
    if ( isset($_GET["produtos"]) ) {
        $nome_produto = $_GET["produtos"];
        $produtos .= "WHERE nomeproduto LIKE '%{$nome_produto}%' ";
    }
    $resultado = mysqli_query($conecta, $produtos);
    if(!$resultado) {
        die("Falha na consulta ao banco");   
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>eCommerce Lista de Produtos</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/produtos.css" rel="stylesheet">
        <link href="_css/produto_pesquisa.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        <?php include_once("_incluir/funcoes.php"); ?>
        
        <main>
            <div id="janela_pesquisa">
                <form action="listagem.php" method="get">
                    <input type="text" name="produtos" placeholder="Pesquisa">
                    <input type="image"  src="_assets/botao_search.png">
                </form>
            </div>
            
            <div id="listagem_produtos"> 
                <?php
                    while($linha = mysqli_fetch_assoc($resultado)) {
                ?>
                <ul>
                    <li class="imagem">
                        <a href="detalhe.php?codigo=<?php echo $linha['idProduto'] ?>">
                            <li><h3><?php echo $linha["nomeproduto"] ?></h3></li>
                        </a>
                    </li>
                    
        
                    <li>Preço unitário : <?php echo real_format($linha["valorproduto"]) ?></li>
                </ul>
             <?php
                }
            ?>           
            </div>
            
        </main>

        <?php include_once("_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>