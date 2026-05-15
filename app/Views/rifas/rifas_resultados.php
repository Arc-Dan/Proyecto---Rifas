<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-10 mx-auto">
            <div class="d-flex align-items-center mb-4">
                <?php if (in_array(session()->get('usuario.rol'), ['admin', 'trabajador'])): ?>
                    <a href="<?= base_url('rifas-dashboard') ?>" class="btn btn-outline-primary me-3 shadow-sm rounded-circle"
                        style="width: 40px; height: 40px; padding: 7px;">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                <?php endif; ?>
                <div>
                    <h2 class="fw-bold mb-1">Resultados del Sorteo</h2>
                    <p class="text-muted mb-0">Ganadores y perdedores de la rifa <strong><?= esc($rifa['nombre']); ?></strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Número de Boleto</th>
                            <th>Cliente ID</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Resultado</th>
                            <th>Fecha de Compra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($boletos as $boleto) { 
                            $usuarioModel = new \App\Models\UsuarioModel();
                            $cliente = $usuarioModel->find($boleto['cliente_id']);
                            $nombreCliente = 'Sin asignar';

                            if ($cliente) {
                                if (is_array($cliente) && array_key_exists('nombre', $cliente)) {
                                    $nombreCliente = $cliente['nombre'];
                                } elseif (is_object($cliente) && property_exists($cliente, 'nombre')) {
                                    $nombreCliente = $cliente->nombre;
                                }
                            }
                        ?>
                            <tr>
                                <td class="ps-4 fw-bold"><?= esc($boleto['numero_boleto']); ?></td>
                                <td><?= esc($boleto['cliente_id']); ?></td>
                                <td><?= esc($nombreCliente); ?></td>
                                <td>
                                    <?php if ($boleto['estado'] === 'pagado') { ?>
                                        <span class="badge bg-success">Pagado</span>
                                    <?php } else { ?>
                                        <span class="badge bg-secondary"><?= esc($boleto['estado']); ?></span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php $res = trim(strtolower($boleto['resultado'] ?? '')); ?>
                                    <?php if ($res === 'primero') { ?>
                                        <span class="badge bg-warning text-dark">🥇 Primer Lugar</span>
                                    <?php } elseif ($res === 'segundo') { ?>
                                        <span class="badge bg-info text-dark">🥈 Segundo Lugar</span>
                                    <?php } elseif ($res === 'tercero') { ?>
                                        <span class="badge bg-primary">🥉 Tercer Lugar</span>
                                    <?php } elseif ($res === 'ninguo') { ?>
                                        <span class="badge bg-secondary">Sin Resultado</span>
                                    <?php } elseif ($boleto['estado'] === 'pagado') { ?>
                                        <span class="badge bg-danger">Perdedor</span>
                                    <?php } else { ?>
                                        <span class="badge bg-light text-dark border">Disponible</span>
                                    <?php } ?>
                                </td>
                                <td><?= esc($boleto['fecha_compra']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .badge {
        font-size: 0.9rem;
        padding: 6px 12px;
        border-radius: 12px;
    }
</style>

<?= $this->endSection() ?>