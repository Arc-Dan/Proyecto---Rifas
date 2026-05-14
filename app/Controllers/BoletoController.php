<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BoletoModel;
use App\Models\RifasModel;

class BoletoController extends BaseController
{
    #GET Mostrar todos los boletos de una rifa (VIEW)
    # route: /boletos/rifa/(:num)
    public function poRifa($rifa_id)
    {
        if (seguridad(['admin', 'trabajador', 'cliente'])) {
            return seguridad();
        }

        $boletos = new BoletoModel();
        $data['boletos'] = $boletos->where('rifa_id', $rifa_id)->findAll();

        $rifas = new RifasModel();
        $data['rifa'] = $rifas->find($rifa_id);

        return view('boletos/index', $data);
    }

    #GET Mostrar formulario para comprar boleto (VIEW)
    # route: /boletos/comprar/(:num)
    public function comprar($boleto_id)
    {
        if (seguridad(['cliente'])) {
            return seguridad();
        }

        $boletos = new BoletoModel();
        $boleto = $boletos->find($boleto_id);

        if (!$boleto) {
            return redirect()->back()->with('error', 'Boleto no encontrado');
        }

        if ($boleto['estado'] !== 'disponible') {
            return redirect()->back()->with('error', 'Este boleto no está disponible');
        }

        $data = ["boleto" => $boleto];
        return view("boletos/comprar", $data);
    }

    #POST Procesar compra de boleto (REDIRECCIONA)
    # route: /boletos/procesar-compra/(:num)
    public function procesarCompra($boleto_id)
    {
        if (seguridad(['cliente'])) {
            return seguridad();
        }

        $boletos = new BoletoModel();
        $boleto = $boletos->find($boleto_id);

        if (!$boleto) {
            return redirect()->back()->with('error', 'Boleto no encontrado');
        }

        if ($boleto['estado'] !== 'disponible') {
            return redirect()->back()->with('error', 'Este boleto no está disponible');
        }

        $data = [
            "cliente_id" => session()->get("usuario.id"),
            "estado" => "pagado",
            "fecha_compra" => date('Y-m-d H:i:s')
        ];

        $boletos->update($boleto_id, $data);

        return redirect()->to('/boletos/rifa/' . $boleto['rifa_id'])->with('success', 'Boleto comprado exitosamente');
    }

    #GET Mostrar mis boletos comprados (VIEW)
    # route: /boletos/mis-boletos
    public function misboletos()
    {
        if (seguridad(['cliente'])) {
            return seguridad();
        }

        $boletos = new BoletoModel();
        $cliente_id = session()->get("usuario.id");

        $data['boletos'] = $boletos->where('cliente_id', $cliente_id)->findAll();

        return view("boletos/mis-boletos", $data);
    }
}