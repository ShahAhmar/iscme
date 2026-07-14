<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::truncate();

        $homeHtml = '
        <!-- HERO SECTION -->
        <section class="parallax-container d-flex align-items-center" style="min-height: 90vh; background: url(\'/hero-bg.png\') no-repeat center center / cover; position: relative;">
            <div class="position-absolute w-100 h-100" style="background: rgba(0, 0, 0, 0.45); top:0; left:0; z-index:0;"></div>
            <div class="container position-relative z-1 text-white py-5">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <p class="text-uppercase fw-bold mb-2" style="letter-spacing:3px; font-size:0.8rem; color:#EBF5FF; opacity:0.85;" data-aos="fade-down">
                            <i class="bi bi-geo-alt-fill me-2"></i>Technical University of Sofia, Bulgaria &nbsp;|&nbsp; 2–4 June, 2027
                        </p>
                        <h1 class="display-3 fw-bold text-white mb-3" style="line-height:1.1; font-family:\'Space Grotesk\',sans-serif;" data-aos="fade-up" data-aos-delay="150">
                            ISCME <span style="color:#5BB8FF;">\'27</span>
                        </h1>
                        <h2 class="fw-semibold text-white mb-4" style="font-size:1.3rem; line-height:1.4; opacity:0.95;" data-aos="fade-up" data-aos-delay="250">
                            International Scientific Conference on<br>Management &amp; Engineering 2027
                        </h2>
                        <p class="mb-4" style="font-size:1.05rem; opacity:0.85; max-width:680px; line-height:1.7;" data-aos="fade-up" data-aos-delay="350">
                            Jointly organized by <strong class="text-white">Faculty of Management, Technical University of Sofia, Bulgaria</strong> &amp; <strong class="text-white">GAFTIM — Global Academic Forum on Technology Innovation &amp; Management</strong>, Universiti Sains Malaysia (USM). In technical collaboration with <strong class="text-white">IEEE Bulgaria Section</strong>.
                        </p>
                        <div class="d-flex flex-wrap gap-2 mb-4" data-aos="fade-up" data-aos-delay="450">
                            <span class="badge rounded-pill px-3 py-2" style="background:rgba(255,255,255,0.15); font-size:0.85rem; border:1px solid rgba(255,255,255,0.3);"><i class="bi bi-award me-1"></i> IEEE Xplore Indexed</span>
                            <span class="badge rounded-pill px-3 py-2" style="background:rgba(255,255,255,0.15); font-size:0.85rem; border:1px solid rgba(255,255,255,0.3);"><i class="bi bi-people me-1"></i> Blind Peer Review</span>
                            <span class="badge rounded-pill px-3 py-2" style="background:rgba(255,255,255,0.15); font-size:0.85rem; border:1px solid rgba(255,255,255,0.3);"><i class="bi bi-globe me-1"></i> International Conference</span>
                        </div>
                        <div class="d-flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="550">
                            <a href="https://iscme.gaftim.com" target="_blank" class="btn btn-premium px-4 py-3" style="border-radius:6px; font-weight:600;">Register Now <i class="bi bi-arrow-right ms-2"></i></a>
                            <a href="/program" class="btn btn-outline-light px-4 py-3" style="border-radius:6px; font-weight:600;">Call for Papers <i class="bi bi-file-earmark-text ms-2"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-5 mt-lg-0 text-lg-end" data-aos="fade-left" data-aos-delay="300">
                        <div class="d-inline-block p-4 rounded-4 w-100" style="background: url(\'/container-bg.png\') no-repeat center center / cover; border: 1px solid rgba(255,255,255,0.2); position: relative; overflow: hidden; z-index: 1;">
                            <div class="mb-3 pb-3 border-bottom border-light border-opacity-25">
                                <small class="text-white-50 d-block mb-1" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:1px;">Submission Deadline</small>
                                <span class="fw-bold text-white" style="font-size:1.05rem;"><i class="bi bi-calendar-check me-2 text-warning"></i>April 20, 2027</span>
                            </div>
                            <div class="mb-3 pb-3 border-bottom border-light border-opacity-25">
                                <small class="text-white-50 d-block mb-1" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:1px;">Acceptance Notification</small>
                                <span class="fw-bold text-white" style="font-size:1.05rem;"><i class="bi bi-envelope-check me-2 text-info"></i>May 10, 2027</span>
                            </div>
                            <div class="mb-3 pb-3 border-bottom border-light border-opacity-25">
                                <small class="text-white-50 d-block mb-1" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:1px;">Early Bird Registration</small>
                                <span class="fw-bold text-white" style="font-size:1.05rem;"><i class="bi bi-tag me-2 text-success"></i>May 15, 2027</span>
                            </div>
                            <div class="mb-3 pb-3 border-bottom border-light border-opacity-25">
                                <small class="text-white-50 d-block mb-1" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:1px;">Normal Registration</small>
                                <span class="fw-bold text-white" style="font-size:1.05rem;"><i class="bi bi-tag me-2 text-info"></i>May 20, 2027</span>
                            </div>
                            <div>
                                <small class="text-white-50 d-block mb-1" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:1px;">Conference Dates</small>
                                <span class="fw-bold text-white" style="font-size:1.05rem;"><i class="bi bi-flag me-2" style="color:#5BB8FF;"></i>June 2–4, 2027</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ORGANIZERS BAR -->
        <div class="bg-white border-bottom py-4" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center text-center g-4">
                    <div class="col-12"><p class="text-muted mb-2" style="font-size:0.75rem; letter-spacing:2px; text-transform:uppercase; font-weight:600;">Organized By &amp; In Technical Collaboration With</p></div>
                    <div class="col-md-4 border-end">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <i class="bi bi-building text-primary" style="font-size:2rem;"></i>
                            <div class="text-start">
                                <strong class="text-primary d-block" style="font-size:0.95rem;">Technical University of Sofia</strong>
                                <small class="text-muted">Faculty of Management, Bulgaria</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 border-end">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <i class="bi bi-globe2 text-primary" style="font-size:2rem;"></i>
                            <div class="text-start">
                                <strong class="text-primary d-block" style="font-size:0.95rem;">GAFTIM &amp; USM</strong>
                                <small class="text-muted">Global Academic Forum on Technology Innovation &amp; Management | Universiti Sains Malaysia</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <i class="bi bi-lightning-charge-fill text-primary" style="font-size:2rem;"></i>
                            <div class="text-start">
                                <strong class="text-primary d-block" style="font-size:0.95rem;">IEEE Bulgaria Section</strong>
                                <small class="text-muted">Technical Sponsor</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ABOUT CONFERENCE -->
        <section class="py-5 bg-white" data-aos="fade-up">
            <div class="container py-4">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <p class="text-primary fw-bold text-uppercase mb-2" style="letter-spacing:1px; font-size:0.82rem;">About ISCME\'27</p>
                        <h2 class="display-5 fw-bold text-primary mb-4" style="font-family:\'Space Grotesk\',sans-serif; line-height:1.15;">Advancing Knowledge in Engineering &amp; Management</h2>
                        <p class="text-muted mb-4" style="font-size:1.05rem; line-height:1.8;">The <strong>International Scientific Conference on Management &amp; Engineering (ISCME \'27)</strong> is jointly organized by <strong>Technical University of Sofia, Bulgaria</strong>, and <strong>GAFTIM (Global Academic Forum on Technology Innovation &amp; Management)</strong> and in technical collaboration with <strong>IEEE Bulgaria Section</strong>.</p>
                        <p class="text-muted mb-4" style="font-size:1.05rem; line-height:1.8;">The conference will be held <strong>physically at Technical University of Sofia — Studentski grad, Sofia, Bulgaria, 2–4th June, 2027</strong>. The main goal of ISCME\'27 is to share and exchange knowledge and innovative ideas about current trends in Engineering, Computer Sciences, Communications &amp; Information, Technology Management, Cyber Security, e-Business, Innovation and Entrepreneurship.</p>
                        <p class="text-muted mb-5" style="font-size:1.05rem; line-height:1.8;">All papers will be <strong>blind peer-reviewed by up to three reviewers</strong> based on full paper submission. Accepted papers will be submitted for inclusion into <strong>IEEE Xplore</strong> subject to meeting IEEE Xplore\'s scope and quality requirements.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="https://iscme.gaftim.com" target="_blank" class="btn btn-premium px-4 py-3" style="border-radius:6px; font-weight:600;">Visit Conference Website <i class="bi bi-box-arrow-up-right ms-2"></i></a>
                            <a href="mailto:iscme@gaftim.com" class="btn btn-outline-primary px-4 py-3" style="border-radius:6px; font-weight:600;"><i class="bi bi-envelope me-2"></i>iscme@gaftim.com</a>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                        <div class="row g-3">
                            <div class="col-6"><div class="card border-0 shadow-sm rounded-4 p-4 text-center floating-card h-100"><i class="bi bi-file-earmark-check text-primary mb-2" style="font-size:2.2rem;"></i><h5 class="fw-bold text-primary mb-1">Blind Peer</h5><p class="small text-muted mb-0">Review by 2–3 expert reviewers per paper</p></div></div>
                            <div class="col-6"><div class="card border-0 shadow-sm rounded-4 p-4 text-center floating-card h-100"><i class="bi bi-cpu text-primary mb-2" style="font-size:2.2rem;"></i><h5 class="fw-bold text-primary mb-1">IEEE Xplore</h5><p class="small text-muted mb-0">Accepted papers submitted for IEEE Xplore inclusion</p></div></div>
                            <div class="col-6"><div class="card border-0 shadow-sm rounded-4 p-4 text-center floating-card h-100"><i class="bi bi-globe text-primary mb-2" style="font-size:2.2rem;"></i><h5 class="fw-bold text-primary mb-1">Global Reach</h5><p class="small text-muted mb-0">Researchers from across the globe</p></div></div>
                            <div class="col-6"><div class="card border-0 shadow-sm rounded-4 p-4 text-center floating-card h-100"><i class="bi bi-geo-alt text-primary mb-2" style="font-size:2.2rem;"></i><h5 class="fw-bold text-primary mb-1">Sofia, Bulgaria</h5><p class="small text-muted mb-0">Physical conference at TU–Sofia Studentski grad campus</p></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- IMPORTANT DATES -->
        <section class="py-5" style="background-color:#0A2540;" data-aos="fade-up">
            <div class="container py-3">
                <div class="text-center mb-5">
                    <p class="fw-bold text-uppercase mb-2" style="letter-spacing:2px; font-size:0.8rem; color:#5BB8FF;">Mark Your Calendar</p>
                    <h2 class="fw-bold text-white" style="font-family:\'Space Grotesk\',sans-serif;">Important Dates</h2>
                </div>
                <div class="row g-4 text-center">
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="rounded-4 p-4 h-100" style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12);">
                            <i class="bi bi-file-earmark-text text-warning mb-3" style="font-size:2.2rem;"></i>
                            <h6 class="text-white-50 text-uppercase mb-2" style="font-size:0.75rem; letter-spacing:1px;">Submission Deadline</h6>
                            <h3 class="fw-bold text-white mb-1">April 20</h3>
                            <p class="text-white-50 mb-0" style="font-size:0.9rem;">2027</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="rounded-4 p-4 h-100" style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12);">
                            <i class="bi bi-envelope-check text-info mb-3" style="font-size:2.2rem;"></i>
                            <h6 class="text-white-50 text-uppercase mb-2" style="font-size:0.75rem; letter-spacing:1px;">Acceptance Deadline</h6>
                            <h3 class="fw-bold text-white mb-1">May 10</h3>
                            <p class="text-white-50 mb-0" style="font-size:0.9rem;">2027</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="rounded-4 p-4 h-100" style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12);">
                            <i class="bi bi-tag text-success mb-3" style="font-size:2.2rem;"></i>
                            <h6 class="text-white-50 text-uppercase mb-2" style="font-size:0.75rem; letter-spacing:1px;">Registration</h6>
                            <h3 class="fw-bold text-white mb-1">May 15</h3>
                            <p class="text-white-50 mb-0" style="font-size:0.9rem;">Early Bird &nbsp;|&nbsp; May 20 Normal</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                        <div class="rounded-4 p-4 h-100" style="background:rgba(91,184,255,0.12); border:2px solid rgba(91,184,255,0.4);">
                            <i class="bi bi-flag-fill mb-3" style="font-size:2.2rem; color:#5BB8FF;"></i>
                            <h6 class="text-white-50 text-uppercase mb-2" style="font-size:0.75rem; letter-spacing:1px;">Conference Dates</h6>
                            <h3 class="fw-bold text-white mb-1">June 2–4</h3>
                            <p class="mb-0" style="font-size:0.9rem; color:#5BB8FF;">2027, Sofia, Bulgaria</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONFERENCE TOPICS -->
        <section class="py-5 bg-white" data-aos="fade-up">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <p class="text-primary fw-bold text-uppercase mb-2" style="letter-spacing:1px; font-size:0.82rem;">Research Areas</p>
                    <h2 class="fw-bold text-primary" style="font-family:\'Space Grotesk\',sans-serif;">Conference Topics</h2>
                    <p class="text-muted mt-3" style="max-width:650px; margin:0 auto; font-size:1rem;">ISCME\'27 Technical University of Sofia welcomes papers pertaining to the following topics including but not limited to:</p>
                </div>
                <div class="row g-3">
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="50"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-robot text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">Artificial Intelligence Applications &amp; Digital Forensics</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-shield-lock text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">IDS, Security &amp; Network Security</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="150"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-currency-bitcoin text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">Blockchain &amp; Cryptocurrency Security</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-people text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">Social Engineering &amp; Technosocial</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="250"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-arrow-repeat text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">Digital Business Transformation</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-bug text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">Cybercrime and Cyber Harassment</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="350"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-lock text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">Cryptography, Steganography &amp; Watermarking</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-bank text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">FinTech &amp; FinTech Security</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="450"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-gear text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">Security Management</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="500"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-lightbulb text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">Technology Management &amp; Innovation</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="550"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-graph-up-arrow text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">Business Intelligence &amp; Analytics</span></div></div>
                    <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="600"><div class="d-flex align-items-start p-3 rounded-3 h-100" style="background:#EBF5FF;"><i class="bi bi-journal-text text-primary me-3 mt-1" style="font-size:1.3rem; flex-shrink:0;"></i><span class="text-primary fw-medium" style="font-size:0.95rem;">Cyber Law, Policy and Strategy</span></div></div>
                </div>
            </div>
        </section>

        <!-- ORGANIZATION COMMITTEES -->
        <section class="py-5" style="background-color:#EBF5FF;" data-aos="fade-up">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <p class="text-primary fw-bold text-uppercase mb-2" style="letter-spacing:1px; font-size:0.82rem;">Leadership</p>
                    <h2 class="fw-bold text-primary" style="font-family:\'Space Grotesk\',sans-serif;">Organization Committees</h2>
                </div>

                <!-- Conference Patron -->
                <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up">
                    <div class="card-header border-0 rounded-top-4 py-3 px-4" style="background:#003D6C;">
                        <h5 class="mb-0 text-white fw-bold"><i class="bi bi-star-fill me-2 text-warning"></i>Conference Patron</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-person-badge-fill text-primary me-3 mt-1" style="font-size:1.5rem; flex-shrink:0;"></i>
                            <div><strong class="text-primary d-block" style="font-size:1rem;">Prof. Dr. Georgi Venkov</strong><span class="text-muted" style="font-size:0.9rem;">Rector, Technical University of Sofia (TUS), Bulgaria</span></div>
                        </div>
                    </div>
                </div>

                <!-- General Chairs -->
                <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header border-0 rounded-top-4 py-3 px-4" style="background:#003D6C;">
                        <h5 class="mb-0 text-white fw-bold"><i class="bi bi-people-fill me-2"></i>General Chairs</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person-circle text-primary me-3 mt-1" style="font-size:1.4rem; flex-shrink:0;"></i><div><strong class="text-primary d-block">Prof. Dr. Yordanka Angelova</strong><span class="text-muted" style="font-size:0.88rem;">Dean Faculty of Management, Technical University of Sofia (TUS), Bulgaria</span></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person-circle text-primary me-3 mt-1" style="font-size:1.4rem; flex-shrink:0;"></i><div><strong class="text-primary d-block">Assoc. Prof. Dr. Fathyah Hashim</strong><span class="text-muted" style="font-size:0.88rem;">Dean of Graduate Business School, Universiti Sains Malaysia (USM), Malaysia</span></div></div></div>
                        </div>
                    </div>
                </div>

                <!-- Conference Chairs & Co-Chairs -->
                <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="card-header border-0 rounded-top-4 py-3 px-4" style="background:#003D6C;">
                        <h5 class="mb-0 text-white fw-bold"><i class="bi bi-diagram-3-fill me-2"></i>Conference Chairs &amp; Co-Chairs</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Prof. Haitham Alzoubi</strong><small class="text-muted">Technical University of Sofia &amp; GAFTIM, UAE</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Prof. Mounir El Khatib</strong><small class="text-muted">Hamdan Bin Mohamad Smart University, UAE</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Munir Ahmad <span class="badge bg-secondary ms-1" style="font-size:0.7rem;">Technical Chair</span></strong><small class="text-muted">NCBA&amp;E, Pakistan</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Assoc. Prof. Dr. Gergana Hristova</strong><small class="text-muted">TU–Sofia, Bulgaria</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Neyara Radwan <span class="badge bg-secondary ms-1" style="font-size:0.7rem;">Conf. Secretary</span></strong><small class="text-muted">Liwa College, Abu Dhabi, UAE</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Mohammad Afifi</strong><small class="text-muted">Director, GAFTIM, UAE</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Prof. Ahmed Sebihi</strong><small class="text-muted">Vice President, Afro-Asian University &amp; GAFTIM</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Fanar Shwedeh</strong><small class="text-muted">City University Ajman, UAE &amp; GAFTIM Director</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Enass Alquqa</strong><small class="text-muted">University of Fujairah, UAE &amp; GAFTIM Director</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Masood Ur Rehman</strong><small class="text-muted">JWSE, University of Glasgow, UK</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Srinidhi Vasudenevan</strong><small class="text-muted">University of Greenwich, UK</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Prof. D.Sc. Kiril Angelov</strong><small class="text-muted">TU–Sofia, Bulgaria</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Chief Assist. Prof. Dr. Stanimir Andonov</strong><small class="text-muted">TU–Sofia, Bulgaria</small></div></div></div>
                        </div>
                    </div>
                </div>

                <!-- Steering Committee -->
                <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-header border-0 rounded-top-4 py-3 px-4" style="background:#003D6C;">
                        <h5 class="mb-0 text-white fw-bold"><i class="bi bi-compass-fill me-2"></i>Steering Committee</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Prof. Dr. Eng. Lidia Galabova</strong><small class="text-muted">TU–Sofia, Bulgaria</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">C.M. Prof. D.Sc. Eng. Georgi Todorov</strong><small class="text-muted">TU–Sofia, Bulgaria</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Prof. D.Sc. Eng. Ivan Kralov</strong><small class="text-muted">TU–Sofia, Bulgaria</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Belal Shneikat</strong><small class="text-muted">GAFTIM, UAE</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Hussam Al Hamadi</strong><small class="text-muted">University of Dubai, UAE</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Rania Itani</strong><small class="text-muted">Murdoch University Dubai, UAE</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Fatma Taher</strong><small class="text-muted">Zayed University, UAE</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Sagheer Abbas</strong><small class="text-muted">Prince Mohammad Bin Fahd University, KSA</small></div></div></div>
                        </div>
                    </div>
                </div>

                <!-- Location Committee -->
                <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up" data-aos-delay="220">
                    <div class="card-header border-0 rounded-top-4 py-3 px-4" style="background:#003D6C;">
                        <h5 class="mb-0 text-white fw-bold"><i class="bi bi-geo-alt-fill me-2"></i>Location Committee</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Mohammad Alshurideh</strong><small class="text-muted">University of Jordan, Jordan</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Ahmad Qasim</strong><small class="text-muted">University of Sharjah, UAE</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Iman Akour</strong><small class="text-muted">University of Sharjah, UAE</small></div></div></div>
                            <div class="col-md-6"><div class="d-flex align-items-start"><i class="bi bi-person text-primary me-2 mt-1" style="flex-shrink:0;"></i><div><strong class="text-primary d-block" style="font-size:0.92rem;">Dr. Amer AlQassem</strong><small class="text-muted">University of AlDhaid, UAE</small></div></div></div>
                        </div>
                    </div>
                </div>

                <!-- Scientific Committee -->
                <div class="card border-0 shadow-sm rounded-4" data-aos="fade-up" data-aos-delay="250">
                    <div class="card-header border-0 rounded-top-4 py-3 px-4" style="background:#003D6C;">
                        <h5 class="mb-0 text-white fw-bold"><i class="bi bi-journal-medical me-2"></i>Scientific Committee</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-2">
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Assoc. Prof. Dr. Teoh Ai Ping</strong><small class="text-muted" style="font-size:0.78rem;">Deputy Dean of Research, Innovation &amp; Industry Community Engagement, Universiti Sains Malaysia</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Assoc. Prof. Dr. Yuvaraj Ganesan</strong><small class="text-muted" style="font-size:0.78rem;">Universiti Sains Malaysia</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Dr. Nikolova-Alexieva</strong><small class="text-muted" style="font-size:0.78rem;">UNWE, Bulgaria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Dr. Dimiter Dimitrakiev</strong><small class="text-muted" style="font-size:0.78rem;">Naval Academy, Varna, Bulgaria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Dr. Tsvetana Stoyanova</strong><small class="text-muted" style="font-size:0.78rem;">UNWE, Bulgaria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Dr. Boyan Durankev</strong><small class="text-muted" style="font-size:0.78rem;">UNWE, Bulgaria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Dr. Nikolay Karev</strong><small class="text-muted" style="font-size:0.78rem;">UCTM, Bulgaria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Dr. Ilyan Minkov</strong><small class="text-muted" style="font-size:0.78rem;">UE – Varna, Bulgaria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Dr. Siyka Demirova</strong><small class="text-muted" style="font-size:0.78rem;">TU – Varna, Bulgaria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Dr. Georgi Stanchev</strong><small class="text-muted" style="font-size:0.78rem;">TU – Sofia, Bulgaria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Dr. Tanya Panteleeva</strong><small class="text-muted" style="font-size:0.78rem;">TU – Varna, Bulgaria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Dr. Valentina Nikolova-Alexieva</strong><small class="text-muted" style="font-size:0.78rem;">UFT, Bulgaria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Vesna Tornjanski</strong><small class="text-muted" style="font-size:0.78rem;">University of Belgrade, Serbia</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Pratima Sharma</strong><small class="text-muted" style="font-size:0.78rem;">Roosevelt University, USA</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Jesus C. Tellez Gaytan</strong><small class="text-muted" style="font-size:0.78rem;">Tecnológico de Monterrey, Mexico</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Tan Cheng Ling</strong><small class="text-muted" style="font-size:0.78rem;">USM, Malaysia</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Mohit Vij</strong><small class="text-muted" style="font-size:0.78rem;">Liwa College, Abu Dhabi, UAE</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Federico Del G. Solfa</strong><small class="text-muted" style="font-size:0.78rem;">National University of La Plata, Argentina</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Keltoum Bentameur</strong><small class="text-muted" style="font-size:0.78rem;">University of Mohamed El Bachir El Ibrahimi, Algeria</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Abdulsattar Al Ali</strong><small class="text-muted" style="font-size:0.78rem;">Dr. Kanayalal Rania Inc., Canada</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Alma Emerita</strong><small class="text-muted" style="font-size:0.78rem;">Far Eastern University Roosevelt, Philippines</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Boudjema Iguenane</strong><small class="text-muted" style="font-size:0.78rem;">uTihoo for Artificial Intelligence, France</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Vorobeva Victoria</strong><small class="text-muted" style="font-size:0.78rem;">National Research Tomsk Polytechnic University, Russia</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Inès Gharbi</strong><small class="text-muted" style="font-size:0.78rem;">University of Sousse, Tunisia</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Laith Abualigah</strong><small class="text-muted" style="font-size:0.78rem;">Al Albait University, Jordan</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Syed Naqvi</strong><small class="text-muted" style="font-size:0.78rem;">Mohawk College, Canada</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Sarfraz Nawaz Brohi</strong><small class="text-muted" style="font-size:0.78rem;">Monash University, Malaysia</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. M. Nawaz Brohi</strong><small class="text-muted" style="font-size:0.78rem;">Bathspa University, UAE</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Nasser Taleb</strong><small class="text-muted" style="font-size:0.78rem;">Canadian University Dubai, UAE</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Adel Abusitta</strong><small class="text-muted" style="font-size:0.78rem;">McGill University, Canada</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Morven McEachern</strong><small class="text-muted" style="font-size:0.78rem;">Huddersfield University, UK</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Yingli Wang</strong><small class="text-muted" style="font-size:0.78rem;">Cardiff University, UK</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Mona Badran</strong><small class="text-muted" style="font-size:0.78rem;">Cairo University, Egypt</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Eiad Yafi</strong><small class="text-muted" style="font-size:0.78rem;">Institute of Business, Timor-Leste</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Noor Zaman Jhanjhi</strong><small class="text-muted" style="font-size:0.78rem;">Taylor\'s University, Malaysia</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Ritu Chauhan</strong><small class="text-muted" style="font-size:0.78rem;">Amity University, India</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Prof. Muhammad Saleem Khan</strong><small class="text-muted" style="font-size:0.78rem;">Rector NCBA&amp;E, Pakistan</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Abdullah Almasri</strong><small class="text-muted" style="font-size:0.78rem;">Hariot Watt University, Malaysia</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Osman Gulseven</strong><small class="text-muted" style="font-size:0.78rem;">Middle East Technical University, Turkey</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Mr. Shabib Aftab</strong><small class="text-muted" style="font-size:0.78rem;">Virtual University of Pakistan, Pakistan</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Tahir Alyas</strong><small class="text-muted" style="font-size:0.78rem;">Lahore Garrison University, Pakistan</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Muhammad Abu Arqoub</strong><small class="text-muted" style="font-size:0.78rem;">Petra University, Jordan</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Ahmad Shubita</strong><small class="text-muted" style="font-size:0.78rem;">Petra University, Jordan</small></div></div></div>
                            <div class="col-md-4 col-sm-6"><div class="d-flex align-items-start"><i class="bi bi-person-check text-primary me-2 mt-1" style="flex-shrink:0; font-size:0.85rem;"></i><div><strong class="text-primary d-block" style="font-size:0.85rem;">Dr. Khairul Akram Zainol Ariffin</strong><small class="text-muted" style="font-size:0.78rem;">Scientific Committee Member</small></div></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- PAPER SUBMISSION & GUIDELINES -->
        <section class="py-5 bg-white" data-aos="fade-up">
            <div class="container py-4">
                <div class="row g-5">
                    <div class="col-lg-6" data-aos="fade-right">
                        <p class="text-primary fw-bold text-uppercase mb-2" style="letter-spacing:1px; font-size:0.82rem;">Submission</p>
                        <h2 class="fw-bold text-primary mb-4" style="font-family:\'Space Grotesk\',sans-serif;">Paper Guidelines</h2>
                        <p class="text-muted mb-3" style="line-height:1.8;">All papers should follow <strong>IEEE manuscript format</strong>:</p>
                        <a href="http://www.ieee.org/conferences_events/conferences/publishing/templates.html" target="_blank" class="btn btn-outline-primary mb-4 px-4 py-2" style="border-radius:6px;"><i class="bi bi-download me-2"></i>Download IEEE Template</a>
                        <div class="p-4 rounded-4 mb-4" style="background:#EBF5FF; border-left:4px solid #003D6C;">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-info-circle me-2"></i>Evaluation Process</h6>
                            <ul class="list-unstyled mb-0 text-primary" style="font-size:0.93rem; line-height:2;">
                                <li><i class="bi bi-check2 me-2"></i>All full papers go through a <strong>blind review process</strong></li>
                                <li><i class="bi bi-check2 me-2"></i>Each article reviewed by <strong>minimum two peer reviewers</strong></li>
                                <li><i class="bi bi-check2 me-2"></i>At least one author must <strong>register and present</strong> physically or virtually</li>
                                <li><i class="bi bi-check2 me-2"></i>Accepted papers published in <strong>ISCME Proceedings</strong></li>
                                <li><i class="bi bi-check2 me-2"></i>Submitted for inclusion into <strong>IEEE Xplore</strong></li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background:#f8f9fa; border:1px solid #dee2e6;">
                            <i class="bi bi-microsoft text-primary" style="font-size:1.8rem;"></i>
                            <div><strong class="text-primary d-block">Paper Submission Platform</strong><span class="text-muted" style="font-size:0.9rem;">Microsoft CMT</span></div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="card border-0 shadow rounded-4 overflow-hidden">
                            <div class="p-4" style="background:#003D6C;">
                                <h5 class="text-white fw-bold mb-0"><i class="bi bi-send-fill me-2"></i>Register &amp; Submit</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-4 pb-4 border-bottom">
                                    <h6 class="fw-bold text-primary mb-3">Conference Website</h6>
                                    <a href="https://iscme.gaftim.com" target="_blank" class="btn btn-premium w-100 py-3" style="border-radius:6px; font-weight:600; font-size:1rem;"><i class="bi bi-globe me-2"></i>https://iscme.gaftim.com</a>
                                </div>
                                <div class="mb-4 pb-4 border-bottom">
                                    <h6 class="fw-bold text-primary mb-3">Contact &amp; Queries</h6>
                                    <a href="mailto:iscme@gaftim.com" class="btn btn-outline-primary w-100 py-3" style="border-radius:6px; font-weight:600;"><i class="bi bi-envelope me-2"></i>iscme@gaftim.com</a>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-primary mb-3">Conference Venue</h6>
                                    <div class="d-flex align-items-start text-muted">
                                        <i class="bi bi-geo-alt-fill text-primary me-3 mt-1" style="flex-shrink:0;"></i>
                                        <span style="line-height:1.7;">Technical University of Sofia, Studentski grad<br>Sofia, Bulgaria<br>Tel: +359-2-965-3237</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CALL TO ACTION -->
        <section class="py-5 text-white text-center" style="background: linear-gradient(135deg, #003D6C 0%, #0071C6 100%);" data-aos="zoom-in">
            <div class="container py-3">
                <h2 class="fw-bold text-white mb-3" style="font-family:\'Space Grotesk\',sans-serif; font-size:2.2rem;">Ready to Present Your Research?</h2>
                <p class="mb-5 text-white" style="font-size:1.1rem; max-width:600px; margin:0 auto; opacity:0.9;">Submit your paper for ISCME\'27 and join researchers from across the globe in Sofia, Bulgaria — June 2–4, 2027. Paper submissions via Microsoft CMT.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="https://iscme.gaftim.com" target="_blank" class="btn btn-light text-primary px-5 py-3" style="border-radius:6px; font-weight:700; font-size:1rem;">Register Now <i class="bi bi-arrow-right ms-2"></i></a>
                    <a href="mailto:iscme@gaftim.com" class="btn btn-outline-light px-5 py-3" style="border-radius:6px; font-weight:600; font-size:1rem;"><i class="bi bi-envelope me-2"></i>iscme@gaftim.com</a>
                </div>
            </div>
        </section>

        ';

        Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'html' => $homeHtml,
            'css' => '',
            'components' => '[]',
            'styles' => '[]',
            'is_published' => true,
        ]);

        $aboutHtml = '
