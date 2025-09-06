<?php

namespace App\Controllers;

use App\Models\Recurso;
use App\Models\Categoria;
use App\Models\Editorial;

class RecursoController extends BaseController
{
    protected $recursoModel;
    protected $categoriaModel;
    protected $editorialModel;

    public function __construct()
    {
        $this->recursoModel = new Recurso();
        $this->categoriaModel = new Categoria();
        $this->editorialModel = new Editorial();
    }

    /**
     * Vista principal - Listar todos los recursos
     */
    public function index()
    {
        $datos['recursos'] = $this->recursoModel->getRecursosCompletos();
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');
        
        return view('recursos/index', $datos);
    }

    /**
     * Vista para crear nuevo recurso
     */
    public function crear()
    {
        // Obtener categorías con subcategorías
        $categorias = $this->categoriaModel->select('categorias.*, subcategorias.idsubcategoria, subcategorias.subcategoria')
                                          ->join('subcategorias', 'subcategorias.idcategoria = categorias.idcategoria')
                                          ->orderBy('categorias.categoria', 'ASC')
                                          ->orderBy('subcategorias.subcategoria', 'ASC')
                                          ->findAll();

        // Agrupar subcategorías por categoría
        $categoriasAgrupadas = [];
        foreach ($categorias as $categoria) {
            $categoriasAgrupadas[$categoria['categoria']][] = [
                'idsubcategoria' => $categoria['idsubcategoria'],
                'subcategoria' => $categoria['subcategoria']
            ];
        }

        $datos['categorias'] = $categoriasAgrupadas;
        $datos['editoriales'] = $this->editorialModel->orderBy('editorial', 'ASC')->findAll();
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');
        
        return view('recursos/crear', $datos);
    }

    /**
     * Guardar nuevo recurso (AJAX)
     */
    public function guardar()
    {
        // Verificar que sea una petición POST
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Método no permitido'
            ]);
        }

        $datos = [
            'idsubcategoria' => $this->request->getPost('idsubcategoria'),
            'ideditorial' => $this->request->getPost('ideditorial'),
            'tipo' => $this->request->getPost('tipo'),
            'titulo' => $this->request->getPost('titulo'),
            'apublicacion' => $this->request->getPost('apublicacion'),
            'isbn' => preg_replace('/[^0-9]/', '', $this->request->getPost('isbn')), // Remover guiones
            'numpaginas' => $this->request->getPost('numpaginas'),
            'rutaportada' => $this->request->getPost('rutaportada'),
            'rutarecurso' => $this->request->getPost('rutarecurso'),
            'estado' => $this->request->getPost('estado')
        ];

        // Validar datos
        if (!$this->recursoModel->validate($datos)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $this->recursoModel->errors()
            ]);
        }

        try {
            $idRecurso = $this->recursoModel->insert($datos);
            
            if ($idRecurso) {
                // Obtener el recurso recién creado con toda la información
                $recursoCompleto = $this->recursoModel->getRecursoCompleto($idRecurso);
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Recurso registrado exitosamente',
                    'data' => $recursoCompleto
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Error al registrar el recurso'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error del servidor: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Buscar recursos por título (AJAX)
     */
    public function buscar()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Acceso no autorizado'
            ]);
        }

        $titulo = $this->request->getPost('titulo');
        
        if (empty($titulo)) {
            $recursos = $this->recursoModel->getRecursosCompletos();
        } else {
            $recursos = $this->recursoModel->buscarPorTitulo($titulo);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $recursos
        ]);
    }

    /**
     * Obtener subcategorías por categoría (AJAX)
     */
    public function getSubcategorias($idCategoria = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Acceso no autorizado'
            ]);
        }

        if (!$idCategoria) {
            $idCategoria = $this->request->getPost('idcategoria');
        }

        $subcategorias = $this->db->table('subcategorias')
                                  ->where('idcategoria', $idCategoria)
                                  ->orderBy('subcategoria', 'ASC')
                                  ->get()
                                  ->getResultArray();

        return $this->response->setJSON([
            'success' => true,
            'data' => $subcategorias
        ]);
    }

    /**
     * Eliminar recurso (AJAX)
     */
    public function eliminar($id = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Acceso no autorizado'
            ]);
        }

        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID de recurso no válido'
            ]);
        }

        try {
            if ($this->recursoModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Recurso eliminado exitosamente'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Error al eliminar el recurso'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error del servidor: ' . $e->getMessage()
            ]);
        }
    }
}