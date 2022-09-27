<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function problems() {
        return $this->hasMany(Problem::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function problem_upvotes(){
        return $this->belongsToMany(Problem::class);
    }

    public function problems_own(){
        return $this->hasMany(Problem::class);
    }

    public function isUser(): bool
    {
        return $this->role === 'USER';
    }

    public function isEmployee(): bool
    {
        return $this->role === 'EMPLOYEE';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'ADMIN';
    }
}
