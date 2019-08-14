<?php namespace App\Projeto\Painel;

use App\Projeto\Entity;
use App\User;

class Role extends Entity
{
    protected $table = 'roles';

    protected $fillable = ['name','label'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
