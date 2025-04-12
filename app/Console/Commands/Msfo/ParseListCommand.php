<?php

namespace App\Console\Commands\Msfo;

use App\Models\Company;
use Illuminate\Console\Command;
use voku\helper\HtmlDomParser;

class ParseListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'msfo:parse-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Анализирует список компаний и создает на егно основе таблицу';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->parse();
    }

    private function parse(): void
    {
        $dom = HtmlDomParser::file_get_html('C:\OSPanel\domains\portfelius\storage\app\downloads\companys_by_sector.html');

        $economicRf = $dom->find('.kompanii_company_col');

        for ($i = 0; $i < 4; $i++) {
            $sectors = $economicRf[$i]->find('.kompanii_sector');

            foreach ($sectors as $sector) {
                $sectorName = $sector->find('h2')->plaintext[0];

                // без етф
                if ($sectorName == 'ETF') {
                    continue;
                }

                foreach ($sector->find('ul') as $ul) {
                    foreach ($ul->find('li') as $li) {
                        $companyName = $li->find('a')->plaintext[0];
                        $companyHref = $li->find('a')->href[0];
                        $companyTicker = explode('/', $companyHref);

                        // без "мусорных" компаний
                        if (array_search($companyTicker[2], $this->garbage()) !== false) {
                            continue;
                        }

                        $this->create($companyTicker[2], $companyName, $sectorName);
                    }
                }
            }
        }
    }

    private function create(string $companyTicker, string $companyName, string $sectorName): Company
    {
        return Company::updateOrCreate([
            'ticker' => $companyTicker,
            'name' => $companyName,
            'sector' => $sectorName
        ]);
    }

    private function garbage(): array
    {
        return [
            '%D0%9F%D1%80%D0%BE%D0%B4%D0%B8%D0%BC%D0%B5%D0%BA%D1%81',
            '%D0%93%D0%98%D0%9F%D0%A0%D0%9E%D0%A1%D0%92%D0%AF%D0%97%D0%AC',
            '%D0%AE%D1%82%D0%B8%D0%BD%D0%B5%D1%82.%D1%80%D1%83',
            '%D0%AD%D0%BA%D0%BE%D0%BD%D0%B8%D0%B2%D0%B0',
            '%D0%9F%D0%B5%D1%80%D0%B2%D0%B0%D1%8F%20%D0%B3%D1%80%D1%83%D0%B7%D0%BE%D0%B2%D0%B0%D1%8F%20%D0%BA%D0%BE%D0%BC%D0%BF%D0%B0%D0%BD%D0%B8%D1%8F',
            '%D0%90%D0%B7%D0%B1%D1%83%D0%BA%D0%B0%20%D0%92%D0%BA%D1%83%D1%81%D0%B0',
            '%D0%9D%D0%97%D0%A0%D0%9C',
            '%D0%A1%D0%BE%D0%BB%D1%8C%20%D0%A0%D1%83%D1%81%D0%B8',
            '%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D0%B5%26%D0%91%D0%B5%D0%BB%D0%BE%D0%B5',
            '%D0%A0%D0%BE%D1%81%D1%82%D0%B5%D1%85',
            '%D0%9C%D0%B5%D1%82%D0%B0%D0%BB%D0%BB%D0%BE%D0%B8%D0%BD%D0%B2%D0%B5%D1%81%D1%82',
            '%D0%92%D0%AD%D0%91',
            '%D0%95%D0%B2%D1%80%D0%BE%D1%85%D0%B8%D0%BC',
            '%D0%A0%D0%BE%D1%81%D0%BD%D0%B0%D0%BD%D0%BE',
            '%D0%9F%D0%9D%D0%9A%20%D0%A0%D0%B5%D0%BD%D1%82%D0%B0%D0%BB%20%D0%97%D0%9F%D0%98%D0%A4',
            '%D0%90%D0%BB%D0%BC%D0%B0%D0%B7%D1%8B%20%D0%90%D1%80%D0%BA%D1%82%D0%B8%D0%BA%D0%B8%20%28%D0%90%D0%9B%D0%9C%D0%90%D0%A0%29',
            '%D0%A1%D0%B8%D0%B3%D0%BD%D0%B0%D0%BB%20%D0%B7%D0%B0%D0%B2%D0%BE%D0%B4',
            '%D0%96%D0%B8%D0%B2%D0%BE%D0%B9%20%D0%BE%D1%84%D0%B8%D1%8',
            '%D0%92%D1%82%D0%BE%D1%80%D1%80%D0%B5%D1%81%D1%83%D1%80%D1%81%D1%8B',
            '%D0%AE%D0%BB%D0%BC%D0%B0%D1%80%D1%82',
            '%D0%96%D0%B8%D0%B2%D0%BE%D0%B9%20%D0%BE%D1%84%D0%B8%D1%81',
            '%D0%9F%D0%BE%D0%B4%D0%BE%D1%80%D0%BE%D0%B6%D0%BD%D0%B8%D0%BA',
            '%D0%A4%D0%B0%D1%80%D0%BC%D1%81%D1%82%D0%B0%D0%BD%D0%B4%D0%B0%D1%80%D1%82',
            '%D0%90%D0%A4%D0%98%20%D0%94%D0%B5%D0%B2%D0%B5%D0%BB%D0%BE%D0%BF%D0%BC%D0%B5%D0%BD%D1%82',
            '%D0%92%D0%A1%D0%97',
            '%D0%97%D0%9C%D0%97',
            'dividends ',
            'Medskan ',
            'Monopoly',
            'goldman-group',
        ];
    }
}
