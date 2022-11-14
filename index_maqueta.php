<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Tienda de camisetas</title>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="logo">
                <img src="assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="index.php">
                    Tienda de camisetas
                </a>
            </div>
        </header>

        <!-- Menú -->
        <nav class="menu">
            <ul>
                <li><a href="">Inicio</a></li>
                <li><a href="">Categoria 1</a></li>
                <li><a href="">Categoria 2</a></li>
                <li><a href="">Categoria 3</a></li>
                <li><a href="">Categoria 4</a></li>
                <li><a href="">Categoria 5</a></li>
            </ul>
        </nav>

        <div class="content">
            <!-- Sidebar -->
            <aside class="lateral">
                <div id="login" class="block-aside">
                    <h3>Entrar en la web</h3>
                    <form action="" method="post">
                        <label for="email">Email: </label>
                        <input type="email" name="email" autocomplete="off">

                        <label for="password">Contraseña: </label>
                        <input type="password" name="password" autocomplete="off">

                        <input type="submit" value="Entrar">
                    </form>

                    <ul>
                        <li><a href="">Mis pedidos</a></li>
                        <li><a href="">Gestionar pedidos</a></li>
                        <li><a href="">Gestionar categorias</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Central content -->
            <div class="central">
                <h1>Productos destacados</h1>

                <?php for($i = 0; $i <=4; $i++): ?>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="">
                    <h2>Camiseta azul olgada</h2>
                    <p>$20.000</p>
                    <a href="" class="button">Comprar</a>
                </div>
                <?php endfor; ?>
                
            </div>

        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>Diseño original &copy; <a href="https://victorroblesweb.es">Victor Robles</a></p>
        </foo autotomplete="off"ter>
    </div>
</body>

</html>