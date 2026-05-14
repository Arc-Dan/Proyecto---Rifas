<?php

// Determina si una rifa ya terminó basándose en el campo resultado de los boletos.
function rifa_terminada_por_boletos(array $boletos): bool
{
    foreach ($boletos as $boleto) {
        if (!empty($boleto['resultado']) && in_array($boleto['resultado'], ['primero', 'segundo', 'tercero'], true)) {
            return true;
        }
    }

    return false;
}

// Determina si una rifa ya terminó basándose en el id de la rifa.
function rifa_terminada_por_id($rifa_id): bool
{
    $boletos = new \App\Models\BoletoModel();
    $ganador = $boletos->where('rifa_id', $rifa_id)
                       ->whereIn('resultado', ['primero', 'segundo', 'tercero'])
                       ->first();

    return !empty($ganador);
}
