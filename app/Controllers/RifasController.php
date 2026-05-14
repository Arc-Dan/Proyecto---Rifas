<?php

/*
Modelo: Se conecta a la tabla de la base de datos

Controlador: logica de programacion (CRUD)
             y salida de datos(imprimir, view html, json, redireccion)

Routes: indicamos que url va a acceder a que funcion de que controlador

Views: Plantilla html o php con un diseño preestablecido listo para usar

*/

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RifasModel;
use App\Models\BoletoModel;

class RifasController extends BaseController
{
    #GET Mostrar todas las rifas (VIEW)
    # route: /rifas
    public function index()
    {
        // validar sesión con helper "seguridad" en autoload
        if (seguridad(['admin', 'trabajador'])) {
            return seguridad();
        }

        $model = new RifasModel();

        $rifas = $model->findAll();

        $data['rifas'] = $rifas;
        return view('rifas/index', $data);
    }

    #GET Mostrar rifa específica {id} (VIEW)
    # route: /rifas/(:num)
    public function show($id)
    {
        if (seguridad(['admin', 'trabajador'])) {
            return seguridad();
        }

        $model = new RifasModel();
        $rifa = $model->find($id);

        if (!$rifa) {
            return redirect()->to('/rifas-dashboard')->with('error', 'Rifa no encontrada');
        }

        $boletos = new BoletoModel();
        $boletosList = $boletos->where('rifa_id', $id)->findAll();

        $data = [
            "rifa" => $rifa,
            "boletos" => $boletosList
        ];

        return view("rifas/rifas_show", $data);
    }

    #GET Mostrar formulario para crear rifa (VIEW)
    # route: /rifas/create
    public function create()
    {
        if (seguridad(['admin', 'trabajador'])) {
            return seguridad();
        }
        return view("rifas/rifas_create");
    }

    #POST Guardar nueva rifa (REDIRECCIONA)
    # route: /rifas/store
    public function store()
    {
        if (seguridad(['admin', 'trabajador'])) {
            return seguridad();
        }

        $rifas = new RifasModel();

        $data = [
            "nombre" => $this->request->getPost("nombre"),
            "descripcion" => $this->request->getPost("descripcion"),
            "costo_boleto" => $this->request->getPost("costo_boleto"),
            "fecha_sorteo" => $this->request->getPost("fecha_sorteo"),
            "premio" => $this->request->getPost("premio"),
            "imagen_promocional" => $this->request->getPost("imagen_promocional")
        ];

        $rifa_id = $rifas->insert($data, true);

        //Generar boletos automáticamente (00-10)
        $this->generarBoletos($rifa_id);

        return redirect()->to("/rifas-dashboard")->with('success', 'Rifa creada exitosamente');
    }

    #GET Mostrar formulario para editar rifa (VIEW)
    # route: /rifas/(:num)/edit
    public function edit($id)
    {
        if (seguridad(['admin', 'trabajador'])) {
            return seguridad();
        }

        $rifas = new RifasModel();
        $rifa = $rifas->find($id);

        if (!$rifa) {
            return redirect()->to('/rifas-dashboard')->with('error', 'Rifa no encontrada');
        }

        $data = ["rifa" => $rifa];
        return view("rifas/rifas_edit", $data);
    }

    #POST Actualizar rifa (REDIRECCIONA)
    # route: /rifas/(:num)/update
    public function update($id)
    {
        if (seguridad(['admin', 'trabajador'])) {
            return seguridad();
        }

        $rifas = new RifasModel();
        $rifa = $rifas->find($id);

        if (!$rifa) {
            return redirect()->to('/rifas-dashboard')->with('error', 'Rifa no encontrada');
        }

        $data = [
            "nombre" => $this->request->getPost("nombre"),
            "descripcion" => $this->request->getPost("descripcion"),
            "costo_boleto" => $this->request->getPost("costo_boleto"),
            "fecha_sorteo" => $this->request->getPost("fecha_sorteo"),
            "premio" => $this->request->getPost("premio"),
            "imagen_promocional" => $this->request->getPost("imagen_promocional")
        ];

        $rifas->update($id, $data);

        return redirect()->to("/rifas-dashboard/" . $id)->with('success', 'Rifa actualizada exitosamente');
    }

    #POST Eliminar rifa (REDIRECCIONA)
    # route: /rifas/(:num)/delete
    public function delete($id)
    {
        if (seguridad(['admin'])) {
            return seguridad();
        }

        $rifas = new RifasModel();
        $rifa = $rifas->find($id);

        if (!$rifa) {
            return redirect()->to('/rifas-dashboard')->with('error', 'Rifa no encontrada');
        }

        //Eliminar boletos asociados
        $boletos = new BoletoModel();
        $boletos->where('rifa_id', $id)->delete();

        //Eliminar rifa
        $rifas->delete($id);

        return redirect()->to("/rifas-dashboard")->with('success', 'Rifa eliminada exitosamente');
    }

