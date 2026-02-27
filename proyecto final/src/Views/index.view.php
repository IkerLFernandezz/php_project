<?php
$pageTitle = "Panel de Control";
$active = "home";
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1 fw-bold text-light">Hola, Administrador</h2>
        <p class="text-secondary mb-0">Aquí tienes un resumen.</p>
    </div>
</div>

<div class="row g-4">

    <div class="col-md-3">
        <div class="card h-100 p-3 border-0 shadow-sm"
            style="background: linear-gradient(145deg, #1e1e2f 0%, #25253a 100%); border-left: 4px solid #6366f1;">
            <div class="card-body">
                <p class="text-uppercase text-secondary fw-bold mb-1" style="font-size: 0.75rem;">
                    Total Estudiantes
                </p>
                <h3 class="fw-bold mb-0 text-light">
                    <?= $totalStudents ?>
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100 p-3 border-0 shadow-sm"
            style="background: linear-gradient(145deg, #1b2a22 0%, #1f3328 100%); border-left: 4px solid #22c55e;">
            <div class="card-body">
                <p class="text-uppercase text-secondary fw-bold mb-1" style="font-size: 0.75rem;">
                    Profesores Activos
                </p>
                <h3 class="fw-bold mb-0 text-light">
                    <?= $totalTeachers ?>
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100 p-3 border-0 shadow-sm"
            style="background: linear-gradient(145deg, #2a1f1a 0%, #33261f 100%); border-left: 4px solid #f97316;">
            <div class="card-body">
                <p class="text-uppercase text-secondary fw-bold mb-1" style="font-size: 0.75rem;">
                    Departamentos Activos
                </p>
                <h3 class="fw-bold mb-0 text-light">
                    <?= $totalDepartments ?>
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100 p-3 border-0 shadow-sm"
            style="background: linear-gradient(145deg, #14221d 0%, #183029 100%); border-left: 4px solid #10b981;">
            <div class="card-body">
                <p class="text-uppercase text-secondary fw-bold mb-1" style="font-size: 0.75rem;">
                    Cursos Activos
                </p>
                <h3 class="fw-bold mb-0 text-light">
                    <?= $totalCourses ?>
                </h3>
            </div>
        </div>
    </div>

</div>