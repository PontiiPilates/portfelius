<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Multiplicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'year',
        'revenue',
        'net_income',
        'operating_income',
        'net_debt',
        'ebitda',
        'net_debt_ebitda',
        'net_margin',
        'roe',
        'p_e',
        'p_s',
        'dividend_yield',
        'dividend_payout_ratio',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
