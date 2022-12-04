<h1>Algunos de nuestros productos</h1>

<?php while ($prod = $products->fetch_object()) : ?>
    <div class="product">
        <a href="<?= base_url ?>product/show&id=<?= $prod->id ?>">
            <div class="img-container">
                <?php if (isset($prod->image) && !empty($prod->image)) : ?>
                    <img src="<?= base_url ?>uploads/images/<?= $prod->image ?>" alt="<?= $prod->name ?>">
                <?php else : ?>
                    <img src="<?= base_url ?>assets/img/camiseta.png" alt="<?= $prod->name ?>">
                <?php endif; ?>
            </div>
            <h2><?= $prod->name ?></h2>
        </a>
        <p><?= $prod->price ?></p>
        <a href="<?= base_url ?>cart/addToCart&id=<?= $prod->id ?>" class="button">Comprar</a>
    </div>
<?php endwhile; ?>