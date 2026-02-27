<?php
$pageTitle = "Gestión de Cursos";
$active = "courses";
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h5 fw-bold text-light mb-0">Cursos Disponibles</h2>

    <a href="/courses/create" class="btn px-4 py-2 text-white" style="background-color:#6366f1;border:none;">
        <i class="bi bi-journal-plus me-1"></i> Nuevo Curso
    </a>
</div>

<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-light">
                <thead style="background-color:#1f2937;">
                    <tr>
                        <th class="ps-4 text-secondary bg-dark">Curso</th>
                        <th class="text-secondary bg-dark">Horario</th>
                        <th class="text-secondary bg-dark">Alumnos</th>
                        <th class="text-secondary bg-dark">Asignaturas</th>
                        <th class="text-end pe-4 text-secondary bg-dark">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($courses as $course): ?>
                        <?php $collapseId = 'course-' . $course->getId()->value(); ?>

                        <tr style="border-bottom:1px solid #1f2937; cursor:pointer;" data-bs-toggle="collapse"
                            data-bs-target="#<?= $collapseId ?>">

                            <td class="ps-4 text-light small bg-dark">
                                <i class="bi bi-chevron-down me-2 text-secondary"></i>
                                <?= htmlspecialchars($course->getName()->value()) ?>
                            </td>

                            <td class="bg-dark">
                                <?php if ($course->getSchedule()->value() === 'Matí'): ?>
                                    <span class="badge rounded-pill" style="background:#064e3b;color:#34d399;">
                                        <i class="bi bi-sun me-1"></i>
                                        <?= $course->getSchedule()->value() ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge rounded-pill" style="background:#451a03;color:#fb923c;">
                                        <i class="bi bi-moon me-1"></i>
                                        <?= $course->getSchedule()->value() ?>
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="text-light bg-dark">
                                <?= $course->getStudents()->count() ?>
                            </td>

                            <td class="text-light bg-dark">
                                <?= $course->getSubjects()->count() ?>
                            </td>

                            <td class="text-end pe-4 bg-dark" onclick="event.stopPropagation();">

                                <a href="/courses/edit/<?= $course->getId()->value() ?>" class="btn-action" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="/courses/delete/<?= $course->getId()->value() ?>" method="POST"
                                    style="display:inline;" onclick="event.stopPropagation();">
                                    <button type="submit" class="btn-action delete" title="Eliminar">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                        <tr class="collapse bg-black" id="<?= $collapseId ?>">
                            <td colspan="5" style="background:#0f172a;">
                                <div class="p-4">

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="text-secondary mb-0">
                                            <i class="bi bi-book me-2"></i> Asignaturas
                                        </h6>

                                        <a href="/subjects/create?course=<?= $course->getId()->value() ?>"
                                            class="btn btn-sm text-white" style="background-color:#6366f1;border:none;"
                                            onclick="event.stopPropagation();">
                                            <i class="bi bi-plus-lg me-1"></i>
                                            Crear Asignatura
                                        </a>
                                    </div>

                                    <?php if ($course->getSubjects()->count() === 0): ?>
                                        <p class="text-secondary small">
                                            No hay asignaturas asociadas.
                                        </p>
                                    <?php endif; ?>

                                    <?php foreach ($course->getSubjects() as $subject): ?>

                                        <div class="card mb-3 border-0" style="background:#1e293b;"
                                            onclick="event.stopPropagation();">

                                            <div class="card-body">

                                                <div class="d-flex justify-content-between align-items-center mb-3">

                                                    <h6 class="text-light mb-0">
                                                        <?= htmlspecialchars($subject->getName()->value()) ?>
                                                    </h6>

                                                    <div class="d-flex align-items-center gap-3"
                                                        onclick="event.stopPropagation();">

                                                        <span class="badge bg-dark text-light border">
                                                            Profesor:
                                                            <?= $subject->getTeacher()
                                                                ? htmlspecialchars(
                                                                    $subject->getTeacher()->getName()->value() . ' ' .
                                                                    $subject->getTeacher()->getSurname()->value()
                                                                )
                                                                : 'Sin asignar' ?>
                                                        </span>

                                                        <div class="d-flex align-items-center gap-2"
                                                            onclick="event.stopPropagation();">

                                                            <a href="/subjects/edit/<?= $subject->getId()->value() ?>"
                                                                class="btn-action" title="Editar">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>

                                                            <form action="/subjects/delete/<?= $subject->getId()->value() ?>"
                                                                method="POST" style="display:inline;"
                                                                onclick="event.stopPropagation();">
                                                                <button type="submit" class="btn-action delete"
                                                                    title="Eliminar">
                                                                    <i class="bi bi-trash3"></i>
                                                                </button>
                                                            </form>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <?php foreach ($course->getStudents() as $student): ?>
                                                        <div class="col-md-3 mb-2">
                                                            <div class="p-2 rounded" style="background:#0f172a;">
                                                                <span class="text-light small">
                                                                    <?= htmlspecialchars(
                                                                        $student->getName()->value() . ' ' .
                                                                        $student->getSurname()->value()
                                                                    ) ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>

                                            </div>
                                        </div>

                                    <?php endforeach; ?>

                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>