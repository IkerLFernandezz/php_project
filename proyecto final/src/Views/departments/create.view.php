<?php
$pageTitle = "Crear Departamento";
$active = "departments";
?>

<div class="mb-4">
    <h2 class="h5 fw-bold text-light">Nuevo Departamento</h2>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<form action="/departments/store" method="POST">

    <div class="card border-0" style="background:#111827;">
        <div class="card-body">

            <div class="mb-3">
                <label class="form-label text-secondary">Nombre</label>
                <input type="text" name="name" class="form-control bg-dark text-light border-0" required>
            </div>

            <button type="submit" class="btn text-white" style="background:#6366f1;">
                Crear Departamento
            </button>

        </div>
    </div>

</form>