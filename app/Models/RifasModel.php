<?php 
#RIFAS/app/models/RifasModel.php

namespace App\Models;

//importar model
use CodeIgniter\Model;

class RifasModel extends Model
{

protected $table ="rifas";

protected $primaryKey = "id";

//para eliminar registros virtualmente
protected $useSoftDeletes = false;

//Campos que se pueden insertar/editar
protected $allowedFields =[
    "nombre",
    "descripcion",
    "costo_boleto",
    "fecha_sorteo",
    "premio",
    "imagen_promocional"
];

protected $useTimestamps = false;
protected $createdField = 'created_at';
protected $updatedField = 'updated_at';

}