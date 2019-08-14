<?php namespace App\Projeto\Painel;

use App\Projeto\Entity;

class PermissionRole extends Entity
{
    protected $table    = 'permission_role';

    protected $fillable = ['permission_id','role_id'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
