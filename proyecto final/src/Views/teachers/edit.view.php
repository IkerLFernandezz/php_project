<?php
$pageTitle = "Editar Profesor";
$active = "teachers";
?>

<div class="card border-0" style="background:#1e293b;">
    <div class="card-body p-4">

        <h5 class="text-light mb-4">Editar Profesor</h5>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/teachers/update/<?= $teacher->getId()->value() ?>" method="POST">

            <div class="mb-3">
                <label class="form-label text-secondary">Nombre</label>
                <input type="text" name="name" value="<?= htmlspecialchars($teacher->getName()->value()) ?>"
                    class="form-control bg-dark text-light border-secondary" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary">Apellidos</label>
                <input type="text" name="surname" value="<?= htmlspecialchars($teacher->getSurname()->value()) ?>"
                    class="form-control bg-dark text-light border-secondary" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary">DNI</label>
                <input type="text" name="dni" value="<?= htmlspecialchars($teacher->getDni()->value()) ?>"
                    class="form-control bg-dark text-light border-secondary" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary">Mail</label>
                <input type="email" name="mail" value="<?= htmlspecialchars($teacher->getMail()->value()) ?>"
                    class="form-control bg-dark text-light border-secondary" required>
            </div>

            <div class="mb-4">
                <label class="form-label text-secondary">Departamento</label>
                <select name="departmentId" class="form-select bg-dark text-light border-secondary" required>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?= $department->getId()->value() ?>"
                            <?= $department->getId()->value() === $teacher->getDepartment()->getId()->value() ? 'selected' : '' ?>>
                            <?= htmlspecialchars($department->getName()->value()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn text-white" style="background-color:#6366f1;border:none;">
                Guardar Cambios
            </button>

        </form>
    </div>
</div>