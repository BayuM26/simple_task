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

    public function scopeSearchdataCategory($query, array $data){
        if (isset($data['c'])? $data['c'] : false) {
            $query->where('category_name','like','%'.$data['c'].'%');
        }
    }
}
