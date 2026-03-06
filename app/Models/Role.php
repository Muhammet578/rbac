<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermission(Permission $permissions): void {
        $this->permissions()->syncWithoutDetaching($permissions->id);
    }

    public function revokePermission(Permission $permissions): void {
        $this->permissions()->syncWithoutDetaching($permissions->id);
    }
}
