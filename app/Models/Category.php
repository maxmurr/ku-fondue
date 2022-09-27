<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 1 หมวดหมู่ มีได้หลายปัญหา
    public function problems(){
        return $this->hasMany(Problem::class);
    }
}
