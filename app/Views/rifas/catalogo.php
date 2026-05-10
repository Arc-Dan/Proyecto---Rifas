<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row mb-5 text-center">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-5 fw-800">¡Prueba tu suerte hoy!</h1>
            <p class="lead text-muted">Elige una de nuestras rifas activas y gana premios increíbles.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card rifa-card shadow-lg h-100">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1616348436168-de43ad0db179?auto=format&fit=crop&w=800&q=80"
                        class="card-img-top" alt="premio" style="height: 200px; object-fit: cover;">
                    <div class="price-badge shadow-sm">$10.00 MXN</div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary-subtle text-primary px-3">Activa</span>
                        <small class="text-muted"><i class="bi bi-calendar-event me-1"></i> 15 Jun</small>
                    </div>
                    <h4 class="card-title fw-bold mb-3">Sorteo iPhone 15 Pro</h4>
                    <p class="card-text text-muted small mb-4">Participa para ganar el último smartphone de Apple.
                        Solo 11 boletos disponibles.</p>

                    <a href="/rifas/ver/1" class="btn btn-buy btn-primary w-100 shadow">
                        <i class="bi bi-ticket-perforated me-2"></i>Comprar Boleto
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f4f7fe;
    }

    .navbar-brand {
        font-weight: 800;
        letter-spacing: -1px;
    }

    .rifa-card {
        border: none;
        border-radius: 20px;
        transition: transform 0.3s ease;
        overflow: hidden;
    }

    .rifa-card:hover {
        transform: translateY(-10px);
    }

    .price-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.9);
        padding: 5px 15px;
        border-radius: 50px;
        font-weight: 700;
        color: #4e73df;
    }

    .btn-buy {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        border-radius: 12px;
        font-weight: 600;
        padding: 12px;
    }
</style>

<?= $this->endSection() ?>