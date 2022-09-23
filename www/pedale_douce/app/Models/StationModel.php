<?php

namespace App\Models;

use CodeIgniter\Model;

class StationModel extends Model
{
    protected $table = 'stations';
    protected $primaryKey = 'uid';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        "num",
        "name",
        "coor_x",
        "coor_y"
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

    // public function readByPseudo($pseudo) {
    //     return $this->where('pseudo', $pseudo)->first();
    // }

    //* ------------------------------------------------------------

    // public function readByRole($role) {
    //     return $this->where('role', $role)->findAll();
    // }

    //* ------------------------------------------------------------

    // public function updateByUid($uid, $data) {
    //     return $this->update($uid, $data);
    // }

}