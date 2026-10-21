<?php
namespace App\Controllers;

use App\Models\EjercicioModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Exercises extends BaseController
{
    private EjercicioModel $ejercicios;

    public function __construct()
    {
        $this->ejercicios = new EjercicioModel();
    }

    // R: Mostrar Listado
    public function index()
    {
        return view('ejercicios/index', [
            'ejercicios' => $this->ejercicios->findAll()
        ]);
    }

    // C: Formulario de alta vacío
    public function nuevo()
    {
        return view('ejercicios/form', ['ejercicio' => null]);
    }

    // C: Procesar el guardado
    public function guardar()
    {
        $datos = $this->request->getPost(['id_rutina', 'nombre_ejercicio', 'series', 'repeticiones', 'descanso_segundos']);
        
        if (!$this->ejercicios->insert($datos)) {
            return redirect()->back()->withInput()->with('errores', $this->ejercicios->errors());
        }

        return redirect()->to('/ejercicios')->with('mensaje', 'Ejercicio creado con éxito.');
    }

    // U: Formulario de edición con datos cargados
    public function editar(int $id)
    {
        return view('ejercicios/form', ['ejercicio' => $this->buscar($id)]);
    }

    // U: Procesar la actualización
    public function actualizar(int $id)
    {
        $this->buscar($id);
        $datos = $this->request->getPost(['id_rutina', 'nombre_ejercicio', 'series', 'repeticiones', 'descanso_segundos']);

        if (!$this->ejercicios->update($id, $datos)) {
            return redirect()->back()->withInput()->with('errores', $this->ejercicios->errors());
        }

        return redirect()->to('/ejercicios')->with('mensaje', 'Ejercicio actualizado.');
    }

    // D: Eliminar registro
    public function eliminar(int $id)
    {
        $this->buscar($id);
        $this->ejercicios->delete($id);
        return redirect()->to('/ejercicios')->with('mensaje', 'Ejercicio eliminado.');
    }

    // Método auxiliar de control de existencia (404)
    private function buscar(int $id): array
    {
        $ejercicio = $this->ejercicios->find($id);
        if ($ejercicio === null) {
            throw PageNotFoundException::forPageNotFound('No existe el ejercicio ' . $id);
        }
        return $ejercicio;
    }
}
