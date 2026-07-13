<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;

class FixVideoZIndex extends Command
{
    protected $signature = 'fix:video-zindex';
    protected $description = 'Fix hero video z-index in home page HTML';

    public function handle()
    {
        $page = Page::where('slug', 'home')->first();
        if (!$page) {
            $this->error('Home page not found!');
            return 1;
        }

        $html = $page->html;
        $html = str_replace('z-index:-1;', 'z-index:1;', $html);
        $page->html = $html;
        $page->save();

        $this->info('Done! Overlay z-index updated to 1.');
        return 0;
    }
}
