<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Speaker;
use App\Models\Sponsor;
use App\Models\ImportantDate;
use App\Models\MenuItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportLegacyConferenceContent extends Command
{
    protected $signature = 'cms:import-legacy-content {--dry-run : Preview extracted records without saving}';
    protected $description = 'Import speakers and partners embedded in the legacy Home page HTML into CMS records';

    public function handle(): int
    {
        $home = Page::where('slug', 'home')->first();
        if (! $home?->html) {
            $this->error('The Home page content was not found.');
            return self::FAILURE;
        }

        $matches = [];
        preg_match_all('/<strong[^>]*>(.*?)<\/strong>\s*<(?:small|span)[^>]*>(.*?)<\/(?:small|span)>/is', html_entity_decode($home->html), $matches, PREG_SET_ORDER);

        $speakers = [];
        foreach ($matches as $match) {
            $name = trim(preg_replace('/\s+/', ' ', strip_tags($match[1])));
            $organisation = trim(preg_replace('/\s+/', ' ', strip_tags($match[2])));
            if (! preg_match('/^(Prof\.?|Dr\.?|Assoc\.?|Mr\.?|C\.M\.)/i', $name)) continue;
            $name = preg_replace('/\s*(Technical Chair|Conf\. Secretary|General Chair|Conference Chair)\s*$/i', '', $name);
            if (mb_strlen($name) > 255 || mb_strlen($organisation) > 255) continue;
            if ($name && $organisation) $speakers[$name] = $organisation;
        }

        $this->info('Extracted '.count($speakers).' speaker/committee records.');
        $partners = [
            ['name' => 'Technical University of Sofia', 'tier' => 'Organising Partner', 'website_url' => 'https://www.tu-sofia.bg/'],
            ['name' => 'GAFTIM', 'tier' => 'Organising Partner', 'website_url' => 'https://gaftim.com/'],
            ['name' => 'IEEE Bulgaria Section', 'tier' => 'Technical Sponsor', 'website_url' => 'https://www.ieee.org/'],
            ['name' => 'Universiti Sains Malaysia (USM)', 'tier' => 'Academic Partner', 'website_url' => 'https://www.usm.my/'],
        ];

        if (! $this->option('dry-run')) {
            DB::transaction(function () use ($speakers, $partners) {
                foreach ($speakers as $name => $organisation) {
                    Speaker::updateOrCreate(['name' => $name], [
                        'organisation' => $organisation,
                        'designation' => 'Conference Committee',
                        'is_published' => true,
                    ]);
                }
                foreach ($partners as $index => $partner) {
                    Sponsor::updateOrCreate(['name' => $partner['name']], [...$partner, 'is_published' => true, 'sort_order' => $index]);
                }
                foreach ([['Submission Deadline','2027-04-20',true],['Acceptance Notification','2027-05-10',false],['Early Bird Registration','2027-05-15',false],['Normal Registration','2027-05-20',false],['Conference Dates','2027-06-02',true]] as $index => [$title,$date,$highlight]) {
                    ImportantDate::updateOrCreate(['title'=>$title],['date'=>$date,'is_highlighted'=>$highlight,'is_published'=>true,'sort_order'=>$index]);
                }
                foreach ([['Home','/'],['About','/about'],['Program','/program'],['Speakers','/speakers'],['Sponsors','/sponsors'],['Exhibition','/exhibition'],['Submission','/submission'],['Contact','/contact']] as $index => [$label,$url]) MenuItem::updateOrCreate(['location'=>'header','url'=>$url],['label'=>$label,'target'=>'_self','sort_order'=>$index,'is_published'=>true]);
            });
        }
        $this->info(($this->option('dry-run') ? 'Previewed' : 'Imported').' '.count($partners).' sponsor/partner records.');

        return self::SUCCESS;
    }
}
