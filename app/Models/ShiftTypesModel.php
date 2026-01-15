<?php

namespace App\Models;
use CodeIgniter\Model;
 
class ShiftTypesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_shift_types';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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


    function get(){
        $db = db_connect();
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_shifts');
        $cols = [
            'tbl_shifts.start_date',
            'tbl_shifts.shift_start_time',
            'tbl_shifts.shift_end_time',
            'tbl_shifts.shift_type',
            'tbl_shifts.slots',
            'tbl_shifts.rate',
            'tbl_shifts.unit',
            'tbl_clients.company_name',
            'tbl_shift_types.name as shift_type_name',
            '(SELECT count(id) FROM tbl_shift_clinicians WHERE tbl_shift_clinicians.shift_id = tbl_shifts.id) as slots_taken'
        ];

        $builder->select(implode(",", $cols));
        $builder->join('tbl_clients', 'tbl_clients.id = tbl_shifts.client_id', 'inner');
        $builder->join('tbl_shift_types', 'tbl_shift_types.id = tbl_shifts.shift_type', 'inner');
        $builder->where('(SELECT count(id) FROM tbl_shift_clinicians WHERE tbl_shift_clinicians.shift_id = tbl_shifts.id) < tbl_shifts.slots');
        $query = $builder->get();

        return $query->getResult();
    }
}
