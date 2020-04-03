<?php
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
        $objBD = new BD();
        $objBD -> connection();
        
      $result = $obj-> selectAll();
      $obj-> insert($_POST);
    ?>
    
    echo"
    <table style=''>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Ação</th>
        </tr>";
        
foreach($result as $item) {
    echo"
    <tr>
        <td> ".$item['id']."</td>
        <td> ".$item['nome']."</td>
        <td> ".$item['cpf']."</td>
        <td><a href='formEditar_cliente.php?id=".$item['id']."'> Editar</a></td>
    </tr>";
}
    echo"</table>";
</body>
</html>