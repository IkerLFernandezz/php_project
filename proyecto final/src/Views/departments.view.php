<?php
$pageTitle = "Departamentos Académicos";
$active = "departments";
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h5 fw-bold text-light mb-0">Estructura Organizativa</h2>

    <a href="/departments/create" class="text-white btn px-4 py-2" style="background-color:#6366f1;border:none;">
        <i class="bi bi-plus-lg me-2"></i>Nuevo Departamento
    </a>
</div>

<div class="row g-4">
    <?php foreach ($departments as $department): ?>
        <?php $collapseId = 'dept-' . $department->getId()->value(); ?>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm" style="background:#111827;">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start mb-3">

                        <div class="d-flex align-items-start gap-2 flex-grow-1" style="cursor:pointer;"
                            data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>">

                            <div class="p-2 rounded" style="background:#1f2937;">
                                <i class="bi bi-buildings fs-4" style="color:#818cf8;"></i>
                            </div>

                            <div>
                                <h6 class="small text-secondary fw-bold text-uppercase mb-1">
                                    ID: <?= htmlspecialchars($department->getId()->value()) ?>
                                </h6>

                                <h5 class="fw-bold text-light mb-0">
                                    <?= htmlspecialchars($department->getName()->value()) ?>
                                </h5>
                            </div>

                        </div>

                        <div class="dropdown">
                            <button class="btn btn-link text-secondary p-0" data-bs-toggle="dropdown"
                                onclick="event.stopPropagation();">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">

                                <li>
                                    <a class="dropdown-item small"
                                        href="/departments/edit/<?= $department->getId()->value() ?>">
                                        <i class="bi bi-pencil me-2"></i>Editar
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form action="/departments/delete/<?= $department->getId()->value() ?>" method="POST"
                                        onclick="event.stopPropagation();">

                                        <button type="submit" class="dropdown-item small text-danger">
                                            <i class="bi bi-trash3 me-2"></i>Eliminar
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </div>

                    </div>

                    <div class="mt-3" style="cursor:pointer;" data-bs-toggle="collapse"
                        data-bs-target="#<?= $collapseId ?>">

                        <span class="badge bg-dark border text-light">
                            Profesores: <?= $department->getTeachers()->count() ?>
                        </span>

                    </div>

                </div>
            </div>

            <div class="collapse mt-2" id="<?= $collapseId ?>">
                <div class="card border-0" style="background:#0f172a;">
                    <div class="card-body">

                        <h6 class="text-secondary mb-3">
                            <i class="bi bi-person-badge me-2"></i> Profesores del departamento
                        </h6>

                        <?php if ($department->getTeachers()->count() === 0): ?>
                            <p class="text-secondary small">No hay profesores asignados.</p>
                        <?php endif; ?>

                        <div class="row">
                            <?php foreach ($department->getTeachers() as $teacher): ?>
                                <div class="col-md-6 mb-2">
                                    <div class="p-2 rounded" style="background:#111827;">
                                        <span class="text-light small">
                                            <?= htmlspecialchars(
                                                $teacher->getName()->value() . ' ' .
                                                $teacher->getSurname()->value()
                                            ) ?>
                                        </span>
                                        <div class="text-secondary small">
                                            DNI: <?= htmlspecialchars($teacher->getDni()->value()) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    <?php endforeach; ?>
</div>