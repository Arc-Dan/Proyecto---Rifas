<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="col-md-8">
    <div class="card p-4">
        <h5 class="fw-bold mb-3">CREAR NUEVA RIFA</h5>

    <?php if( session()->getFlashdata('errors') ){
          foreach(session()->getFlashdata('errors') as $error){
    ?>
        <div class="alert alert-danger">
            <?= esc($error)  ?>
        </div>
        
    <?php }} ?> 
    
        <form action="<?= base_url('rifas-dashboard/store') ?>" method="POST" >

            <div class="form-group">
                <label > Nombre de la Rifa</label>
                <input type="text" name="nombre" value="<?= old('nombre') ?>" class="form-control" required="true" >
            </div>      
            
            <div class="form-group">
                <label > Descripción</label>
                <textarea name="descripcion" class="form-control" maxlength="250" required="true"><?= old('descripcion') ?></textarea>
            </div>      
            
            <div class="form-group">
                <label > Costo del boleto</label>
                <input type="number" step="0.01" name="costo_boleto" value="<?= old('costo_boleto') ?>" required="true" class="form-control">
            </div>      

            <div class="form-group">
                <label > Fecha del sorteo</label>
                <input type="date" name="fecha_sorteo" value="<?= old('fecha_sorteo') ?>" required="true" class="form-control">
            </div>

            <div class="form-group">
                <label > Premio Principal</label>
                <input type="text" name="premio" value="<?= old('premio') ?>" required="true" class="form-control">
            </div>

            <div class="form-group">
                <label > URL Imagen Promocional</label>
                <input type="text" name="imagen_promocional" value="<?= old('imagen_promocional') ?>" class="form-control">
            </div>

            <br> 
            <button type="submit" class="btn btn-success w-100">CREAR RIFA</button>
        </form>


    </div>
</div>

<?= $this->endSection(); ?>