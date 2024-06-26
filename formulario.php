<?php
// Teste de unidade: Verifica se a conexão com o banco de dados é estabelecida corretamente
include_once('config.php');

if(isset($_POST['submit'])) {
    // Teste de unidade: Verifica se o nome e o email foram recebidos corretamente do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    // Adicione outros campos conforme necessário

    // Evitar SQL Injection usando prepared statements
    // Teste de unidade: Verifica se a consulta preparada é construída corretamente
    $query = "INSERT INTO clientes (nome, email) VALUES (?, ?)";
    
    // Preparar a declaração
    if ($stmt = mysqli_prepare($conexao, $query)) {
        // Vincular parâmetros
        // Teste de unidade: Verifica se os parâmetros são vinculados corretamente à consulta preparada
        mysqli_stmt_bind_param($stmt, "ss", $nome, $email);
        
        // Executar a declaração
        if (mysqli_stmt_execute($stmt)) {
            echo "Registro inserido com sucesso.";
        } else {
            // Teste de unidade: Verifica se o erro é tratado corretamente ao inserir o registro
            echo "Erro ao inserir o registro: " . mysqli_stmt_error($stmt);
        }
        
        // Fechar a declaração
        mysqli_stmt_close($stmt);
    } else {
        // Teste de unidade: Verifica se o erro é tratado corretamente na preparação da declaração
        echo "Erro na preparação da declaração: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Cadastro de Clientes | GN</title>
    <style>
        body{
            font-family: Arial, Helvetica;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            padding: 15px;
            border-radius: 15px;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="box">
        <form action="formulario.php" method="POST">
            <fieldset>
                <legend><b>Formulário Cadastro de Clientes</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome">Nome Completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="email" name="email" class="inputUser" required>
                    <label for="email">E-mail</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="telefone" class="inputUser" required>
                    <label for="telefone">Telefone</label>
                </div>
                <p>Sexo:</p>
                <input type="radio" id="feminino" name="genero" value="feminino" required>
                <label for="feminino">Feminino</label>
                <input type="radio" id="masculino" name="genero" value="masculino" required>
                <label for="masculino">Masculino</label>   
                <input type="radio" id="outro" name="genero" value="outro" required>
                <label for="outro">Outro</label>
                <div class="inputBox">
                    <br><br>
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="inputUser" required>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required>
                    <label for="cidade">Cidade</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" required>
                    <label for="estado">Estado</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" required>
                    <label for="endereco">Endereço</label>
                </div>
                <input type="submit" name="submit" id="enviar" value="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>
