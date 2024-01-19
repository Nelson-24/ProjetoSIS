<!-- detalhes.php -->
<?php
/** @var yii\web\View $this */
use yii\helpers\Html;

$this->title = $artigo->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Artigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="artigo-detalhes-container">
    <div class="artigo-detalhes">
        <!-- Exibição da imagem -->
        <?php
        $imagemSrc = "/projeto/frontend/web/images/materiais/{$artigo->imagem}";
        ?>
        <img src="<?= $imagemSrc ?>" alt="Imagem do Artigo">

        <!-- Campos de detalhes do artigo -->
        <h2>Referência: <?= Html::encode($artigo->referencia) ?></h2>
        <h3>Descrição: <?= Html::encode($artigo->descricao) ?></h3>
        <p>Preço: <?= Html::encode($artigo->preco) ?> €</p>
        <p>Stock: <?= Html::encode($artigo->stock) ?></p>

        <!-- Botão de Adicionar ao Carrinho -->
        <button class="add-carrinho" onclick="adicionarAoCarrinho()">Adicionar ao Carrinho</button>

        <!-- Botão para voltar -->
        <?= Html::a('Voltar', Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<script>
    function adicionarAoCarrinho() {
        alert("Artigo adicionado ao carrinho!");
    }
</script>