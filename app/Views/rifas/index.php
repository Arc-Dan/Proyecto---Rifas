<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>
<div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Gestión de Rifas</h3>
            <p class="text-muted">Administra las rifas activas y simula los sorteos.</p>
        </div>
        <button class="btn btn-primary shadow-sm px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalCrearRifa">
            <i class="bi bi-plus-lg me-2"></i>Nueva Rifa
        </button>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Imagen</th>
                            <th>Nombre de la Rifa</th>
                            <th>Costo</th>
                            <th>Premio</th>
                            <th>Fecha Sorteo</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4">
                                <img src="https://via.placeholder.com/50" class="rounded-3" alt="rifa">
                            </td>
                            <td>
                                <span class="fw-600 text-dark">Sorteo iPhone 15 Pro</span>
                                <br><small class="text-muted">ID: #001</small>
                            </td>
                            <td><span class="badge bg-soft-primary text-primary font-weight-bold">$10.00</span></td>
                            <td>Apple iPhone 15</td>
                            <td>15 de Junio, 2026</td>
                            <td class="text-end pe-4">
                                <div class="btn-group shadow-sm">
                                    <button class="btn btn-white btn-sm text-primary" title="Simular Sorteo"><i
                                            class="bi bi-trophy-fill"></i></button>
                                    <button class="btn btn-white btn-sm text-warning" title="Editar"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-white btn-sm text-danger btn-eliminar" title="Eliminar"><i
                                            class="bi bi-trash3"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-eliminar').forEach(btn => {
        btn.addEventListener('click', function () {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer y eliminará todos los boletos asociados.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí iría la lógica de redirección o fetch para eliminar
                }
            })
        });
    });
</script>

<style>
    .bg-soft-primary {
        background-color: #e0e7ff;
    }

    .btn-white {
        background: white;
        border: 1px solid #edf2f9;
    }

    .fw-600 {
        font-weight: 600;
    }
</style>
<?= $this->endSection() ?>