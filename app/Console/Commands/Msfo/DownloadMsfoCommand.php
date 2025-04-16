<?php

namespace App\Console\Commands\Msfo;

use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DownloadMsfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'msfo:download-msfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Скачивает финансовую отчетность компаний';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $list = Company::limit(500)->get('ticker');

        foreach ($list as $item) {
            $this->checkStatement($item->ticker);
        }
    }

    /**
     * Проверка величины контента страницы.
     * Если контент меньше установленной длины, то скорее всего у данной компании отчётности нет.
     * Если величина контента удовлетворяет параметрам, то происходит скачивание финансовой отчётности.
     * 
     * @param string $ticker
     * @return void
     */
    private function checkStatement(string $ticker): void
    {
        $http = Http::get("https://smart-lab.ru/q/$ticker/f/y/MSFO/");
        $length = strlen($http->body());

        if ($length < 5000) {
            Company::where('ticker', $ticker)->update(['is_bad' => true]);
            $this->error('По компании нет отчётности');
        } else {
            $this->download($ticker);
        }
    }

    private function download(string $ticker): void
    {
        shell_exec(
            "curl -o storage/app/downloads/companies_collection/$ticker.html https://smart-lab.ru/q/$ticker/f/y/MSFO/"
        );
    }
}
