<?php
$pageTitle = "Editar Curso";
$active = "courses";
?>

<div class="card border-0" style="background:#1e293b;">
    <div class="card-body p-4">

        <h5 class="text-light mb-4">Editar Curso</h5>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/courses/update/<?= $course->getId()->value() ?>" method="POST">

            <div class="mb-3">
                <label class="form-label text-secondary">Nombre</label>
                <input type="text" name="name" value="<?= htmlspecialchars($course->getName()->value()) ?>"
                    class="form-control bg-dark text-light border-secondary" required>
            </div>

            <div class="mb-4">
                <label class="form-label text-secondary">Horario</label>
                <select name="schedule" class="form-select bg-dark text-light border-secondary" required>
                    <option value="Matí" <?= $course->getSchedule()->value() === 'Matí' ? 'selected' : '' ?>>
                        Matí
                    </option>
                    <option value="Diurn" <?= $course->getSchedule()->value() === 'Diurn' ? 'selected' : '' ?>>
                        Diurn
                    </option>
                </select>
            </div>

            <button type="submit" class="btn text-white" style="background-color:#6366f1;border:none;">
                Guardar Cambios
            </button>

        </form>
    </div>
</div>