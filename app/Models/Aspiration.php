<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    //yang boleh diisi
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'date',
        'location',
        'description',
        'image',
        'status',
        'response',
        'admin_image'
    ];

    //biar tanggal sesuai format
    protected $casts = [
        'date' => 'datetime',
    ];

    //relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
