<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>
<div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Gestión de Rifas</h3>
            <p class="text-muted">Administra las rifas activas y simula los sorteos.</p>
        </div>
        <a href="<?= base_url('rifas-dashboard/create') ?>" class="btn btn-primary shadow-sm px-4 py-2">
            <i class="bi bi-plus-lg me-2"></i>Nueva Rifa
        </a>
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
                            <th>Estado</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rifas as $rifa) { ?>
                            <tr>
                                <td class="text-center ps-4" style="width: 150px;">
                                    <div style="width: 120px; height: 100px; overflow: hidden; margin: 0 auto; background-color: #f8f9fa;"
                                        class="rounded-3 shadow-sm d-flex align-items-center justify-content-center">
                                        <?php if ($rifa["imagen_promocional"]) { ?>
                                            <img src="<?= $rifa["imagen_promocional"]; ?>" alt="rifa"
                                                style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                        <?php } else { ?>
                                            <i class="bi bi-camera-video-off text-muted fs-4"></i>
                                        <?php } ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-600 text-dark">
                                        <?= $rifa["nombre"]; ?>
                                    </span>
                                    <br><small class="text-muted">ID: #<?= $rifa["id"]; ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary font-weight-bold">$
                                        <?= $rifa["costo_boleto"]; ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $rifa["descripcion"]; ?>
                                </td>
                                <td><?= $rifa["fecha_sorteo"]; ?></td>
                                <td>
                                    <?php if (rifa_terminada_por_id($rifa['id'])) { ?>
                                        <span class="badge bg-danger">Cerrada</span>
                                    <?php } else { ?>
                                        <span class="badge bg-success">Activa</span>
                                    <?php } ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group shadow-sm">
                                        <a href="<?= base_url('rifas-dashboard/' . $rifa['id']) ?>"
                                            class="btn btn-white btn-sm text-primary" title="Ver Rifa"><i
                                                class="bi bi-eye-fill"></i></a>
                                        <a href="<?= base_url('rifas-dashboard/' . $rifa['id'] . '/edit') ?>"
                                            class="btn btn-white btn-sm text-warning" title="Editar"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <!-- Solo admin puede eliminar rifas -->
                                        <?php if (session()->get('usuario.rol') == 'admin') { ?>
                                            <button onClick="eliminarRifa(<?= $rifa['id']; ?>)"
                                                class="btn btn-white btn-sm text-danger" title="Eliminar">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function eliminarRifa(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer y eliminará todos los boletos asociados.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir a la ruta de eliminación
                window.location.href = "<?= base_url('rifas-dashboard/') ?>/" + id + "/delete";
            }
        })
    }

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