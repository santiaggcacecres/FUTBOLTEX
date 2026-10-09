<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FutbolTex - Panel de Ejercicios</title>
    <!-- CSS de Bootstrap 5 -->
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1> Panel de Ejercicios</h1>
        <a href="<?= site_url('ejercicios/nuevo') ?>" class="btn btn-primary">+ Nuevo Ejercicio</a>
    </div>

    <!-- Mensajes de éxito del sistema -->
    <?php if (session('mensaje')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc(session('mensaje')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 vertical-align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre del Ejercicio</th>
                            <th>Series</th>
                            <th>Repeticiones</th>
                            <th>Descanso</th>
                            <th class="text-end px-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($ejercicios)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No hay ejercicios registrados en el sistema.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($ejercicios as $e): ?>
                                <tr>
                                    <td class="fw-bold"><?= esc($e['nombre']) ?></td>
                                    <td><span class="badge bg-secondary"><?= esc($e['series']) ?></span></td>
                                    <td><span class="badge bg-secondary"><?= esc($e['repeticiones']) ?></span></td>
                                    <td><?= esc($e['descanso']) ?> seg</td>
                                    <td class="text-end px-4">
                                        <a href="<?= site_url('ejercicios/editar/' . $e['id']) ?>" class="btn btn-sm btn-warning me-2">Editar</a>
                                        
                                        <!-- Formulario seguro POST para eliminar -->
                                        <form action="<?= site_url('ejercicios/eliminar/' . $e['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este ejercicio?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="https://jsdelivr.net"></script>
</body>
</html>
