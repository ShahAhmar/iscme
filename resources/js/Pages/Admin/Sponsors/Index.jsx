import React, { useMemo, useState } from 'react';
import { Head, router, useForm, usePage } from '@inertiajs/react';
import { Edit3, ExternalLink, Image as ImageIcon, Plus, Save, Search, Sparkles, Trash2, X } from 'lucide-react';
import AdminLayout from '../../../Admin/AdminLayout';

export default function SponsorsIndex({ sponsors }) {
    const [query, setQuery] = useState('');
    const [editing, setEditing] = useState(null);
    const [isOpen, setIsOpen] = useState(false);
    const user = usePage().props.auth?.user;

    const form = useForm({
        name: '',
        tier: 'Organising Partner',
        website_url: '',
        logo: null,
        sort_order: 0,
        is_published: true,
    });

    const rows = sponsors.data || sponsors || [];

    const filtered = useMemo(() => {
        return rows.filter(s =>
            `${s.name} ${s.tier || ''}`.toLowerCase().includes(query.toLowerCase())
        );
    }, [rows, query]);

    const openModal = (sponsor = null) => {
        setEditing(sponsor);
        if (sponsor) {
            form.setData({
                name: sponsor.name || '',
                tier: sponsor.tier || '',
                website_url: sponsor.website_url || '',
                logo: null,
                sort_order: sponsor.sort_order ?? 0,
                is_published: Boolean(sponsor.is_published),
            });
        } else {
            form.setData({
                name: '',
                tier: 'Organising Partner',
                website_url: '',
                logo: null,
                sort_order: 0,
                is_published: true,
            });
        }
        form.clearErrors();
        setIsOpen(true);
    };

    const closeModal = () => {
        setIsOpen(false);
        setEditing(null);
        form.reset();
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        
        if (editing) {
            const payload = { ...form.data };
            if (!payload.logo) {
                delete payload.logo;
            }
            router.post(`/admin/sponsors/${editing.id}`, {
                _method: 'PUT',
                ...payload,
            }, {
                onSuccess: () => closeModal(),
                preserveScroll: true,
            });
        } else {
            form.post('/admin/sponsors', {
                onSuccess: () => closeModal(),
                preserveScroll: true,
            });
        }
    };

    const remove = (sponsor) => {
        if (confirm(`Delete “${sponsor.name}”?`)) {
            router.delete(`/admin/sponsors/${sponsor.id}`, { preserveScroll: true });
        }
    };

    return (
        <>
            <Head title="Sponsors & Partners" />

            <div className="mb-7 flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p className="mb-2 text-xs font-extrabold uppercase tracking-[.15em] text-blue-600">
                        Conference content
                    </p>
                    <h1 className="text-3xl font-black tracking-tight text-slate-900">
                        Sponsors & partners
                    </h1>
                    <p className="mt-2 text-sm text-slate-500">
                        Manage conference sponsors, academic partners, and technical supporters.
                    </p>
                </div>
                <button
                    onClick={() => openModal()}
                    className="inline-flex items-center gap-2 rounded-xl bg-[#0d4c86] px-4 py-3 text-sm font-bold text-white shadow-lg shadow-blue-900/15 transition hover:-translate-y-0.5"
                >
                    <Plus size={17} /> Add sponsor
                </button>
            </div>

            <section className="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div className="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-5 py-4">
                    <div>
                        <h2 className="font-extrabold text-slate-800">
                            All sponsors <span className="ml-1 text-sm font-medium text-slate-400">({sponsors.total ?? rows.length})</span>
                        </h2>
                    </div>
                    <label className="relative block">
                        <Search className="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" size={16} />
                        <input
                            value={query}
                            onChange={(e) => setQuery(e.target.value)}
                            placeholder="Search sponsors"
                            className="w-64 rounded-xl border border-slate-200 py-2 pl-9 pr-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-50"
                        />
                    </label>
                </div>

                <div className="overflow-x-auto">
                    <table className="min-w-full text-left">
                        <thead className="bg-slate-50 text-[10px] font-extrabold uppercase tracking-[.12em] text-slate-400">
                            <tr>
                                <th className="px-5 py-3">Sponsor</th>
                                <th className="px-5 py-3">Tier</th>
                                <th className="px-5 py-3">Website</th>
                                <th className="px-5 py-3">Visibility</th>
                                <th className="px-5 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-slate-100">
                            {filtered.map((sponsor) => (
                                <tr key={sponsor.id} className="hover:bg-blue-50/35">
                                    <td className="px-5 py-4">
                                        <div className="flex items-center gap-3">
                                            {sponsor.logo ? (
                                                <img
                                                    src={`/storage/${sponsor.logo}`}
                                                    alt={sponsor.name}
                                                    className="h-10 w-14 rounded-lg border border-slate-200 object-contain p-1 bg-white"
                                                />
                                            ) : (
                                                <span className="grid h-10 w-10 place-items-center rounded-xl bg-amber-50 text-amber-700">
                                                    <Sparkles size={18} />
                                                </span>
                                            )}
                                            <div>
                                                <strong className="block text-sm text-slate-800">{sponsor.name}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td className="px-5 py-4 text-sm text-slate-600">
                                        <span className="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                            {sponsor.tier || 'Partner'}
                                        </span>
                                    </td>
                                    <td className="px-5 py-4 text-sm">
                                        {sponsor.website_url ? (
                                            <a
                                                href={sponsor.website_url}
                                                target="_blank"
                                                rel="noreferrer"
                                                className="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:underline"
                                            >
                                                Visit <ExternalLink size={12} />
                                            </a>
                                        ) : (
                                            <span className="text-slate-400">—</span>
                                        )}
                                    </td>
                                    <td className="px-5 py-4">
                                        {sponsor.is_published ? (
                                            <span className="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                                Published
                                            </span>
                                        ) : (
                                            <span className="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700">
                                                Draft
                                            </span>
                                        )}
                                    </td>
                                    <td className="px-5 py-4">
                                        <div className="flex justify-end gap-1">
                                            <button
                                                onClick={() => openModal(sponsor)}
                                                className="grid h-9 w-9 place-items-center rounded-lg text-blue-700 hover:bg-blue-50"
                                                title="Edit sponsor"
                                            >
                                                <Edit3 size={17} />
                                            </button>
                                            {['super_admin', 'admin'].includes(user?.role) && (
                                                <button
                                                    onClick={() => remove(sponsor)}
                                                    className="grid h-9 w-9 place-items-center rounded-lg text-rose-600 hover:bg-rose-50"
                                                    title="Delete sponsor"
                                                >
                                                    <Trash2 size={17} />
                                                </button>
                                            )}
                                        </div>
                                    </td>
                                </tr>
                            ))}
                            {filtered.length === 0 && (
                                <tr>
                                    <td colSpan="5" className="px-5 py-14 text-center text-sm text-slate-400">
                                        No sponsors found.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
            </section>

            {/* Modal for Add / Edit Sponsor */}
            {isOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 p-4 backdrop-blur-sm">
                    <div className="w-full max-w-lg rounded-2xl bg-white p-6 shadow-2xl animate-in fade-in zoom-in duration-150">
                        <div className="mb-5 flex items-center justify-between border-b border-slate-100 pb-4">
                            <h3 className="text-lg font-black text-slate-900">
                                {editing ? 'Edit Sponsor' : 'Add New Sponsor'}
                            </h3>
                            <button
                                onClick={closeModal}
                                className="rounded-xl p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-700"
                            >
                                <X size={20} />
                            </button>
                        </div>

                        <form onSubmit={handleSubmit} className="space-y-4">
                            <div>
                                <label className="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-600">
                                    Name *
                                </label>
                                <input
                                    type="text"
                                    required
                                    value={form.data.name}
                                    onChange={(e) => form.setData('name', e.target.value)}
                                    placeholder="e.g. Technical University of Sofia"
                                    className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50"
                                />
                                {form.errors.name && <p className="mt-1 text-xs text-rose-600">{form.errors.name}</p>}
                            </div>

                            <div>
                                <label className="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-600">
                                    Tier / Role
                                </label>
                                <input
                                    type="text"
                                    value={form.data.tier}
                                    onChange={(e) => form.setData('tier', e.target.value)}
                                    placeholder="e.g. Organising Partner, Technical Sponsor, Academic Partner"
                                    className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50"
                                />
                                {form.errors.tier && <p className="mt-1 text-xs text-rose-600">{form.errors.tier}</p>}
                            </div>

                            <div>
                                <label className="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-600">
                                    Website URL
                                </label>
                                <input
                                    type="url"
                                    value={form.data.website_url}
                                    onChange={(e) => form.setData('website_url', e.target.value)}
                                    placeholder="https://example.com"
                                    className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50"
                                />
                                {form.errors.website_url && <p className="mt-1 text-xs text-rose-600">{form.errors.website_url}</p>}
                            </div>

                            <div>
                                <label className="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-600">
                                    Logo Image
                                </label>
                                {editing?.logo && (
                                    <div className="mb-2 flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-2">
                                        <img src={`/storage/${editing.logo}`} alt="" className="h-8 w-12 object-contain" />
                                        <span className="text-xs text-slate-500">Current logo</span>
                                    </div>
                                )}
                                <input
                                    type="file"
                                    accept="image/*"
                                    onChange={(e) => form.setData('logo', e.target.files[0])}
                                    className="w-full text-xs text-slate-500 file:mr-3 file:rounded-xl file:border-0 file:bg-blue-50 file:px-3 file:py-2 file:text-xs file:font-bold file:text-blue-700 hover:file:bg-blue-100"
                                />
                                {form.errors.logo && <p className="mt-1 text-xs text-rose-600">{form.errors.logo}</p>}
                            </div>

                            <div className="flex items-center gap-6 pt-2">
                                <label className="flex items-center gap-2 cursor-pointer">
                                    <input
                                        type="checkbox"
                                        checked={form.data.is_published}
                                        onChange={(e) => form.setData('is_published', e.target.checked)}
                                        className="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                    />
                                    <span className="text-sm font-semibold text-slate-700">Published</span>
                                </label>
                            </div>

                            <div className="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                                <button
                                    type="button"
                                    onClick={closeModal}
                                    className="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-50"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    disabled={form.processing}
                                    className="inline-flex items-center gap-2 rounded-xl bg-[#0d4c86] px-5 py-2.5 text-sm font-bold text-white shadow-md hover:bg-blue-900"
                                >
                                    <Save size={16} /> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </>
    );
}

SponsorsIndex.layout = (page) => <AdminLayout>{page}</AdminLayout>;
