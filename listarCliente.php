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
    <title>Document</title>
</head>

<body>
    <!-- formulario com o botao para chamar o arquivo formCliente -->
    <form action="formCliente.php" method="POST">
        <label>Cadastrar Cliente: </label>
        <input type="submit" value="Novo">
    </form>
    <?php
    //cria um instancia do objeto BD
    $objBD = new BD();
    //Faz a chamada do metodo Connection para conecta com o Banco de Dados
    $objBD->connection();

    //Faz a chamada do metodo selectAll para conecta com o Banco de Dados
    $result = $objBD->selectAll();

    //monta uma tabela e lista os dados atraves do foreach
    echo "
<table style=''>
<tr>
  <th>ID</th>
  <th>Nome</th>
  <th>CPF</th>
  <th>Ação</th>
</tr>";

    foreach ($result as $item) {
        echo "
    <tr>
      <td>" . $item['id'] . "</td>
      <td>" . $item['nome'] . "</td>
      <td>" . $item['cpf'] . "</td>
      <td><a href='formEditarCliente.php?id=" . $item['id'] . "'>Editar</a></td>
      <td><a href='formEditarDeletar.php?id=" . $item['id'] . "'>Deletar</a></td>
    </tr>
    ";
    //a ultima linha foi criado um link para passar o parameto do id para a pagina formEditarCliente
    }
    echo "</table>";

    ?>
</body>

</html>