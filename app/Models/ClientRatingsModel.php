<?php

namespace App\Models;
use CodeIgniter\Model;

class ClientRatingsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_client_ratings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['shift_id', 'clinician_id', 'client_id', 'cleanliness', 'work_environment', 'tools_needed', 'average', 'comment', 'datetime_added'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    
}
