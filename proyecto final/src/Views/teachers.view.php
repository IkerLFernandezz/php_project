<?php
$pageTitle = "Directorio de Profesores";
$active = "teachers";
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h5 fw-bold text-light mb-0">Listado de Profesores</h2>

    <a href="/teachers/create" class="btn px-4 py-2 text-white" style="background-color:#6366f1;border:none;">
        <i class="bi bi-person-plus me-1"></i> Añadir Profesor
    </a>
</div>

<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-light">
                <thead style="background:#1f2937;">
                    <tr>
                        <th class="ps-4 text-secondary bg-dark">Profesor</th>
                        <th class="text-secondary bg-dark">DNI</th>
                        <th class="text-secondary bg-dark">Mail</th>
                        <th class="text-secondary bg-dark">Departamento</th>
                        <th class="text-end pe-4 text-secondary bg-dark">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($teachers as $teacher): ?>
                        <tr style="border-bottom:1px solid #1f2937;">
                            <td class="ps-4 bg-dark">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                        style="width:35px;height:35px;background:#312e81;color:#a5b4fc;">
                                        <?= substr($teacher->getName()->value(), 0, 1) ?>
                                    </div>
                                    <div class="fw-semibold text-light">
                                        <?= htmlspecialchars(
                                            $teacher->getName()->value() . ' ' .
                                            $teacher->getSurname()->value()
                                        ) ?>
                                    </div>
                                </div>
                            </td>

                            <td class="text-light bg-dark">
                                <?= htmlspecialchars($teacher->getDni()->value()) ?>
                            </td>

                            <td class="text-light bg-dark">
                                <?= htmlspecialchars($teacher->getMail()->value()) ?>
                            </td>

                            <td class="text-light bg-dark">
                                <?= htmlspecialchars(
                                    $teacher->getDepartment()->getName()->value()
                                ) ?>
                            </td>

                            <td class="text-end pe-4 bg-dark">

                                <a href="/teachers/edit/<?= $teacher->getId()->value() ?>" class="btn-action"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="/teachers/delete/<?= $teacher->getId()->value() ?>" method="POST"
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