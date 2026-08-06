<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Sponsor;
use App\Models\MenuItem;
use App\Models\SiteSetting;
use Inertia\Inertia;

class FrontendController extends Controller
{
    public function show($slug = null)
    {
        if (!$slug) {
            $slug = 'home';
        }
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();

        // If page has no custom CSS, fallback to home page CSS for shared header/footer styles
        if (empty(trim($page->css ?? ''))) {
            $homePage = Page::where('slug', 'home')->first();
            if ($homePage && !empty($homePage->css)) {
                $page->css = $homePage->css;
            }
        }

        $page->html = $this->injectDynamicSponsors($page->slug, $page->html);
        $page->html = $this->injectRegistrationForm($page->slug, $page->html);

        $footerData = $this->getFooterData();

        return Inertia::render('Page', [
            'page'       => $page,
            'footerData' => $footerData,
        ]);
    }

    private function getSettings(): array
    {
        $stored = SiteSetting::where('group', 'general')->get()
            ->mapWithKeys(fn($item) => [$item->key => $item->value['value'] ?? ''])
            ->all();
        return array_replace([
            'site_name'                   => 'ISCME 2027',
            'tagline'                     => 'International Scientific Conference on Management & Engineering',
            'contact_email'               => 'iscme@gaftim.com',
            'contact_phone'               => '+359-2-965-3237',
            'address'                     => 'Technical University of Sofia, Studentski grad, Sofia, Bulgaria',
            'venue_dates'                 => '2–4 June, 2027 • Sofia, Bulgaria',
            'copyright_text'              => '© 2027 ISCME — International Scientific Conference on Management & Engineering. All rights reserved.',
            'technical_sponsor_name'      => 'IEEE Bulgaria Section',
            'facebook_url'                => '',
            'linkedin_url'                => '',
            'x_url'                       => '',
            'youtube_url'                 => '',
            'registration_status'         => 'enabled',
            'registration_closed_message' => 'Pre-registration is currently closed for XXV ISCME 2027. Please check back later for updates.',
        ], $stored);
    }

    private function getFooterData(): array
    {
        $settings = $this->getSettings();

        $footerNav = MenuItem::where('location', 'footer')
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn($item) => [
                'label'  => $item->label,
                'url'    => $item->url,
                'target' => $item->target ?? '_self',
            ])
            ->toArray();

        $sponsors = Sponsor::where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->filter(fn($s) => !empty($s->logo))
            ->map(fn($s) => [
                'name'        => $s->name,
                'logo'        => '/storage/' . $s->logo,
                'website_url' => $s->website_url ?? '#',
            ])
            ->values()
            ->toArray();

