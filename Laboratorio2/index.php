<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Materia</title>
</head>
<body>
    <div class="container">
        <h1>MATERIA</h1>
        <?php
            require_once 'db.php';
                
            if ($_SERVER['REQUEST_METHOD']=== 'POST') {
                $nombre = $_POST['nombre'];
                $profesor = $_POST['profesor'];
                addMateria($nombre, $profesor); 
                header('Location: index.php');
            }
            if (isset($_GET['delete'])) {
                # code...
                deleteMateria($_GET['delete']);
                header('Location: index.php');
            }
            if (isset($_GET['complete'])) {
                # code...
                completarMateria($_GET['complete']);
                header('Location: index.php');
            }
            if(isset($_GET['busqueda'])) {
                $nombre = $_GET['busqueda'];

                $resultadoBusqueda = searchMateria($nombre);
                
                if(!empty($resultadoBusqueda)) {
                    ?>
                    <ul class="list-group">
                        <table class="table2">
                            <thead>
                                <tr>
                                    <th>Nombre Materia</th>
                                    <th>Profesor</th>
                                </tr>
                            <thead>
                        </table>
                        <?php foreach($resultadoBusqueda as $resultado) {
                        ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><?= $resultado->nombre?></span>
                                <span ><?= $resultado->profesor?></span>
                                <div>
                                    <a class= "btn btn-danger" href="index.php?delete=<?= $resultado->id?>">Eliminar</a> 
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                <?php
                } else {
                    echo "<p>No se encontraron resultados, busque por nombre de la materia :)</p>";
                }
            }
        ?>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <form class="d-flex" role="search" action="index.php" method="GET">
                    <input class="form-control me-2" id="busqueda" name="busqueda" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <form action="index.php" method="post">
            <div>
                <label for="nombre" class="form-label">Nombre Materia</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
            </div>
            <div>
                <label for="profesor" class="form-label">Profesor</label>
                <input type="text" name="profesor" id="profesor" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
        </form>
        
    </div>
</body>
</html>