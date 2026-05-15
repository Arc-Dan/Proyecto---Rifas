<?php

//Si no hay sesión, lo manda al login
function seguridad($rol = array())
{
    if (!session()->has('usuario')) {
        return redirect()->to('/usuarios/login');
    }

    if ($rol) {
        $encontrado = false;
        foreach ($rol as $r) {
            if (session()->get('usuario.rol') === $r) {
                $encontrado = true;
            }

        }

        if ($encontrado == false) {
            return redirect()->to('/rifas')->with('error', 'No tienes permisos para acceder a esta sección!');
        }
    }


}

//Si hay sesión, lo manda al dashboard principal
function noSeguridad()
{
    if (session()->has('usuario')) {
        return redirect()->to('/rifas');
    }
}