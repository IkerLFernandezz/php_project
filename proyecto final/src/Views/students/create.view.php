<?php
$pageTitle = "Crear Estudiante";
$active = "students";
?>

<div class="card border-0" style="background:#111827; max-width:700px;">
    <div class="card-body">

        <h5 class="fw-bold text-light mb-4">
            <i class="bi bi-person-plus me-2"></i> Nuevo Estudiante
        </h5>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/students/store">

            <div class="mb-3">
                <label class="form-label text-secondary">Nombre</label>
                <input name="name" class="form-control bg-dark text-light border-0" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary">Apellido</label>
                <input name="surname" class="form-control bg-dark text-light border-0" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary">DNI</label>
                <input name="dni" class="form-control bg-dark text-light border-0" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary">Mail</label>
                <input name="mail" class="form-control bg-dark text-light border-0" required>
            </div>

            <div class="mb-4">
                <label class="form-label text-secondary">Curso</label>
                <select name="courseId" class="form-control bg-dark text-light border-0" required>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= $course->getId()->value() ?>">
                            <?= htmlspecialchars($course->getName()->value()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">

                <a href="/students" class="btn btn-outline-secondary">
                    Cancelar
                </a>

                <button type="submit" class="btn text-white" style="background-color:#6366f1;border:none;">
                    Crear Estudiante
                </button>

            </div>

        </form>

    </div>
</div>