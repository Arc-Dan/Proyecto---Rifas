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

    <a href="<?= base_url('boletos/rifa/' . $rifa['id']) ?>" class="btn btn-primary">Dashboard de Boletos</a>
</section>


<?= $this->endSection() ?>