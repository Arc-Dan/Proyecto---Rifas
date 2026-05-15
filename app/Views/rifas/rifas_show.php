<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content') ?>

<div class="col-12 col-lg-10 mx-auto">
    <!-- Header -->
    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
        <a href="<?= base_url('rifas-dashboard') ?>" class="btn btn-outline-primary me-3 shadow-sm rounded-circle"
            style="width: 40px; height: 40px; padding: 7px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h3 class="fw-bold mb-0">Detalles de la Rifa</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('rifas-dashboard') ?>">Rifas</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= esc($rifa['nombre']) ?></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="<?= base_url('rifas-dashboard/' . $rifa['id'] . '/edit') ?>" class="btn btn-warning shadow-sm">
                <i class="bi bi-pencil-square me-2"></i>Editar Rifa
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Columna de Imagen y Estado -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm overflow-hidden rounded-4">
                <div class="position-relative">
                    <?php if ($rifa["imagen_promocional"]) { ?>
                        <img src="<?= $rifa["imagen_promocional"]; ?>" alt="Premio" class="w-100"
                            style="height: 300px; object-fit: cover;">
                    <?php } else { ?>
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                            <i class="bi bi-gift text-muted" style="font-size: 5rem;"></i>
                        </div>
                    <?php } ?>

                    <?php $rifaFinalizada = rifa_terminada_por_boletos($boletos); ?>
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge <?= $rifaFinalizada ? 'bg-danger' : 'bg-success' ?> shadow p-2 px-3 fs-6">
                            <i class="bi <?= $rifaFinalizada ? 'bi-check-circle' : 'bi-play-circle' ?> me-2"></i>
                            <?= $rifaFinalizada ? 'Finalizada' : 'Activa' ?>
                        </span>
                    </div>
                </div>
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold text-dark mb-1"><?= esc($rifa['premio']) ?></h4>
                    <p class="text-muted small mb-0">Premio Principal</p>
                </div>
            </div>

            <!-- Estadísticas rápidas -->
            <div class="row g-3 mt-2">
                <div class="col-6">
                    <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                        <h3 class="fw-bold text-primary mb-0"><?= count($boletos) ?></h3>
                        <small class="text-muted text-uppercase fw-bold">Boletos</small>
                    </div>
                </div>
                <div class="col-6">
                    <?php
                    $pagados = array_filter($boletos, fn($b) => $b['estado'] === 'pagado');
                    ?>
                    <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                        <h3 class="fw-bold text-success mb-0"><?= count($pagados) ?></h3>
                        <small class="text-muted text-uppercase fw-bold">Pagados</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna de Información -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-2">Información General</h5>

                    <div class="mb-4">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Nombre de la Rifa</label>
                        <h4 class="fw-bold text-dark"><?= esc($rifa['nombre']) ?></h4>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Descripción</label>
                        <p class="text-dark lead fs-6"><?= esc($rifa['descripcion']) ?></p>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Costo por Boleto</label>
                            <div class="d-flex align-items-center">
                                <div class="bg-soft-success p-2 rounded-3 me-2">
                                    <i class="bi bi-cash-stack text-success fs-4"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-0">$ <?= number_format($rifa['costo_boleto'], 2) ?></h4>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Fecha del Sorteo</label>
                            <div class="d-flex align-items-center">
                                <div class="bg-soft-primary p-2 rounded-3 me-2">
                                    <i class="bi bi-calendar-event text-primary fs-4"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-0">
                                    <?= date('d M Y, h:i A', strtotime($rifa['fecha_sorteo'])) ?>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center mt-auto">
                        <a href="<?= base_url('boletos/rifa/' . $rifa['id']) ?>"
                            class="btn btn-outline-primary btn-lg px-4 rounded-3 shadow-sm">
                            <i class="bi bi-grid-3x3-gap me-2"></i>Vista Boletos Clientes
                        </a>

                        <?php if (!$rifaFinalizada): ?>
                            <form action="<?= base_url('rifas-dashboard/' . $rifa['id'] . '/simular') ?>" method="POST">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-success btn-lg px-5 rounded-3 shadow">
                                    <i class="bi bi-dice-5-fill me-2"></i>Simular Rifa
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?= base_url('rifas-dashboard/' . $rifa['id'] . '/resultados') ?>"
                                class="btn btn-danger btn-lg px-5 rounded-3 shadow">
                                <i class="bi bi-trophy-fill me-2"></i>Ver Resultados
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-soft-success {
        background-color: #d1fae5;
    }

    .bg-soft-primary {
        background-color: #e0e7ff;
    }

    .rounded-4 {
        border-radius: 1.25rem !important;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        content: "›";
        font-size: 1.2rem;
        vertical-align: middle;
    }
</style>


<?= $this->endSection() ?>