<!-- HERO SECTION -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #0A2540 0%, #003D6C 100%); min-height: 40vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="background: url(\'/images/hero.png\') no-repeat center center / cover; opacity: 0.15; top: 0; left: 0; z-index: 0;"></div>
    <div class="container position-relative z-1 reveal-fade-up">
        <h1 class="display-4 fw-bold mb-3" style="font-family: \'Space Grotesk\', sans-serif;">About the Conference</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 750px;">XXV International Scientific Conference on Management and Engineering (ISCME \'27) is a premier global forum for scientific exchange.</p>
    </div>
</section>

<!-- GENERAL DESCRIPTION -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal-fade-right">
                <p class="text-primary fw-bold text-uppercase mb-2" style="font-size: 0.85rem; letter-spacing: 1px;">Ecosystem & Joint Organization</p>
                <h2 class="display-6 fw-bold text-primary mb-4" style="font-family: \'Space Grotesk\', sans-serif; line-height:1.2;">Uniting Global Academic &amp; Scientific Excellence</h2>
                <p class="text-muted mb-4" style="font-size: 1.05rem; line-height: 1.85;">
                    ISCME \'27 is jointly organized by the <strong>Faculty of Management at the Technical University of Sofia, Bulgaria</strong> and <strong>GAFTIM (Global Academic Forum on Technology Innovation &amp; Management)</strong>, in collaboration with the <strong>Universiti Sains Malaysia (USM)</strong>.
                </p>
                <p class="text-muted mb-4" style="font-size: 1.05rem; line-height: 1.85;">
                    This year, our XXV anniversary edition focuses on building synergies between classic engineering, computer sciences, smart technology governance, and digital entrepreneurship.
                </p>
                <div class="p-4 rounded-4" style="background: #EBF5FF;">
                    <h6 class="fw-bold text-primary mb-2"><i class="bi bi-shield-check me-2"></i>IEEE Technical Sponsorship</h6>
                    <p class="text-primary mb-0" style="font-size:0.92rem; line-height: 1.6;">
                        We are proud to announce that the conference is in technical sponsorship with the <strong>IEEE Bulgaria Section</strong>. All accepted papers meeting IEEE quality criteria will be submitted for inclusion into <strong>IEEE Xplore</strong>.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 reveal-fade-left">
                <div class="position-relative rounded-4 overflow-hidden shadow-lg border-0 floating-card p-0">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop" class="w-100" alt="About ISCME Mission">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GENERAL CHAIR WELCOME -->
