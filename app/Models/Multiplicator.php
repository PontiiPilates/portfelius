<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'net_income_revenue',
        'roe',
        'p_e',
        'p_s',
    ];
}
