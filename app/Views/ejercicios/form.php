<?php $editando = $ejercicio !== null; ?>

<h1><?= $editando ? 'Modificar Ejercicio' : 'Nuevo Ejercicio' ?></h1>

<!-- Mostrar errores de validación de la cátedra -->
<?php foreach (session('errores') ?? [] as $error): ?>
    <p style="color: red;"><?= esc($error) ?></p>
<?php endforeach ?>

<form method="post" action="<?= $editando ? site_url('ejercicios/actualizar/' . $ejercicio['id_ejercicio']) : site_url('ejercicios/guardar') ?>">
    <?= csrf_field() ?>

    <!-- Hardcodeamos temporalmente ID de rutina 1 para pruebas -->
    <input type="hidden" name="id_rutina" value="1">

    <p>
        <label>Nombre del Ejercicio:</label><br>
        <input type="text" name="nombre_ejercicio" value="<?= esc(old('nombre_ejercicio', $ejercicio['nombre_ejercicio'] ?? '', false)) ?>">
    </p>

    <p>
        <label>Series:</label><br>
        <input type="number" name="series" value="<?= esc(old('series', $ejercicio['series'] ?? '', false)) ?>">
    </p>

    <p>
        <label>Repeticiones:</label><br>
        <input type="text" name="repeticiones" placeholder="Ej: 10 o Al fallo" value="<?= esc(old('repeticiones', $ejercicio['repeticiones'] ?? '', false)) ?>">
    </p>

    <p>
        <label>Descanso (segundos):</label><br>
        <input type="number" name="descanso_segundos" value="<?= esc(old('descanso_segundos', $ejercicio['descanso_segundos'] ?? '', false)) ?>">
    </p>

    <button type="submit">Guardar Ejercicio</button>
    <a href="<?= site_url('ejercicios') ?>">Cancelar</a>
</form>
