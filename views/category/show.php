<?php if(isset($category) && !empty($category)): ?>
    <h1><?= $category->name ?></h1>

    <?php if($products->num_rows != 0): ?>

        <?php while($prod = $products->fetch_object()): ?>
            <div class="product">
                <a href="<?=base_url?>?controller=product&action=show&id=<?=$prod->id?>">
                    <div class="img-container">
                        <?php if(isset($prod->image) && !empty($prod->image)): ?>
                            <img src="<?=base_url?>uploads/images/<?=$prod->image?>" alt="<?=$prod->name?>">
                        <?php else: ?>
                            <img src="<?=base_url?>assets/img/camiseta.png" alt="<?=$prod->name?>">
                        <?php endif; ?>
                    </div>
                <h2><?= $prod->name ?></h2>
                </a>
                <p><?= $prod->price ?></p>
                <a href="<?=base_url?>?controller=cart&action=addToCart&id=<?=$prod->id?>" class="button">Comprar</a>
            </div>
        <?php endwhile; ?>

    <?php else: ?>

        <h2>Al parecer no hay productos correspondientes a esta categoria</h2>

    <?php endif; ?>

<?php else: ?>

    <h1>La pagina que buscas no existe</h1>

<?php endif; ?>