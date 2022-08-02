<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    public $fillable = ['title', 'address'];

    public function menus(){
        return $this->hasMany('App\Models\Menu');
    }

}