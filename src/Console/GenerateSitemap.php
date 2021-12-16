<?php

namespace App\Console\Commands;

use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap';

    protected $currentSitemap = 1;

    protected $sitemapLimit = 50000;

    private $storage;

    private $carbon;

    /**
     * GenerateSitemap constructor.
     * @param Carbon $carbon
     */
    public function __construct(Carbon $carbon)
    {
        parent::__construct();

        $this->carbon = $carbon;
        $this->storage = Storage::disk('public');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lastId = 0;
        $query = Page::query();

        $this->bar = $this->output->createProgressBar($query->count());

        do {
            $set = $query->select(['url'])
                ->where('id', '>', $lastId)
                ->limit($limit)
                ->get()
                ->each(function (Page $page) {
                    $this->sitemapContent[] = url($page->getUrl());
                    $this->checkContentLimit();
                    $this->bar->advance();
                });

            $lastId = $set->last()->getId();
        } while ($set->count() === $limit);

        $this->writeCurrentSitemap();

        $this->writeSitemapIndex();
        $this->bar->finish();

        return 0;
    }

    protected function clearSitemaps()
    {
        $this->storage->deleteDirectory('sitemap');
    }


    protected function checkContentLimit()
    {
        if (count($this->sitemapContent) < $this->sitemapLimit)
            return;

        $this->writeCurrentSitemap();
    }

    private function writeCurrentSitemap()
    {
        $this->storage->put("sitemap/profile{$this->currentSitemap}.txt", collect($this->sitemapContent)->implode("\n"));
        $this->sitemapContent = [];
        $this->currentSitemap++;
    }

    protected function writeSitemapIndex()
    {
        $files = collect($this->storage->files('sitemap'))->map(function ($i) {
            $url = url("storage/{$i}");

            return "<sitemap><loc>{$url}</loc></sitemap>";
        })->implode('');

        $files = sprintf('<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">%s</sitemapindex>', $files);
        Storage::disk('public')->put("sitemap/sitemap_index.xml", $files);
    }
}
