import React, { useState } from 'react';
import { Link, router, usePage } from '@inertiajs/react';
import { AnimatePresence, motion } from 'framer-motion';
import { BookOpen, CalendarDays, Code2, ExternalLink, FileText, HelpCircle, Image, LayoutDashboard, Menu, MenuSquare, Mic2, Newspaper, PanelTop, Settings, Sparkles, Tags, UserCheck, Users } from 'lucide-react';

const navigation = [
    { label: 'Overview', items: [{ name: 'Dashboard', href: '/admin', icon: LayoutDashboard, match: '/admin' }] },
    { label: 'Website', items: [{ name: 'Pages', href: '/admin/pages', icon: PanelTop, match: '/admin/pages' },{ name: 'Menus', href: '/admin/menus', icon: MenuSquare, match: '/admin/menus' }] },
    { label: 'Submissions', items: [{ name: 'Registrations', href: '/admin/registrations', icon: UserCheck, match: '/admin/registrations' }] },
    { label: 'Publishing', items: [{ name: 'News & Posts', href: '/admin/posts', icon: Newspaper, match: '/admin/posts' }, { name: 'Categories', href: '/admin/categories', icon: Tags, match: '/admin/categories' }] },
    { label: 'Library', items: [{ name: 'Media', href: '/admin/media', icon: Image, match: '/admin/media' }] },
    { label: 'Conference content', items: [
        { name: 'Important Dates', href: '/admin/important-dates', icon: CalendarDays, match: '/admin/important-dates' },
        { name: 'Speakers', href: '/admin/speakers', icon: Mic2, match: '/admin/speakers' },
        { name: 'Sponsors & Partners', href: '/admin/sponsors', icon: Sparkles, match: '/admin/sponsors' },
        { name: 'FAQs', href: '/admin/faqs', icon: BookOpen, match: '/admin/faqs' },
    ] },
    { label: 'Documentation & Guides', items: [
        { name: 'System Docs', href: '/admin/docs', icon: FileText, match: '/admin/docs' },
        { name: 'User Manual', href: '/admin/docs/user-manual', icon: HelpCircle, match: '/admin/docs/user-manual' },
        { name: 'Technical Manual', href: '/admin/docs/technical-manual', icon: Code2, match: '/admin/docs/technical-manual' },
    ] },
    { label: 'System', items: [{ name: 'Users & Roles', href: '/admin/users', icon: Users, match: '/admin/users' }, { name: 'Settings', href: '/admin/settings', icon: Settings, match: '/admin/settings' }] },
];

