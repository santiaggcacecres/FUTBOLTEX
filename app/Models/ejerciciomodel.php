<?php
namespace App\Models;

use CodeIgniter\Model;

class EjercicioModel extends Model
{
    protected $table            = 'Ejercicios';
    protected $primaryKey       = 'id_ejercicio';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_rutina', 'nombre_ejercicio', 'series', 'repeticiones', 'descanso_segundos'];

    // Reglas de validación requeridas por la cátedra
    protected $validationRules = [
        'id_rutina'        => 'required|is_natural_no_zero',
        'nombre_ejercicio' => 'required|min_length[3]|max_length[150]',
        'series'           => 'required|is_natural_no_zero',
        'repeticiones'     => 'required|max_length[50]',
        'descanso_segundos'=> 'required|is_natural'
    ];

    protected $validationMessages = [
        'nombre_ejercicio' => ['required' => 'El nombre del ejercicio es obligatorio.'],
        'series'           => ['is_natural_no_zero' => 'Las series deben ser un número mayor a 0.']
    ];
}
