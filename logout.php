<?php
// Inicia a sessão para poder manipular variáveis de sessão
session_start();

// Remove todas as variáveis de sessão (limpa os dados do usuário logado)
session_unset();

// Destroi completamente a sessão do usuário (finaliza o login)
session_destroy();

// Redireciona o usuário de volta para a tela de login
header("Location: index.php");
exit; // Encerra o script imediatamente após o redirecionamento
?>
