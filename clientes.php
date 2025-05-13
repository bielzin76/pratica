<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Loja Online - Produtos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
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
      padding: 1rem;
    }

    .product-card {
      background: white;
      border: 1px solid #ddd;
      padding: 1rem;
      width: 200px;
      text-align: center;
    }

    .product-card img {
      max-width: 100%;
      height: auto;
    }

    .product-card h3 {
      margin: 1rem 0;
    }

    .product-card p {
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

  <header>
    <h1>Loja Online - Produtos</h1>
  </header>

  <div class="product-list" id="productList">
    <!-- Produtos serão carregados aqui -->
  </div>

  <script>
    // Função para listar os produtos na página do cliente
    function carregarProdutos() {
      fetch('listar_produtos.php')  // Chama o script PHP para obter os produtos
        .then(response => response.json())  // Espera a resposta JSON
        .then(data => {
          const productList = document.getElementById("productList");
          productList.innerHTML = '';  // Limpa a lista antes de exibir novos produtos

          data.forEach(produto => {
            const produtoHTML = `
              <div class="product-card">
                <img src="${produto.imagem}" alt="${produto.nome}">
                <h3>${produto.nome}</h3>
                <p>R$ ${produto.preco}</p>
                <p><em>${produto.descricao}</em></p>
                <button onclick="adicionarAoCarrinho(${produto.id})">Adicionar ao Carrinho</button>
              </div>
            `;
            productList.innerHTML += produtoHTML;
          });
        })
        .catch(error => {
          console.error('Erro ao carregar os produtos:', error);
        });
    }

    // Função para adicionar o produto ao carrinho
    function adicionarAoCarrinho(produtoId) {
      alert('Produto ' + produtoId + ' adicionado ao carrinho!');
    }

    // Carrega os produtos quando a página for carregada
    window.onload = carregarProdutos;
  </script>

</body>
</html>
