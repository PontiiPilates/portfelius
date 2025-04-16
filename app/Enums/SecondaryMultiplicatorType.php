<?php

namespace App\Enums;

enum SecondaryMultiplicatorType
{
    case net_operating_income; // Чистый операционный доход
    case net_interest_income; // Чист. проц. доходы
    case commission_income; // Чист. комисс. доходы
    case dividend_payout; // Див. выплата
    case dividend; // Дивиденд
    case div_yield; // Див доход, ао
    case div_payout_ratio; // Дивиденды/прибыль
    case cash; // Наличность
    case bank_assets; // Активы банка
    case capital; // Капитал
    case loan_portfolio; // Кредитный портфель
    case corporate_loans; // Кредиты юрлицам
    case retail_loans; // Кредиты физлицам
    case deposits; // Депозиты
    case corporate_deposits; // Депозиты юрлиц
    case retail_deposits; // Депозиты физлиц
    case loan_to_deposit_ratio; // Loan-to-deposit ratio
    case common_share; // Цена акции ао
    case number_of_shares; // Число акций ао
    case market_cap; // Капитализаци
    case ev; // EV
    case eps; // EPS
    case bank_margin; // Рентабельность банка
    case net_income_ns; // Чистая прибыль н/с
    case ocf; // Опер. ленежный поток
    case capex; // CAPEX
    case fcf; // FCF
    case opex; // OPEX
    case cost_of_production; // Себестоимость
    case amortization; // Амортизация
    case employment_expenses; // Расходы на персонал
    case interest_expenses; // Процентные расходы
    case debt; // Долг
    case net_assets; // Чистые активы
    case book_value; // Балансовая стоимость
    case roa; // ROA
    case fcf_share; // FCF / акцию
    case bv_share; // BV / акцию
    case ebitda_margin; // Рентабильность EBITDA
    case net_margin; // Чистая рентабильность
    case fcf_yield; // Доходность
    case p_fcf; // P / FCF
    case p_bv; // P / BV
    case ev_ebitda; // EV / EBITDA
    case debt_ebitda; // DEBT / EBITDA
    case employees; // Персонал
    case labour_productivity; // Произв. труда
    case expenses_per_employee; // Расходы / чел / год
    case r_and_d_capex; // R&D / CAPEX
    case capex_revenue; // CAPEX / Выручка
    case p_b; // P/B
}