<section class="py-5" style="background: #EBF5FF;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 order-lg-2 reveal-fade-left">
                <p class="text-primary fw-bold text-uppercase mb-2" style="font-size: 0.85rem; letter-spacing: 1px;">Dean\'s Message</p>
                <h2 class="display-6 fw-bold text-primary mb-4" style="font-family: \'Space Grotesk\', sans-serif;">Welcome from General Chair</h2>
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white" style="border-left: 5px solid #003D6C !important;">
                    <p class="text-muted italic mb-4" style="font-size:1.05rem; line-height:1.7; font-style: italic;">
                        "Welcome to the XXV edition of the International Scientific Conference on Management and Engineering. It is our honor to invite you to the beautiful city of Sofia to engage in academic and scientific dialogue that pushes the boundaries of management theory and smart technologies."
                    </p>
                    <h6 class="fw-bold text-primary mb-1">Prof. Dr. Yordanka Angelova</h6>
                    <small class="text-muted">Dean of Faculty of Management, Technical University of Sofia</small>
                </div>
            </div>
            <div class="col-lg-7 order-lg-1 reveal-fade-right">
                <h3 class="fw-bold text-primary mb-4" style="font-family: \'Space Grotesk\', sans-serif;">Conference Objectives</h3>
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-journal-text text-primary me-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h5 class="fw-bold text-primary">Academic Publication</h5>
                                <p class="small text-muted mb-0">High-impact indexing in databases, providing globally visible proceedings.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-people text-primary me-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h5 class="fw-bold text-primary">Global Networking</h5>
                                <p class="small text-muted mb-0">Bridging the gap between researchers from Europe, Asia, and North America.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-lightbulb text-primary me-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h5 class="fw-bold text-primary">Knowledge Transfer</h5>
                                <p class="small text-muted mb-0">Applying theoretical mathematical and cyber security concepts to practical ecosystems.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-award text-primary me-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h5 class="fw-bold text-primary">Anniversary Edition</h5>
                                <p class="small text-muted mb-0">Celebrating 25 years of scientific leadership and active management exchange.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
