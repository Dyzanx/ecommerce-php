<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?= base_url ?>assets/img/camiseta.png" type="image/x-icon">

    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/font-awesome6.2.0.css">

    <title>Tienda de camisetas</title>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="logo">
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="<?= base_url ?>product/index">
                    Tienda de camisetas
                </a>
            </div>
        </header>

        <!-- Menú -->
        <nav class="menu">
            <ul>
                <li><a href="<?= base_url ?>product/index">Inicio</a></li>
                <?php
                $categories = utils::getCategories();
                while ($cat = $categories->fetch_object()) :
                ?>
                    <li><a href="<?= base_url ?>category/show&id=<?= $cat->id ?>"><?= $cat->name ?></a></li>
                <?php endwhile; ?>
            </ul>
        </nav>

        <div class="content">