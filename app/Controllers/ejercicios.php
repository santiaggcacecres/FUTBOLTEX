<?php
namespace App\Controllers;

use App\Models\EjercicioModel;
use App\Models\RutinaModel; // Necesario para rellenar el selector select
use CodeIgniter\Exceptions\PageNotFoundException;

class Ejercicios extends BaseController
{
    private EjercicioModel $ejercicios;
    private RutinaModel $rutinas;

    public function __construct()
    {
        $this->ejercicios = new EjercicioModel();
        $this->rutinas = new RutinaModel();
    }

    // R: Listar ejercicios
    public function index()
    {
        return view('ejercicios/index', [
            'ejercicios' => $this->ejercicios->orderBy('nombre')->findAll()
        ]);
    }

    // C: Formulario de nuevo registro
    public function nuevo()
    {
        return view('ejercicios/form', [
            'ejercicio' => null,
            'rutinas'   => $this->rutinas->orderBy('nombre', 'ASC')->findAll()
        ]);
    }

    // C: Procesar guardado
    public function guardar()
    {
        $datos = $this->request->getPost(['rutina_id', 'nombre', 'series', 'repeticiones', 'descanso']);
        
        if (! $this->ejercicios->insert($datos)) {
            return redirect()->back()->withInput()->with('errores', $this->ejercicios->errors());
        }
        return redirect()->to('/ejercicios')->with('mensaje', 'Ejercicio registrado correctamente.');
    }

    // U: Cargar datos para edición
    public function editar(int $id)
    {
        return view('ejercicios/form', [
            'ejercicio' => $this->buscar($id),
            'rutinas'   => $this->rutinas->orderBy('nombre', 'ASC')->findAll()
        ]);
    }

    // U: Guardar cambios
    public function actualizar(int $id)
    {
        $this->buscar($id);
        $datos = $this->request->getPost(['rutina_id', 'nombre', 'series', 'repeticiones', 'descanso']);
        
        if (! $this->ejercicios->update($id, $datos)) {
            return redirect()->back()->withInput()->with('errores', $this->ejercicios->errors());
        }
        return redirect()->to('/ejercicios')->with('mensaje', 'Ejercicio actualizado con éxito.');
    }

    // D: Eliminar registro
    public function eliminar(int $id)
    {
        $this->buscar($id);
        $this->ejercicios->delete($id);
        return redirect()->to('/ejercicios')->with('mensaje', 'Ejercicio eliminado.');
    }

    // Método seguro reutilizable de búsqueda
    private function buscar(int $id): array
    {
        $ejercicio = $this->ejercicios->find($id);
        if ($ejercicio === null) {
            throw PageNotFoundException::forPageNotFound('No se encontró el ejercicio solicitado con ID: ' . $id);
        }
        return $ejercicio;
    }
}
