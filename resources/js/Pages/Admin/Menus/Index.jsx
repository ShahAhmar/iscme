import React, { useState } from 'react';
import { Head, router, useForm, usePage } from '@inertiajs/react';
import { Edit3, LayoutList, MenuSquare, Plus, Save, Trash2, X } from 'lucide-react';
import AdminLayout from '../../../Admin/AdminLayout';

export default function MenusIndex({ items, currentLocation = 'header' }) {
    const [editing, setEditing] = useState(null);
    const user = usePage().props.auth?.user;

    const form = useForm({
        label: '',
        url: '',
        location: currentLocation,
        target: '_self',
        sort_order: 0,
        is_published: true,
    });

    const switchLocation = (loc) => {
        setEditing(null);
        form.reset();
        router.get('/admin/menus', { location: loc }, { preserveState: true });
    };

    const openForm = (item = null) => {
        setEditing(item);
        if (item) {
            form.setData({
                label: item.label || '',
                url: item.url || '',
                location: item.location || currentLocation,
                target: item.target || '_self',
                sort_order: item.sort_order ?? 0,
                is_published: Boolean(item.is_published),
            });
        } else {
            form.setData({
                label: '',
                url: '',
                location: currentLocation,
                target: '_self',
                sort_order: items.length,
                is_published: true,
            });
        }
        form.clearErrors();
    };

    const submit = (e) => {
        e.preventDefault();
        const options = {
            preserveScroll: true,
            onSuccess: () => {
                setEditing(null);
                form.reset();
            },
        };
        if (editing) {
            form.put(`/admin/menus/${editing.id}`, options);
        } else {
            form.post('/admin/menus', options);
        }
    };

    const remove = (item) => {
        if (confirm(`Delete link “${item.label}”?`)) {
            router.delete(`/admin/menus/${item.id}`, { preserveScroll: true });
        }
    };

    return (
        <>
            <Head title="Navigation Menus" />

            <div className="mb-7 flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p className="mb-2 text-xs font-extrabold uppercase tracking-[.15em] text-blue-600">
                        Website
                    </p>
                    <h1 className="text-3xl font-black tracking-tight text-slate-900">
                        Navigation Menus
                    </h1>
                    <p className="mt-2 text-sm text-slate-500">
                        Manage header and footer navigation links displayed on the public website.
                    </p>
                </div>
            </div>

            {/* Location Tabs */}
            <div className="mb-6 flex gap-2 border-b border-slate-200 pb-3">
                <button
                    onClick={() => switchLocation('header')}
                    className={`flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-bold transition ${
                        currentLocation === 'header'
                            ? 'bg-[#0d4c86] text-white shadow-md'
                            : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'
                    }`}
                >
                    <MenuSquare size={17} /> Header Menu
                </button>
                <button
                    onClick={() => switchLocation('footer')}
                    className={`flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-bold transition ${
                        currentLocation === 'footer'
                            ? 'bg-[#0d4c86] text-white shadow-md'
                            : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'
                    }`}
                >
                    <LayoutList size={17} /> Footer Menu
                </button>
            </div>

            <div className="grid gap-6 lg:grid-cols-[380px_1fr]">
                {/* Form */}
                <form onSubmit={submit} className="h-fit space-y-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h2 className="font-extrabold text-slate-800">
                            {editing ? 'Edit link' : `Add ${currentLocation} link`}
                        </h2>
                        {editing && (
                            <button
                                type="button"
                                onClick={() => {
                                    setEditing(null);
                                    form.reset();
                                }}
                                className="rounded-lg p-1 text-slate-400 hover:bg-slate-100"
                            >
                                <X size={18} />
                            </button>
                        )}
                    </div>

                    <input type="hidden" value={form.data.location} />

                    <label className="block text-sm font-bold text-slate-700">
                        Label *
                        <input
                            type="text"
                            required
                            value={form.data.label}
                            onChange={(e) => form.setData('label', e.target.value)}
                            placeholder="e.g. Speakers, Registration"
                            className="mt-1.5 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm font-normal focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50"
                        />
                        {form.errors.label && <small className="text-rose-600">{form.errors.label}</small>}
                    </label>

                    <label className="block text-sm font-bold text-slate-700">
                        URL *
                        <input
                            type="text"
                            required
                            value={form.data.url}
                            onChange={(e) => form.setData('url', e.target.value)}
                            placeholder="e.g. /speakers or https://example.com"
                            className="mt-1.5 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm font-normal focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50"
                        />
                        {form.errors.url && <small className="text-rose-600">{form.errors.url}</small>}
                    </label>

                    <label className="block text-sm font-bold text-slate-700">
                        Display order
                        <input
                            type="number"
                            value={form.data.sort_order}
                            onChange={(e) => form.setData('sort_order', parseInt(e.target.value) || 0)}
                            className="mt-1.5 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm font-normal focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50"
                        />
                    </label>

                    <label className="block text-sm font-bold text-slate-700">
                        Target window
                        <select
                            value={form.data.target}
                            onChange={(e) => form.setData('target', e.target.value)}
                            className="mt-1.5 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm font-normal focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50"
                        >
                            <option value="_self">Same tab (_self)</option>
                            <option value="_blank">New tab (_blank)</option>
                        </select>
                    </label>

                    <label className="flex items-center gap-2 text-sm font-semibold text-slate-700 pt-1">
                        <input
                            type="checkbox"
                            checked={form.data.is_published}
                            onChange={(e) => form.setData('is_published', e.target.checked)}
                            className="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                        />
                        Visible in menu
                    </label>

                    <button
                        type="submit"
                        disabled={form.processing}
                        className="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0d4c86] py-3 text-sm font-bold text-white shadow-md hover:bg-blue-900"
                    >
                        <Save size={16} /> Save link
                    </button>
                </form>

                {/* Items List */}
                <section className="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div className="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                        <h2 className="font-extrabold text-slate-800">
                            Active {currentLocation === 'header' ? 'Header' : 'Footer'} Links ({items.length})
                        </h2>
                        <MenuSquare size={18} className="text-slate-400" />
                    </div>

                    <div className="divide-y divide-slate-100">
                        {items.map((item) => (
                            <div key={item.id} className="flex items-center gap-4 px-5 py-4 hover:bg-blue-50/35">
                                <span className="grid h-9 w-9 place-items-center rounded-xl bg-blue-50 text-xs font-bold text-blue-700">
                                    {item.sort_order + 1}
                                </span>
                                <div className="min-w-0 flex-1">
                                    <strong className="block text-sm text-slate-800">{item.label}</strong>
                                    <span className="block truncate text-xs text-slate-400">{item.url}</span>
                                </div>
                                <span className={`rounded-full px-2.5 py-1 text-xs font-bold ${item.is_published ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500'}`}>
                                    {item.is_published ? 'Visible' : 'Hidden'}
                                </span>
                                <button
                                    onClick={() => openForm(item)}
                                    className="grid h-9 w-9 place-items-center rounded-lg text-blue-700 hover:bg-blue-50"
                                    title="Edit link"
                                >
                                    <Edit3 size={17} />
                                </button>
                                {['super_admin', 'admin'].includes(user?.role) && (
                                    <button
                                        onClick={() => remove(item)}
                                        className="grid h-9 w-9 place-items-center rounded-lg text-rose-600 hover:bg-rose-50"
                                        title="Delete link"
                                    >
                                        <Trash2 size={17} />
                                    </button>
                                )}
                            </div>
                        ))}
                        {items.length === 0 && (
                            <div className="px-5 py-14 text-center text-sm text-slate-400">
                                No {currentLocation} menu links added yet.
                            </div>
                        )}
                    </div>
                </section>
            </div>
        </>
    );
}

MenusIndex.layout = (page) => <AdminLayout>{page}</AdminLayout>;
