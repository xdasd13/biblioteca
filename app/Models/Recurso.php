<?php

namespace App\Models;

use CodeIgniter\Model;

class Recurso extends Model
{
    protected $table            = 'recursos';
    protected $primaryKey       = 'idrecurso';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'idsubcategoria',
        'ideditorial', 
        'tipo',
        'titulo',
        'apublicacion',
        'isbn',
        'numpaginas',
        'rutaportada',
        'rutarecurso',
        'estado'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado';
    protected $updatedField  = 'modificado';

    // Validation
    protected $validationRules = [
        'idsubcategoria' => 'required|integer|is_not_unique[subcategorias.idsubcategoria]',
        'ideditorial'    => 'required|integer|is_not_unique[editoriales.ideditorial]',
        'tipo'           => 'required|in_list[Físico,Digital]',
        'titulo'         => 'required|max_length[200]|min_length[3]',
        'apublicacion'   => 'required|integer|greater_than[1900]|less_than_equal_to[' . date('Y') . ']',
        'isbn'           => 'required|max_length[20]|min_length[10]|is_unique[recursos.isbn,idrecurso,{idrecurso}]',
        'numpaginas'     => 'required|integer|greater_than[0]',
        'rutaportada'    => 'permit_empty|max_length[200]',
        'rutarecurso'    => 'permit_empty|max_length[200]',
        'estado'         => 'required|in_list[Bueno,Regular,Malo]'
    ];

    protected $validationMessages = [
        'idsubcategoria' => [
            'required' => 'La subcategoría es obligatoria',
            'integer' => 'La subcategoría debe ser un número válido',
            'is_not_unique' => 'La subcategoría seleccionada no existe'
        ],
        'ideditorial' => [
            'required' => 'La editorial es obligatoria',
            'integer' => 'La editorial debe ser un número válido',
            'is_not_unique' => 'La editorial seleccionada no existe'
        ],
        'tipo' => [
            'required' => 'El tipo de recurso es obligatorio',
            'in_list' => 'El tipo debe ser Físico o Digital'
        ],
        'titulo' => [
            'required' => 'El título es obligatorio',
            'max_length' => 'El título no puede exceder 200 caracteres',
            'min_length' => 'El título debe tener al menos 3 caracteres'
        ],
        'apublicacion' => [
            'required' => 'El año de publicación es obligatorio',
            'integer' => 'El año debe ser un número válido',
            'greater_than' => 'El año debe ser mayor a 1900',
            'less_than_equal_to' => 'El año no puede ser mayor al año actual'
        ],
        'isbn' => [
            'required' => 'El ISBN es obligatorio',
            'max_length' => 'El ISBN no puede exceder 20 caracteres',
            'min_length' => 'El ISBN debe tener al menos 10 caracteres',
            'is_unique' => 'Este ISBN ya está registrado'
        ],
        'numpaginas' => [
            'required' => 'El número de páginas es obligatorio',
            'integer' => 'El número de páginas debe ser un número válido',
            'greater_than' => 'El número de páginas debe ser mayor a 0'
        ],
        'estado' => [
            'required' => 'El estado del recurso es obligatorio',
            'in_list' => 'El estado debe ser Bueno, Regular o Malo'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Obtener todos los recursos con información completa (JOIN)
     */
    public function getRecursosCompletos()
    {
        return $this->select('recursos.*, 
                             editoriales.editorial, 
                             editoriales.nacionalidad,
                             categorias.categoria,
                             subcategorias.subcategoria')
                    ->join('subcategorias', 'subcategorias.idsubcategoria = recursos.idsubcategoria')
                    ->join('categorias', 'categorias.idcategoria = subcategorias.idcategoria')
                    ->join('editoriales', 'editoriales.ideditorial = recursos.ideditorial')
                    ->orderBy('recursos.creado', 'DESC')
                    ->findAll();
    }

    /**
     * Obtener un recurso específico con información completa
     */
    public function getRecursoCompleto($id)
    {
        return $this->select('recursos.*, 
                             editoriales.editorial, 
                             editoriales.nacionalidad,
                             categorias.categoria,
                             subcategorias.subcategoria')
                    ->join('subcategorias', 'subcategorias.idsubcategoria = recursos.idsubcategoria')
                    ->join('categorias', 'categorias.idcategoria = subcategorias.idcategoria')
                    ->join('editoriales', 'editoriales.ideditorial = recursos.ideditorial')
                    ->where('recursos.idrecurso', $id)
                    ->first();
    }

    /**
     * Buscar recursos por título
     */
    public function buscarPorTitulo($titulo)
    {
        return $this->select('recursos.*, 
                             editoriales.editorial, 
                             editoriales.nacionalidad,
                             categorias.categoria,
                             subcategorias.subcategoria')
                    ->join('subcategorias', 'subcategorias.idsubcategoria = recursos.idsubcategoria')
                    ->join('categorias', 'categorias.idcategoria = subcategorias.idcategoria')
                    ->join('editoriales', 'editoriales.ideditorial = recursos.ideditorial')
                    ->like('recursos.titulo', $titulo)
                    ->orderBy('recursos.creado', 'DESC')
                    ->findAll();
    }
}