export default function AdminLayout({ children }) {
    const { url, props } = usePage();
    const [open, setOpen] = useState(false);
    const user = props.auth?.user;
    const initials = user?.name?.slice(0, 1).toUpperCase() || 'A';
    const close = () => setOpen(false);

    const sidebar = (
        <aside className="flex h-full w-[276px] flex-col bg-[#071e3d] px-3.5 py-5 text-white shadow-2xl shadow-slate-900/20">
            <Link href="/admin" onClick={close} className="mb-7 flex items-center gap-3 px-2.5 no-underline">
                <div className="relative flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-white p-1 shadow-md ring-2 ring-sky-400/40">
                    <img src="/logo-iscme.png" alt="ISCME '27" className="h-full w-full object-contain rounded-full" />
                </div>
                <span>
                    <span className="block text-[18px] font-black tracking-tight text-white">ISCME '27</span>
                    <span className="block text-[10px] font-bold tracking-[.14em] text-sky-300">CONTENT STUDIO</span>
                </span>
            </Link>
            <nav className="space-y-4 overflow-y-auto pr-1 custom-scrollbar">
                {navigation.map((group) => (
                    <section key={group.label}>
                        <p className="mb-2 px-3 text-[10px] font-extrabold uppercase tracking-[.15em] text-slate-400">{group.label}</p>
                        <div className="space-y-1">
                            {group.items.map(({ name, href, icon: Icon, match }) => {
                                const active = match === '/admin' ? url === '/admin' : (match === '/admin/docs' ? url === '/admin/docs' : url.startsWith(match));
                                const className = `flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold no-underline transition ${active ? 'bg-gradient-to-r from-blue-500/50 to-blue-500/10 text-white shadow-sm ring-1 ring-inset ring-blue-300/15' : 'hover:bg-white/7 hover:text-white'}`;
                                const reactPage = href.startsWith('/admin');
                                return reactPage
                                    ? <Link key={href} href={href} onClick={close} style={{ color: active ? '#ffffff' : '#c5d7eb' }} className={className}><Icon size={18} strokeWidth={active ? 2.3 : 1.9} />{name}</Link>
                                    : <a key={href} href={href} onClick={close} style={{ color: active ? '#ffffff' : '#c5d7eb' }} className={className}><Icon size={18} strokeWidth={active ? 2.3 : 1.9} />{name}</a>;
                            })}
                        </div>
                    </section>
                ))}
            </nav>
            <div className="mt-auto border-t border-white/10 px-2 pt-4">
                <div className="flex items-center gap-3">
                    <span className="grid h-9 w-9 place-items-center rounded-full bg-sky-600 text-xs font-bold">{initials}</span>
                    <span className="min-w-0 flex-1">
                        <strong className="block truncate text-sm text-white">{user?.name}</strong>
                        <span className="block capitalize text-xs text-slate-400">{user?.role?.replace('_', ' ')}</span>
                    </span>
                    <button onClick={() => router.post('/admin/logout')} className="rounded-lg p-2 text-slate-400 transition hover:bg-white/10 hover:text-white" title="Sign out"><ExternalLink size={16} /></button>
                </div>
            </div>
        </aside>
    );

    return (
        <div className="min-h-screen bg-[#f4f7fb] font-sans text-slate-900">
            <div className="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:block">{sidebar}</div>
            <AnimatePresence>
                {open && (
                    <>
                        <motion.button aria-label="Close navigation" className="fixed inset-0 z-40 bg-slate-950/50 lg:hidden" initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} onClick={close} />
                        <motion.div className="fixed inset-y-0 left-0 z-50 lg:hidden" initial={{ x: -290 }} animate={{ x: 0 }} exit={{ x: -290 }} transition={{ type: 'spring', damping: 28, stiffness: 280 }}>{sidebar}</motion.div>
                    </>
                )}
            </AnimatePresence>
            <div className="lg:pl-[276px]">
                <header className="flex h-[76px] items-center justify-between border-b border-slate-200/80 bg-white/90 px-5 backdrop-blur lg:px-9">
                    <div className="flex items-center gap-3">
                        <button onClick={() => setOpen(true)} className="rounded-xl border border-slate-200 p-2 text-slate-600 lg:hidden"><Menu size={19} /></button>
                        <div>
                            <p className="text-xs font-medium text-slate-400">Conference management workspace</p>
                            <p className="hidden text-xs font-semibold text-slate-600 sm:block">ISCME ’27 · Sofia, Bulgaria</p>
                        </div>
                    </div>
                    <a href="/" target="_blank" className="inline-flex items-center gap-2 rounded-xl border border-blue-100 bg-blue-50 px-3 py-2 text-xs font-bold text-[#0d4c86] no-underline transition hover:bg-blue-100"><ExternalLink size={14} />View website</a>
                </header>
                <main className="mx-auto max-w-[1600px] p-5 sm:p-7 lg:p-9">
                    <AnimatePresence mode="wait">
                        <motion.div key={url} initial={{ opacity: 0, y: 8 }} animate={{ opacity: 1, y: 0 }} exit={{ opacity: 0, y: -8 }} transition={{ duration: .18 }}>{children}</motion.div>
                    </AnimatePresence>
                </main>
            </div>
        </div>
    );
}
