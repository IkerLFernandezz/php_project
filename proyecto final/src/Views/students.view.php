<?php
$pageTitle = "Directorio de Estudiantes";
$active = "students";
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h5 fw-bold text-light mb-0">Listado de Estudiantes</h2>
    <a href="/students/create" class="btn px-4 py-2 text-white" style="background-color:#6366f1;border:none;">
        <i class="bi bi-plus-lg me-1"></i> Añadir Estudiante
    </a>
</div>

<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-light">
                <thead style="background-color:#1f2937;">
                    <tr>
                        <th class="ps-4 text-secondary bg-dark">Estudiante</th>
                        <th class="text-secondary bg-dark">DNI</th>
                        <th class="text-secondary bg-dark">Mail</th>
                        <th class="text-secondary bg-dark">Curso</th>
                        <th class="text-end pe-4 text-secondary bg-dark">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <?php
                        $course = $student->getCourse();
                        ?>
                        <tr style="border-bottom:1px solid #1f2937;">
                            <td class="ps-4 bg-dark">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-light fw-bold"
                                        style="width:40px;height:40px;">
                                        <?= substr($student->getName()->value(), 0, 1) ?>
                                        <?= substr($student->getSurname()->value(), 0, 1) ?>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-light">
                                            <?= htmlspecialchars(
                                                $student->getName()->value() . ' ' .
                                                $student->getSurname()->value()
                                            ) ?>
                                        </div>
                                        <div class="text-secondary small">
                                            ID: <?= htmlspecialchars($student->getId()->value()) ?>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-light bg-dark">
                                <?= htmlspecialchars($student->getDni()->value()) ?>
                            </td>

                            <td class="text-light bg-dark">
                                <i class="bi bi-envelope me-1"></i>
                                <?= htmlspecialchars($student->getMail()->value()) ?>
                            </td>

                            <td class="bg-dark">
                                <span class="badge bg-dark border text-light">
                                    <?= htmlspecialchars($course->getName()->value()) ?>
                                </span>
                            </td>
                            <td class="text-end pe-4 bg-dark">
                                <a href="/students/edit/<?= $student->getId()->value() ?>" class="btn-action"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="/students/delete/<?= $student->getId()->value() ?>" method="POST"
                                    style="display:inline;">
                                    <button type="submit" class="btn-action delete" title="Eliminar">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>