<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $connection= 'mysql';
    protected $table = 'types';
    protected $primaryKey = 'type_id';
    protected $fillable = ['type_name'];
}