';

        Page::create([
            'title' => 'About',
            'slug' => 'about',
            'html' => $aboutHtml,
            'css' => '',
            'components' => '[]',
            'styles' => '[]',
            'is_published' => true,
        ]);

        $programHtml = '
<!-- HERO SECTION -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #0A2540 0%, #003D6C 100%); min-height: 40vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="background: url(\'/images/hero.png\') no-repeat center center / cover; opacity: 0.15; top: 0; left: 0; z-index: 0;"></div>
    <div class="container position-relative z-1 reveal-fade-up">
        <h1 class="display-4 fw-bold mb-3" style="font-family: \'Space Grotesk\', sans-serif;">Conference Program</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 650px;">A detailed agenda of research sessions, parallel tracks, and keynotes. Sofia, Bulgaria (June 2–4, 2027)</p>
    </div>
</section>

<!-- AGENDA TABS & DETAILS -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5 reveal-fade-up">
            <h2 class="fw-bold text-primary" style="font-family: \'Space Grotesk\', sans-serif;">Schedule &amp; Tracks</h2>
            <p class="text-muted mt-2">Physical presentations will take place at the Faculty of Management, TU Sofia.</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-lg-9">
                <!-- Day 1 Track -->
                <div class="mb-5 reveal-fade-up" data-reveal-delay="50">
                    <div class="p-3 mb-4 rounded-3 text-white fw-bold d-flex justify-content-between align-items-center" style="background: #003D6C;">
                        <span><i class="bi bi-calendar-event me-2"></i>Day 1 — Wednesday, June 2, 2027</span>
                        <span class="badge bg-light text-primary">Inauguration &amp; Keynotes</span>
                    </div>
                    
                    <div class="card border-0 shadow-sm p-4 rounded-4 mb-3 border-start border-4 border-primary">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                            <span class="badge bg-light text-primary px-3 py-2 fw-bold" style="font-size:0.82rem;">09:00 AM - 10:00 AM</span>
                            <span class="small text-muted"><i class="bi bi-geo-alt me-1"></i>Main Auditorium, TU Sofia</span>
                        </div>
                        <h5 class="fw-bold text-primary mb-2">Inauguration Ceremony &amp; Presidential Address</h5>
                        <p class="small text-muted mb-0">Opening statements from Conference Patron Prof. Dr. Georgi Venkov and Dean Prof. Dr. Yordanka Angelova.</p>
                    </div>

                    <div class="card border-0 shadow-sm p-4 rounded-4 mb-3 border-start border-4 border-primary">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                            <span class="badge bg-light text-primary px-3 py-2 fw-bold" style="font-size:0.82rem;">10:30 AM - 12:00 PM</span>
                            <span class="small text-muted"><i class="bi bi-geo-alt me-1"></i>Main Auditorium</span>
                        </div>
                        <h5 class="fw-bold text-primary mb-2">Keynote Plenary Session: Cognitive Technology and Smart Industry</h5>
                        <p class="small text-muted mb-0">Analyzing industrial transformation paradigms, digital assets security and robotic innovations.</p>
                    </div>
                </div>

                <!-- Day 2 Track -->
                <div class="mb-5 reveal-fade-up" data-reveal-delay="100">
                    <div class="p-3 mb-4 rounded-3 text-white fw-bold d-flex justify-content-between align-items-center" style="background: #0071C6;">
                        <span><i class="bi bi-calendar-event me-2"></i>Day 2 — Thursday, June 3, 2027</span>
                        <span class="badge bg-light text-primary">Parallel Tracks</span>
                    </div>
                    
                    <div class="card border-0 shadow-sm p-4 rounded-4 mb-3 border-start border-4 border-info">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                            <span class="badge bg-light text-info px-3 py-2 fw-bold" style="font-size:0.82rem; color: #0071C6 !important;">09:00 AM - 12:30 PM</span>
                            <span class="small text-muted"><i class="bi bi-geo-alt me-1"></i>Seminar Room 1 &amp; 2</span>
                        </div>
                        <h5 class="fw-bold text-primary mb-2">Track A: Cyber Security, FinTech &amp; Blockchain Platforms</h5>
                        <p class="small text-muted mb-0">Presentation of peer-reviewed papers on secure blockchain infrastructure, cryptography and steganography.</p>
                    </div>

                    <div class="card border-0 shadow-sm p-4 rounded-4 mb-3 border-start border-4 border-info">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                            <span class="badge bg-light text-info px-3 py-2 fw-bold" style="font-size:0.82rem; color: #0071C6 !important;">01:30 PM - 05:00 PM</span>
                            <span class="small text-muted"><i class="bi bi-geo-alt me-1"></i>Seminar Room 3</span>
                        </div>
                        <h5 class="fw-bold text-primary mb-2">Track B: Business Intelligence, Analytics &amp; Smart Management</h5>
                        <p class="small text-muted mb-0">Empirical research and data-driven studies on strategic governance, business analytics and modern entrepreneurship.</p>
                    </div>
                </div>

                <!-- Day 3 Track -->
                <div class="reveal-fade-up" data-reveal-delay="150">
                    <div class="p-3 mb-4 rounded-3 text-white fw-bold d-flex justify-content-between align-items-center" style="background: #0A2540;">
                        <span><i class="bi bi-calendar-event me-2"></i>Day 3 — Friday, June 4, 2027</span>
                        <span class="badge bg-light text-primary">Valedictory &amp; Awards</span>
                    </div>
                    
                    <div class="card border-0 shadow-sm p-4 rounded-4 mb-3 border-start border-4 border-dark">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                            <span class="badge bg-light text-dark px-3 py-2 fw-bold" style="font-size:0.82rem;">10:00 AM - 12:30 PM</span>
                            <span class="small text-muted"><i class="bi bi-geo-alt me-1"></i>Main Auditorium</span>
                        </div>
                        <h5 class="fw-bold text-primary mb-2">Paper Presentations &amp; Doctorials Colloquium</h5>
                        <p class="small text-muted mb-0">Graduate and post-doctoral researchers presenting emerging technology findings.</p>
                    </div>

                    <div class="card border-0 shadow-sm p-4 rounded-4 mb-3 border-start border-4 border-dark">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                            <span class="badge bg-light text-dark px-3 py-2 fw-bold" style="font-size:0.82rem;">02:00 PM - 04:00 PM</span>
                            <span class="small text-muted"><i class="bi bi-geo-alt me-1"></i>Main Auditorium</span>
                        </div>
                        <h5 class="fw-bold text-primary mb-2">Closing Ceremony &amp; Best Paper Awards</h5>
                        <p class="small text-muted mb-0">Distribution of certificates, valedictory address, and details of future publication indices.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
