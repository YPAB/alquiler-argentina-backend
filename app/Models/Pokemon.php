<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;
    protected $connection= 'mysql';
    protected $table = 'pokemon';
    protected $primaryKey = 'pok_id';
    public function types(){
        return $this->belongsToMany(Type::class,'pokemon_types','pok_id','type_id');
    }

}
