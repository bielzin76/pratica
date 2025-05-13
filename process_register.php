<?php
// Inclui o arquivo de conexão com o banco de dados
require 'config/db.php';

// Verifica se o formulário foi enviado utilizando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pega os dados do formulário enviados pelo método POST
    $nome = $_POST['nome'];     // Nome digitado pelo usuário
    $email = $_POST['email'];   // Email digitado pelo usuário

    // Criptografa a senha antes de salvar no banco de dados
    // password_hash() é uma função segura que utiliza o algoritmo bcrypt por padrão
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Prepara a query SQL com parâmetros (?) para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");

    // Substitui os parâmetros da query pelos valores reais de forma segura
    // "sss" significa que estamos passando 3 strings (s = string)
    $stmt->bind_param("sss", $nome, $email, $senha);

    // Executa a query SQL no banco de dados
    if ($stmt->execute()) {
        // Se o cadastro for feito com sucesso, redireciona para a tela de login
        // Envia o parâmetro "sucesso=1" na URL para mostrar mensagem no login
        header("Location: index.php?sucesso=1");
        exit; // Finaliza o script imediatamente após o redirecionamento
    } else {
        // Caso ocorra algum erro (ex: email duplicado), exibe o erro na tela
        echo "Erro ao cadastrar: " . $conn->error;
    }
}
?>