';

        Page::create([
            'title' => 'Program',
            'slug' => 'program',
            'html' => $programHtml,
            'css' => '',
            'components' => '[]',
            'styles' => '[]',
            'is_published' => true,
        ]);

        $speakersHtml = '
<!-- HERO SECTION -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #0A2540 0%, #003D6C 100%); min-height: 40vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="background: url(\'/images/hero.png\') no-repeat center center / cover; opacity: 0.15; top: 0; left: 0; z-index: 0;"></div>
    <div class="container position-relative z-1 reveal-fade-up">
        <h1 class="display-4 fw-bold mb-3" style="font-family: \'Space Grotesk\', sans-serif;">Chairs &amp; Key Speakers</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 650px;">visionaries, committee leaders, and international scholars steering the XXV ISCME \'27 Conference.</p>
    </div>
</section>

<!-- FEATURED COMMITTEE LEADERSHIP -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5 reveal-fade-up">
            <p class="text-primary fw-bold text-uppercase mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">Advisory Board</p>
            <h2 class="fw-bold text-primary" style="font-family: \'Space Grotesk\', sans-serif;">Keynote Speakers &amp; General Chairs</h2>
        </div>

        <div class="row g-4 justify-content-center text-center">
            <div class="col-lg-4 col-md-6 reveal-fade-up" data-reveal-delay="50">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 pb-3 bg-white floating-card">
                    <div class="bg-light pt-4 px-3" style="height: 180px;">
                        <i class="bi bi-person-circle text-primary" style="font-size: 5rem;"></i>
                    </div>
                    <div class="card-body bg-white pt-2">
                        <h5 class="fw-bold text-primary mb-1">Prof. Dr. Georgi Venkov</h5>
                        <p class="small text-muted mb-2">Rector, TU Sofia</p>
                        <span class="badge bg-primary text-white px-3 py-1">Conference Patron</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 reveal-fade-up" data-reveal-delay="100">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 pb-3 bg-white floating-card">
                    <div class="bg-light pt-4 px-3" style="height: 180px;">
                        <i class="bi bi-person-circle text-primary" style="font-size: 5rem;"></i>
                    </div>
                    <div class="card-body bg-white pt-2">
                        <h5 class="fw-bold text-primary mb-1">Prof. Dr. Yordanka Angelova</h5>
                        <p class="small text-muted mb-2">Dean of Faculty of Management, TU Sofia</p>
                        <span class="badge bg-primary text-white px-3 py-1">General Chair</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal-fade-up" data-reveal-delay="150">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 pb-3 bg-white floating-card">
                    <div class="bg-light pt-4 px-3" style="height: 180px;">
                        <i class="bi bi-person-circle text-primary" style="font-size: 5rem;"></i>
                    </div>
                    <div class="card-body bg-white pt-2">
                        <h5 class="fw-bold text-primary mb-1">Assoc. Prof. Dr. Fathyah Hashim</h5>
                        <p class="small text-muted mb-2">Dean of GBS, Universiti Sains Malaysia</p>
                        <span class="badge bg-primary text-white px-3 py-1">General Chair</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal-fade-up" data-reveal-delay="200">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 pb-3 bg-white floating-card">
                    <div class="bg-light pt-4 px-3" style="height: 180px;">
                        <i class="bi bi-person-circle text-primary" style="font-size: 5rem;"></i>
                    </div>
                    <div class="card-body bg-white pt-2">
                        <h5 class="fw-bold text-primary mb-1">Prof. Haitham Alzoubi</h5>
                        <p class="small text-muted mb-2">Technical University of Sofia &amp; GAFTIM, UAE</p>
                        <span class="badge bg-primary text-white px-3 py-1">Conference Chair</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal-fade-up" data-reveal-delay="250">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 pb-3 bg-white floating-card">
                    <div class="bg-light pt-4 px-3" style="height: 180px;">
                        <i class="bi bi-person-circle text-primary" style="font-size: 5rem;"></i>
                    </div>
                    <div class="card-body bg-white pt-2">
                        <h5 class="fw-bold text-primary mb-1">Prof. Mounir El Khatib</h5>
                        <p class="small text-muted mb-2">Hamdan Bin Mohamad Smart University, UAE</p>
                        <span class="badge bg-primary text-white px-3 py-1">Conference Chair</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal-fade-up" data-reveal-delay="300">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 pb-3 bg-white floating-card">
                    <div class="bg-light pt-4 px-3" style="height: 180px;">
                        <i class="bi bi-person-circle text-primary" style="font-size: 5rem;"></i>
                    </div>
                    <div class="card-body bg-white pt-2">
                        <h5 class="fw-bold text-primary mb-1">Dr. Munir Ahmad</h5>
                        <p class="small text-muted mb-2">NCBA&amp;E, Pakistan</p>
                        <span class="badge bg-primary text-white px-3 py-1">Technical Chair</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SCIENTIFIC RESEARCH PANELS -->
        <div class="text-center mt-5">
            <p class="text-muted">A full list of scientific reviewers and session directors is available under the homepage committees section.</p>
            <a href="/" class="btn btn-premium px-4 py-2 mt-2" style="border-radius: 6px;">View All Committee Members</a>
        </div>
    </div>
