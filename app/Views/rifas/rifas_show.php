<?= $this->extend('layout/dashboard'); ?>


<?= $this->section('content') ?>


<section class="col-11">
    <div class="card">
        <br>
        <h3 style="text-align:center;">
            <?= $rifa["nombre"]; ?>
        </h3>
        <hr>
        <ul>
            <li>ID: <?= $rifa["id"]; ?></li>
            <li>Precio del boleto: <?= $rifa["costo_boleto"]; ?> </li>
            <li>Descripcion: <?= $rifa["descripcion"]; ?> </li>
            <li>Fecha del sorteo: <?= $rifa["fecha_sorteo"]; ?></li>
            <li>Imagen promocional: <?= $rifa["imagen_promocional"]; ?></li>
        </ul>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="<?= base_url('boletos/rifa/' . $rifa['id']) ?>" class="btn btn-primary">Dashboard de Boletos</a>
    </div>

    <?php $rifaFinalizada = rifa_terminada_por_boletos($boletos); ?>

    <?php if (!$rifaFinalizada): ?>
    <div style="text-align: center; margin-top: 20px;">
        <form action="<?= base_url('rifas-dashboard/' . $rifa['id'] . '/simular') ?>" method="POST" style="display: inline;">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-dice"></i> Simular Rifa
            </button>
        </form>
    </div>
    <?php else: ?>
    <div style="text-align: center; margin-top: 20px;">
        <button class="btn btn-secondary btn-lg" disabled>
            <i class="fas fa-check-circle"></i> Rifa Finalizada
        </button>
    </div>
    <?php endif; ?>
</section>


<?= $this->endSection() ?>