        return [
            'settings'  => $settings,
            'footerNav' => $footerNav,
            'sponsors'  => $sponsors,
        ];
    }

    private function injectRegistrationForm(string $slug, string $html): string
    {
        if ($slug !== 'register') {
            return $html;
        }

        $settings  = $this->getSettings();
        $isClosed  = ($settings['registration_status'] ?? 'enabled') === 'disabled';
        $closedMsg = e($settings['registration_closed_message'] ?? 'Pre-registration is currently closed.');

        if ($isClosed) {
            $closedHtml = <<<HTML
<div id="registration-form-container">
    <div class="alert alert-warning p-4 rounded-4 text-center border-warning shadow-sm" style="background:#fff9e6; border:1px solid #ffe58f;">
        <div class="mb-2">
            <i class="bi bi-exclamation-octagon-fill text-warning" style="font-size:2.2rem;"></i>
        </div>
        <h5 class="fw-bold text-dark mb-2">Pre-Registration is Currently Closed</h5>
        <p class="text-muted mb-0" style="font-size:0.9rem; line-height:1.6;">{$closedMsg}</p>
    </div>
</div>
HTML;
            $patternForm = '/<form[^>]*>.*?<\/form>/s';
            $replaced = preg_replace($patternForm, $closedHtml, $html);
            if ($replaced && $replaced !== $html) {
                return $replaced;
            }
            return $html;
        }

        $categoriesJson = $settings['registration_categories'] ?? '[]';
        $categories = json_decode($categoriesJson, true) ?: [
            ['name' => 'International Authors', 'early_bird' => '$350', 'regular' => '$400'],
            ['name' => 'National Authors (Bulgaria)', 'early_bird' => '150 BGN', 'regular' => '200 BGN'],
            ['name' => 'International Listeners', 'early_bird' => '$150', 'regular' => '$180'],
            ['name' => 'National Listeners (Bulgaria)', 'early_bird' => '80 BGN', 'regular' => '100 BGN'],
        ];

        // 1. Build Select Options
        $selectOptionsHtml = '<option value="" disabled selected>Select Registration Category *</option>';
        foreach ($categories as $cat) {
            $label = e($cat['name']);
            if (!empty($cat['early_bird'])) {
                $label .= ' - ' . e($cat['early_bird']) . ' (Early Bird)';
            }
            $selectOptionsHtml .= '<option value="' . e($cat['name']) . '">' . $label . '</option>';
        }

        // 2. Build Fee Table Rows
        $tableRowsHtml = '';
        foreach ($categories as $cat) {
            $eb  = trim($cat['early_bird'] ?? '');
            $reg = trim($cat['regular']    ?? '');
            // Treat "0", "0.00", empty as em-dash
            $ebDisplay  = ($eb  === '' || $eb  === '0' || $eb  === '0.00') ? '—' : e($eb);
            $regDisplay = ($reg === '' || $reg === '0' || $reg === '0.00') ? '—' : e($reg);
            $tableRowsHtml .= '<tr>';
            $tableRowsHtml .= '<td class="fw-semibold text-primary">' . e($cat['name']) . '</td>';
            $tableRowsHtml .= '<td>' . $ebDisplay . '</td>';
            $tableRowsHtml .= '<td>' . $regDisplay . '</td>';
            $tableRowsHtml .= '</tr>';
        }

        // Replace static <tbody> in HTML
        $patternTable = '/<tbody[^>]*>.*?<\/tbody>/s';
        $html = preg_replace($patternTable, '<tbody>' . $tableRowsHtml . '</tbody>', $html, 1);

        $csrf = csrf_token();

        $formHtml = <<<HTML
<div id="registration-form-container">
    <div id="reg-alert" style="display:none;" class="alert mb-4 rounded-3"></div>
    <form id="iscme-register-form">
        <input type="hidden" name="_token" value="{$csrf}">
        <div class="mb-3">
            <input type="text" name="full_name" class="form-control py-3" placeholder="Full Name *" required style="border-radius: 6px;">
        </div>
        <div class="mb-3">
            <input type="email" name="email" class="form-control py-3" placeholder="Email Address *" required style="border-radius: 6px;">
        </div>
        <div class="mb-3">
            <input type="text" name="institution" class="form-control py-3" placeholder="Affiliated University / Institution *" required style="border-radius: 6px;">
        </div>
        <div class="mb-3">
            <select name="category" class="form-select py-3" required style="border-radius: 6px;">
                {$selectOptionsHtml}
            </select>
        </div>
        <div class="mb-3">
            <input type="text" name="paper_id" class="form-control py-3" placeholder="Paper ID (Microsoft CMT) - Optional" style="border-radius: 6px;">
        </div>

        <!-- CAPTCHA BOX -->
        <div class="mb-4 p-3 rounded-3" style="background:#eef6ff; border: 1px solid #cce3ff;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <label class="form-label fw-bold text-primary mb-0" style="font-size:0.85rem;">
                    <i class="bi bi-shield-lock-fill me-1"></i> Security Captcha *
                </label>
                <button type="button" id="btn-refresh-captcha" class="btn btn-sm btn-link text-decoration-none p-0 text-primary font-weight-bold" style="font-size:0.8rem;">
                    <i class="bi bi-arrow-clockwise"></i> New Captcha
                </button>
            </div>
            <div class="d-flex align-items-center gap-3 mb-2">
                <span id="captcha-question-text" class="fw-bold px-3 py-2 bg-white rounded border text-primary shadow-sm" style="font-size:1.1rem; letter-spacing:1px;">...</span>
                <input type="number" name="captcha_user_answer" class="form-control py-2" placeholder="Answer *" required style="border-radius: 6px; max-width: 140px;">
            </div>
        </div>

        <button type="submit" id="btn-submit-reg" class="btn btn-premium w-100 py-3" style="border-radius: 6px; font-weight:600;">
            <span>Submit Pre-Registration</span>
        </button>
    </form>
</div>
HTML;

        // Replace static form with dynamic form
        $patternForm = '/<form[^>]*>.*?<\/form>/s';
        $replaced = preg_replace($patternForm, $formHtml, $html);
        if ($replaced && $replaced !== $html) {
            return $replaced;
        }

        return $html;
    }

    private function injectDynamicSponsors(string $slug, string $html): string
    {
        $sponsors = Sponsor::where('is_published', true)->orderBy('sort_order')->orderBy('name')->get();
        if ($sponsors->isEmpty()) {
            return $html;
        }

        if ($slug === 'sponsors') {
            $dynamicHtml = '<section class="py-5 bg-white"><div class="container py-4 text-center">';

            $grouped = $sponsors->groupBy(function ($item) {
                return str_contains(strtolower($item->tier ?? ''), 'technical') ? 'Technical Sponsors' : 'Academic & Organising Sponsors';
            });

            foreach ($grouped as $groupTitle => $groupItems) {
                $dynamicHtml .= '<div class="mb-4 reveal-fade-up">';
                $dynamicHtml .= '<p class="text-primary fw-bold text-uppercase mb-1" style="font-size:0.8rem; letter-spacing:1px;">Partnership</p>';
                $dynamicHtml .= '<h2 class="fw-bold text-primary mb-4" style="font-family:\'Space Grotesk\',sans-serif;">' . e($groupTitle) . '</h2>';
                $dynamicHtml .= '</div>';

                $dynamicHtml .= '<div class="row g-4 justify-content-center mb-5 reveal-fade-up">';
                foreach ($groupItems as $sponsor) {
                    $logoUrl    = $sponsor->logo ? '/storage/' . $sponsor->logo : null;
                    $websiteUrl = $sponsor->website_url ? e($sponsor->website_url) : '#';

                    $dynamicHtml .= '<div class="col-md-5 col-lg-3">';
                    $dynamicHtml .= '<div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-white text-center d-flex flex-column align-items-center justify-content-between">';
                    $dynamicHtml .= '<div class="mb-3 d-flex align-items-center justify-content-center" style="min-height: 100px; width: 100%;">';
                    if ($logoUrl) {
                        $dynamicHtml .= '<img src="' . e($logoUrl) . '" alt="' . e($sponsor->name) . '" class="img-fluid" style="max-height: 85px; max-width: 100%; object-fit: contain;" />';
                    } else {
                        $dynamicHtml .= '<i class="bi bi-building text-primary" style="font-size: 3rem;"></i>';
                    }
                    $dynamicHtml .= '</div>';
                    $dynamicHtml .= '<div>';
                    $dynamicHtml .= '<h6 class="fw-bold text-primary mb-1">' . e($sponsor->name) . '</h6>';
                    if ($sponsor->tier) {
                        $dynamicHtml .= '<span class="badge bg-light text-primary border mb-2" style="font-size:0.75rem;">' . e($sponsor->tier) . '</span>';
                    }
                    $dynamicHtml .= '</div>';
                    if ($sponsor->website_url) {
                        $dynamicHtml .= '<a href="' . $websiteUrl . '" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary mt-3 px-3 py-1 rounded-pill" style="font-size:0.75rem;"><i class="bi bi-box-arrow-up-right me-1"></i> Visit Website</a>';
                    }
                    $dynamicHtml .= '</div>';
                    $dynamicHtml .= '</div>';
                }
                $dynamicHtml .= '</div>';
            }

            $dynamicHtml .= '</div></section>';

            $replaced = preg_replace('/<!-- ORGANIZERS & COLLABORATIONS -->.*?<\/section>/s', '<!-- ORGANIZERS & COLLABORATIONS -->' . $dynamicHtml, $html);
            if ($replaced && $replaced !== $html) {
                $html = $replaced;
            } else {
                $html = preg_replace('/<section class="py-5 bg-white">.*?<\/section>/s', $dynamicHtml, $html, 1);
            }
        }

        if ($slug === 'home') {
            $barHtml  = '<div class="bg-white border-bottom py-4 organizers-bar" data-aos="fade-up"><div class="container"><div class="row align-items-center text-center g-4">';
            $barHtml .= '<div class="col-12"><p class="text-muted mb-2" style="font-size:0.75rem; letter-spacing:2px; text-transform:uppercase; font-weight:600;">Organized By &amp; In Technical Collaboration With</p></div>';

            $colWidth = count($sponsors) > 0 ? max(3, floor(12 / count($sponsors))) : 3;
            foreach ($sponsors as $sponsor) {
                $logoUrl  = $sponsor->logo ? '/storage/' . $sponsor->logo : null;
                $barHtml .= '<div class="col-6 col-md-' . $colWidth . '">';
                $barHtml .= '<div class="d-flex align-items-center justify-content-center gap-3 p-2">';
                if ($logoUrl) {
                    $barHtml .= '<img src="' . e($logoUrl) . '" alt="' . e($sponsor->name) . '" style="max-height: 48px; max-width: 140px; object-fit: contain;" />';
                }
                $barHtml .= '<div class="text-start">';
                $barHtml .= '<strong class="text-primary d-block" style="font-size:0.88rem;">' . e($sponsor->name) . '</strong>';
                if ($sponsor->tier) {
                    $barHtml .= '<small class="text-muted" style="font-size:0.75rem;">' . e($sponsor->tier) . '</small>';
                }
                $barHtml .= '</div></div></div>';
            }
            $barHtml .= '</div></div></div>';

            $pattern  = '/(<!-- ORGANIZERS BAR -->|<div[^>]*organizers-bar[^>]*>).*?(?=<!-- ABOUT CONFERENCE -->|<section)/s';
            $replaced = preg_replace($pattern, '<!-- ORGANIZERS BAR -->' . $barHtml, $html);
            if ($replaced && $replaced !== $html) {
                $html = $replaced;
            }
        }

        return $html;
    }
}
