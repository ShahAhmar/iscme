import React, { useMemo, useState } from 'react';
import { Head, router, useForm, usePage } from '@inertiajs/react';
import { BookOpen, Edit3, Plus, Save, Search, Trash2, X } from 'lucide-react';
import AdminLayout from '../../../Admin/AdminLayout';

export default function FaqsIndex({ faqs }) {
    const [query, setQuery] = useState('');
    const [editing, setEditing] = useState(null);
    const [isOpen, setIsOpen] = useState(false);
    const user = usePage().props.auth?.user;

    const form = useForm({
        question: '',
        answer: '',
        category: 'General',
        sort_order: 0,
        is_published: true,
    });

    const rows = faqs.data || faqs || [];

    const filtered = useMemo(() => {
        return rows.filter(f =>
            `${f.question} ${f.answer} ${f.category || ''}`.toLowerCase().includes(query.toLowerCase())
        );
    }, [rows, query]);

    const openModal = (faq = null) => {
        setEditing(faq);
        if (faq) {
            form.setData({
                question: faq.question || '',
                answer: faq.answer || '',
                category: faq.category || 'General',
                sort_order: faq.sort_order ?? 0,
                is_published: Boolean(faq.is_published),
            });
        } else {
            form.setData({
                question: '',
                answer: '',
                category: 'General',
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
        const options = {
            onSuccess: () => closeModal(),
            preserveScroll: true,
        };
        if (editing) {
            form.put(`/admin/faqs/${editing.id}`, options);
        } else {
            form.post('/admin/faqs', options);
        }
    };

    const remove = (faq) => {
        if (confirm(`Delete FAQ “${faq.question}”?`)) {
            router.delete(`/admin/faqs/${faq.id}`, { preserveScroll: true });
        }
    };

    return (
        <>
            <Head title="FAQs" />

            <div className="mb-7 flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p className="mb-2 text-xs font-extrabold uppercase tracking-[.15em] text-blue-600">
                        Conference content
                    </p>
                    <h1 className="text-3xl font-black tracking-tight text-slate-900">
                        Frequently Asked Questions
                    </h1>
                    <p className="mt-2 text-sm text-slate-500">
                        Manage attendee inquiries, registration questions, and general guidance.
                    </p>
                </div>
                <button
                    onClick={() => openModal()}
                    className="inline-flex items-center gap-2 rounded-xl bg-[#0d4c86] px-4 py-3 text-sm font-bold text-white shadow-lg shadow-blue-900/15 transition hover:-translate-y-0.5"
                >
                    <Plus size={17} /> Add FAQ
                </button>
            </div>

            <section className="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div className="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-5 py-4">
                    <div>
                        <h2 className="font-extrabold text-slate-800">
                            All FAQs <span className="ml-1 text-sm font-medium text-slate-400">({faqs.total ?? rows.length})</span>
                        </h2>
                    </div>
                    <label className="relative block">
                        <Search className="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" size={16} />
                        <input
                            value={query}
                            onChange={(e) => setQuery(e.target.value)}
                            placeholder="Search FAQs"
                            className="w-64 rounded-xl border border-slate-200 py-2 pl-9 pr-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-50"
                        />
                    </label>
                </div>

                <div className="overflow-x-auto">
                    <table className="min-w-full text-left">
                        <thead className="bg-slate-50 text-[10px] font-extrabold uppercase tracking-[.12em] text-slate-400">
                            <tr>
                                <th className="px-5 py-3">Question</th>
                                <th className="px-5 py-3">Category</th>
                                <th className="px-5 py-3">Visibility</th>
                                <th className="px-5 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-slate-100">
                            {filtered.map((faq) => (
                                <tr key={faq.id} className="hover:bg-blue-50/35">
                                    <td className="px-5 py-4 max-w-md">
                                        <div className="flex items-start gap-3">
                                            <span className="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-blue-50 text-blue-700">
                                                <BookOpen size={16} />
                                            </span>
                                            <div>
                                                <strong className="block text-sm font-bold text-slate-800 mb-1">{faq.question}</strong>
                                                <p className="line-clamp-2 text-xs text-slate-500">{faq.answer}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td className="px-5 py-4 text-sm text-slate-600">
                                        <span className="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                            {faq.category || 'General'}
                                        </span>
                                    </td>
                                    <td className="px-5 py-4">
                                        {faq.is_published ? (
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
                                                onClick={() => openModal(faq)}
                                                className="grid h-9 w-9 place-items-center rounded-lg text-blue-700 hover:bg-blue-50"
                                                title="Edit FAQ"
                                            >
                                                <Edit3 size={17} />
                                            </button>
                                            {['super_admin', 'admin'].includes(user?.role) && (
                                                <button
                                                    onClick={() => remove(faq)}
                                                    className="grid h-9 w-9 place-items-center rounded-lg text-rose-600 hover:bg-rose-50"
                                                    title="Delete FAQ"
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
                                    <td colSpan="4" className="px-5 py-14 text-center text-sm text-slate-400">
                                        No FAQs found.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
            </section>

            {/* Modal for Add / Edit FAQ */}
            {isOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 p-4 backdrop-blur-sm">
                    <div className="w-full max-w-xl rounded-2xl bg-white p-6 shadow-2xl animate-in fade-in zoom-in duration-150">
                        <div className="mb-5 flex items-center justify-between border-b border-slate-100 pb-4">
                            <h3 className="text-lg font-black text-slate-900">
                                {editing ? 'Edit FAQ' : 'Add New FAQ'}
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
                                    Question *
                                </label>
                                <input
                                    type="text"
                                    required
                                    value={form.data.question}
                                    onChange={(e) => form.setData('question', e.target.value)}
                                    placeholder="e.g. How do I submit my paper?"
                                    className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50"
                                />
                                {form.errors.question && <p className="mt-1 text-xs text-rose-600">{form.errors.question}</p>}
                            </div>

                            <div>
                                <label className="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-600">
                                    Answer *
                                </label>
                                <textarea
                                    required
                                    rows="5"
                                    value={form.data.answer}
                                    onChange={(e) => form.setData('answer', e.target.value)}
                                    placeholder="Enter full detailed response..."
                                    className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50"
                                />
                                {form.errors.answer && <p className="mt-1 text-xs text-rose-600">{form.errors.answer}</p>}
                            </div>

                            <div>
                                <label className="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-600">
                                    Category
                                </label>
                                <input
                                    type="text"
                                    value={form.data.category}
                                    onChange={(e) => form.setData('category', e.target.value)}
                                    placeholder="e.g. General, Registration, Submissions"
                                    className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50"
                                />
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

FaqsIndex.layout = (page) => <AdminLayout>{page}</AdminLayout>;
