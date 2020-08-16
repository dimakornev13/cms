<?php

namespace App\Console\Commands;

use App\Repositories\UriRepository;
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

    private $urls;
    private $storage;
    private $carbon;

    /**
     * GenerateSitemap constructor.
     * @param UriRepository $urls
     * @param Carbon $carbon
     */
    public function __construct(UriRepository $urls, Carbon $carbon)
    {
        parent::__construct();

        $this->urls = $urls;
        $this->carbon = $carbon;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $offset = 0;
        $limit = 1000;
        $sql = $this->urls->getEntity();
        $sitemapContent = '';

        do {
            $urls = $sql->offset($offset)->limit($limit)->get();
            $offset += $urls->count();

            $urls->each(function ($uri) use (&$sitemapContent) {
                if ($uri->url === '/')
                    return;

                $url = url($uri->url);

                $date = $this->carbon::now()->toAtomString();

                $sitemapContent .= sprintf('<url><loc>%s</loc><priority>1.0</priority><lastmod>%s</lastmod></url>', $url, $date);
            });
        } while ($urls->count() === $limit);

        $sitemapContent = sprintf('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">%s</urlset>', $sitemapContent);

        Storage::disk('public')->put('ema_sitemap.xml', $sitemapContent);

        $this->info(sprintf('%d pages have been published', $offset));

        return 0;
    }


}
