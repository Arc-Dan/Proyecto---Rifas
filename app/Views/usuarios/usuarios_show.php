<?= $this->extend('layout/dashboard'); ?>


<?= $this->section('content') ?>


<div class="col-12 col-md-8 col-lg-6 mx-auto">
    <!-- Header -->
    <div class="d-flex align-items-center mb-4 pb-2 border-bottom">
        <?php if (session()->get('usuario.rol') !== 'cliente'): ?>
            <a href="javascript:history.back()" class="btn btn-outline-primary me-3 shadow-sm rounded-circle"
                style="width: 40px; height: 40px; padding: 7px;">
                <i class="bi bi-arrow-left"></i>
            </a>
        <?php endif; ?>
        <h4 class="fw-bold mb-0">Perfil de Usuario</h4>
    </div>

    <!-- Profile Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="bg-primary py-5 text-center position-relative">
            <!-- Decorative background elements -->
            <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25"
                style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;">
            </div>

            <div class="position-relative">
                <div class="bg-white d-inline-flex align-items-center justify-content-center rounded-circle shadow-lg mb-3"
                    style="width: 100px; height: 100px; border: 4px solid rgba(255,255,255,0.3);">
                    <i class="bi bi-person-fill text-primary" style="font-size: 3.5rem;"></i>
                </div>
                <h3 class="text-white fw-bold mb-1"><?= esc($usuario['nombre']) ?></h3>
                <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold shadow-sm">
                    <i class="bi bi-shield-check me-1"></i> <?= strtoupper(esc($usuario['rol'] ?? 'Usuario')) ?>
                </span>
            </div>
        </div>

        <div class="card-body p-4 p-md-5">
            <div class="row g-4">
                <!-- ID Info -->
                <div class="col-12 border-bottom pb-3 mb-2">
                    <div class="d-flex align-items-center">
                        <div class="bg-light p-3 rounded-3 me-3 text-primary">
                            <i class="bi bi-hash fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block text-uppercase fw-bold" style="letter-spacing: 1px;">ID de
                                Cuenta</small>
                            <span class="fs-5 fw-bold text-dark">#<?= $usuario['id'] ?></span>
                        </div>
                    </div>
                </div>

                <!-- Email Info -->
                <div class="col-12 border-bottom pb-3 mb-2">
                    <div class="d-flex align-items-center">
                        <div class="bg-light p-3 rounded-3 me-3 text-primary">
                            <i class="bi bi-envelope-at fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block text-uppercase fw-bold" style="letter-spacing: 1px;">Correo
                                Electrónico</small>
                            <span class="fs-5 fw-bold text-dark"><?= esc($usuario['email']) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Status Info -->
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-activity text-primary me-2"></i>
                            <span class="fw-bold text-muted text-uppercase small">Estado de Cuenta</span>
                        </div>
                        <?php
                        $statusClass = (strtolower($usuario['status']) === 'activo') ? 'bg-success' : 'bg-secondary';
                        ?>
                        <span class="badge <?= $statusClass ?> px-3 py-2 rounded-pill shadow-sm">
                            <?= ucfirst(esc($usuario['status'])) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rounded-4 {
        border-radius: 1.25rem !important;
    }

    .bg-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
    }
</style>


<?= $this->endSection() ?>