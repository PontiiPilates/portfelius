<?php

namespace App\Console\Commands\Msfo;

use Illuminate\Console\Command;

class DownloadListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'msfo:download-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Скачивает список компаний';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        shell_exec("curl -o storage/app/downloads/companys_by_sector.html https://smart-lab.ru/forum/sectors/");
    }
}
