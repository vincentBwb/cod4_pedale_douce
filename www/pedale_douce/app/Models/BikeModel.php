<?php

namespace App\Models;

use CodeIgniter\Model;

class BikeModel extends Model
{
    protected $table = 'bikes';
    protected $primaryKey = 'uid';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        "serial",
        "status",
        "fk_borne"
    ];
    // protected $returnType = 'App\Entities\User';
    protected $returnType = 'array';
    // protected $useTimestamps = true;

    //* ------------------------------------------------------------

    // public function create($data) {
    //     return $this->insert($data);
    // }

    //* ------------------------------------------------------------

    public function readAllRec() {
        return $this->findAll();
    }

    //* ------------------------------------------------------------

    public function readOneByUid($uid) {
        return $this->find($uid);
    }

    //* ------------------------------------------------------------

    public function readAllByStatus($status) {
        return $this->where('status', $status)->findAll();
    }

    //* ------------------------------------------------------------

    public function readOneByFkBorne($fkBorne) {
        return $this->where('fk_borne', $fkBorne)->first();
    }

    //* ------------------------------------------------------------

    // public function updateByUid($uid, $data) {
    //     return $this->update($uid, $data);
    // }

}