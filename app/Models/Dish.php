<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    public $fillable = ['title', 'description', 'foto_url', 'menu_id'];

    public function menu() {
        return $this->belongsTo('App\Models\Menu');
    }
}