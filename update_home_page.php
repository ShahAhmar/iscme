<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

$page = Page::where('slug', 'home')->first();
if (!$page) {
    echo "Home page not found in DB\n";
    exit;
}

$heroHtml = "
        <!-- HERO SECTION -->
        <section class=\"parallax-container d-flex align-items-center\" style=\"min-height: 95vh; background: url('/hero-bg.png') no-repeat center center / cover; position: relative; padding-bottom: 120px;\">
            <div class=\"position-absolute w-100 h-100\" style=\"background: transparent; top:0; left:0; z-index:0;\"></div>
            <div class=\"container position-relative z-1 py-5\">
                <div class=\"row align-items-center\">
                    <div class=\"col-lg-8\">
                        <p class=\"text-uppercase fw-bold mb-2\" style=\"letter-spacing:3px; font-size:0.8rem; color:#0D3A6E;\" data-aos=\"fade-down\">
                            <i class=\"bi bi-geo-alt-fill me-2\" style=\"color: #1A73E8;\"></i>Technical University of Sofia, Bulgaria &nbsp;|&nbsp; 2–4 June, 2027
                        </p>
                        <h1 class=\"display-3 fw-bold mb-3\" style=\"line-height:1.1; font-family:'Space Grotesk',sans-serif; color: #0D3A6E;\" data-aos=\"fade-up\" data-aos-delay=\"150\">
                            ISCME <span style=\"color:#1A73E8;\">'27</span>
                        </h1>
                        <h2 class=\"fw-semibold mb-4\" style=\"font-size:1.4rem; line-height:1.4; color: #0D3A6E;\" data-aos=\"fade-up\" data-aos-delay=\"250\">
                            International Scientific Conference on<br><span style=\"color:#1565C0;\">Management &amp; Engineering 2027</span>
                        </h2>
                        <p class=\"mb-4\" style=\"font-size:1.05rem; color:#374151; max-width:680px; line-height:1.7;\" data-aos=\"fade-up\" data-aos-delay=\"350\">
                            Jointly organized by <strong style=\"color: #0D3A6E;\">Faculty of Management, Technical University of Sofia, Bulgaria</strong> &amp; <strong style=\"color: #0D3A6E;\">GAFTIM — Global Academic Forum on Technology Innovation &amp; Management</strong>, Universiti Sains Malaysia (USM). In technical collaboration with <strong style=\"color: #0D3A6E;\">IEEE Bulgaria Section</strong>.
                        </p>
                        <div class=\"d-flex flex-wrap gap-2 mb-4\" data-aos=\"fade-up\" data-aos-delay=\"450\">
                            <span class=\"badge rounded-pill px-3 py-2\" style=\"background:rgba(13,58,110,0.06); color:#0D3A6E; font-size:0.85rem; border:1px solid rgba(13,58,110,0.2);\"><i class=\"bi bi-award me-1\" style=\"color: #1A73E8;\"></i> IEEE Xplore Indexed</span>
                            <span class=\"badge rounded-pill px-3 py-2\" style=\"background:rgba(13,58,110,0.06); color:#0D3A6E; font-size:0.85rem; border:1px solid rgba(13,58,110,0.2);\"><i class=\"bi bi-people me-1\" style=\"color: #1A73E8;\"></i> Blind Peer Review</span>
                            <span class=\"badge rounded-pill px-3 py-2\" style=\"background:rgba(13,58,110,0.06); color:#0D3A6E; font-size:0.85rem; border:1px solid rgba(13,58,110,0.2);\"><i class=\"bi bi-globe me-1\" style=\"color: #1A73E8;\"></i> International Conference</span>
                        </div>
                        <div class=\"d-flex flex-wrap gap-3\" data-aos=\"fade-up\" data-aos-delay=\"550\">
                            <a href=\"https://iscme.gaftim.com\" target=\"_blank\" class=\"btn px-4 py-3\" style=\"background:#0D3A6E; color:#ffffff; border-radius:6px; font-weight:600; text-decoration:none; box-shadow: 0 4px 12px rgba(13,58,110,0.2);\">Register Now <i class=\"bi bi-arrow-right ms-2\"></i></a>
                            <a href=\"/program\" class=\"btn px-4 py-3\" style=\"background:#ffffff; color:#374151; border:1px solid rgba(0,0,0,0.15); border-radius:6px; font-weight:600; text-decoration:none; box-shadow: 0 2px 8px rgba(0,0,0,0.05);\">Call for Papers <i class=\"bi bi-file-earmark-text ms-2\"></i></a>
                        </div>
                    </div>
                    <div class=\"col-lg-4 mt-5 mt-lg-0 text-lg-end\" data-aos=\"fade-left\" data-aos-delay=\"300\">
                        <div class=\"d-inline-block p-4 rounded-4 w-100\" style=\"background: rgba(255,255,255,0.45); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.65); box-shadow: 0 10px 30px rgba(0,61,108,0.08); position: relative; overflow: hidden; z-index: 1;\">
                            <div class=\"mb-3 pb-3 border-bottom border-secondary border-opacity-10 text-start\">
                                <small class=\"d-block mb-1\" style=\"font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:#5E7E9F; font-weight:700;\">Submission Deadline</small>
                                <span class=\"fw-bold\" style=\"font-size:1.05rem; color:#0D3A6E;\"><i class=\"bi bi-calendar-check me-2 text-warning\"></i>April 20, 2027</span>
                            </div>
                            <div class=\"mb-3 pb-3 border-bottom border-secondary border-opacity-10 text-start\">
                                <small class=\"d-block mb-1\" style=\"font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:#5E7E9F; font-weight:700;\">Acceptance Notification</small>
                                <span class=\"fw-bold\" style=\"font-size:1.05rem; color:#0D3A6E;\"><i class=\"bi bi-envelope-check me-2 text-info\"></i>May 10, 2027</span>
                            </div>
                            <div class=\"mb-3 pb-3 border-bottom border-secondary border-opacity-10 text-start\">
                                <small class=\"d-block mb-1\" style=\"font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:#5E7E9F; font-weight:700;\">Early Bird Registration</small>
                                <span class=\"fw-bold\" style=\"font-size:1.05rem; color:#0D3A6E;\"><i class=\"bi bi-tag me-2 text-success\"></i>May 15, 2027</span>
                            </div>
                            <div class=\"mb-3 pb-3 border-bottom border-secondary border-opacity-10 text-start\">
                                <small class=\"d-block mb-1\" style=\"font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:#5E7E9F; font-weight:700;\">Normal Registration</small>
                                <span class=\"fw-bold\" style=\"font-size:1.05rem; color:#0D3A6E;\"><i class=\"bi bi-tag me-2 text-info\"></i>May 20, 2027</span>
                            </div>
                            <div class=\"text-start\">
                                <small class=\"d-block mb-1\" style=\"font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:#5E7E9F; font-weight:700;\">Conference Dates</small>
                                <span class=\"fw-bold\" style=\"font-size:1.05rem; color:#0D3A6E;\"><i class=\"bi bi-flag me-2\" style=\"color:#1A73E8;\"></i>June 2–4, 2027</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- STATS BAR -->
            <div class=\"stats-bar w-100 py-4 px-5\" style=\"background: linear-gradient(90deg, #0A3A6E 0%, #031D3B 100%); border-top: 1px solid rgba(255,255,255,0.1); position: absolute; bottom: 0; left: 0; z-index: 2;\">
                <div class=\"row text-white align-items-center text-center text-md-start\">
                    <div class=\"col-md-3 border-end border-white border-opacity-10 py-2\">
                        <div class=\"d-flex align-items-center gap-3 justify-content-center justify-content-md-start\">
                            <div class=\"rounded-circle p-2 d-flex align-items-center justify-content-center\" style=\"background: rgba(255,255,255,0.08); width: 50px; height: 50px;\">
                                <i class=\"bi bi-calendar3\" style=\"font-size: 1.3rem; color: #5BB8FF;\"></i>
                            </div>
                            <div>
                                <small class=\"text-white-50 text-uppercase d-block fw-bold\" style=\"font-size: 0.65rem; letter-spacing: 1px;\">Date</small>
                                <span class=\"d-block fw-bold\" style=\"font-size: 1rem; line-height: 1.2;\">2 - 4 June, 2027</span>
                                <small class=\"text-white-50\" style=\"font-size: 0.7rem;\">3 Days Conference</small>
                            </div>
                        </div>
                    </div>
                    <div class=\"col-md-3 border-end border-white border-opacity-10 py-2\">
                        <div class=\"d-flex align-items-center gap-3 justify-content-center justify-content-md-start\">
                            <div class=\"rounded-circle p-2 d-flex align-items-center justify-content-center\" style=\"background: rgba(255,255,255,0.08); width: 50px; height: 50px;\">
                                <i class=\"bi bi-geo-alt\" style=\"font-size: 1.3rem; color: #5BB8FF;\"></i>
                            </div>
                            <div>
                                <small class=\"text-white-50 text-uppercase d-block fw-bold\" style=\"font-size: 0.65rem; letter-spacing: 1px;\">Venue</small>
                                <span class=\"d-block fw-bold\" style=\"font-size: 1rem; line-height: 1.2;\">Sofia, Bulgaria</span>
                                <small class=\"text-white-50\" style=\"font-size: 0.7rem;\">Technical University of Sofia</small>
                            </div>
                        </div>
                    </div>
                    <div class=\"col-md-3 border-end border-white border-opacity-10 py-2\">
                        <div class=\"d-flex align-items-center gap-3 justify-content-center justify-content-md-start\">
                            <div class=\"rounded-circle p-2 d-flex align-items-center justify-content-center\" style=\"background: rgba(255,255,255,0.08); width: 50px; height: 50px;\">
                                <i class=\"bi bi-people\" style=\"font-size: 1.3rem; color: #5BB8FF;\"></i>
                            </div>
                            <div>
                                <small class=\"text-white-50 text-uppercase d-block fw-bold\" style=\"font-size: 0.65rem; letter-spacing: 1px;\">Participants</small>
                                <span class=\"d-block fw-bold\" style=\"font-size: 1rem; line-height: 1.2;\">1000+</span>
                                <small class=\"text-white-50\" style=\"font-size: 0.7rem;\">Researchers & Academicians</small>
                            </div>
                        </div>
                    </div>
                    <div class=\"col-md-3 py-2\">
                        <div class=\"d-flex align-items-center gap-3 justify-content-center justify-content-md-start\">
                            <div class=\"rounded-circle p-2 d-flex align-items-center justify-content-center\" style=\"background: rgba(255,255,255,0.08); width: 50px; height: 50px;\">
                                <i class=\"bi bi-award\" style=\"font-size: 1.3rem; color: #5BB8FF;\"></i>
                            </div>
                            <div>
                                <small class=\"text-white-50 text-uppercase d-block fw-bold\" style=\"font-size: 0.65rem; letter-spacing: 1px;\">Tracks</small>
                                <span class=\"d-block fw-bold\" style=\"font-size: 1rem; line-height: 1.2;\">15+</span>
                                <small class=\"text-white-50\" style=\"font-size: 0.7rem;\">Topics & Special Sessions</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
";

$html = $page->html;

// Find position of the old hero section and replace it
$startPattern = "<!-- HERO SECTION -->";
$endPattern = "<!-- ORGANIZERS BAR -->";

$startPos = strpos($html, $startPattern);
$endPos = strpos($html, $endPattern);

if ($startPos !== false && $endPos !== false) {
    $before = substr($html, 0, $startPos);
    $after = substr($html, $endPos);
    $html = $before . trim($heroHtml) . "\n\n        " . $after;
    $page->html = $html;
    $page->save();
    echo "SUCCESS: Page content updated with dark fonts, light glassmorphism card, and bottom stats bar!\n";
} else {
    echo "ERROR: Could not find hero boundaries in page HTML\n";
}
