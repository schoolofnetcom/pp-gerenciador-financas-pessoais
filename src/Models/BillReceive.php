<?php

namespace SONFin\Models;


use Illuminate\Database\Eloquent\Model;

class BillReceive extends Model
{
    //Mass Assignment
    protected $fillable = [
        'date_launch',
        'name',
        'value',
        'user_id'
    ];
}
