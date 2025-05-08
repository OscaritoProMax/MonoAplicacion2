<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Lista de Categorías</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $cat): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><?= $cat['name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
