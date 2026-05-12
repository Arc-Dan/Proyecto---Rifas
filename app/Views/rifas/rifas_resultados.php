<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h2 class="fw-bold">Resultados del Sorteo</h2>
            <p class="text-muted">Ganadores y perdedores de la rifa <strong><?= esc($rifa['nombre']); ?></strong></p>
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
                            <th>Estado</th>
                            <th>Resultado</th>
                            <th>Fecha de Compra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($boletos as $boleto) { ?>
                            <tr>
                                <td class="ps-4 fw-bold"><?= esc($boleto['numero_boleto']); ?></td>
                                <td><?= esc($boleto['cliente_id']); ?></td>
                                <td>
                                    <?php if ($boleto['estado'] === 'pagado') { ?>
                                        <span class="badge bg-success">Pagado</span>
                                    <?php } else { ?>
                                        <span class="badge bg-secondary"><?= esc($boleto['estado']); ?></span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($boleto['resultado'] === 'primero') { ?>
                                        <span class="badge bg-warning text-dark">🥇 Primer Lugar</span>
                                    <?php } elseif ($boleto['resultado'] === 'segundo') { ?>
                                        <span class="badge bg-info text-dark">🥈 Segundo Lugar</span>
                                    <?php } elseif ($boleto['resultado'] === 'tercero') { ?>
                                        <span class="badge bg-primary">🥉 Tercer Lugar</span>
                                    <?php } elseif ($boleto['resultado'] === 'ninguno') { ?>
                                        <span class="badge bg-danger">Perdedor</span>
                                    <?php } else { ?>
                                        <span class="badge bg-secondary">Disponible</span>
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

    <div class="mt-4 text-center">
        <a href="<?= base_url('rifas-dashboard') ?>" class="btn btn-outline-primary px-4">
            <i class="bi bi-arrow-left me-2"></i>Volver al Dashboard
        </a>
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
