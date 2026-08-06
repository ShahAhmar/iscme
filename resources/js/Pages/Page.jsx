import React, { useEffect } from 'react';
import { Head, usePage } from '@inertiajs/react';

/* ─────────────────────────────────────────────
   Glassmorphism Footer Component
───────────────────────────────────────────── */
function GlassFooter({ footerData }) {
    if (!footerData) return null;
    const { settings = {}, footerNav = [], sponsors = [] } = footerData;

    const socials = [
        settings.linkedin_url && { icon: 'bi-linkedin',  url: settings.linkedin_url,  label: 'LinkedIn' },
        settings.x_url        && { icon: 'bi-twitter-x', url: settings.x_url,         label: 'X' },
        settings.facebook_url && { icon: 'bi-facebook',  url: settings.facebook_url,  label: 'Facebook' },
        settings.youtube_url  && { icon: 'bi-youtube',   url: settings.youtube_url,   label: 'YouTube' },
    ].filter(Boolean);

    if (!socials.length) {
        socials.push(
            { icon: 'bi-linkedin',  url: '#', label: 'LinkedIn' },
            { icon: 'bi-twitter-x', url: '#', label: 'X' },
            { icon: 'bi-youtube',   url: '#', label: 'YouTube' },
        );
    }

    return (
        <>
            <style>{`
                .igf-wrap {
                    background: linear-gradient(135deg, #001f3d 0%, #003D6C 60%, #00274d 100%);
                    border-top-left-radius: 2.5rem;
                    border-top-right-radius: 2.5rem;
                    overflow: hidden;
                    position: relative;
                    margin-top: 0;
                }
                .igf-orb {
                    position: absolute;
                    border-radius: 50%;
                    pointer-events: none;
                }
                .igf-orb-1 {
                    top: -120px; left: -80px;
                    width: 420px; height: 420px;
                    background: radial-gradient(circle, rgba(91,184,255,0.15) 0%, transparent 70%);
                }
                .igf-orb-2 {
                    bottom: 60px; right: -60px;
                    width: 360px; height: 360px;
                    background: radial-gradient(circle, rgba(228,242,255,0.10) 0%, transparent 70%);
                }
                .igf-inner {
                    position: relative; z-index: 1;
                    padding: 3.5rem 1.5rem 0;
                    max-width: 1260px;
                    margin: 0 auto;
                }
                .igf-glass {
                    background: rgba(228,242,255,0.06);
                    border: 1px solid rgba(228,242,255,0.18);
                    border-radius: 1.5rem;
                    backdrop-filter: blur(20px);
                    -webkit-backdrop-filter: blur(20px);
                    padding: 2.5rem;
                    box-shadow: inset 0 1px 0 rgba(255,255,255,0.07), 0 8px 40px rgba(0,0,0,0.25);
                    margin-bottom: 2.5rem;
                }
                .igf-grid {
                    display: grid;
                    grid-template-columns: 1.4fr 1fr 1fr 1fr;
                    gap: 2rem;
                }
                @media(max-width:991px){ .igf-grid { grid-template-columns: 1fr 1fr; } }
                @media(max-width:575px){ .igf-grid { grid-template-columns: 1fr; gap:1.75rem; }
                    .igf-wrap { border-top-left-radius:1.5rem; border-top-right-radius:1.5rem; } }
                .igf-brand-title {
                    font-family:'Space Grotesk',sans-serif;
                    font-size:1.35rem; font-weight:800; color:#fff;
                    margin:0 0 .25rem; line-height:1.2;
                }
                .igf-brand-sub {
                    font-size:.78rem; color:#E4F2FF; opacity:.75;
                    line-height:1.55; margin-bottom:1.25rem; max-width:240px;
                }
                .igf-logos { display:flex; flex-wrap:wrap; gap:.6rem; align-items:center; margin-bottom:1.25rem; }
                .igf-logo-pill {
                    display:inline-flex; align-items:center;
                    background:rgba(255,255,255,0.95); border-radius:.65rem;
                    padding:.3rem .6rem;
                    transition:transform .2s,box-shadow .2s;
                    text-decoration:none; border:1px solid rgba(228,242,255,0.25);
                }
                .igf-logo-pill:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,.25); }
                .igf-logo-pill img { height:28px; width:auto; object-fit:contain; display:block; }
                .igf-socials { display:flex; flex-wrap:wrap; gap:.4rem; }
                .igf-social {
                    display:inline-flex; align-items:center; justify-content:center;
                    width:36px; height:36px; border-radius:50%;
                    background:rgba(228,242,255,0.12); border:1px solid rgba(228,242,255,0.22);
                    color:#E4F2FF; font-size:.9rem; text-decoration:none;
                    transition:background .2s,transform .2s,box-shadow .2s;
                }
                .igf-social:hover {
                    background:rgba(228,242,255,0.28); color:#fff;
                    transform:translateY(-3px); box-shadow:0 4px 18px rgba(91,184,255,.3);
                }
                .igf-col-title {
                    font-size:.62rem; font-weight:800; text-transform:uppercase;
                    letter-spacing:.18em; color:#5BB8FF; margin:0 0 1rem;
                    display:flex; align-items:center; gap:.5rem;
                }
                .igf-col-title::after {
                    content:''; flex:1; height:1px;
                    background:linear-gradient(90deg,rgba(91,184,255,.45),transparent);
                    border-radius:1px;
                }
                .igf-link {
                    display:block; color:rgba(228,242,255,0.75); text-decoration:none;
                    font-size:.85rem; font-weight:500; padding:.2rem 0;
                    transition:color .18s,padding-left .18s; list-style:none;
                }
                .igf-link:hover { color:#fff; padding-left:.35rem; }
                .igf-info {
                    display:flex; align-items:flex-start; gap:.65rem;
                    margin-bottom:.85rem; color:rgba(228,242,255,0.78);
                    font-size:.85rem; line-height:1.55;
                }
                .igf-info i { color:#5BB8FF; font-size:.95rem; margin-top:2px; flex-shrink:0; }
                .igf-info a { color:rgba(228,242,255,0.85); text-decoration:none; transition:color .18s; }
                .igf-info a:hover { color:#fff; }
                .igf-badge {
                    display:inline-flex; align-items:center; gap:.4rem;
                    background:rgba(91,184,255,0.14); border:1px solid rgba(91,184,255,.3);
                    border-radius:999px; padding:.25rem .75rem;
                    font-size:.72rem; font-weight:700; color:#5BB8FF; margin-top:.75rem;
                }
                .igf-divider { border:none; border-top:1px solid rgba(228,242,255,.10); margin:0; }
                .igf-bottom {
                    display:flex; align-items:center; justify-content:space-between;
                    flex-wrap:wrap; gap:.75rem;
                    padding:1.1rem 2.5rem 1.5rem;
                    font-size:.75rem; color:rgba(228,242,255,.5);
                    max-width:1260px; margin:0 auto;
                }
                .igf-bottom a {
                    color:rgba(228,242,255,.55); text-decoration:none;
                    transition:color .18s; margin-left:1rem;
                }
                .igf-bottom a:hover { color:#fff; }
            `}</style>

            <footer className="igf-wrap">
                <div className="igf-orb igf-orb-1" />
                <div className="igf-orb igf-orb-2" />

                <div className="igf-inner">
                    <div className="igf-glass">
                        <div className="igf-grid">

                            {/* Col 1 — Brand */}
                            <div>
                                <p className="igf-col-title"><i className="bi bi-mortarboard-fill" /> About</p>
                                <h2 className="igf-brand-title">{settings.site_name || 'ISCME 2027'}</h2>
                                <p className="igf-brand-sub">{settings.tagline || 'International Scientific Conference on Management & Engineering'}</p>

                                {sponsors.length > 0 && (
                                    <div className="igf-logos">
                                        {sponsors.map((s, i) => (
                                            <a key={i} href={s.website_url || '#'} target="_blank" rel="noopener" className="igf-logo-pill" title={s.name}>
                                                <img src={s.logo} alt={s.name} />
                                            </a>
                                        ))}
                                    </div>
                                )}

                                <div className="igf-socials">
                                    {socials.map((s, i) => (
                                        <a key={i} href={s.url} target="_blank" rel="noopener" aria-label={s.label} className="igf-social">
                                            <i className={`bi ${s.icon}`} />
                                        </a>
                                    ))}
                                </div>
                            </div>

                            {/* Col 2 — Navigation */}
                            <div>
                                <p className="igf-col-title"><i className="bi bi-grid-3x3-gap-fill" /> Navigation</p>
                                <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
                                    {footerNav.map((item, i) => (
                                        <li key={i} style={{ marginBottom: '.4rem' }}>
                                            <a
                                                href={item.url}
                                                target={item.target === '_blank' ? '_blank' : undefined}
                                                rel={item.target === '_blank' ? 'noopener' : undefined}
                                                className="igf-link"
                                            >
                                                {item.label}
                                            </a>
                                        </li>
                                    ))}
                                </ul>
                            </div>

                            {/* Col 3 — Venue & Dates */}
                            <div>
                                <p className="igf-col-title"><i className="bi bi-calendar3" /> Venue &amp; Dates</p>
                                <div className="igf-info">
                                    <i className="bi bi-calendar-event-fill" />
                                    <span>{settings.venue_dates || '2–4 June, 2027 • Sofia, Bulgaria'}</span>
                                </div>
                                <div className="igf-info">
                                    <i className="bi bi-geo-alt-fill" />
                                    <span>Technical University of Sofia<br />Studentski grad, Sofia, Bulgaria</span>
                                </div>
                                <span className="igf-badge">
                                    <i className="bi bi-award-fill" /> IEEE Xplore Indexed
                                </span>
                            </div>

                            {/* Col 4 — Contact */}
                            <div>
                                <p className="igf-col-title"><i className="bi bi-chat-dots-fill" /> Contact</p>
                                {settings.contact_email && (
                                    <div className="igf-info">
                                        <i className="bi bi-envelope-fill" />
                                        <a href={`mailto:${settings.contact_email}`}>{settings.contact_email}</a>
                                    </div>
                                )}
                                {settings.contact_phone && (
                                    <div className="igf-info">
                                        <i className="bi bi-telephone-fill" />
                                        <span>{settings.contact_phone}</span>
                                    </div>
                                )}
                                {settings.technical_sponsor_name && (
                                    <div className="igf-info" style={{ marginTop: '1rem' }}>
                                        <i className="bi bi-lightning-charge-fill" />
                                        <div>
                                            <span style={{ fontSize: '.7rem', color: '#5BB8FF', fontWeight: 700, display: 'block', textTransform: 'uppercase', letterSpacing: '.1em' }}>Technical Sponsor</span>
                                            <strong style={{ color: 'rgba(228,242,255,0.9)', fontSize: '.88rem' }}>{settings.technical_sponsor_name}</strong>
                                        </div>
                                    </div>
                                )}
                            </div>

                        </div>
                    </div>
                </div>

                <hr className="igf-divider" />
                <div className="igf-bottom">
                    <span>{settings.copyright_text || '© 2027 ISCME. All rights reserved.'}</span>
                    <div>
                        <a href="/privacy">Privacy Policy</a>
                        <a href="/terms">Terms</a>
                        <a href="/cookies">Cookie Policy</a>
                    </div>
                </div>
            </footer>
        </>
    );
}

