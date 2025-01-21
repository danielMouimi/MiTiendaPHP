
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Tienda</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 30px 0;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
            background-color: #0056b3;
        }

        nav ul li {
            margin: 0;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
        }

        nav ul li a:hover {
            background-color: #003f7f;
            border-radius: 4px;
        }

    </style>
</head>
<body>
<nav>
    <ul>
        <li><a href="<?=BASE_URL?>">Inicio</a></li>


        <?php
            if(isset($_SESSION['user'])){
                if($_SESSION['user']['rol'] == 'admin'){
                    echo "<li><a href='".BASE_URL."gestionarCategorias'>Gestionar Categoria</a></li>";
                    echo "<li><a href='".BASE_URL."newProducto'>Crear Producto</a></li>";
                }
                echo "<li><a href='" .BASE_URL . "cerrar'>Cerrar Sesion</a></li>";
            }else {
                echo "<li><a href='" .BASE_URL . "login'>Iniciar Sesion</a></li>";
                echo "<li><a href='". BASE_URL . "register'>Registrarse</a></li>";
            }
        ?>
        <li><a href="<?=BASE_URL?>">Carrito</a></li>
    </ul>
</nav>
<h1>Tienda</h1>





