<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="col-12 col-lg-8 mx-auto">
    <!-- Header -->
    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
        <a href="<?= base_url('rifas-dashboard/' . $rifa['id']) ?>" class="btn btn-outline-primary me-3 shadow-sm rounded-circle"
            style="width: 40px; height: 40px; padding: 7px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h3 class="fw-bold mb-0">Editar Rifa</h3>
            <p class="text-muted small mb-0">Modificando: <span class="text-primary fw-bold"><?= esc($rifa['nombre']) ?></span></p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
            <?php if (session()->getFlashdata('errors')) { ?>
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <ul class="mb-0 small">
                        <?php foreach (session()->getFlashdata('errors') as $error) { ?>
                            <li><?= esc($error) ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <form action="<?= base_url('rifas-dashboard/' . $rifa['id'] . '/update') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="row g-4">
                    <!-- Nombre de la Rifa -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-type me-2 text-primary"></i>Nombre de la Rifa</label>
                        <input type="text" name="nombre" value="<?= old('nombre', $rifa['nombre']) ?>" 
                            class="form-control form-control-lg bg-light border-0 shadow-none px-4 rounded-3" required>
                    </div>

                    <!-- Descripción -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-text-paragraph me-2 text-primary"></i>Descripción</label>
                        <textarea name="descripcion" class="form-control bg-light border-0 shadow-none px-4 py-3 rounded-3" 
                            maxlength="250" rows="3" required><?= old('descripcion', $rifa['descripcion']) ?></textarea>
                    </div>

                    <!-- Costo y Fecha -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-cash-stack me-2 text-primary"></i>Costo del Boleto</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 rounded-start-3 text-muted px-3">$</span>
                            <input type="number" step="0.01" name="costo_boleto" value="<?= old('costo_boleto', $rifa['costo_boleto']) ?>" 
                                class="form-control form-control-lg bg-light border-0 shadow-none px-3 rounded-end-3" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-calendar-check me-2 text-primary"></i>Fecha del Sorteo</label>
                        <input type="date" name="fecha_sorteo" value="<?= old('fecha_sorteo', date('Y-m-d', strtotime($rifa['fecha_sorteo']))) ?>" 
                            class="form-control form-control-lg bg-light border-0 shadow-none px-4 rounded-3" required>
                    </div>

                    <!-- Premio Principal -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-gift me-2 text-primary"></i>Premio Principal</label>
                        <input type="text" name="premio" value="<?= old('premio', $rifa['premio']) ?>" 
                            class="form-control form-control-lg bg-light border-0 shadow-none px-4 rounded-3" required>
                    </div>

                    <!-- URL Imagen -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-image me-2 text-primary"></i>URL Imagen Promocional (Opcional)</label>
                        <input type="url" name="imagen_promocional" value="<?= old('imagen_promocional', $rifa['imagen_promocional']) ?>" 
                            class="form-control form-control-lg bg-light border-0 shadow-none px-4 rounded-3">
                        <small class="text-muted ms-2">Enlace directo a la imagen del premio.</small>
                    </div>

                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-warning btn-lg w-100 py-3 rounded-3 shadow fw-bold text-dark">
                            <i class="bi bi-check-circle-fill me-2"></i>ACTUALIZAR INFORMACIÓN
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .rounded-4 { border-radius: 1.25rem !important; }
    .form-control-lg { font-size: 1rem; }
    .form-control::placeholder { color: #adb5bd; opacity: 0.8; font-weight: 400; }
    .btn-warning { background: linear-gradient(135deg, #f6e05e 0%, #ecc94b 100%); border: none; }
</style>

<?= $this->endSection(); ?>