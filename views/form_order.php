<?php
require_once __DIR__ . '/../models/entities/mesa.php';
require_once __DIR__ . '/../models/entities/dishe.php';

use App\models\Mesa;
use App\models\entities\Dishes;

$mesas = (new Mesa())->all();
$platos = (new Dishes())->all();
$fechaHoy = date("Y-m-d");

// Generar opciones para el select de platos
$optionsPlatos = "";
foreach ($platos as $p) {
    $optionsPlatos .= "<option value='{$p->get('id')}' data-precio='{$p->get('price')}'>{$p->get('description')}</option>";
}
?>

<h1>Registrar Orden</h1>

<form action="actions/saveorder.php" method="POST" id="orderForm">
    <label>Fecha:</label>
    <input type="date" name="fecha" value="<?= $fechaHoy ?>" required><br><br>

    <label>Mesa:</label>
    <select name="id_mesa" required>
        <?php while ($m = $mesas->fetch_object()): ?>
            <option value="<?= $m->id ?>"><?= $m->name ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <h3>Detalle de la Orden</h3>
    <table id="detalleOrden">
        <thead>
            <tr>
                <th>Plato</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
                <th>Quitar</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <button type="button" onclick="agregarPlato()">Agregar Plato</button><br><br>

    <strong>Total: $<span id="totalOrden">0.00</span></strong>
    <input type="hidden" name="total" id="inputTotal"><br><br>

    <input type="submit" value="Guardar Orden">
</form>

<script>
function agregarPlato() {
    const tbody = document.querySelector("#detalleOrden tbody");
    const row = document.createElement("tr");

    const platoSelect = document.createElement("select");
    platoSelect.name = "platos[]";
    platoSelect.required = true;
    platoSelect.innerHTML = `<?= $optionsPlatos ?>`;

    const cantidadInput = document.createElement("input");
    cantidadInput.type = "number";
    cantidadInput.name = "cantidades[]";
    cantidadInput.min = 1;
    cantidadInput.value = 1;
    cantidadInput.required = true;

    const precioInput = document.createElement("input");
    precioInput.name = "precios[]";
    precioInput.readOnly = true;

    const subtotalCell = document.createElement("td");
    subtotalCell.textContent = "0";

    const removeBtn = document.createElement("button");
    removeBtn.type = "button";
    removeBtn.textContent = "X";
    removeBtn.onclick = () => {
        row.remove();
        calcularTotal();
    };

    function actualizarPrecioYSubtotal() {
        const precio = parseFloat(platoSelect.selectedOptions[0].dataset.precio);
        const cantidad = parseInt(cantidadInput.value) || 0;
        precioInput.value = precio;
        subtotalCell.textContent = (precio * cantidad).toFixed(2);
        calcularTotal();
    }

    platoSelect.onchange = actualizarPrecioYSubtotal;
    cantidadInput.oninput = actualizarPrecioYSubtotal;

    row.appendChild(document.createElement("td")).appendChild(platoSelect);
    row.appendChild(document.createElement("td")).appendChild(cantidadInput);
    row.appendChild(document.createElement("td")).appendChild(precioInput);
    row.appendChild(subtotalCell);
    row.appendChild(document.createElement("td")).appendChild(removeBtn);

    tbody.appendChild(row);
    actualizarPrecioYSubtotal();
}

function calcularTotal() {
    let total = 0;
    document.querySelectorAll("#detalleOrden tbody tr").forEach(row => {
        const subtotal = parseFloat(row.children[3].textContent) || 0;
        total += subtotal;
    });
    document.getElementById("totalOrden").textContent = total.toFixed(2);
    document.getElementById("inputTotal").value = total.toFixed(2);
}
</script>

<a href="index.php">Volver</a>
