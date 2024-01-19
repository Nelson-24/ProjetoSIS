<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Artigo';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="css/artigo-index.css">
</head>

<body>
<br>

<?php
if (!empty($artigos)) : ?>
<div class="container">
    <div class="artigos-container">
        <?php foreach ($artigos as $index => $artigo): ?>
            <div class="artigo-item<?= ($index + 1) % 4 === 0 ? ' last-in-row' : '' ?>">
                <div class="artigo-container">
                    <?php
                    $imagemSrc = 'http://localhost/ProjetoPSI_/frontend/web/images/materiais/' . $artigo->imagem;
                    ?>
                    <img src="<?= $imagemSrc ?>" alt="Imagem do Artigo" width="100" height="150">

                    <h2><?= Html::encode($artigo->descricao) ?></h2>
                    <p>Preço: <?= Html::encode($artigo->preco) ?> €</p>

                    <?php if (!Yii::$app->user->isGuest): ?>
                        <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $artigo->id, 'quantidade' => 1], ['class' => 'btn btn-primary']) ?>
                    <?php else: ?>
                        <?= Html::a('Adicionar ao Carrinho', ['site/login'], ['class' => 'btn btn-primary']) ?>
                    <?php endif; ?>

                    <!-- Botão de detalhes -->
                    <?= Html::a('Detalhes', ['view', 'id' => $artigo->id], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php else : ?>
    <p>Não tens artigos.</p>
<?php endif; ?>



</body>
</html>