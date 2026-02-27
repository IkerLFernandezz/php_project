<?php
$pageTitle = "Editar Estudiante";
$active = "students";
?>

<div class="card border-0" style="background:#111827; max-width:700px;">
    <div class="card-body">

        <h5 class="fw-bold text-light mb-4">
            <i class="bi bi-pencil me-2"></i> Editar Estudiante
        </h5>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/students/update/<?= $student->getId()->value() ?>">

            <div class="mb-3">
                <label class="form-label text-secondary">Nombre</label>
                <input name="name" value="<?= htmlspecialchars($student->getName()->value()) ?>"
                    class="form-control bg-dark text-light border-0" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary">Apellido</label>
                <input name="surname" value="<?= htmlspecialchars($student->getSurname()->value()) ?>"
                    class="form-control bg-dark text-light border-0" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary">DNI</label>
                <input name="dni" value="<?= htmlspecialchars($student->getDni()->value()) ?>"
                    class="form-control bg-dark text-light border-0" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary">Mail</label>
                <input name="mail" value="<?= htmlspecialchars($student->getMail()->value()) ?>"
                    class="form-control bg-dark text-light border-0" required>
            </div>

            <div class="mb-4">
                <label class="form-label text-secondary">Curso</label>
                <select name="courseId" class="form-control bg-dark text-light border-0" required>

                    <?php foreach ($courses as $course): ?>
                        <option value="<?= $course->getId()->value() ?>"
                            <?= $course->getId()->value() === $student->getCourse()->getId()->value() ? 'selected' : '' ?>>
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
                    Actualizar
                </button>

            </div>

        </form>

    </div>
</div>