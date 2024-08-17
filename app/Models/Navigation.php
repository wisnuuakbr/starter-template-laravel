<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;
    // TODO : ben iso njupuk id sek string mergo di custom ben ra leading zero nganggo $cast ya brow
    // Define atribute casting
    protected $casts = [
        'nav_id' => 'string',
    ];

    // Set nav_id as PK
    protected $primaryKey = 'nav_id';

    // set user_id as not auto increment
    public $incrementing = false;

    protected $fillable = [
        'nav_id',
        'parent_id',
        'nav_title',
        'nav_url',
        'nav_icon',
        'nav_no',
        'nav_desc',
        'display_st'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('nav_no', 'asc');
    }

    public function subMenus()
    {
        return $this->hasMany(Navigation::class, 'parent_id');
    }
}