<?php namespace App\Projeto\Painel;

use App\Projeto\Entity;

class RoleUser extends Entity
{
    protected $table    = 'role_user';

    protected $fillable = ['name','label'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
