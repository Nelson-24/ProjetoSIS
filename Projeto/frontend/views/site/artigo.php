<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Artigo';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Artigo</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>CRM</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="web/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../../web/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  -->
    <!-- owl stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesoeet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            justify-content: space-around;
            flex-direction: row; /* Certifique-se de que os elementos são dispostos em linha */
        }
        .article-container {
            max-width: 300px;
            margin: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            box-sizing: border-box;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        h2, p, span {
            margin-bottom: 10px;
        }
        .price {
            color: green;
            font-weight: bold;
            font-size: 1.2em;
        }
        .add-to-cart-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1em;
            cursor: pointer;
        }
        .detalhes-btn {
            background-color: #FFA500;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1em;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="article-container">
    <img src=images/materiais/cimento.jpg alt="Imagem do Artigo 1">
    <h2>Cimento</h2>
    <p>Saco de Cimento de 25 Kg</p>
    <p class="price">Preço: 25€</p>
    <p>Disponibilidade: Em estoque</p>
    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">Adicionar ao Carrinho</button>
    <button class="detalhes-btn" onclick="adicionarAoCarrinho()">Detalhes</button>
</div>

<div class="article-container">
    <img src="images/materiais/tijolo-04.jpg" alt="Imagem do Artigo 2">
    <h2>Tijolo</h2>
    <p>Conjunto de 200 Tijolos</p>
    <p class="price">Preço: 10€</p>
    <p>Disponibilidade: Em estoque</p>
    <button class="add-to-cart-btn" onclick="adicionarAoCarrinho()">Adicionar ao Carrinho</button>
    <button class="detalhes-btn" onclick="adicionarAoCarrinho()">Detalhes</button>
</div>

<script>
    function adicionarAoCarrinho() {
        alert("Artigo adicionado ao carrinho!");
    }
</script>

</body>
</html>