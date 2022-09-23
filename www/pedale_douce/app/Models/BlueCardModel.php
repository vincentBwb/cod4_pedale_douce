<?php

namespace App\Models;

use CodeIgniter\Model;

class BlueCardModel extends Model
{
    protected $table = 'blue_cards';
    protected $primaryKey = 'uid';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        "first_name",
        "last_name",
        "number",
        "cryptogram",
        "expiry"
    ];
    // protected $returnType = 'App\Entities\User';
    protected $returnType = 'array';
    // protected $useTimestamps = true;

    //* ------------------------------------------------------------

    public function create($data) {
        return $this->insert($data);  //* Return inserted UID
    }

    //* ------------------------------------------------------------

    public function readAllRec() {
        return $this->findAll();
    }

    //* ------------------------------------------------------------

    public function readByPseudo($pseudo) {
        return $this->where('pseudo', $pseudo)->first();
    }

    //* ------------------------------------------------------------

    public function readByRole($role) {
        return $this->where('role', $role)->findAll();
    }

    //* ------------------------------------------------------------

    // public function updateByUid($uid, $data) {
    //     return $this->update($uid, $data);
    // }

}