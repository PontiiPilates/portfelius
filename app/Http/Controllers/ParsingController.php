<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use voku\helper\HtmlDomParser;

class ParsingController extends Controller
{
    /**
     * @link селекторы https://simplehtmldom.sourceforge.io/docs/1.9/manual/finding-html-elements/ 
     * 
     * echo $e->tag; // Returns: " div"
     * echo $e->outertext; // Returns: " <div>foo <b>bar</b></div>"
     * echo $e->innertext; // Returns: " foo <b>bar</b>"
     * echo $e->plaintext; // Returns: " foo bar"
     */
    public function handle()
    {
        $dom = HtmlDomParser::file_get_html('C:\OSPanel\domains\portfelius\storage\app\downloads\avan.html');

        $availableYears = $dom->find(".header_row")->find('td')?->plaintext;
        dump($availableYears);

        // Чистый операционный доход
        $netOperatingIncome = $dom->find("[field=net_operating_income]")->find('td')?->plaintext;
        dump($netOperatingIncome);

        // Чист. проц. доходы
        $netInterestIncome = $dom->find("[field=net_interest_income]")->find('td')?->plaintext;
        dump($netInterestIncome);

        // Чист. комисс. доходы
        $commissionIncome = $dom->find("[field=commission_income]")->find('td')?->plaintext;
        dump($commissionIncome);

        // Чистая прибыль
        $netIncome = $dom->find("[field=net_income]")->find('td')?->plaintext;
        dump($netIncome);

        // Див. выплата
        $dividendPayout = $dom->find("[field=dividend_payout]")->find('td')?->plaintext;
        dump($dividendPayout);

        // Дивиденд
        $dividend = $dom->find("[field=dividend]")->find('td')?->plaintext;
        dump($dividend);

        // Див доход, ао
        $divYield = $dom->find("[field=div_yield]")->find('td')?->plaintext;
        dump($divYield);

        // Дивиденды/прибыль
        $divPayoutRatio = $dom->find("[field=div_payout_ratio]")->find('td')?->plaintext;
        dump($divPayoutRatio);

        // Наличность
        $cash = $dom->find("[ield=cash]")->find('td')?->plaintext;
        dump($cash);

        // Чистый долг
        $netDebt = $dom->find("[field=net_debt]")->find('td')?->plaintext;
        dump($netDebt);

        // Активы банка
        $bankAssets = $dom->find("[field=bank_assets]")->find('td')?->plaintext;
        dump($bankAssets);

        // Капитал
        $capital = $dom->find("[field=capital]")->find('td')?->plaintext;
        dump($capital);

        // Кредитный портфель
        $loanPortfolio = $dom->find("[field=loan_portfolio]")->find('td')?->plaintext;
        dump($loanPortfolio);

        // Кредиты юрлицам
        $corporateLoans = $dom->find("[field=corporate_loans]")->find('td')?->plaintext;
        dump($corporateLoans);

        // Кредиты физлицам
        $retailLoans = $dom->find("[field=retail_loans]")->find('td')?->plaintext;
        dump($retailLoans);

        // Депозиты
        $deposits = $dom->find("[field=deposits]")->find('td')?->plaintext;
        dump($deposits);

        // Депозиты юрлиц
        $corporateDeposits = $dom->find("[field=corporate_deposits]")->find('td')?->plaintext;
        dump($corporateDeposits);

        // Депозиты физлиц
        $retailDeposits = $dom->find("[field=retail_deposits]")->find('td')?->plaintext;
        dump($retailDeposits);

        // Loan-to-deposit ratio
        $loanToDepositRatio = $dom->find("[field=loan_to_deposit_ratio]")->find('td')?->plaintext;
        dump($loanToDepositRatio);

        // Цена акции ао
        $commonShare = $dom->find("[field=common_share]")->find('td')?->plaintext;
        dump($commonShare);

        // Число акций ао
        $numberOfShares = $dom->find("[field=number_of_shares]")->find('td')?->plaintext;
        dump($numberOfShares);

        // Капитализаци
        $marketCap = $dom->find("[field=market_cap]")->find('td')?->plaintext;
        dump($marketCap);

        // EV
        $ev = $dom->find("[field=ev]")->find('td')?->plaintext;
        dump($ev);

        // EPS
        $eps = $dom->find("[field=eps]")->find('td')?->plaintext;
        dump($eps);

        // Рентабельность банка
        $bank_margin = $dom->find("[field=bank_margin]")->find('td')?->plaintext;
        dump($bank_margin);

        // P/E
        $pE = $dom->find("[field=p_e]")->find('td')?->plaintext;
        dump($pE);

        // P/B
        $pB = $dom->find("[field=p_b]")->find('td')?->plaintext;
        dump($pB);
    }
}
