import React, { useState, useEffect } from 'react';
import { Link, usePage } from '@inertiajs/react';
import { motion, AnimatePresence } from 'framer-motion';
import { Menu, X, ArrowRight, Mail, Calendar, MapPin, Award, ChevronDown, Linkedin, Twitter, Facebook, Youtube } from 'lucide-react';

export default function Layout({ children }) {
    const { url } = usePage();
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [scrolled, setScrolled] = useState(false);

    useEffect(() => {
        const handleScroll = () => setScrolled(window.scrollY > 60);
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    const navLinks = [
        { name: 'Home',       path: '/' },
        { name: 'About',      path: '/about' },
        { name: 'Program',    path: '/program' },
        { name: 'Speakers',   path: '/speakers' },
        { name: 'Sponsors',   path: '/sponsors' },
        { name: 'Exhibition', path: '/exhibition' },
        { name: 'News',       path: '/news' },
        { name: 'Contact',    path: '/contact' },
    ];

    const isActive = (path) =>
        path === '/' ? url === '/' || url === '' : url.startsWith(path);

    return (
        <div className="min-h-screen flex flex-col" style={{
            fontFamily: "'Inter', 'Space Grotesk', sans-serif",
            background: 'linear-gradient(to bottom, #071e3d 0%, #071e3d 130px, #D3DFFC 130px)',
        }}>

            {/* ── Topbar ─────────────────────────────────────── */}
            <div style={{ background: '#071e3d', borderBottom: '1px solid rgba(255,255,255,0.07)' }}>
                <div className="max-w-7xl mx-auto px-6 py-2 flex justify-between items-center">
                    <div className="flex items-center gap-6 text-xs" style={{ color: '#94afc8' }}>
                        <span className="flex items-center gap-1.5">
                            <Calendar size={12} style={{ color: '#4a9de0' }} />
                            June 2–4, 2027
                        </span>
                        <span className="hidden md:flex items-center gap-1.5">
                            <MapPin size={12} style={{ color: '#4a9de0' }} />
                            Sofia, Bulgaria
                        </span>
                        <span className="flex items-center gap-1.5">
                            <Mail size={12} style={{ color: '#4a9de0' }} />
                            iscme@gaftim.com
                        </span>
                    </div>
                    <div className="flex items-center gap-4 text-xs">
                        <span className="flex items-center gap-1.5 px-2.5 py-1 rounded-full"
                            style={{ background: 'rgba(16,185,129,0.12)', color: '#34d399', border: '1px solid rgba(16,185,129,0.2)' }}>
                            <span className="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse inline-block" />
                            Submissions Open
                        </span>
                        <span className="hidden lg:flex items-center gap-1.5" style={{ color: '#94afc8' }}>
                            <Award size={12} style={{ color: '#f59e0b' }} />
                            <span>Technical Sponsor: <strong style={{ color: '#cbd5e1' }}>IEEE Bulgaria Section</strong></span>
                        </span>
                    </div>
                </div>
            </div>

            {/* ── Main Header (Floating rounded card) ────────────────────────────────── */}
            <header
                className={`z-50 transition-all duration-400 ${scrolled ? 'fixed top-0 left-0 right-0 pt-2 px-6' : 'relative px-6'}`}
                style={{
                    marginTop: scrolled ? '0' : '16px',
                    marginBottom: scrolled ? '0' : '8px',
                }}
            >
                <div 
                    className="w-full mx-auto px-4 lg:px-8 2xl:px-14"
                    style={{
                        background: '#FFFFFF',
                        borderRadius: '20px',
                        boxShadow: scrolled ? '0 10px 30px rgba(0, 0, 0, 0.08)' : '0 4px 20px rgba(0, 0, 0, 0.04)',
                        border: '1px solid rgba(0,0,0,0.06)',
                        transition: 'all 0.3s ease',
                    }}
                >
                    <div className="flex items-center justify-between" style={{ height: '88px' }}>

                        {/* 5 Partner Logos + ISCME label */}
                        <Link href="/" className="flex items-center gap-3 group flex-shrink-0" style={{ textDecoration: 'none' }}>
                            <div className="flex items-center gap-2 lg:gap-3">
                                <img src="/logo-iscme.png"  alt="ISCME"  style={{ height: '48px', width: 'auto', objectFit: 'contain' }} />
                                <img src="/logo-gaftim.png" alt="GAFTIM" style={{ height: '48px', width: 'auto', objectFit: 'contain' }} />
                                <img src="/logo-tus.png"    alt="TU Sofia" style={{ height: '48px', width: 'auto', objectFit: 'contain' }} />
                                <img src="/logo-ieee.webp"  alt="IEEE"   style={{ height: '52px', width: 'auto', objectFit: 'contain' }} />
                                <img src="/logo-usm.png"    alt="USM"    style={{ height: '44px', width: 'auto', objectFit: 'contain' }} />
                            </div>

                            {/* Conference label — visible from lg */}
                            <div className="hidden lg:flex flex-col ml-1" style={{ borderLeft: '1.5px solid rgba(0,61,108,0.2)', paddingLeft: '14px' }}>
                                <span className="font-black leading-tight tracking-tight" style={{ color: '#003D6C', fontSize: '1.1rem' }}>ISCME <span style={{ color: '#1565C0' }}>'27</span></span>
                                <span style={{ color: '#7096b2', fontSize: '0.68rem', fontWeight: 600, letterSpacing: '0.12em', textTransform: 'uppercase' }}>Sofia, Bulgaria · June 2027</span>
                            </div>
                        </Link>

                        {/* Desktop Nav */}
                        <nav className="hidden lg:flex items-center gap-0.5">
                            {navLinks.map((link) => (
                                <Link
                                    key={link.path}
                                    href={link.path}
                                    className="relative px-3 py-2 text-[11.5px] font-bold tracking-widest uppercase transition-colors duration-200"
                                    style={{
                                        color: isActive(link.path) ? '#0D3A6E' : '#374151',
                                        textDecoration: 'none',
                                    }}
                                >
                                    {link.name}
                                    {isActive(link.path) && (
                                        <span className="absolute bottom-0 left-1/2 -translate-x-1/2 w-4 h-0.5 rounded-full" style={{ background: '#0D3A6E' }} />
                                    )}
                                </Link>
                            ))}
                        </nav>

                        {/* Register CTA */}
                        <div className="hidden lg:flex items-center gap-3">
                            <Link
                                href="/register"
                                className="flex items-center gap-2 group px-5 py-2.5 text-xs font-bold tracking-widest uppercase text-white transition-all duration-200"
                                style={{
                                    background: '#0D3A6E',
                                    borderRadius: '6px',
                                    letterSpacing: '0.08em',
                                    textDecoration: 'none',
                                }}
                            >
                                REGISTER NOW
                                <ArrowRight size={13} className="transition-transform duration-200 group-hover:translate-x-1" />
                            </Link>
                        </div>

                        {/* Mobile Toggle */}
                        <button
                            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                            className="lg:hidden p-2 rounded-lg transition-colors"
                            style={{ color: '#0D3A6E', background: 'rgba(0,61,108,0.06)' }}
                        >
                            {mobileMenuOpen ? <X size={20} /> : <Menu size={20} />}
                        </button>
                    </div>
                </div>
            </header>

            {/* ── Mobile Drawer ──────────────────────────────── */}
            <AnimatePresence>
                {mobileMenuOpen && (
                    <motion.div
                        initial={{ opacity: 0, y: -8 }}
                        animate={{ opacity: 1, y: 0 }}
                        exit={{ opacity: 0, y: -8 }}
                        transition={{ duration: 0.2 }}
                        className="lg:hidden z-40 border-b"
                        style={{ background: '#E4F2FF', borderColor: 'rgba(0,61,108,0.12)' }}
                    >
                        <div className="max-w-7xl mx-auto px-6 py-5 flex flex-col gap-1">
                            {navLinks.map((link) => (
                                <Link
                                    key={link.path}
                                    href={link.path}
                                    onClick={() => setMobileMenuOpen(false)}
                                    className="py-3 text-sm font-semibold tracking-wider uppercase border-b transition-colors"
                                    style={{
                                        color: isActive(link.path) ? '#003D6C' : '#4a6e8a',
                                        borderColor: 'rgba(0,61,108,0.08)',
                                        textDecoration: 'none',
                                    }}
                                >
                                    {link.name}
                                </Link>
                            ))}
                            <Link
                                href="/register"
                                onClick={() => setMobileMenuOpen(false)}
                                className="mt-4 py-3.5 text-center text-xs font-bold tracking-widest uppercase text-white rounded-lg flex items-center justify-center gap-2"
                                style={{ background: 'linear-gradient(135deg, #003D6C, #0a4a8a)', border: '1px solid rgba(0,61,108,0.2)', textDecoration: 'none' }}
                            >
                                Register Now <ArrowRight size={13} />
                            </Link>
                        </div>
                    </motion.div>
                )}
            </AnimatePresence>

            {/* ── Spacer so content doesn't hide under fixed nav when scrolled ─ */}
            {scrolled && <div style={{ height: '78px' }} />}

            {/* ── Page Content ───────────────────────────────── */}
            <main className="flex-grow">
                <AnimatePresence mode="wait">
                    <motion.div
                        key={url}
                        initial={{ opacity: 0, y: 12 }}
                        animate={{ opacity: 1, y: 0 }}
                        exit={{ opacity: 0, y: -12 }}
                        transition={{ duration: 0.3, ease: [0.16, 1, 0.3, 1] }}
                    >
                        {children}
                    </motion.div>
                </AnimatePresence>
            </main>

            {/* ── CTA Banner ──────────────────────────────────── */}
            <section style={{
                background: 'linear-gradient(135deg, #1a3a8f 0%, #1A73E8 50%, #0ea5e9 100%)',
                margin: '0 24px 0 24px',
                borderRadius: '20px',
                position: 'relative',
                overflow: 'hidden',
            }}>
                {/* Decorative wave */}
                <div style={{ position:'absolute', right:0, top:0, bottom:0, width:'40%', opacity:0.15, backgroundImage:'url("data:image/svg+xml,%3Csvg viewBox=\'0 0 200 200\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath fill=\'%23FFFFFF\' d=\'M44.6,-62.3C56.9,-52.3,64.8,-37.1,68.4,-21.3C72,-5.5,71.3,10.9,65.1,25.1C58.9,39.3,47.1,51.3,33.3,58.7C19.5,66.1,3.6,68.9,-12.3,66.6C-28.3,64.3,-44.3,56.9,-55.5,45C-66.7,33.1,-73.1,16.5,-72.3,0.5C-71.5,-15.6,-63.5,-31.2,-52.4,-41.8C-41.2,-52.5,-27,-58.2,-12.2,-62.4C2.6,-66.6,32.3,-72.2,44.6,-62.3Z\' transform=\'translate(100 100)\'/%3E%3C/svg%3E")' }}></div>
                <div className="max-w-4xl mx-auto px-6 py-16 text-center" style={{ position:'relative', zIndex:1 }}>
                    <h2 className="fw-bold text-white mb-3" style={{ fontFamily:"'Space Grotesk',sans-serif", fontSize:'2rem' }}>Ready to Present Your Research?</h2>
                    <div style={{ display:'flex', alignItems:'center', justifyContent:'center', gap:'12px', margin:'0 0 20px' }}>
                        <div style={{ height:'1px', width:'60px', background:'rgba(255,255,255,0.4)' }}></div>
                        <div style={{ width:'8px', height:'8px', borderRadius:'50%', background:'rgba(255,255,255,0.7)', border:'2px solid white' }}></div>
                        <div style={{ height:'1px', width:'60px', background:'rgba(255,255,255,0.4)' }}></div>
                    </div>
                    <p className="text-white mb-8" style={{ opacity:0.85, maxWidth:'550px', margin:'0 auto 32px', lineHeight:1.7 }}>
                        Submit your paper for ISCME'27 and join researchers from across the globe in Sofia, Bulgaria — June 2–4, 2027. Paper submissions via Microsoft CMT.
                    </p>
                    <div className="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link href="/register" style={{
                            background:'white', color:'#1A73E8', fontWeight:700,
                            padding:'14px 28px', borderRadius:'10px',
                            display:'inline-flex', alignItems:'center', gap:'10px',
                            textDecoration:'none', fontSize:'0.95rem', transition:'all 0.2s'
                        }}>
                            Register Now <ArrowRight size={16} /> <span style={{ display:'inline-flex', alignItems:'center', justifyContent:'center', width:'28px', height:'28px', borderRadius:'50%', background:'#1A73E8', color:'white' }}><ArrowRight size={13} /></span>
                        </Link>
                        <a href="mailto:iscme@gaftim.com" style={{
                            background:'transparent', color:'white', fontWeight:600,
                            padding:'14px 28px', borderRadius:'10px',
                            display:'inline-flex', alignItems:'center', gap:'10px',
                            textDecoration:'none', fontSize:'0.95rem',
                            border:'1.5px solid rgba(255,255,255,0.6)', transition:'all 0.2s'
                        }}>
                            <Mail size={16} /> iscme@gaftim.com
                        </a>
                    </div>
                </div>
            </section>

            {/* ── Footer ─────────────────────────────────────── */}
            <footer style={{ background: '#0d1f38', borderTop: '1px solid rgba(74,157,224,0.08)', margin: '0 24px', borderRadius: '0 0 20px 20px' }}>
                <div className="max-w-7xl mx-auto px-8 py-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                    {/* Col 1 — Logo + About + Social */}
                    <div>
                        <div className="flex items-center gap-2 mb-4 p-3 rounded-xl" style={{ background:'rgba(255,255,255,0.06)', display:'inline-flex' }}>
                            <img src="/logo1.png" alt="ISCME" className="h-8 w-auto object-contain" />
                            <img src="/tus-logo.jpeg" alt="TUS" className="h-8 w-auto object-contain" />
                            <img src="/gaftim-logo.png" alt="GAFTIM" className="h-8 w-auto object-contain" onError={(e)=>e.target.style.display='none'} />
                            <img src="/ieee-logo.png" alt="IEEE" className="h-8 w-auto object-contain" onError={(e)=>e.target.style.display='none'} />
                            <img src="/usm-logo.png" alt="USM" className="h-8 w-auto object-contain" onError={(e)=>e.target.style.display='none'} />
                        </div>
                        <p className="text-sm leading-relaxed mt-4 mb-5" style={{ color: '#7296b5' }}>
                            An international scientific conference on management &amp; engineering, co-organized by TU Sofia, GAFTIM, and USM — technically co-sponsored by IEEE.
                        </p>
                        <div className="flex gap-3">
                            {[{icon: <Linkedin size={15}/>, href:'#'}, {icon:<Twitter size={15}/>, href:'#'}, {icon:<Facebook size={15}/>, href:'#'}, {icon:<Youtube size={15}/>, href:'#'}].map((s, i) => (
                                <a key={i} href={s.href} style={{
                                    width:'36px', height:'36px', borderRadius:'50%',
                                    background:'rgba(255,255,255,0.07)',
                                    border:'1px solid rgba(255,255,255,0.12)',
                                    display:'flex', alignItems:'center', justifyContent:'center',
                                    color:'#7296b5', textDecoration:'none', transition:'all 0.2s'
                                }}>{s.icon}</a>
                            ))}
                        </div>
                    </div>

                    {/* Col 2 — Navigation */}
                    <div>
                        <h4 className="text-xs font-bold tracking-widest uppercase mb-1" style={{ color: '#4a9de0' }}>Navigation</h4>
                        <div style={{ width:'32px', height:'2px', background:'linear-gradient(90deg,#1A73E8,#5BB8FF)', borderRadius:'2px', marginBottom:'18px' }}></div>
                        <div className="grid grid-cols-2 gap-y-3 gap-x-4">
                            {navLinks.map((link) => (
                                <Link key={link.path} href={link.path}
                                    className="text-sm transition-colors flex items-center gap-1.5"
                                    style={{ color: '#7296b5', textDecoration:'none' }}>
                                    <ChevronDown size={12} style={{ transform:'rotate(-90deg)', color:'#4a9de0', flexShrink:0 }} />
                                    {link.name}
                                </Link>
                            ))}
                        </div>
                    </div>

                    {/* Col 3 — Venue & Dates */}
                    <div>
                        <h4 className="text-xs font-bold tracking-widest uppercase mb-1" style={{ color: '#4a9de0' }}>Venue &amp; Dates</h4>
                        <div style={{ width:'32px', height:'2px', background:'linear-gradient(90deg,#1A73E8,#5BB8FF)', borderRadius:'2px', marginBottom:'18px' }}></div>
                        <div className="flex flex-col gap-4 text-sm" style={{ color: '#7296b5' }}>
                            <span className="flex items-start gap-3">
                                <span style={{ width:'34px', height:'34px', borderRadius:'50%', background:'rgba(26,115,232,0.15)', border:'1px solid rgba(26,115,232,0.25)', display:'flex', alignItems:'center', justifyContent:'center', flexShrink:0 }}>
                                    <Calendar size={15} style={{ color: '#4a9de0' }} />
                                </span>
                                <span style={{ paddingTop:'6px' }}>June 2–4, 2027</span>
                            </span>
                            <span className="flex items-start gap-3">
                                <span style={{ width:'34px', height:'34px', borderRadius:'50%', background:'rgba(26,115,232,0.15)', border:'1px solid rgba(26,115,232,0.25)', display:'flex', alignItems:'center', justifyContent:'center', flexShrink:0 }}>
                                    <MapPin size={15} style={{ color: '#4a9de0' }} />
                                </span>
                                <span style={{ paddingTop:'4px' }}>Technical University of Sofia,<br />Studentski grad, Sofia, Bulgaria</span>
                            </span>
                        </div>
                    </div>

                    {/* Col 4 — Contact */}
                    <div>
                        <h4 className="text-xs font-bold tracking-widest uppercase mb-1" style={{ color: '#4a9de0' }}>Contact</h4>
                        <div style={{ width:'32px', height:'2px', background:'linear-gradient(90deg,#1A73E8,#5BB8FF)', borderRadius:'2px', marginBottom:'18px' }}></div>
                        <div className="flex flex-col gap-3 text-sm" style={{ color: '#7296b5' }}>
                            <span className="flex items-center gap-3">
                                <span style={{ width:'34px', height:'34px', borderRadius:'50%', background:'rgba(26,115,232,0.15)', border:'1px solid rgba(26,115,232,0.25)', display:'flex', alignItems:'center', justifyContent:'center', flexShrink:0 }}>
                                    <Mail size={15} style={{ color: '#4a9de0' }} />
                                </span>
                                iscme@gaftim.com
                            </span>
                            <div className="mt-3 pt-4" style={{ borderTop: '1px solid rgba(74,157,224,0.1)' }}>
                                <p className="text-xs mb-1" style={{ color: '#4a6a8a' }}>Technical Sponsor</p>
                                <p className="text-sm font-bold text-white">IEEE Bulgaria Section</p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Bottom bar */}
                <div style={{ borderTop: '1px solid rgba(255,255,255,0.05)' }}>
                    <div className="max-w-7xl mx-auto px-8 py-5 flex flex-col md:flex-row justify-between items-center gap-3 text-xs" style={{ color: '#4a6a8a' }}>
                        <p>&copy; {new Date().getFullYear()} ISCME '27 - International Scientific Conference on Management &amp; Engineering. All rights reserved.</p>
                        <div className="flex items-center gap-3">
                            <a href="#" style={{ color:'#4a6a8a', textDecoration:'none' }}>Privacy</a>
                            <span style={{ color:'rgba(74,106,138,0.4)' }}>|</span>
                            <a href="#" style={{ color:'#4a6a8a', textDecoration:'none' }}>Terms</a>
                            <span style={{ color:'rgba(74,106,138,0.4)' }}>|</span>
                            <a href="#" style={{ color:'#4a6a8a', textDecoration:'none' }}>Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    );
}
