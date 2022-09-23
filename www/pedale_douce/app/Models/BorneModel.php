<?php

namespace App\Models;

use CodeIgniter\Model;

class BorneModel extends Model
{
    protected $table = 'bornes';
    protected $primaryKey = 'uid';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        "num",
        "status",
        "code",
        "fk_station"
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

    public function readAllByFkStation($fkStation) {
        return $this->where('fk_station', $fkStation)->findAll();
    }

    //* ------------------------------------------------------------

    // public function updateByUid($uid, $data) {
    //     return $this->update($uid, $data);
    // }

}