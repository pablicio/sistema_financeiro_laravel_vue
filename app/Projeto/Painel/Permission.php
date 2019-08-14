<?php namespace App\Projeto\Painel;

use App\Projeto\Entity;
use App\User;

class Permission extends Entity
{
    protected $table    = 'permissions';

    protected $fillable = ['name','label','tipo'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
