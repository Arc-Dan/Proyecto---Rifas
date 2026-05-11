<?php 
#RIFAS/app/models/BoletoModel.php

namespace App\Models;

//importar model
use CodeIgniter\Model;

class BoletoModel extends Model
{

protected $table ="boletos";

protected $primaryKey = "id";

//para eliminar registros virtualmente
protected $useSoftDeletes = false;

//Campos que se pueden insertar/editar
protected $allowedFields =[
    "rifa_id",
    "numero_boleto",
    "cliente_id",
    "estado",
    "resultado",
    "fecha_compra"
];

protected $useTimestamps = false;
protected $createdField = 'created_at';
protected $updatedField = 'updated_at';
}
