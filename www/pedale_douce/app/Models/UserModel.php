<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'uid';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        "pseudo",
        "password",
        "email",
        "fk_cb",
        "role",
        "fk_bike",
        "time_bike",
        "fk_borne",
        "time_borne"
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

    public function readOneByUid($uid) {
        return $this->find($uid);
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

    public function updateByUid($uid, $data) {
        return $this->update($uid, $data);
    }

}