</section>
';

        Page::create([
            'title' => 'Speakers',
            'slug' => 'speakers',
            'html' => $speakersHtml,
            'css' => '',
            'components' => '[]',
            'styles' => '[]',
            'is_published' => true,
        ]);

        $sponsorsHtml = '
<!-- HERO SECTION -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #0A2540 0%, #003D6C 100%); min-height: 40vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="background: url(\'/images/hero.png\') no-repeat center center / cover; opacity: 0.15; top: 0; left: 0; z-index: 0;"></div>
    <div class="container position-relative z-1 reveal-fade-up">
        <h1 class="display-4 fw-bold mb-3" style="font-family: \'Space Grotesk\', sans-serif;">Collaborating Partners</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 650px;">academic, technical and industry leaders fostering research paradigms for ISCME \'27.</p>
    </div>
</section>

<!-- ORGANIZERS & COLLABORATIONS -->
<section class="py-5 bg-white">
    <div class="container py-4 text-center">
        <div class="mb-5 reveal-fade-up">
            <p class="text-primary fw-bold text-uppercase mb-1" style="font-size:0.8rem; letter-spacing:1px;">Joint Organizers</p>
            <h2 class="fw-bold text-primary" style="font-family:\'Space Grotesk\',sans-serif;">Academic Sponsorship</h2>
        </div>
        <div class="row g-4 justify-content-center mb-5 reveal-fade-up">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-white">
                    <i class="bi bi-building text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5 class="fw-bold text-primary">Technical University of Sofia</h5>
                    <p class="small text-muted mb-0">Faculty of Management, Sofia, Bulgaria. Providing the physical infrastructure and academic leadership.</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-white">
                    <i class="bi bi-globe2 text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5 class="fw-bold text-primary">GAFTIM</h5>
                    <p class="small text-muted mb-0">Global Academic Forum on Technology Innovation &amp; Management. Leading international research propagation.</p>
                </div>
            </div>
        </div>

        <div class="mb-5 reveal-fade-up">
            <p class="text-primary fw-bold text-uppercase mb-1" style="font-size:0.8rem; letter-spacing:1px;">Collaboration</p>
            <h2 class="fw-bold text-primary" style="font-family:\'Space Grotesk\',sans-serif;">Technical Sponsors</h2>
        </div>
        <div class="row g-4 justify-content-center reveal-fade-up">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-white border-start border-4 border-primary">
                    <i class="bi bi-award text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5 class="fw-bold text-primary">IEEE Bulgaria Section</h5>
                    <p class="small text-muted mb-0">Technical collaborator for indexation and standards evaluation, ensuring papers are submitted for inclusion into IEEE Xplore.</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-white">
                    <i class="bi bi-mortarboard text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5 class="fw-bold text-primary">Universiti Sains Malaysia (USM)</h5>
                    <p class="small text-muted mb-0">Joint academic partner facilitating peer evaluations, reviewer distribution, and international registration oversight.</p>
                </div>
            </div>
        </div>
    </div>
