<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php'); // Redireciona para a página de login se não houver sessão ativa
    exit();
}
require 'config/db.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Produtos - Minha Loja Online</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      color: white;
      padding: 1rem;
      text-align: center;
    }

    .product-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
      padding: 2rem;
    }

    .product-card {
      background: white;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 1rem;
      width: 200px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .product-card img {
      max-width: 100%;
      height: auto;
    }

    .empty-message {
      text-align: center;
      padding: 2rem;
      color: #666;
    }
  </style>
</head>
<body>

  <header>
    <h1>Produtos Disponíveis</h1>
  </header>

  <div class="product-list" id="listaProdutos">
    <!-- Produtos serão carregados aqui -->
  </div>

  <div class="empty-message" id="mensagemVazia" style="display: none;">
    Nenhum produto cadastrado ainda.
  </div>
 
  <script>
    // Verifica se o usuário está logado na sessão
    const usuarioLogado = <?php echo json_encode($_SESSION['usuario'] ?? null); ?>;
    if (!usuarioLogado) {
        window.location.href = 'login.php'; // Redireciona para login se o usuário não estiver logado
    }

    // Carrega produtos do localStorage
    const lista = document.getElementById("listaProdutos");
    const mensagem = document.getElementById("mensagemVazia");

    const produtos = JSON.parse(localStorage.getItem("produtos")) || [];

    if (produtos.length === 0) {
      mensagem.style.display = "block";
    } else {
      produtos.forEach(prod => {
        const card = document.createElement("div");
        card.className = "product-card";
        card.innerHTML = `
          <img src="${prod.imagem}" alt="${prod.nome}">
          <h3>${prod.nome}</h3>
          <p>R$ ${parseFloat(prod.preco).toFixed(2)}</p>
        `;
        lista.appendChild(card);
      });
    }
  </script>
</body>
</html>
