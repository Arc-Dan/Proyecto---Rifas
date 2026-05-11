<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="col-md-8">
    <div class="card p-4">
        <h5 class="fw-bold mb-3">EDITAR RIFA</h5>

        <?php if (session()->getFlashdata('errors')) {
            foreach (session()->getFlashdata('errors') as $error) {
                ?>
                <div class="alert alert-danger">
                    <?= esc($error) ?>
                </div>

            <?php }
        } ?>

        <form action="<?= base_url('rifas-dashboard/' . $rifa['id'] . '/update') ?>" method="POST">

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= old('nombre', $rifa["nombre"]) ?>"
                    required="true">
            </div>

            <div class="form-group">
                <label> Descripción</label>
                <input type="text" name="descripcion" maxlength="250"
                    value="<?= old('descripcion', $rifa["descripcion"]) ?>" required="true" class="form-control">
            </div>

            <div class="form-group">
                <label>Costo del boleto</label>
                <input type="number" step="0.01" name="costo_boleto"
                    value="<?= old('costo_boleto', $rifa["costo_boleto"]) ?>" class="form-control" required="true">
            </div>

            <div class="form-group">
                <label>Fecha del sorteo</label>
                <input type="date" name="fecha_sorteo"
                    value="<?= old('fecha_sorteo', date('Y-m-d', strtotime($rifa["fecha_sorteo"]))) ?>"
                    class="form-control" required="true">
            </div>

            <div class="form-group">
                <label>Premio</label>
                <input type="text" name="premio" maxlength="250" value="<?= old('premio', $rifa["premio"]) ?>"
                    class="form-control" required="true">
            </div>

            <div class="form-group">
                <label>URL de Imagen promocional</label>
                <input type="text" name="imagen_promocional"
                    value="<?= old('imagen_promocional', $rifa["imagen_promocional"]) ?>" class="form-control">
            </div>

            <br>
            <button type="submit" class="btn btn-success ">GUARDAR</button>
        </form>


    </div>
</div>

<?= $this->endSection(); ?>