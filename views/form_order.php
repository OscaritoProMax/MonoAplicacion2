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

<link rel="stylesheet" href="/MonoAplicacion2/views/css/form.css">

<div class="form-container">
    <h1 class="form-title">Registrar Orden</h1>

    <form action="actions/saveorder.php" method="POST" id="orderForm">
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?= $fechaHoy ?>" required>
        </div>

        <div class="form-group">
            <label for="id_mesa">Mesa:</label>
            <select name="id_mesa" id="id_mesa" required>
                <?php while ($m = $mesas->fetch_object()): ?>
                    <option value="<?= $m->id ?>"><?= $m->name ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <h3 class="form-subtitle">Detalle de la Orden</h3>
        <table id="detalleOrden" class="styled-table">
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

        <div class="form-actions">
            <button type="button" onclick="agregarPlato()" class="btn btn-secondary">➕ Agregar Plato</button>
        </div>

        <div class="form-total">
            <strong>Total: $<span id="totalOrden">0.00</span></strong>
            <input type="hidden" name="total" id="inputTotal">
        </div>

        <div class="form-actions">
            <input type="submit" value="💾 Guardar Orden" class="btn btn-primary">
        </div>
    </form>

    <a href="index.php" class="btn btn-back">🔙 Volver</a>
</div>

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
    removeBtn.textContent = "❌";
    removeBtn.className = "btn btn-danger";
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

    const td1 = document.createElement("td");
    td1.appendChild(platoSelect);
    const td2 = document.createElement("td");
    td2.appendChild(cantidadInput);
    const td3 = document.createElement("td");
    td3.appendChild(precioInput);
    const td4 = subtotalCell;
    const td5 = document.createElement("td");
    td5.appendChild(removeBtn);

    row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);
    row.appendChild(td4);
    row.appendChild(td5);

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

