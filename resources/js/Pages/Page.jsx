import React, { useEffect } from 'react';
import { Head } from '@inertiajs/react';

export default function Page({ page }) {
    useEffect(() => {
        // 1. Parallax Video Scroll Effect
        const parallaxVideo = document.querySelector('.parallax-video');
        if (parallaxVideo) {
            parallaxVideo.play().catch(e => console.warn("Video autoplay failed:", e));
        }
        let parallaxTicking = false;
        
        const handleScroll = () => {
            if (!parallaxTicking && parallaxVideo) {
                window.requestAnimationFrame(() => {
                    const scrollY = window.pageYOffset;
                    parallaxVideo.style.transform = `translate3d(0, ${scrollY * 0.3}px, 0)`;
                    parallaxTicking = false;
                });
                parallaxTicking = true;
            }
        };

        if (parallaxVideo) {
            window.addEventListener('scroll', handleScroll, { passive: true });
        }

        // 2. Custom Scroll Reveal (IntersectionObserver)
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

        // 3. Floating Cards Animation
        const floatingCards = document.querySelectorAll('.floating-card');
        floatingCards.forEach((card, i) => {
            card.style.animation = `floatCard ${2.5 + (i % 3) * 0.4}s ease-in-out ${i * 0.15}s infinite alternate`;
        });

        // 4. Typed Text Effect
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

        // 5. Animated Counters
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

        // Cleanup
        return () => {
            window.removeEventListener('scroll', handleScroll);
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
            
            {/* Render GrapesJS Content */}
            <div 
                className="gjs-content-wrapper"
                dangerouslySetInnerHTML={{ __html: page.html }} 
            />
        </>
    );
}
