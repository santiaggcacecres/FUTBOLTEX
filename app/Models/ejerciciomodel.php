<?php
namespace App\Models;
use CodeIgniter\Model;

class EjercicioModel extends Model
{
    protected $table            = 'ejercicios';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = true; // Rellena de forma automática created_at y updated_at
    
    // Campos permitidos para transacciones seguras
    protected $allowedFields    = ['rutina_id', 'nombre', 'series', 'repeticiones', 'descanso']; 

    protected $validationRules = [
        'rutina_id'    => 'required|is_not_unique[rutinas.id]',
        'nombre'       => 'required|min_length[3]|max_length[100]',
        'series'       => 'required|is_natural_no_zero',
        'repeticiones' => 'required|is_natural_no_zero',
        'descanso'     => 'required|is_natural',
    ];

    protected $validationMessages = [
        'rutina_id' => [
            'is_not_unique' => 'La rutina seleccionada no es válida o no existe.'
        ],
        'nombre' => [
            'required'   => 'El nombre del ejercicio es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.'
        ]
    ];
}
