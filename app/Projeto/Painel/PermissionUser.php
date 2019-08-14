<?php namespace App\Projeto\Painel;

use App\Projeto\Entity;

class PermissionUser extends Entity
{
    protected $table    = 'permission_user';

    protected $fillable = ['name','label'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
