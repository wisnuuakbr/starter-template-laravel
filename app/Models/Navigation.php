<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;
    // protected $guard = ['id'];
    // protected $primaryKey = 'id';
    protected $fillable = [
        'parent_id',
        'name',
        'url',
        'icon',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function subMenus()
    {
        return $this->hasMany(Navigation::class, 'parent_id');
    }
}
