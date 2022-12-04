<?php if ($product) : ?>
    <h1><?= $product->name ?></h1>

    <div class="detail-product">
        <div class="detail-image">
            <?php if (isset($product->image) && !empty($product->image)) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $product->image ?>" alt="<?= $product->name ?>">
            <?php else : ?>
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="<?= $product->name ?>">
            <?php endif; ?>
        </div>

        <div class="info-container">
            <h2><?= $product->name ?></h2>
            <p class="description"><?= $product->description ?></p>
            <p class="stock">unidades disponibles: <strong><?= $product->stock ?></strong></p>
            <p class="price">Precio: $<?= $product->price ?></p>
            <hr>
            <a href="<?= base_url ?>cart/addToCart&id=<?= $product->id ?>" class="button">Comprar</a>
        </div>
    </div>

<?php else : ?>
    <h1>El producto que buscas no existe en nuestra base de datos</h1>
<?php endif; ?>