</section>
';

        Page::create([
            'title' => 'Sponsors',
            'slug' => 'sponsors',
            'html' => $sponsorsHtml,
            'css' => '',
            'components' => '[]',
            'styles' => '[]',
            'is_published' => true,
        ]);

        $exhibitionHtml = '
<!-- HERO SECTION -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #0A2540 0%, #003D6C 100%); min-height: 40vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="background: url(\'/images/hero.png\') no-repeat center center / cover; opacity: 0.15; top: 0; left: 0; z-index: 0;"></div>
    <div class="container position-relative z-1 reveal-fade-up">
        <h1 class="display-4 fw-bold mb-3" style="font-family: \'Space Grotesk\', sans-serif;">Exhibit at TU Sofia</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 650px;">Showcase technology prototypes, digital tools, and smart research models at our physical venue.</p>
    </div>
</section>

<!-- EXHIBITION DETAILS -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal-fade-right">
                <p class="text-primary fw-bold text-uppercase mb-2" style="font-size: 0.8rem; letter-spacing: 1px;">Research &amp; Industry Expo</p>
                <h2 class="fw-bold text-primary mb-4" style="font-family: \'Space Grotesk\', sans-serif; line-height: 1.25;">Connect Directly with Scientific Decision Makers</h2>
                <p class="text-muted mb-4">
                    ISCME \'27 offers physical research spaces inside the Faculty of Management at the Technical University of Sofia. Showcase digital transformation solutions, cyber security tools, FinTech platforms, and robotics prototypes to over 200 delegates.
                </p>
                <ul class="list-unstyled text-dark fw-medium mt-4">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Dedicated Display Space at TU Sofia Campus</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Showcase AI &amp; Smart Manufacturing prototypes</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Publication and distribution of material in delegate kit</li>
                </ul>
            </div>
            <div class="col-lg-6 reveal-fade-left">
                <div class="card border-0 shadow-lg p-5 rounded-4" style="background: #EBF5FF;">
                    <h4 class="fw-bold text-primary mb-3">Inquire for Space</h4>
                    <form onsubmit="event.preventDefault(); alert(\'Thank you! Your request has been recorded.\');">
                        <div class="mb-3">
                            <input type="text" class="form-control py-3" placeholder="Institution / Organization" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control py-3" placeholder="Primary Contact Email" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Briefly describe the research / technology prototype to display" required style="border-radius: 6px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-premium w-100 py-3" style="border-radius: 6px;">Send Inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
';

        Page::create([
            'title' => 'Exhibition',
            'slug' => 'exhibition',
            'html' => $exhibitionHtml,
            'css' => '',
            'components' => '[]',
            'styles' => '[]',
            'is_published' => true,
        ]);

        $newsHtml = '
<!-- HERO SECTION -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #0A2540 0%, #003D6C 100%); min-height: 40vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="background: url(\'/images/hero.png\') no-repeat center center / cover; opacity: 0.15; top: 0; left: 0; z-index: 0;"></div>
    <div class="container position-relative z-1 reveal-fade-up">
        <h1 class="display-4 fw-bold mb-3" style="font-family: \'Space Grotesk\', sans-serif;">Latest Announcements</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 650px;">Stay up-to-date with indexation timelines, submission extensions and schedules for ISCME \'27.</p>
    </div>
</section>

