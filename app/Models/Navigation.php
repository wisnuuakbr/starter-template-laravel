<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;
    // TODO : ben iso njupuk id sek string mergo di custom ben ra leading zero nganggo $cast ya brow
    // define atribute casting
    protected $casts = [
        'id' => 'string',
    ];
    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'url',
        'icon',
        'sort',
        'description',
        'display_st'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort', 'asc');
    }

    public function subMenus()
    {
        return $this->hasMany(Navigation::class, 'parent_id');
    }
}
