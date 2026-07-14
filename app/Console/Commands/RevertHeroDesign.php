<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;

class RevertHeroDesign extends Command
{
    protected $signature = 'revert:hero-design';
    protected $description = 'Revert hero design to original image bg, add border/curves, and container bg';

    public function handle()
    {
        $page = Page::where('slug', 'home')->first();
        if (!$page) {
            $this->error('Home page not found!');
            return 1;
        }

        $html = $page->html;

        // 1. Remove the video element completely
        // We will locate "<video" to "</video>" and remove it.
        $startPos = strpos($html, '<video');
        $endPos = strpos($html, '</video>');
        if ($startPos !== false && $endPos !== false) {
            $endPos += strlen('</video>');
            $videoPart = substr($html, $startPos, $endPos - $startPos);
            $html = str_replace($videoPart, '', $html);
            $this->info('Removed video tag.');
        }

        // 2. Update the section tag.
        // Let's replace the parallax-container section style
        $targetSectionStart = '<section class="parallax-container d-flex align-items-center"';
        // Let's search for this section tag
        $sectionPos = strpos($html, $targetSectionStart);
        if ($sectionPos !== false) {
            $sectionEndPos = strpos($html, '>', $sectionPos);
            if ($sectionEndPos !== false) {
                $sectionTag = substr($html, $sectionPos, $sectionEndPos - $sectionPos + 1);
                // Replace with new section tag
                $newSectionTag = '<section class="parallax-container d-flex align-items-center" style="min-height: 90vh; background: url(\'/hero-bg.png\') no-repeat center center / cover; position: relative;">';
                $html = str_replace($sectionTag, $newSectionTag, $html);
                $this->info('Updated section background to hero-bg.png.');
            }
        }

        // 3. Fix the overlay div
        // We look for class="position-absolute w-100 h-100" and replace its style to simple black overlay
        $overlayTarget = '<div class="position-absolute w-100 h-100"';
        $overlayPos = strpos($html, $overlayTarget);
        if ($overlayPos !== false) {
            $overlayEndPos = strpos($html, '>', $overlayPos);
            if ($overlayEndPos !== false) {
                $overlayTag = substr($html, $overlayPos, $overlayEndPos - $overlayPos + 1);
                $newOverlayTag = '<div class="position-absolute w-100 h-100" style="background: rgba(0, 0, 0, 0.45); top:0; left:0; z-index:0;"></div>';
                $html = str_replace($overlayTag, $newOverlayTag, $html);
                $this->info('Updated overlay to semi-transparent black.');
            }
        }

        // 4. Update the deadline container background to container-bg.png
        $containerTarget = 'rounded-4 w-100';
        $containerPos = strpos($html, $containerTarget);
        if ($containerPos !== false) {
            // Find the start of the div tag before this position
            $divStartPos = strrpos(substr($html, 0, $containerPos), '<div');
            if ($divStartPos !== false) {
                $divEndPos = strpos($html, '>', $divStartPos);
                if ($divEndPos !== false) {
                    $divTag = substr($html, $divStartPos, $divEndPos - $divStartPos + 1);
                    $newDivTag = '<div class="d-inline-block p-4 rounded-4 w-100" style="background: url(\'/container-bg.png\') no-repeat center center / cover; border: 1px solid rgba(255,255,255,0.2); position: relative; overflow: hidden; z-index: 1;">';
                    $html = str_replace($divTag, $newDivTag, $html);
                    $this->info('Updated deadline container background to container-bg.png.');
                }
            }
        }

        $page->html = $html;
        $page->save();

        $this->info('Database HTML updated successfully!');
        return 0;
    }
}
