<header>
    <div id="header_central">
        <?php
            if (isset($_SESSION["user_portal"])){
                $user = $_SESSION["user_portal"];
                $saudacao = "SELECT nomecliente, nivel FROM cliente WHERE idCliente = {$user}";
                $saudacao_login = mysqli_query($conecta,$saudacao);
                if (!$saudacao_login){
                    die("falha no banco de dados");
                }
                $saudacao_login = mysqli_fetch_assoc($saudacao_login);
                $nome= $saudacao_login["nomecliente"];

            if ($saudacao_login["nivel"]=="admin"){
                ?><a href="listagem_cadastro.php" id="cadastros"> Cadastros     </a><?php
            }



        ?>
        <div id = "header_saudacao">
            <h5>Seja bem vindo, <?php echo $nome?>  <a href="logout.php">|sair|</a></h5>
            
        </div>
        <?php }?>

        <a href="listagem.php" id ="pudim"><h3>Pudim.eCommerce</h3></a>
    </div>
</header>