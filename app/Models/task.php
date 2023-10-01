<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_category',
        'task_name',
        'deskrip_task',
        'status',
        'read',
    ];

    public function scopeSearchdataTask($query, array $data){
        if (isset($data['t'])? $data['t'] : false) {
            $query->where('task_name','like','%'.$data['t'].'%')
                    ->orWhere('deskrip_task','like','%'.$data['t'].'%')
                    ->orWhere('status','like','%'.$data['t'].'%');
        }
    }

    public function User(){
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function m_category(){
        return $this->belongsTo(m_category_task::class,'id_category','id');
    }
}
