<?php
$pageTitle = "Editar Asignatura";
$active = "courses";
?>

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="h5 fw-bold text-light">Editar Asignatura</h2>
        <p class="text-secondary small">Modifica los datos de la asignatura.</p>
    </div>

    <div class="card border-0" style="background:#1e293b;">
        <div class="card-body">

            <form method="POST" action="/subjects/update/<?= $subject->getId()->value() ?>">

                <div class="mb-3">
                    <label class="form-label text-secondary">Nombre</label>
                    <input type="text" name="name" class="form-control bg-dark text-light border-secondary"
                        value="<?= htmlspecialchars($subject->getName()->value()) ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary">Profesor</label>
                    <select name="teacher_id" class="form-select bg-dark text-light border-secondary" required>

                        <?php foreach ($teachers as $teacher): ?>
                            <option value="<?= $teacher->getId()->value() ?>"
                                <?= $teacher->getId()->value() === $subject->getTeacher()->getId()->value() ? 'selected' : '' ?>>
                                <?= htmlspecialchars(
                                    $teacher->getName()->value() . ' ' .
                                    $teacher->getSurname()->value()
                                ) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between">
                    <a href="/courses" class="btn" style="background:#1f2937;color:#e2e8f0;border:1px solid #374151;">
                        Cancelar
                    </a>

                    <button type="submit" class="btn text-white" style="background-color:#6366f1;border:none;">
                        Guardar Cambios
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>