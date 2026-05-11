<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>
<div class="col-12">
    <div class="d-flex align-items-center mb-4 pb-3 border-b">
        <a href="<?= base_url('rifas') ?>" class="btn btn-white text-primary me-3 shadow-sm rounded-circle"
            style="width: 40px; height: 40px; padding: 7px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h3 class="fw-bold mb-0">Selecciona tu Boleto</h3>
            <p class="text-muted mb-0">
                <?= esc($rifa['nombre']) ?>
            </p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div style="width: 100%; height: 200px; overflow: hidden; background-color: #f8f9fa;"
                        class="rounded-3 shadow-sm mb-4">
                        <?php if ($rifa["imagen_promocional"]) { ?>
                            <img src="<?= $rifa["imagen_promocional"]; ?>" alt="Premio"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        <?php } else { ?>
                            <div class="d-flex h-100 align-items-center justify-content-center">
                                <i class="bi bi-gift text-muted" style="font-size: 4rem;"></i>
                            </div>
                        <?php } ?>
                    </div>

                    <h4 class="fw-bold text-dark mb-2">
                        <?= esc($rifa['premio']) ?>
                    </h4>
                    <p class="text-muted small mb-4">
                        <?= esc($rifa['descripcion']) ?>
                    </p>

                    <div class="bg-soft-primary rounded-3 p-3 mb-4 text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-primary fw-600">Costo por boleto:</span>
                            <span class="fw-bold text-dark">$
                                <?= number_format($rifa['costo_boleto'], 2) ?>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-primary fw-600">Fecha del Sorteo:</span>
                            <span class="fw-bold text-dark">
                                <?= date('d M Y', strtotime($rifa['fecha_sorteo'])) ?>
                            </span>
                        </div>
                    </div>

                    <div class="alert alert-warning d-none" id="resumen-seleccion">
                        <i class="bi bi-ticket-perforated-fill me-2"></i>Has seleccionado el boleto <strong
                            id="numero-elegido" class="fs-5"></strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Boletos Disponibles</h5>
                        <div class="d-flex gap-3 small fw-600">
                            <span class="d-flex align-items-center"><span class="leyenda-color bg-success me-1"></span>
                                Disponible</span>
                            <span class="d-flex align-items-center"><span class="leyenda-color bg-warning me-1"></span>
                                Seleccionado</span>
                            <span class="d-flex align-items-center"><span class="leyenda-color bg-danger me-1"></span>
                                Pagado</span>
                        </div>
                    </div>

                    <div class="row row-cols-4 row-cols-md-5 g-3 mb-5">
                        <?php if (empty($boletos)): ?>
                            <div class="col-12 text-center py-5">
                                <i class="bi bi-ticket-perforated text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3">No hay boletos generados para esta rifa.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($boletos as $boleto): ?>
                                <div class="col">
                                    <?php if ($boleto['estado'] === 'pagado'): ?>
                                        <button type="button" class="btn btn-danger w-100 boleto-box disabled opacity-75"
                                            title="No disponible">
                                            <?= str_pad($boleto['numero_boleto'], 2, '0', STR_PAD_LEFT) ?>
                                        </button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-outline-success w-100 boleto-box boleto-disponible"
                                            data-id="<?= $boleto['id'] ?>"
                                            data-numero="<?= str_pad($boleto['numero_boleto'], 2, '0', STR_PAD_LEFT) ?>">
                                            <?= str_pad($boleto['numero_boleto'], 2, '0', STR_PAD_LEFT) ?>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <form action="" method="POST" id="form-compra">
                        <?= csrf_field() ?>

                        <input type="hidden" name="rifa_id" value="<?= $rifa['id'] ?>">
                        <input type="hidden" name="boleto_id" id="input_boleto_id" required>

                        <div class="text-end border-t pt-3">
                            <button type="button" id="btn-submit-compra" class="btn btn-primary px-5 py-2 shadow-sm"
                                disabled>
                                <i class="bi bi-cart-check me-2"></i>Pagar Boleto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

    /* Estilos específicos para la cuadrícula */
    .boleto-box {
        aspect-ratio: 1 / 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: bold;
        border-width: 2px;
        transition: all 0.2s ease;
    }

    .boleto-box:hover:not(.disabled) {
        transform: scale(1.05);
    }

    /* Clase que se añade por JS al seleccionar */
    .boleto-seleccionado {
        background-color: #ffc107 !important;
        border-color: #ffc107 !important;
        color: #000 !important;
    }

    .leyenda-color {
        width: 12px;
        height: 12px;
        display: inline-block;
        border-radius: 3px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const boletos = document.querySelectorAll('.boleto-disponible');
        const inputBoletoId = document.getElementById('input_boleto_id');
        const btnSubmit = document.getElementById('btn-submit-compra');
        const resumenSeleccion = document.getElementById('resumen-seleccion');
        const numeroElegido = document.getElementById('numero-elegido');

        // Lógica de selección exclusiva (Solo uno a la vez)
        boletos.forEach(boleto => {
            boleto.addEventListener('click', function () {
                // 1. Limpiar selecciones previas (quitar amarillo, volver a verde)
                boletos.forEach(b => {
                    b.classList.remove('boleto-seleccionado', 'btn-warning');
                    b.classList.add('btn-outline-success');
                });

                // 2. Marcar el clickeado de amarillo
                this.classList.remove('btn-outline-success');
                this.classList.add('boleto-seleccionado', 'btn-warning');

                // 3. Guardar el ID en el input oculto
                inputBoletoId.value = this.getAttribute('data-id');

                // 4. Actualizar interfaz visual
                numeroElegido.innerText = this.getAttribute('data-numero');
                resumenSeleccion.classList.remove('d-none');

                // 5. Habilitar el botón de pago
                btnSubmit.removeAttribute('disabled');
            });
        });

        // Lógica de SweetAlert para confirmar compra
        btnSubmit.addEventListener('click', function () {
            const num = numeroElegido.innerText;
            Swal.fire({
                title: `¿Confirmas la compra?`,
                text: `Estás a punto de pagar el boleto #${num}.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, pagar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario por POST a la ruta correcta con el ID del boleto
                    const form = document.getElementById('form-compra');
                    form.action = "<?= base_url('boletos/procesar-compra') ?>/" + inputBoletoId.value;
                    form.submit();
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>