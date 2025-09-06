<?php

namespace App\Models;

use CodeIgniter\Model;

class Categoria extends Model
{
    protected $table            = 'categorias';
    protected $primaryKey       = 'idcategoria';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['categoria'];

    // Dates
    protected $useTimestamps = false;

    // Validation
    protected $validationRules = [
        'categoria' => 'required|max_length[200]|min_length[3]'
    ];

    protected $validationMessages = [
        'categoria' => [
            'required' => 'El nombre de la categoría es obligatorio',
            'max_length' => 'El nombre no puede exceder 200 caracteres',
            'min_length' => 'El nombre debe tener al menos 3 caracteres'
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
     * Obtener categorías con sus subcategorías
     */
    public function getCategoriasConSubcategorias()
    {
        return $this->select('categorias.*, subcategorias.idsubcategoria, subcategorias.subcategoria')
                    ->join('subcategorias', 'subcategorias.idcategoria = categorias.idcategoria', 'left')
                    ->orderBy('categorias.categoria', 'ASC')
                    ->orderBy('subcategorias.subcategoria', 'ASC')
                    ->findAll();
    }
}
