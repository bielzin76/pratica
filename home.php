<?php 
session_start();
require 'config/db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Minha Loja Online</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f2f2f2;
    }

    header {
      background-color: #333;
      color: white;
      padding: 1rem;
      text-align: center;
    }

    #carousel {
      width: 100%;
      max-height: 300px;
      overflow: hidden;
      position: relative;
    }

    #carousel img {
      width: 100%;
      display: none;
    }

    #carousel img.active {
      display: block;
    }

    .form-container {
      background: white;
      margin: 2rem auto;
      padding: 1rem;
      max-width: 400px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-container input {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
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
      position: relative;
    }

    .product-card img {
      max-width: 100%;
      height: auto;
    }

    .remove-btn {
      background: red;
      color: white;
      border: none;
      padding: 0.3rem 0.5rem;
      position: absolute;
      top: 5px;
      right: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    /* Modal de confirmação */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: white;
      margin: 15% auto;
      padding: 1rem;
      border: 1px solid #888;
      width: 80%;
      max-width: 400px;
      text-align: center;
      border-radius: 5px;
    }

    .modal-buttons {
      margin-top: 1rem;
      display: flex;
      justify-content: center;
      gap: 1rem;
    }

    .modal-buttons button {
      padding: 0.5rem 1rem;
      cursor: pointer;
    }

    @media (max-width: 600px) {
      .product-card {
        width: 100%;
      }

      .form-container {
        margin: 1rem;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Minha Loja Online</h1>
  </header>

  <div id="carousel">
    <img src="C:\Users\Aluno(a)\Pictures\Screenshots\GettyImages-1186283017-low.webp" class="active">
    <img src="C:\Users\Aluno(a)\Pictures\Screenshots\rentabilidade-o-que-e.jpg.webp">
    <img src="C:\Users\Aluno(a)\Pictures\Screenshots\samuel.png">
  </div>

  <div class="form-container">
    <h2>Cadastrar Produto</h2>
    <input type="text" name="nome" placeholder="Nome do produto">
    <input type="number" name="preco" id="preco" placeholder="Preço">
    <input type="text" name="descricao" placeholder="Descrição ou Categoria">
    <input type="text" name="url" id="imagem" placeholder="URL da imagem">
    <button onclick="adicionarProduto()">Cadastrar</button>
  </div>

  <div class="product-list" id="listaProdutos">
    <!-- Produtos aparecerão aqui -->
  </div>

  <!-- Modal de confirmação -->
  <div id="modalConfirm" class="modal">
    <div class="modal-content">
      <p>Tem certeza que deseja remover este produto?</p>
      <div class="modal-buttons">
        <button id="confirmYes">Sim</button>
        <button id="confirmNo">Cancelar</button>
      </div>
    </div>
  </div>

  <script>
    // Carrossel
    const slides = document.querySelectorAll("#carousel img");
    let slideIndex = 0;

    function showSlides() {
      slides.forEach(slide => slide.classList.remove("active"));
      slideIndex = (slideIndex + 1) % slides.length;
      slides[slideIndex].classList.add("active");
    }

    setInterval(showSlides, 3000);

    // Validação de imagem
    function isValidImageUrl(url) {
      return /\.(jpg|jpeg|png|gif)$/i.test(url);
    }

    // Manipulação de produtos
    function getProdutos() {
      return JSON.parse(localStorage.getItem("produtos") || "[]");
    }

    function salvarProdutos(produtos) {
      localStorage.setItem("produtos", JSON.stringify(produtos));
    }

    function limparCampos() {
      document.getElementById("nome").value = '';
      document.getElementById("preco").value = '';
      document.getElementById("descricao").value = '';
      document.getElementById("imagem").value = '';
    }

    function renderizarProdutos() {
      const lista = document.getElementById("listaProdutos");
      lista.innerHTML = "";

      const produtos = getProdutos();
      produtos.forEach(prod => {
        const produtoHTML = `
          <div class="product-card">
            <button class="remove-btn" onclick="removerProduto(${prod.id})">X</button>
            <img src="${prod.imagem}" alt="${prod.nome}">
            <h3>${prod.nome}</h3>
            <p>R$ ${prod.preco}</p>
            <p><em>${prod.descricao}</em></p>
          </div>
        `;
        lista.innerHTML += produtoHTML;
      });
    }

    function adicionarProduto() {
      const nome = document.getElementById("nome").value;
      const preco = document.getElementById("preco").value;
      const descricao = document.getElementById("descricao").value;
      const imagem = document.getElementById("imagem").value;

      if (!nome || !preco || !descricao || !imagem) {
        alert("Por favor, preencha todos os campos!");
        return;
      }

      if (!isValidImageUrl(imagem)) {
        alert("URL da imagem inválida! Use .jpg, .jpeg, .png ou .gif.");
        return;
      }

      const produto = {
        id: Date.now(),
        nome,
        preco: parseFloat(preco).toFixed(2),
        descricao,
        imagem
      };

      const produtos = getProdutos();
      produtos.push(produto);
      salvarProdutos(produtos);
      renderizarProdutos();
      limparCampos();
    }

    // Modal de confirmação
    let produtoParaRemover = null;

    function removerProduto(id) {
      produtoParaRemover = id;
      document.getElementById("modalConfirm").style.display = "block";
    }

    document.getElementById("confirmYes").onclick = () => {
      if (produtoParaRemover !== null) {
        let produtos = getProdutos();
        produtos = produtos.filter(prod => prod.id !== produtoParaRemover);
        salvarProdutos(produtos);
        renderizarProdutos();
        produtoParaRemover = null;
        document.getElementById("modalConfirm").style.display = "none";
      }
    };

    document.getElementById("confirmNo").onclick = () => {
      produtoParaRemover = null;
      document.getElementById("modalConfirm").style.display = "none";
    };

    // Inicializar produtos ao carregar a página
    window.onload = renderizarProdutos;
  </script>
</body>
</html>