<!-- NEWS GRID -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-4 reveal-fade-up" data-reveal-delay="50">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-light">
                    <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?q=80&w=600&auto=format&fit=crop" class="card-img-top" style="height: 180px; object-fit: cover;" alt="News">
                    <div class="card-body p-4 bg-white">
                        <p class="small text-muted mb-2"><i class="bi bi-clock me-1"></i>June 12, 2026</p>
                        <h5 class="fw-bold text-primary mb-3">ISCME\'27 Call for Papers Released</h5>
                        <p class="small text-muted mb-4">Official publication tracks and formatting guidelines have been published under IEEE templates. Submissions are open via Microsoft CMT.</p>
                        <a href="#" class="small text-decoration-none fw-bold text-primary">Read Guidelines <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 reveal-fade-up" data-reveal-delay="100">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-light">
                    <img src="https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=600&auto=format&fit=crop" class="card-img-top" style="height: 180px; object-fit: cover;" alt="News">
                    <div class="card-body p-4 bg-white">
                        <p class="small text-muted mb-2"><i class="bi bi-clock me-1"></i>June 10, 2026</p>
                        <h5 class="fw-bold text-primary mb-3">Springer Publishing Guidelines Updated</h5>
                        <p class="small text-muted mb-4">Formatting templates for Springer-indexed proceedings and metadata rules for abstract submission are now online.</p>
                        <a href="#" class="small text-decoration-none fw-bold text-primary">Read More <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 reveal-fade-up" data-reveal-delay="150">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-light">
                    <img src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?q=80&w=600&auto=format&fit=crop" class="card-img-top" style="height: 180px; object-fit: cover;" alt="News">
                    <div class="card-body p-4 bg-white">
                        <p class="small text-muted mb-2"><i class="bi bi-clock me-1"></i>June 05, 2026</p>
                        <h5 class="fw-bold text-primary mb-3">Registration Slots for ISCME\'27 Open</h5>
                        <p class="small text-muted mb-4">Early-bird registration fee tables for international delegates, local Bulgarian students, and listeners have been finalized.</p>
                        <a href="/register" class="small text-decoration-none fw-bold text-primary">View Fees <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
';

        Page::create([
            'title' => 'News',
            'slug' => 'news',
            'html' => $newsHtml,
            'css' => '',
            'components' => '[]',
            'styles' => '[]',
            'is_published' => true,
        ]);

        $contactHtml = '
<!-- HERO SECTION -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #0A2540 0%, #003D6C 100%); min-height: 40vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="background: url(\'/images/hero.png\') no-repeat center center / cover; opacity: 0.15; top: 0; left: 0; z-index: 0;"></div>
    <div class="container position-relative z-1 reveal-fade-up">
        <h1 class="display-4 fw-bold mb-3" style="font-family: \'Space Grotesk\', sans-serif;">Contact Secretariat</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 650px;">Have queries regarding paper submission, registration, or travel details? Reach out to us.</p>
    </div>
</section>

<!-- CONTACT DETAILS & FORM -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-5">
            <div class="col-lg-6 reveal-fade-right">
                <h3 class="fw-bold text-primary mb-4" style="font-family: \'Space Grotesk\', sans-serif;">Get in Touch</h3>
                <form onsubmit="event.preventDefault(); alert(\'Message sent successfully! The secretariat will contact you shortly.\');">
                    <div class="mb-3">
                        <input type="text" class="form-control py-3" placeholder="Full Name" required style="border-radius: 6px;">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control py-3" placeholder="Email Address" required style="border-radius: 6px;">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="5" placeholder="Write your query here..." required style="border-radius: 6px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-premium px-5 py-3" style="border-radius: 6px; font-weight:600;">Send Message <i class="bi bi-send ms-2"></i></button>
                </form>
            </div>
            
            <div class="col-lg-6 reveal-fade-left">
                <h3 class="fw-bold text-primary mb-4" style="font-family: \'Space Grotesk\', sans-serif;">Secretariat Contact Details</h3>
                <div class="card border-0 shadow-sm p-4 rounded-4 mb-4" style="background:#f8f9fa;">
                    <div class="d-flex align-items-start mb-4">
                        <i class="bi bi-geo-alt text-primary me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            <h6 class="fw-bold text-primary mb-1">Conference Venue</h6>
                            <p class="text-muted mb-0" style="font-size: 0.95rem;">Technical University of Sofia, Studentski grad, Sofia, Bulgaria</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <i class="bi bi-envelope text-primary me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            <h6 class="fw-bold text-primary mb-1">Email Support</h6>
                            <p class="text-muted mb-0" style="font-size: 0.95rem;">iscme@gaftim.com</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <i class="bi bi-telephone text-primary me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            <h6 class="fw-bold text-primary mb-1">Phone Inquiry</h6>
                            <p class="text-muted mb-0" style="font-size: 0.95rem;">+359-2-965-3237</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
';

        Page::create([
            'title' => 'Contact',
            'slug' => 'contact',
            'html' => $contactHtml,
            'css' => '',
            'components' => '[]',
            'styles' => '[]',
            'is_published' => true,
        ]);

        $registerHtml = '
<!-- HERO SECTION -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #0A2540 0%, #003D6C 100%); min-height: 40vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="background: url(\'/images/hero.png\') no-repeat center center / cover; opacity: 0.15; top: 0; left: 0; z-index: 0;"></div>
    <div class="container position-relative z-1 reveal-fade-up">
        <h1 class="display-4 fw-bold mb-3" style="font-family: \'Space Grotesk\', sans-serif;">Registration &amp; Fees</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 650px;">Register for XXV ISCME \'27. Select category and submit paper credentials.</p>
    </div>
</section>

<!-- REGISTRATION FEES & TABLE -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-5">
            <div class="col-lg-6 reveal-fade-right">
                <h3 class="fw-bold text-primary mb-4" style="font-family: \'Space Grotesk\', sans-serif;">Registration Fee Structure</h3>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="text-white" style="background: #003D6C;">
                            <tr>
                                <th>Category</th>
                                <th>Early Bird (Until May 15)</th>
                                <th>Regular (After May 15)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold text-primary">International Authors</td>
                                <td>$350</td>
                                <td>$400</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-primary">National Authors (Bulgaria)</td>
                                <td>150 BGN</td>
                                <td>200 BGN</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-primary">International Listeners</td>
                                <td>$150</td>
                                <td>$180</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-primary">National Listeners (Bulgaria)</td>
                                <td>80 BGN</td>
                                <td>100 BGN</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 rounded-4 mt-4" style="background: #EBF5FF;">
                    <h6 class="fw-bold text-primary mb-2"><i class="bi bi-info-circle-fill me-2"></i>IEEE Disclaimers</h6>
                    <p class="text-primary small mb-0" style="line-height:1.6;">
                        Each registered paper must have at least one registered author by May 20, 2027, to ensure submission for publication in IEEE Xplore.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-6 reveal-fade-left">
                <div class="card border-0 shadow-lg p-5 rounded-4" style="background:#f8f9fa;">
                    <h4 class="fw-bold text-primary mb-3">Pre-Registration Form</h4>
                    <form onsubmit="event.preventDefault(); alert(\'Pre-registration success! We have sent payment instructions to your email.\');">
                        <div class="mb-3">
                            <input type="text" class="form-control py-3" placeholder="Full Name" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control py-3" placeholder="Email Address" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control py-3" placeholder="Affiliated University / Institution" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <select class="form-select py-3" required style="border-radius: 6px;">
                                <option value="" disabled selected>Select Registration Category</option>
                                <option>International Author - $350 (Early Bird)</option>
                                <option>National Author - 150 BGN (Early Bird)</option>
                                <option>International Listener - $150</option>
                                <option>National Listener - 80 BGN</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control py-3" placeholder="Paper ID (Microsoft CMT) - Optional" style="border-radius: 6px;">
                        </div>
                        <button type="submit" class="btn btn-premium w-100 py-3" style="border-radius: 6px; font-weight:600;">Submit Pre-Registration</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
';

        Page::create([
            'title' => 'Register',
            'slug' => 'register',
            'html' => $registerHtml,
            'css' => '',
            'components' => '[]',
            'styles' => '[]',
            'is_published' => true,
        ]);

    }
}
