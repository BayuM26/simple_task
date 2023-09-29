<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_category_task extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
    ];
}
