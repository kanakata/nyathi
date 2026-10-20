<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

#[Signature('app:generate-sitemap')]
#[Description('Command description')]
class GenerateSitemap extends Command
{
    /**
     * Execute the console command.
     */
    protected $signature = 'sitemap:generate';
    public function handle()
    {
        // $this->info('Generating sitemap...');
        SitemapGenerator::create(config("app.url"))
            ->writeToFile(public_path("sitemap.xml"));
    }
}
