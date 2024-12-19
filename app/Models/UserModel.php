<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['username', 'nama', 'password', 'level'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'username' => 'is_unique[user.username]|required|min_length[3]',
        'nama' => 'required|min_length[3]',
        'password' => 'required|min_length[8]',
        'level' => 'required',
    ];
    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Sorry. That username has already been taken. Please choose another.',
            'required' => 'username tidak boleh kosong.',
            'min_length' => 'username terlalu singkat.'
        ],
        'nama' => [
            'required' => 'nama tidak boleh kosong.',
            'min_length' => 'nama terlalu singkat.'
        ],
        'password' => [
            'required' => 'password tidak boleh kosong.',
            'min_length' => 'password terlalu singkat.'
        ],
        'level' => [
            'required' => 'level tidak boleh kosong.',
        ],
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function savedata()
    {

    }
}
