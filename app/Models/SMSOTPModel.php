<?php

namespace App\Models;
use CodeIgniter\Model;

class SMSOTPModel extends Model{
    protected $table      = 'tbl_sms_otp';
    protected $primaryKey = 'id';

    // protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['contact_number', 'code', 'status', 'datetime_generated'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = false;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
}