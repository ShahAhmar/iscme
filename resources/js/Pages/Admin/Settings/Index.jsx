import React, { useState } from 'react';
import { Head, usePage, router } from '@inertiajs/react';
import { AlertCircle, CheckCircle2, Globe2, Layout, Layers, Lock, Paintbrush, Plus, Save, Share2, Trash2 } from 'lucide-react';
import AdminLayout from '../../../Admin/AdminLayout';

const timezones = ['Europe/Sofia', 'Asia/Karachi', 'UTC', 'Asia/Kuala_Lumpur', 'Europe/London'];

export default function SettingsIndex({ settings }) {
    const user = usePage().props.auth?.user;
    const flash = usePage().props.flash;

    const [processing, setProcessing] = useState(false);
    const [errors, setErrors] = useState({});

    const [categories, setCategories] = useState(() => {
        try {
            const raw = settings.registration_categories;
            if (typeof raw === 'string') return JSON.parse(raw);
            if (Array.isArray(raw)) return raw;
            return [];
        } catch (e) {
            return [];
        }
    });

    const [formData, setFormData] = useState({
        site_name: settings.site_name || '',
        tagline: settings.tagline || '',
        contact_email: settings.contact_email || '',
        contact_phone: settings.contact_phone || '',
        address: settings.address || '',
        venue_dates: settings.venue_dates || '',
        copyright_text: settings.copyright_text || '',
        technical_sponsor_name: settings.technical_sponsor_name || '',
        primary_color: settings.primary_color || '#003D6C',
        timezone: settings.timezone || 'Europe/Sofia',
        facebook_url: settings.facebook_url || '',
        linkedin_url: settings.linkedin_url || '',
        x_url: settings.x_url || '',
        youtube_url: settings.youtube_url || '',
        registration_status: settings.registration_status || 'enabled',
        registration_closed_message: settings.registration_closed_message || 'Pre-registration is currently closed for XXV ISCME 2027. Please check back later for updates.',
    });

    const set = (key, value) => setFormData(prev => ({ ...prev, [key]: value }));

    const addCategory = () => setCategories([...categories, { name: '', early_bird: '', regular: '' }]);

    const updateCategory = (index, field, value) => {
        const next = [...categories];
        next[index][field] = value;
        setCategories(next);
    };

    const removeCategory = (index) => setCategories(categories.filter((_, i) => i !== index));

    const handleSubmit = (e) => {
        e.preventDefault();
        setProcessing(true);
        setErrors({});

        const payload = {
            ...formData,
            registration_categories: JSON.stringify(categories),
        };

        router.put('/admin/settings', payload, {
            preserveScroll: true,
            onSuccess: () => {
                setProcessing(false);
            },
            onError: (errs) => {
                setErrors(errs);
                setProcessing(false);
            },
            onFinish: () => {
                setProcessing(false);
            },
        });
    };

    const field = (key, label, type = 'text', placeholder = '') => (
        <label className="block">
            <span className="mb-1.5 block text-sm font-bold text-slate-700">{label}</span>
            <input
                type={type}
                value={formData[key] || ''}
                onChange={(e) => set(key, e.target.value)}
                placeholder={placeholder}
                className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-50"
            />
            {errors[key] && <small className="mt-1 block font-semibold text-rose-600">{errors[key]}</small>}
        </label>
    );

    if (!['super_admin', 'admin'].includes(user?.role)) {
        return <div className="rounded-2xl bg-amber-50 p-6 text-amber-800 font-medium">Only administrators can update global settings.</div>;
    }

    const hasErrors = Object.keys(errors).length > 0;

    return (
        <>
            <Head title="Settings" />

            <div className="mb-7">
                <p className="mb-2 text-xs font-extrabold uppercase tracking-[.15em] text-blue-600">System</p>
                <h1 className="text-3xl font-black tracking-tight text-slate-900">Global Settings</h1>
                <p className="mt-2 text-sm text-slate-500">Control header branding, footer info, registration status & categories, contact details and theme colors.</p>
            </div>

            {/* Flash Success */}
            {flash?.success && (
                <div className="mb-5 flex items-center gap-2 rounded-xl bg-emerald-50 px-4 py-3.5 text-sm font-bold text-emerald-800 border border-emerald-200 shadow-sm">
                    <CheckCircle2 size={18} className="text-emerald-600" />
                    {flash.success}
                </div>
            )}

            {/* Error Banner */}
            {hasErrors && (
                <div className="mb-5 flex items-center gap-2 rounded-xl bg-rose-50 px-4 py-3.5 text-sm font-bold text-rose-800 border border-rose-200">
                    <AlertCircle size={18} className="text-rose-600" />
                    Please fix the validation errors below before saving.
                    <ul className="mt-1 list-disc pl-5 text-xs font-normal">
                        {Object.values(errors).map((err, i) => <li key={i}>{err}</li>)}
                    </ul>
                </div>
            )}

            <form onSubmit={handleSubmit} className="grid gap-6 xl:grid-cols-2">
                {/* Site Identity */}
                <section className="space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div className="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <Globe2 size={19} className="text-blue-700" />
                        <h2 className="font-extrabold text-slate-800">Site Identity & Header</h2>
                    </div>
                    <div className="grid gap-4 sm:grid-cols-2">
                        {field('site_name', 'Site Title', 'text', 'ISCME 2027')}
                        {field('contact_email', 'Contact Email', 'text', 'iscme@gaftim.com')}
                    </div>
                    {field('tagline', 'Subheading / Tagline', 'text', 'International Scientific Conference...')}
                    {field('contact_phone', 'Phone Number', 'text', '+359-2-965-3237')}
                </section>

                {/* Footer & Venue */}
                <section className="space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div className="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <Layout size={19} className="text-blue-700" />
                        <h2 className="font-extrabold text-slate-800">Footer Details & Venue</h2>
                    </div>
                    {field('venue_dates', 'Venue & Conference Dates', 'text', '2–4 June, 2027 • Sofia, Bulgaria')}
                    {field('technical_sponsor_name', 'Technical Sponsor Name', 'text', 'IEEE Bulgaria Section')}
                    {field('copyright_text', 'Copyright Notice', 'text', '© 2027 ISCME. All rights reserved.')}
                </section>

                {/* Registration ON/OFF Control */}
                <section className="space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-2">
                    <div className="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <Lock size={19} className="text-blue-700" />
                        <div>
                            <h2 className="font-extrabold text-slate-800">Pre-Registration Status Control</h2>
                            <p className="text-xs text-slate-400">Turn online pre-registration ON or OFF for visitors.</p>
                        </div>
                    </div>
                    <div className="grid gap-6 md:grid-cols-2">
                        <div>
                            <span className="mb-2 block text-sm font-bold text-slate-700">Pre-Registration Status</span>
                            <div className="flex gap-4 pt-1">
                                <label className={`flex flex-1 cursor-pointer items-center justify-center gap-2.5 rounded-xl border p-3.5 transition ${formData.registration_status === 'enabled' ? 'border-emerald-500 bg-emerald-50/70 text-emerald-800 font-bold ring-2 ring-emerald-500/20' : 'border-slate-200 bg-slate-50 text-slate-600'}`}>
                                    <input
                                        type="radio"
                                        name="registration_status"
                                        value="enabled"
                                        checked={formData.registration_status === 'enabled'}
                                        onChange={() => set('registration_status', 'enabled')}
                                        className="h-4 w-4 accent-emerald-600"
                                    />
                                    <span>🟢 Registration OPEN</span>
                                </label>
                                <label className={`flex flex-1 cursor-pointer items-center justify-center gap-2.5 rounded-xl border p-3.5 transition ${formData.registration_status === 'disabled' ? 'border-rose-500 bg-rose-50/70 text-rose-800 font-bold ring-2 ring-rose-500/20' : 'border-slate-200 bg-slate-50 text-slate-600'}`}>
                                    <input
                                        type="radio"
                                        name="registration_status"
                                        value="disabled"
                                        checked={formData.registration_status === 'disabled'}
                                        onChange={() => set('registration_status', 'disabled')}
                                        className="h-4 w-4 accent-rose-600"
                                    />
                                    <span>🔴 Registration CLOSED</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label className="block">
                                <span className="mb-1.5 block text-sm font-bold text-slate-700">Closed Notice Message</span>
                                <textarea
                                    rows="3"
                                    value={formData.registration_closed_message || ''}
                                    onChange={(e) => set('registration_closed_message', e.target.value)}
                                    placeholder="Message shown to users when registration is turned OFF..."
                                    className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-50"
                                />
                            </label>
                        </div>
                    </div>
                </section>

                {/* Registration Fee Categories */}
                <section className="space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-2">
                    <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div className="flex items-center gap-2">
                            <Layers size={19} className="text-blue-700" />
                            <div>
                                <h2 className="font-extrabold text-slate-800">Registration Fee Categories & Pricing</h2>
                                <p className="text-xs text-slate-400">Manage categories in the fee table and registration dropdown.</p>
                            </div>
                        </div>
                        <button type="button" onClick={addCategory} className="inline-flex items-center gap-1.5 rounded-xl bg-blue-50 px-3.5 py-2 text-xs font-bold text-blue-700 hover:bg-blue-100 transition">
                            <Plus size={15} /> Add Category
                        </button>
                    </div>
                    <div className="space-y-3">
                        {categories.map((cat, idx) => (
                            <div key={idx} className="flex flex-wrap items-center gap-3 rounded-xl border border-slate-200/80 bg-slate-50/60 p-3">
                                <div className="flex-1 min-w-[200px]">
                                    <span className="block text-xs font-bold text-slate-500 mb-1">Category Name</span>
                                    <input type="text" value={cat.name || ''} onChange={(e) => updateCategory(idx, 'name', e.target.value)} placeholder="e.g. International Authors" className="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm bg-white outline-none focus:border-blue-500" />
                                </div>
                                <div className="w-36">
                                    <span className="block text-xs font-bold text-slate-500 mb-1">Early Bird Fee</span>
                                    <input type="text" value={cat.early_bird || ''} onChange={(e) => updateCategory(idx, 'early_bird', e.target.value)} placeholder="e.g. $350" className="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm bg-white outline-none focus:border-blue-500" />
                                </div>
                                <div className="w-36">
                                    <span className="block text-xs font-bold text-slate-500 mb-1">Regular Fee</span>
                                    <input type="text" value={cat.regular || ''} onChange={(e) => updateCategory(idx, 'regular', e.target.value)} placeholder="e.g. $400" className="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm bg-white outline-none focus:border-blue-500" />
                                </div>
                                <button type="button" onClick={() => removeCategory(idx)} className="self-end rounded-lg p-2 text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition" title="Delete"><Trash2 size={16} /></button>
                            </div>
                        ))}
                        {categories.length === 0 && <p className="text-sm text-slate-400 italic">No categories yet. Click "Add Category" above.</p>}
                    </div>
                </section>

                {/* Brand Theme */}
                <section className="space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div className="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <Paintbrush size={19} className="text-blue-700" />
                        <h2 className="font-extrabold text-slate-800">Brand Theme</h2>
                    </div>
                    <div className="grid gap-4 sm:grid-cols-2">
                        {field('primary_color', 'Primary Brand Color', 'color')}
                        <label className="block">
                            <span className="mb-1.5 block text-sm font-bold text-slate-700">Timezone</span>
                            <select value={formData.timezone || 'Europe/Sofia'} onChange={(e) => set('timezone', e.target.value)} className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm">
                                {timezones.map((t) => <option key={t} value={t}>{t}</option>)}
                            </select>
                        </label>
                    </div>
                </section>

                {/* Social Links */}
                <section className="space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div className="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <Share2 size={19} className="text-blue-700" />
                        <h2 className="font-extrabold text-slate-800">Social Media Links</h2>
                    </div>
                    <div className="grid gap-4 sm:grid-cols-2">
                        {field('linkedin_url', 'LinkedIn URL', 'text', 'https://linkedin.com/...')}
                        {field('x_url', 'X (Twitter) URL', 'text', 'https://x.com/...')}
                        {field('facebook_url', 'Facebook URL', 'text', 'https://facebook.com/...')}
                        {field('youtube_url', 'YouTube URL', 'text', 'https://youtube.com/...')}
                    </div>
                </section>

                <div className="xl:col-span-2">
                    <button
                        type="submit"
                        disabled={processing}
                        className="inline-flex items-center gap-2 rounded-xl bg-[#0d4c86] px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-900/15 transition hover:bg-blue-900 disabled:opacity-60"
                    >
                        <Save size={17} />
                        {processing ? 'Saving...' : 'Save Global Settings'}
                    </button>
                </div>
            </form>
        </>
    );
}

SettingsIndex.layout = (page) => <AdminLayout>{page}</AdminLayout>;
