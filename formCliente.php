<?php
// inclui o arquivo BD.php dentro deste arquivo 
//para que seus metodos fiquem visiveis
include 'BD.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php

    //cria um instancia do objeto BD
    $objBD = new BD();
    //Faz a chamada do metodo Connection para conecta com o Banco de Dados
    $objBD->connection();

    if (!empty($_POST)) {
        //chama o metodo INSERT recebendo os dados do usuário através do metodo $_POST
        $objBD->insert($_POST);
        //metodo header faz uma chamada para a tela de listagem
        //depois que realizou a adicao
        header("Location: listarCliente.php");
    }
    ?>

    <!-- propriedade action faz a chamada do BD.php para pegar o valor do form
        o restante e um formulario comum usando o metodo POST
    -->
    <form action="formCliente.php" method="POST">
        <label>Nome</label>
        <input type="text" name="nome"> <br>

        <label>CPF</label>
        <input type="text" name="cpf"> <br>

        <label>Telefone</label>
        <input type="text" name="telefone"> <br>

        <label>E-mail</label>
        <input type="text" name="email"> <br>

        <input type="submit" value="Enviar">
        <a href="listarCliente.php"><button>Voltar</button></a>
    </form>
</body>

</html>