<?php

namespace App\Enums;

enum PrimaryMultiplicatorType
{
    case revenue; // Выручка
    case net_income; // Чистая прибыль
    case operating_income; // Операционный доход
    case net_debt; // Чистый долг
    case ebitda; // EBITDA
    case roe; // ROE
    case p_e; // P/E
    case p_s; // P/S
}
