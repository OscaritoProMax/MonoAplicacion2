<?php
require_once("models/entities/categories.php");
use MonoApp\Models\Entities\Categories;

$categorias = Categories::getAll();

if ($categorias) {
    echo "<h3>Conexión exitosa. Categorías encontradas:</h3>";
    echo "<ul>";
    foreach ($categorias as $c) {
        echo "<li>ID: {$c['id']} - Nombre: {$c['name']}</li>";
    }
    echo "</ul>";
} else {
    echo "<p>❌ Error: No se encontraron categorías o la conexión falló.</p>";
}
?>
