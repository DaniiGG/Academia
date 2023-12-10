<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PDF de Alumnos y Notas Medias</title>
    <style>
        /* Estilos CSS para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Listado de Alumnos y Notas Medias por Asignatura</h1>
    <?php if (!empty($alumnosNotasMedias)): ?>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Nota Media</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumnosNotasMedias as $alumno): ?>
                <tr>
                    <td><?= $alumno['nombre'] ?></td>
                    <td><?= $alumno['apellidos'] ?></td>
                    <td><?= number_format($alumno['nota_media'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No hay notas para mostrar.</p>
    <?php endif; ?>
</body>
</html>