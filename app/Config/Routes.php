<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

# "URL" , "Archivo Controlador PHP:: funcion" 
$routes->get('/', 'Home::index');


$routes->get('/saludar', 'Home::saludar');

$routes->get('/saludar2/(:alpha)/(:num)', 'Home::saludar2/$1/$2');

# (:num), (:alpha), (:segment), o (:any)


$routes->get('/calculadora', 'Calculadora::index');

$routes->post('/calculadora/sumar', 'Calculadora::sumar');

$routes->post(
    '/calculadora/calcular'
    ,
    'Calculadora::calcular'
);

$routes->get('/usuariotest', 'Home::usuarioTest');


$routes->group("usuarios", function ($routes) {

    #GET Mostrar usuarios (VIEW)  
    $routes->get("", "UsuarioController::index");   #"localhost:8080/usuarios/"

    #GET Mostar usuario {id} (VIEW)
    $routes->get("(:num)", "UsuarioController::show/$1");  #"localhost:8080/usuarios/5"

    #GET mostrar formulario para agregar usuario (VIEW)
    $routes->get("create", "UsuarioController::create");
    #POST accion: crear usuario  (redicrecciona -> usuarios/{id})
    $routes->post("store", "UsuarioController::store");

    #GET Mostrar formulario para editar usuario {id} (VIEW)
    $routes->get("edit/(:num)", "UsuarioController::edit/$1");
    #POST Accion: actualizar info del usuario {id} en la base de datos (Redireccion -> /usuarios)
    $routes->post("update/(:num)", "UsuarioController::update/$1");

    #POST accion: eliminar usuario {id}
    $routes->get("delete/(:num)", "UsuarioController::delete/$1");

    #GET mostrar login
    $routes->get("login", "UsuarioController::login");
    #post accion: validar login
    $routes->post("auth", "UsuarioController::auth");
    #get acción de un botón: logout
    $routes->get("logout", "UsuarioController::logout");
    #
    $routes->get("activar/(:num)/(:num)", "UsuarioController::activar/$1/$2");

});

/**
 * ========== RUTAS DE RIFAS ==========
 * Grupo de rutas para gestión de rifas
 * Requiere autenticación (Admin/Trabajador)
 */

$routes->group("rifas-dashboard", function ($routes) {

    # ADMIN/TRABAJADOR: Ver todas las rifas
    $routes->get("", "RifasController::index");

    # ADMIN/TRABAJADOR: Mostrar formulario para crear rifa
    $routes->get("create", "RifasController::create");

    # ADMIN/TRABAJADOR: Guardar nueva rifa
    $routes->post("store", "RifasController::store");

    # ADMIN/TRABAJADOR: Ver detalle de una rifa
    $routes->get("(:num)", "RifasController::show/$1");

    # ADMIN/TRABAJADOR: Mostrar formulario para editar rifa
    $routes->get("(:num)/edit", "RifasController::edit/$1");

    # ADMIN/TRABAJADOR: Actualizar rifa
    $routes->post("(:num)/update", "RifasController::update/$1");

    # SOLO ADMIN: Eliminar rifa
    $routes->get("(:num)/delete", "RifasController::delete/$1");

    # ADMIN/TRABAJADOR: Realizar sorteo automático (genera ganadores aleatorios)
    $routes->post("(:num)/simular", "RifasController::simular/$1");
    
    # ADMIN/TRABAJADOR: Ver resultados del sorteo
    $routes->get("(:num)/resultados", "RifasController::resultados/$1");
});

/**
 * ========== RUTAS DE RIFAS PÚBLICAS ==========
 * Requieren autenticación (todos los roles: admin, trabajador, cliente)
 * Accesibles para clientes autenticados para ver y comprar boletos
 */

$routes->group("rifas", function ($routes) {
    # TODOS LOS ROLES: Ver todas las rifas activas (pantalla pública)
    $routes->get("", "RifasController::publico");

    # TODOS LOS ROLES: Ver detalle de una rifa (pantalla pública)
    $routes->get("(:num)", "RifasController::showPublico/$1");
});


/**
 * ========== RUTAS DE BOLETOS ==========
 * Gestión de compra y visualización de boletos
 * Requiere autenticación
 */

$routes->group("boletos", function ($routes) {
    # Ver boletos de una rifa específica - Admins y Trabajadores
    $routes->get("rifa/(:num)", "BoletoController::poRifa/$1");

    # Mostrar formulario para comprar boleto - Clientes
    $routes->get("comprar/(:num)", "BoletoController::comprar/$1");

    # Procesar compra de boleto
    $routes->post("procesar-compra/(:num)", "BoletoController::procesarCompra/$1");

    # Ver mis boletos comprados
    $routes->get("mis-boletos", "BoletoController::misboletos");
});