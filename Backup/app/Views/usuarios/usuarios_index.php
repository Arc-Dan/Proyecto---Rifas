<?= $this->extend('layout/dashboard' ); ?>

<?= $this->section('content') ?>

<section class=""col-12>
    <div class="tard">
        <h4>Tabla de usuarios</h4>

        <a href="/usuarios/create" class="btn btn-success btn-sm">
            <i class="bi bi-plus"></i>
            Crear usuario</a>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($usuarios as $usuario){  ?>
                <tr>
                    <th><?=$usuario["id"] ?></th>
                    <td><?=$usuario["nombre"] ?></td>
                    <td><?=$usuario["email"] ?></td>
                    <td><?=$usuario["status"] ?></td>
                    <td>
                        <a href="/usuarios/<?=$usuario["id"]; ?>" class="btn btn-dark btn-sm"><i class="bi bi-eye"></i></a>
                        <a href="" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <button onClick="eliminar(<?= $usuario["id"]; ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <?php  } ?>
            </tbody>

        </table>

    </div>
</section>

<script>
    function eliminar(id){
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: "btn btn-success",
    cancelButton: "btn btn-danger"
  },
  buttonsStyling: false
});
swalWithBootstrapButtons.fire({
  title: "¿Estás seguro?",
  text: "Se eliminará para siempre!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonText: "Sí, eliminar!",
  cancelButtonText: "Cancelar",
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    location.href="/usuarios/delete/"+id
  }
});
}
</script>

<?= $this->endSection() ?>