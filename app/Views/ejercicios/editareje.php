<?php $editando = $ejercicio !== null; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FutbolTex - <?= $editando ? 'Editar Ejercicio' : 'Nuevo Ejercicio' ?></title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title mb-0"><?= $editando ? '📝 Editar Ejercicio' : '💪 Agregar Nuevo Ejercicio' ?></h3>
        </div>
        <div class="card-body p-4">

            <!-- Listado de errores de validación del Modelo -->
            <?php if (session('errores')): ?>
                <div class="alert alert-danger pb-0">
                    <ul>
                        <?php foreach (session('errores') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <!-- Acción dinámica del formulario -->
            <form method="post" action="<?= $editando ? site_url('ejercicios/actualizar/' . $ejercicio['id']) : site_url('ejercicios/guardar') ?>">
                <?= csrf_field() ?>

                <!-- Selector de Rutina (Clave Foránea) -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Asignar a Rutina</label>
                    <select name="rutina_id" class="form-select">
                        <option value="">-- Selecciona una rutina asociada --</option>
                        <?php 
                        $seleccionada = old('rutina_id', $ejercicio['rutina_id'] ?? '', false); 
                        foreach ($rutinas as $r): 
                        ?>
                            <option value="<?= $r['id'] ?>" <?= $seleccionada == $r['id'] ? 'selected' : '' ?>>
                                <?= esc($r['nombre']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <!-- Nombre del Ejercicio -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre del Ejercicio</label>
                    <input type="text" name="nombre" class="form-select" placeholder="Ej: Sentadillas con salto, Pasadas de velocidad" value="<?= esc(old('nombre', $ejercicio['nombre'] ?? '', false)) ?>">
                </div>

                <div class="row">
                    <!-- Series -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Series</label>
                        <input type="number" name="series" class="form-control" min="1" value="<?= esc(old('series', $ejercicio['series'] ?? 3, false)) ?>">
                    </div>

                    <!-- Repeticiones -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Repeticiones</label>
                        <input type="number" name="repeticiones" class="form-control" min="1" value="<?= esc(old('repeticiones', $ejercicio['repeticiones'] ?? 10, false)) ?>">
                    </div>
                </div>

                <!-- Descanso -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Tiempo de descanso (en segundos)</label>
                    <input type="number" name="descanso" class="form-control" min="0" placeholder="Ej: 45, 60, 90" value="<?= esc(old('descanso', $ejercicio['descanso'] ?? 60, false)) ?>">
                </div>

                <!-- Botones de Acción -->
                <div class="d-flex justify-content-between">
                    <a href="<?= site_url('ejercicios') ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4">Guardar Cambios</button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
