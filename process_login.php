
<?php
// Inicia a sessão para poder usar variáveis de sessão (como manter o login do usuário)
session_start();

// Inclui o arquivo de conexão com o banco de dados
require 'config/db.php';

// Verifica se o formulário foi enviado com o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe os dados digitados no formulário de login
    $email = $_POST['email'];   // Email informado pelo usuário
    $senha = $_POST['senha'];   // Senha informada (sem criptografia ainda)

    // Prepara uma consulta segura para buscar o usuário pelo email
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email); // Substitui o ? pelo valor da variável $email
    $stmt->execute();               // Executa a consulta
    $result = $stmt->get_result();  // Obtém o resultado da consulta

    // Verifica se encontrou exatamente um usuário com o email informado
    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc(); // Pega os dados do usuário do banco

        // Verifica se a senha digitada confere com a senha criptografada do banco
        if (password_verify($senha, $usuario['senha'])) {
            // Se a senha estiver correta, cria variáveis de sessão
            $_SESSION['usuario_id'] = $usuario['id'];       // ID do usuário
            $_SESSION['nome'] = $usuario['nome'];           // Nome do usuário

            // Redireciona para a página protegida (dashboard)
            header("Location: dashboard.php");
            exit;
        } else {
            // Senha incorreta — redireciona para login com erro na senha
            header("Location: index.php?erro=senha");
            exit;
        }
    } else {
        // Email não encontrado — redireciona para login com erro no email
        header("Location: index.php?erro=email");
        exit;
    }
}
?>
