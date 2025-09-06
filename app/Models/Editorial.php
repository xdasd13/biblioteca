<?php

namespace App\Models;

use CodeIgniter\Model;

class Editorial extends Model
{
    protected $table            = 'editoriales';
    protected $primaryKey       = 'ideditorial';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['editorial', 'nacionalidad'];

    // Dates
    protected $useTimestamps = false;

    // Validation
    protected $validationRules = [
        'editorial' => 'required|max_length[200]|min_length[3]',
        'nacionalidad' => 'required|max_length[200]|min_length[3]'
    ];

    protected $validationMessages = [
        'editorial' => [
            'required' => 'El nombre de la editorial es obligatorio',
            'max_length' => 'El nombre no puede exceder 200 caracteres',
            'min_length' => 'El nombre debe tener al menos 3 caracteres'
        ],
        'nacionalidad' => [
            'required' => 'La nacionalidad es obligatoria',
            'max_length' => 'La nacionalidad no puede exceder 200 caracteres',
            'min_length' => 'La nacionalidad debe tener al menos 3 caracteres'
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
}