/* ─────────────────────────────────────────────
   Main Page Component
───────────────────────────────────────────── */
export default function Page({ page, footerData }) {
    useEffect(() => {
        // 1. Custom Scroll Reveal (IntersectionObserver)
        const revealEls = document.querySelectorAll(
            '.reveal-fade-up, .reveal-fade-left, .reveal-fade-right, .reveal-zoom-in'
        );
        const revealObserverOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -60px 0px'
        };

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const delay = entry.target.dataset.revealDelay || 0;
                    setTimeout(() => {
                        entry.target.classList.add('active');
                    }, parseInt(delay));
                    revealObserver.unobserve(entry.target);
                }
            });
        }, revealObserverOptions);

        revealEls.forEach(el => revealObserver.observe(el));

        // 2. Floating Cards Animation
        const floatingCards = document.querySelectorAll('.floating-card');
        floatingCards.forEach((card, i) => {
            card.style.animation = `floatCard ${2.5 + (i % 3) * 0.4}s ease-in-out ${i * 0.15}s infinite alternate`;
        });

        // 3. Typed Text Effect
        const typedEl = document.querySelector('[data-typed]');
        let typeTimeoutId;
        if (typedEl) {
            const words = typedEl.dataset.typed.split(',');
            let wordIndex = 0;
            let charIndex = 0;
            let isDeleting = false;
            let typeDelay = 100;

            const typeEffect = () => {
                const currentWord = words[wordIndex];
                if (isDeleting) {
                    typedEl.textContent = currentWord.substring(0, charIndex - 1);
                    charIndex--;
                    typeDelay = 60;
                } else {
                    typedEl.textContent = currentWord.substring(0, charIndex + 1);
                    charIndex++;
                    typeDelay = 100;
                }

                if (!isDeleting && charIndex === currentWord.length) {
                    isDeleting = true;
                    typeDelay = 1800;
                } else if (isDeleting && charIndex === 0) {
                    isDeleting = false;
                    wordIndex = (wordIndex + 1) % words.length;
                    typeDelay = 400;
                }
                typeTimeoutId = setTimeout(typeEffect, typeDelay);
            };
            typeEffect();
        }

        // 4. Animated Counters
        const counters = document.querySelectorAll('[data-count]');
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.dataset.count);
                    const duration = 2000;
                    const step = target / (duration / 16);
                    let current = 0;
                    const timer = setInterval(() => {
                        current += step;
                        if (current >= target) {
                            entry.target.textContent = target + (entry.target.dataset.suffix || '');
                            clearInterval(timer);
                        } else {
                            entry.target.textContent = Math.floor(current) + (entry.target.dataset.suffix || '');
                        }
                    }, 16);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(c => counterObserver.observe(c));

        // 5. Pre-Registration Form + Security Captcha Handling
        const regForm = document.getElementById('iscme-register-form');
        if (regForm) {
            const loadCaptcha = () => {
                const qEl = document.getElementById('captcha-question-text');
                if (qEl) qEl.textContent = 'Loading...';
                fetch('/api/captcha', { headers: { 'Accept': 'application/json' } })
                    .then(res => res.json())
                    .then(data => {
                        if (qEl && data.question) qEl.textContent = data.question;
                    })
                    .catch(() => {
                        if (qEl) qEl.textContent = '4 + 3 = ?';
                    });
            };

            loadCaptcha();

            const btnRefresh = document.getElementById('btn-refresh-captcha');
            if (btnRefresh) {
                btnRefresh.onclick = (e) => {
                    e.preventDefault();
                    loadCaptcha();
                };
            }

            regForm.onsubmit = (e) => {
                e.preventDefault();
                e.stopPropagation();

                const alertEl = document.getElementById('reg-alert');
                const btnSubmit = document.getElementById('btn-submit-reg');

                if (alertEl) {
                    alertEl.style.display = 'none';
                    alertEl.className = 'alert mb-4 rounded-3';
                }
                if (btnSubmit) {
                    btnSubmit.disabled = true;
                    btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Submitting...';
                }

                const formData = new FormData(regForm);

                fetch('/register/submit', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(async (res) => {
                    const data = await res.json();
                    if (!res.ok) {
                        throw data;
                    }
                    return data;
                })
                .then((data) => {
                    if (alertEl) {
                        alertEl.className = 'alert alert-success mb-4 rounded-3 border-success';
                        alertEl.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> <strong>Registration Successful!</strong> ' + data.message;
                        alertEl.style.display = 'block';
                    }
                    regForm.reset();
                    loadCaptcha();
                })
                .catch((err) => {
                    const msg = err.message || (err.errors ? Object.values(err.errors)[0][0] : 'Failed to submit registration.');
                    if (alertEl) {
                        alertEl.className = 'alert alert-danger mb-4 rounded-3 border-danger';
                        alertEl.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Error:</strong> ' + msg;
                        alertEl.style.display = 'block';
                    }
                    loadCaptcha();
                })
                .finally(() => {
                    if (btnSubmit) {
                        btnSubmit.disabled = false;
                        btnSubmit.innerHTML = '<span>Submit Pre-Registration</span>';
                    }
                });

                return false;
            };
        }

        // Cleanup
        return () => {
            revealObserver.disconnect();
            counterObserver.disconnect();
            if (typeTimeoutId) clearTimeout(typeTimeoutId);
        };
    }, [page]);

    return (
        <>
            <Head title={`${page.title} - ISCME 2027`}>
                {page.css ? <style dangerouslySetInnerHTML={{ __html: page.css }} /> : null}
            </Head>

            {/* GrapesJS Page Content — footer is embedded inside page HTML */}
            <div
                className="gjs-content-wrapper"
                dangerouslySetInnerHTML={{ __html: page.html }}
            />
        </>
    );
}
