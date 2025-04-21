<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticker',
        'name',
        'sector',
        'is_bad',
    ];

    public function multiplicators(): HasMany
    {
        return $this->hasMany(Multiplicator::class);
    }
}
