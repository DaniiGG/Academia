<!-- formulario_pruebas.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Prueba</title>
    <style>
body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2{
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            font-weight: bolder; 
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            color:#007bff;
            background-color: white;
            border:1px solid #007bff;
        }
        .alert_green {
            color: #155724;
            background-color: #d4edda;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .alert_red {
            color: #721c24;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        h6{
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
    </header>
    <main>
    <h2>Agregar Nueva Prueba</h2>
    <?php use Utils\Utils; ?>
    <?php if(isset($_SESSION['prueba_added']) && $_SESSION['prueba_added'] == 'duplicate'): ?> 
    <h6><strong class="alert_red">El alumno ya tiene una nota para esta asignatura y trimestre</strong></h6>
<?php elseif(isset($_SESSION['prueba_added']) && $_SESSION['prueba_added'] == 'complete'): ?> 
    <h6><strong class="alert_green">Registro completado correctamente</strong></h6>
<?php elseif(isset($_SESSION['prueba_added']) && $_SESSION['prueba_added'] == 'failed'): ?> 
    <h6><strong class="alert_red">Registro fallido, introduzca bien los datos</strong></h6>
<?php endif; ?>
    <?php Utils::deleteSession('prueba_added'); ?>
    <form action="<?= BASE_URL ?>pruebas/agregarPrueba/" method="post">
    <label for="nombre_alumno">Nombre del Alumno:</label><br>
<input type="text" id="nombre_alumno" name="nombre_alumno" required><br><br>

<label for="apellidos_alumno">Apellidos del Alumno:</label><br>
<input type="text" id="apellidos_alumno" name="apellidos_alumno" required><br><br>

        <label for="id_materia">Materias:</label>
        <select id="id_materia" name="id_materia" required>
            <option value="" disabled selected>Selecciona una categoría</option>
            <?php foreach ($materias as $materia): ?>
                <option value="<?= $materia->id ?>"><?= $materia->nombre_materia ?></option>
            <?php endforeach; ?>
        </select><br><br><br>
            
        <label for="trimestre">Trimestre:</label><br>
        <input type="text" id="trimestre" name="trimestre" required><br><br>


        <label for="horario">Horario:</label><br>
        <input type="text" id="horario" name="horario" required><br><br>

        <label for="nota">Nota:</label><br>
        <input type="text" id="nota" name="nota" required><br><br>
            
        <input type="submit" value="Guardar">
    </form>
</main>
</body>
</html>