<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPT extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'tb_pt';
    protected $fillable = [
        'name',
        'slug',
        'kode',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
