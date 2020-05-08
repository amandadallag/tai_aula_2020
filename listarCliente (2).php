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
     <form action="listarCliente.php" method="POST">
        <label>Buscar: </label>
        <input type="text" value="nome">
        <select name="tipo">
            <option value="nome">Nome</option>
            <option value="cpf">CPF</option>
        </select>
        <input type="submit" value="Buscar">
    </form>
    <?php
    //cria um instancia do objeto BD
    $objBD = new BD();
    //Faz a chamada do metodo Connection para conecta com o Banco de Dados
    $objBD->connection();

    if(!empty($_POST['valor'])){
        $result = $objBD -> search($_POST);
    }else{
        $result = $objBD -> selectAll();
    }
    //Faz a chamada do metodo selectAll para conecta com o Banco de Dados
    $result = $objBD->selectAll();

    //monta uma tabela e lista os dados atraves do foreach
    echo "
<table style=''>
<tr>
  <th>ID</th>
  <th>Nome</th>
  <th>CPF</th>
  <th>Municipio</th>
  <th>UF</th>
  <th>Ação</th>
</tr>";

    foreach ($result as $item) {
        $objMunicipio = $objBD -> find($item['municipio_id'], "municipio");
        echo "
    <tr>
      <td>" . $item['id'] . "</td>
      <td>" . $item['nome'] . "</td>
      <td>" . $item['cpf'] . "</td>
      <td>" . $objMunicipio= nome . "</td>
       <td>" . $objMunicipio= uf . "</td>
      <td><a href='formEditarCliente.php?id=" . $item['id'] . "'>Editar</a></td>
      <td><a href='formDeletarCliente.php?id=" . $item['id'] . "'>Deletar</a></td>
      </tr>
    ";
        //a ultima linha foi criado um link para passar o parameto do id para a pagina formEditarCliente
    }
    echo "</table>";

    ?>
</body>

</html>