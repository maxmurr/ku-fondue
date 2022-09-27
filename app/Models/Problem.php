<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user_upvotes(){
        return $this->belongsToMany(User::class);
    }

    // 1 problem มีได้แค่ 1 category
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function own_by(){
        return $this->belongsTo(User::class);
    }
}
