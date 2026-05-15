<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="col-12 col-lg-8 mx-auto">
    <!-- Header -->
    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
        <a href="<?= base_url('rifas-dashboard') ?>" class="btn btn-outline-primary me-3 shadow-sm rounded-circle"
            style="width: 40px; height: 40px; padding: 7px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h3 class="fw-bold mb-0">Crear Nueva Rifa</h3>
            <p class="text-muted small mb-0">Configura los detalles del sorteo y los premios.</p>
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

            <form action="<?= base_url('rifas-dashboard/store') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="row g-4">
                    <!-- Nombre de la Rifa -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-type me-2 text-primary"></i>Nombre
                            de la Rifa</label>
                        <input type="text" name="nombre" value="<?= old('nombre') ?>"
                            class="form-control form-control-lg bg-light border-0 shadow-none px-4 rounded-3"
                            placeholder="Ej: Gran Rifa de Verano" required>
                    </div>

                    <!-- Descripción -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark"><i
                                class="bi bi-text-paragraph me-2 text-primary"></i>Descripción</label>
                        <textarea name="descripcion"
                            class="form-control bg-light border-0 shadow-none px-4 py-3 rounded-3" maxlength="250"
                            rows="3" placeholder="Detalles sobre la rifa..."
                            required><?= old('descripcion') ?></textarea>
                    </div>

                    <!-- Costo y Fecha -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark"><i
                                class="bi bi-cash-stack me-2 text-primary"></i>Costo del Boleto</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 rounded-start-3 text-muted px-3">$</span>
                            <input type="number" step="0.01" name="costo_boleto" value="<?= old('costo_boleto') ?>"
                                class="form-control form-control-lg bg-light border-0 shadow-none px-3 rounded-end-3"
                                placeholder="0.00" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark"><i
                                class="bi bi-calendar-check me-2 text-primary"></i>Fecha del Sorteo</label>
                        <input type="date" name="fecha_sorteo" value="<?= old('fecha_sorteo') ?>"
                            class="form-control form-control-lg bg-light border-0 shadow-none px-4 rounded-3" required>
                    </div>

                    <!-- Premio Principal -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-gift me-2 text-primary"></i>Premio
                            Principal</label>
                        <input type="text" name="premio" value="<?= old('premio') ?>"
                            class="form-control form-control-lg bg-light border-0 shadow-none px-4 rounded-3"
                            placeholder="Ej: iPhone 15 Pro Max" required>
                    </div>

                    <!-- URL Imagen -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-image me-2 text-primary"></i>URL
                            Imagen Promocional</label>
                        <input type="url" name="imagen_promocional" value="<?= old('imagen_promocional') ?>"
                            class="form-control form-control-lg bg-light border-0 shadow-none px-4 rounded-3"
                            placeholder="https://ejemplo.com/imagen.jpg">
                        <small class="text-muted ms-2">Ingresa un enlace directo a la imagen del premio.</small>
                    </div>

                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 rounded-3 shadow fw-bold">
                            <i class="bi bi-plus-circle me-2"></i>GUARDAR Y CREAR RIFA
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .rounded-4 {
        border-radius: 1.25rem !important;
    }

    .form-control-lg {
        font-size: 1rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #224abe 0%, #1a3a96 100%);
    }

    /* Ajuste de opacidad para los placeholders */
    .form-control::placeholder {
        color: #adb5bd;
        opacity: 0.8;
        font-weight: 400;
    }
</style>

<?= $this->endSection(); ?>