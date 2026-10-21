<h1>Panel de Ejercicios</h1>

<?php if (session('mensaje')): ?>
    <p style="color: green;"><?= esc(session('mensaje')) ?></p>
<?php endif ?>

<a href="<?= site_url('ejercicios/nuevo') ?>">+ Registrar Nuevo Ejercicio</a>

<table border="1" cellpadding="5" style="margin-top: 15px; border-collapse: collapse;">
    <thead>
        <tr>
            <th>Ejercicio</th>
            <th>Series</th>
            <th>Repeticiones</th>
            <th>Descanso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ejercicios as $e): ?>
        <tr>
            <td><?= esc($e['nombre_ejercicio']) ?></td>
            <td><?= esc($e['series']) ?></td>
            <td><?= esc($e['repeticiones']) ?></td>
            <td><?= esc($e['descanso_segundos']) ?> seg</td>
            <td>
                <a href="<?= site_url('ejercicios/editar/' . $e['id_ejercicio']) ?>">Editar</a>
                
                <form action="<?= site_url('ejercicios/eliminar/' . $e['id_ejercicio']) ?>" method="post" onsubmit="return confirm('¿Seguro que querés borrar este ejercicio?')" style="display:inline">
                    <?= csrf_field() ?>
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
