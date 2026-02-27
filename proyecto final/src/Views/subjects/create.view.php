<?php
$pageTitle = "Crear Asignatura";
$active = "courses";
?>

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="h5 fw-bold text-light">Nueva Asignatura</h2>
        <p class="text-secondary small">Crea una nueva asignatura asociada a un curso.</p>
    </div>

    <div class="card border-0" style="background:#1e293b;">
        <div class="card-body">

            <form method="POST" action="/subjects/store">

                <div class="mb-3">
                    <label class="form-label text-secondary">Nombre</label>
                    <input type="text" name="name" class="form-control bg-dark text-light border-secondary" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary">Curso</label>

                    <select name="course_id" class="form-select bg-dark text-light border-secondary" required>

                        <option value="">Seleccionar curso</option>

                        <?php foreach ($courses as $course): ?>
                            <option value="<?= $course->getId()->value() ?>"
                                <?= ($selectedCourse === $course->getId()->value()) ? 'selected' : '' ?>>

                                <?= htmlspecialchars($course->getName()->value()) ?>

                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-secondary">Profesor</label>
                    <select name="teacher_id" class="form-select bg-dark text-light border-secondary" required>
                        <option value="">Seleccionar profesor</option>

                        <?php foreach ($teachers as $teacher): ?>
                            <option value="<?= $teacher->getId()->value() ?>">
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
                        Crear Asignatura
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>