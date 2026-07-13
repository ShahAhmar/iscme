<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;

class FixHeroOverlay extends Command
{
    protected $signature = 'fix:hero-overlay';
    protected $description = 'Change hero overlay from blue to black in home page HTML';

    public function handle()
    {
        $page = Page::where('slug', 'home')->first();
        if (!$page) {
            $this->error('Home page not found!');
            return 1;
        }

        $html = $page->html;
        
        // Replace the blue gradient overlay with a dark/black one
        $html = str_replace(
            'background: linear-gradient(135deg, rgba(10,37,64,0.88) 0%, rgba(0,61,108,0.72) 100%)',
            'background: linear-gradient(135deg, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.60) 100%)',
            $html
        );

        $page->html = $html;
        $page->save();

        $this->info('Done! Hero overlay changed to black/dark.');
        return 0;
    }
}