    #POST Simular sorteo automático (REDIRECCIONA)
    # route: /rifas/(:num)/simular
    public function simular($id)
    {
        if (seguridad(['admin', 'trabajador'])) {
            return seguridad();
        }

        $rifas = new RifasModel();
        $rifa = $rifas->find($id);

        if (!$rifa) {
            return redirect()->to('/rifas-dashboard')->with('error', 'Rifa no encontrada');
        }

        $boletos = new BoletoModel();

        // Evitar simular si la rifa ya tiene ganadores
        if (rifa_terminada_por_id($id)) {
            return redirect()->to('/rifas-dashboard/' . $id)
                            ->with('error', 'La rifa ya fue simulada');
        }

        $boletosPagados = $boletos->where('rifa_id', $id)
                                ->where('estado', 'pagado')
                                ->findAll();

        if (count($boletosPagados) < 3) {
            return redirect()->to('/rifas-dashboard/' . $id)
                            ->with('error', 'No hay suficientes boletos pagados (mínimo 3)');
        }

        // Seleccionar 3 ganadores aleatorios
        $indices = array_rand($boletosPagados, 3);
        $resultados = ["primero", "segundo", "tercero"];
        $ganadoresIds = [];

        foreach ($indices as $i => $index) {
            $ganadorId = $boletosPagados[$index]['id'];
            $ganadoresIds[] = $ganadorId;
            (new BoletoModel())->update($ganadorId, ['resultado' => $resultados[$i]]);
        }

        // Marcar a los perdedores como 'ninguno' para evitar posibles ambigüedades
        foreach ($boletosPagados as $boleto) {
            if (!in_array($boleto['id'], $ganadoresIds)) {
                (new BoletoModel())->update($boleto['id'], ['resultado' => 'ninguno']);
            }
        }
        //Marcar rifa como finalizada

        // Redirigir a la vista de resultados
        return redirect()->to('/rifas-dashboard/' . $id . '/resultados')
                        ->with('success', 'Sorteo realizado exitosamente');
    }

    public function resultados($id)
    {
        if (seguridad(['admin', 'trabajador', 'cliente'])) {
            return seguridad();
        }

        $rifas = new RifasModel();
        $boletos = new BoletoModel();

        $rifa = $rifas->find($id);
        if (!$rifa) {
            return redirect()->to('/rifas-dashboard')->with('error', 'Rifa no encontrada');
        }

        $data = [
            'rifa' => $rifa,
            'boletos' => $boletos->where('rifa_id', $id)->findAll()
        ];

        return view('rifas/rifas_resultados', $data);
    }


    /*
    public function simular($id)
    {
        if (seguridad(['admin', 'trabajador'])) {
            return seguridad();
        }

        $rifas = new RifasModel();
        $rifa = $rifas->find($id);

        if (!$rifa) {
            return redirect()->to('/rifas-dashboard')->with('error', 'Rifa no encontrada');
        }

        $boletos = new BoletoModel();
        $boletosPagados = $boletos->where('rifa_id', $id)->where('estado', 'pagado')->findAll();

        if (count($boletosPagados) < 3) {
            return redirect()->to('/rifas-dashboard/' . $id)->with('error', 'No hay suficientes boletos pagados (mínimo 3)');
        }

        // Seleccionar 3 ganadores aleatorios
        $ganadores = array_rand($boletosPagados, 3);

        $boletos->update($boletosPagados[$ganadores[0]]['id'], ['resultado' => 'primero']);
        $boletos->update($boletosPagados[$ganadores[1]]['id'], ['resultado' => 'segundo']);
        $boletos->update($boletosPagados[$ganadores[2]]['id'], ['resultado' => 'tercero']);

        // Sorteo realizado exitosamente

        return redirect()->to('/rifas-dashboard/' . $id)->with('success', 'Sorteo realizado exitosamente con ganadores aleatorios');
    }
*/
    #GET Ver rifas públicas (con login requerido)
    # route: /rifas-publico
    public function publico()
    {
        if (seguridad(['admin', 'trabajador', 'cliente'])) {
            return seguridad();
        }

        $rifas = new RifasModel();
        $data['rifas'] = $rifas->findAll();
        return view('rifas/catalogo', $data);
    }

    #GET Ver rifa pública específica (con login requerido)
    # route: /rifas-publico/(:num)
    public function showPublico($id)
    {
        if (seguridad(['admin', 'trabajador', 'cliente'])) {
            return seguridad();
        }

        return redirect()->to('/boletos/rifa/' . $id);
    }


    //FUNCIÓN AUXILIAR: Generar boletos automáticamente (00-10)
    private function generarBoletos($rifa_id)
    {
        $boletos = new BoletoModel();
        for ($i = 1; $i <= 10; $i++) {
            $numero = str_pad($i, 2, '0', STR_PAD_LEFT);
            $boletos->insert([
                'rifa_id' => $rifa_id,
                'numero_boleto' => $numero,
                'estado' => 'disponible'
            ]);
        }
    }
}