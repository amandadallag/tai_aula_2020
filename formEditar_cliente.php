<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <php
        $objBD = new BD();
        $objBD -> connection();
        
        if(!empty($_POST)) {
        $objBD-> insert($_POST);
        header("Location: formListar_cliente.php");
        }
    ?>
    
    <form action="BD.php" method="POST">
        <label>Nome</label>
        <input type="text" name="nome"> <br>

        <label>CPF</label>
        <input type="text" name="cpf"> <br>
        
         <label>Telefone</label>
        <input type="text" name="telefone"> <br>
        
         <label>E-mail</label>
        <input type="text" name="e-mail"> <br>

        <input type="submit" value="Enviar">
    </form>
</body>
    
</html>