import React, { useState } from 'react';
import { Head, router, usePage } from '@inertiajs/react';
import {
    CheckCircle2,
    Clock,
    Download,
    Eye,
    Filter,
    Inbox,
    RefreshCw,
    Search,
    ShieldAlert,
    Trash2,
    UserCheck,
    UserX,
    Users
} from 'lucide-react';
import AdminLayout from '../../../Admin/AdminLayout';

export default function RegistrationsIndex({ registrations, filters, stats }) {
    const [search, setSearch] = useState(filters?.search || '');
    const [statusFilter, setStatusFilter] = useState(filters?.status || '');
    const [categoryFilter, setCategoryFilter] = useState(filters?.category || '');
    const [selectedRegistration, setSelectedRegistration] = useState(null);
    const [updatingId, setUpdatingId] = useState(null);

    const handleFilterSubmit = (e) => {
        e?.preventDefault();
        router.get(
            '/admin/registrations',
            { search, status: statusFilter, category: categoryFilter },
            { preserveState: true, replace: true }
        );
    };

    const handleStatusUpdate = (id, newStatus) => {
        setUpdatingId(id);
        router.put(
            `/admin/registrations/${id}`,
            { status: newStatus },
            {
                preserveScroll: true,
                onFinish: () => {
                    setUpdatingId(null);
                    if (selectedRegistration && selectedRegistration.id === id) {
                        setSelectedRegistration({ ...selectedRegistration, status: newStatus });
                    }
                },
            }
        );
    };

    const handleDelete = (registration) => {
        if (confirm(`Are you sure you want to delete registration for '${registration.full_name}'?`)) {
            router.delete(`/admin/registrations/${registration.id}`, {
                preserveScroll: true,
                onSuccess: () => setSelectedRegistration(null),
            });
        }
    };

    const getStatusBadge = (status) => {
        switch (status) {
            case 'confirmed':
                return <span className="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700 border border-emerald-200"><CheckCircle2 size={13} /> Confirmed</span>;
            case 'rejected':
                return <span className="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-xs font-bold text-rose-700 border border-rose-200"><UserX size={13} /> Rejected</span>;
            case 'cancelled':
                return <span className="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600 border border-slate-200">Cancelled</span>;
            default:
                return <span className="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 border border-amber-200"><Clock size={13} /> Pending</span>;
        }
    };

    return (
        <>
            <Head title="Registrations - Admin" />

            {/* Header */}
            <div className="mb-7 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p className="mb-1 text-xs font-extrabold uppercase tracking-[.15em] text-blue-600">Submissions</p>
                    <h1 className="text-3xl font-black tracking-tight text-slate-900">Conference Registrations</h1>
                    <p className="mt-1 text-sm text-slate-500">Manage pre-registration submissions, paper credentials, and approval status.</p>
                </div>
                <a
                    href="/admin/registrations/export/csv"
                    className="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-white shadow-md transition hover:bg-slate-800"
                >
                    <Download size={15} /> Export CSV
                </a>
            </div>

            {/* Success Flash */}
            {usePage().props.flash?.success && (
                <div className="mb-6 flex items-center gap-2.5 rounded-2xl bg-emerald-50 px-5 py-3.5 text-sm font-bold text-emerald-800 border border-emerald-200/60 shadow-sm">
                    <CheckCircle2 size={18} className="text-emerald-600" />
                    {usePage().props.flash.success}
                </div>
            )}

            {/* Stats Cards */}
            <div className="mb-7 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div className="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                    <div className="flex items-center justify-between">
                        <span className="text-xs font-bold uppercase tracking-wider text-slate-400">Total Entries</span>
                        <div className="grid h-9 w-9 place-items-center rounded-xl bg-blue-50 text-blue-600"><Users size={18} /></div>
                    </div>
                    <p className="mt-3 text-3xl font-black text-slate-900">{stats?.total || 0}</p>
                </div>

                <div className="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                    <div className="flex items-center justify-between">
                        <span className="text-xs font-bold uppercase tracking-wider text-slate-400">Pending Review</span>
                        <div className="grid h-9 w-9 place-items-center rounded-xl bg-amber-50 text-amber-600"><Clock size={18} /></div>
                    </div>
                    <p className="mt-3 text-3xl font-black text-amber-600">{stats?.pending || 0}</p>
                </div>

                <div className="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                    <div className="flex items-center justify-between">
                        <span className="text-xs font-bold uppercase tracking-wider text-slate-400">Confirmed</span>
                        <div className="grid h-9 w-9 place-items-center rounded-xl bg-emerald-50 text-emerald-600"><UserCheck size={18} /></div>
                    </div>
                    <p className="mt-3 text-3xl font-black text-emerald-600">{stats?.confirmed || 0}</p>
                </div>

                <div className="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                    <div className="flex items-center justify-between">
                        <span className="text-xs font-bold uppercase tracking-wider text-slate-400">Rejected</span>
                        <div className="grid h-9 w-9 place-items-center rounded-xl bg-rose-50 text-rose-600"><UserX size={18} /></div>
                    </div>
                    <p className="mt-3 text-3xl font-black text-rose-600">{stats?.rejected || 0}</p>
                </div>
            </div>

            {/* Filter Bar */}
            <form onSubmit={handleFilterSubmit} className="mb-6 flex flex-wrap items-center gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm">
                <div className="relative flex-1 min-w-[220px]">
                    <Search size={17} className="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                    <input
                        type="text"
                        placeholder="Search by name, email, paper ID..."
                        value={search}
                        onChange={(e) => setSearch(e.target.value)}
                        className="w-full rounded-xl border border-slate-200 pl-10 pr-4 py-2 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-50"
                    />
                </div>

                <select
                    value={statusFilter}
                    onChange={(e) => setStatusFilter(e.target.value)}
                    className="rounded-xl border border-slate-200 px-3.5 py-2 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-50"
                >
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="rejected">Rejected</option>
                    <option value="cancelled">Cancelled</option>
                </select>

                <button
                    type="submit"
                    className="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-xs font-bold text-white shadow-sm transition hover:bg-blue-700"
                >
                    <Filter size={14} /> Filter
                </button>
            </form>

            {/* Registrations Table */}
            <div className="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">
                <div className="overflow-x-auto">
                    <table className="w-full text-left text-sm">
                        <thead className="border-b border-slate-100 bg-slate-50/70 text-xs font-extrabold uppercase tracking-wider text-slate-500">
                            <tr>
                                <th className="px-5 py-4">Applicant</th>
                                <th className="px-5 py-4">Category</th>
                                <th className="px-5 py-4">Paper ID</th>
                                <th className="px-5 py-4">Status</th>
                                <th className="px-5 py-4">Date</th>
                                <th className="px-5 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-slate-100">
                            {registrations.data.length === 0 ? (
                                <tr>
                                    <td colSpan="6" className="px-5 py-12 text-center text-slate-400">
                                        <div className="flex flex-col items-center gap-2">
                                            <Inbox size={32} className="text-slate-300" />
                                            <p className="font-semibold text-slate-500">No registrations found.</p>
                                        </div>
                                    </td>
                                </tr>
                            ) : (
                                registrations.data.map((item) => (
                                    <tr key={item.id} className="hover:bg-slate-50/50 transition">
                                        <td className="px-5 py-4">
                                            <div className="font-bold text-slate-900">{item.full_name}</div>
                                            <div className="text-xs text-slate-500">{item.email}</div>
                                            <div className="text-xs text-slate-400">{item.institution}</div>
                                        </td>
                                        <td className="px-5 py-4 font-medium text-slate-700">
                                            <span className="inline-block max-w-[200px] truncate" title={item.category}>
                                                {item.category}
                                            </span>
                                        </td>
                                        <td className="px-5 py-4">
                                            {item.paper_id ? (
                                                <span className="rounded-md bg-blue-50 px-2 py-1 font-mono text-xs font-bold text-blue-700">
                                                    {item.paper_id}
                                                </span>
                                            ) : (
                                                <span className="text-xs text-slate-400">—</span>
                                            )}
                                        </td>
                                        <td className="px-5 py-4">{getStatusBadge(item.status)}</td>
                                        <td className="px-5 py-4 text-xs text-slate-500 whitespace-nowrap">
                                            {new Date(item.created_at).toLocaleDateString(undefined, {
                                                year: 'numeric',
                                                month: 'short',
                                                day: 'numeric',
                                            })}
                                        </td>
                                        <td className="px-5 py-4 text-right">
                                            <div className="inline-flex items-center gap-1.5">
                                                <button
                                                    onClick={() => setSelectedRegistration(item)}
                                                    className="rounded-lg p-2 text-slate-600 hover:bg-slate-100 hover:text-blue-600 transition"
                                                    title="View Details"
                                                >
                                                    <Eye size={16} />
                                                </button>

                                                {item.status !== 'confirmed' && (
                                                    <button
                                                        onClick={() => handleStatusUpdate(item.id, 'confirmed')}
                                                        disabled={updatingId === item.id}
                                                        className="rounded-lg p-2 text-emerald-600 hover:bg-emerald-50 transition"
                                                        title="Mark Confirmed"
                                                    >
                                                        <CheckCircle2 size={16} />
                                                    </button>
                                                )}

                                                <button
                                                    onClick={() => handleDelete(item)}
                                                    className="rounded-lg p-2 text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition"
                                                    title="Delete"
                                                >
                                                    <Trash2 size={16} />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ))
                            )}
                        </tbody>
                    </table>
                </div>
            </div>

            {/* View Modal */}
            {selectedRegistration && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
                    <div className="w-full max-w-lg rounded-3xl bg-white p-6 shadow-2xl space-y-5 animate-in fade-in zoom-in duration-150">
                        <div className="flex items-center justify-between border-b border-slate-100 pb-4">
                            <div>
                                <p className="text-xs font-bold uppercase tracking-wider text-blue-600">Registration Details</p>
                                <h3 className="text-xl font-extrabold text-slate-900">{selectedRegistration.full_name}</h3>
                            </div>
                            <button
                                onClick={() => setSelectedRegistration(null)}
                                className="rounded-full p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700"
                            >
                                ✕
                            </button>
                        </div>

                        <div className="space-y-3 text-sm">
                            <div className="flex justify-between py-1 border-b border-slate-50">
                                <span className="text-slate-500 font-medium">Email Address</span>
                                <a href={`mailto:${selectedRegistration.email}`} className="font-semibold text-blue-600">{selectedRegistration.email}</a>
                            </div>
                            <div className="flex justify-between py-1 border-b border-slate-50">
                                <span className="text-slate-500 font-medium">Institution / University</span>
                                <span className="font-semibold text-slate-800">{selectedRegistration.institution}</span>
                            </div>
                            <div className="flex justify-between py-1 border-b border-slate-50">
                                <span className="text-slate-500 font-medium">Registration Category</span>
                                <span className="font-semibold text-slate-800">{selectedRegistration.category}</span>
                            </div>
                            <div className="flex justify-between py-1 border-b border-slate-50">
                                <span className="text-slate-500 font-medium">Paper ID (CMT)</span>
                                <span className="font-semibold text-slate-800">{selectedRegistration.paper_id || 'Not specified'}</span>
                            </div>
                            <div className="flex justify-between py-1 border-b border-slate-50">
                                <span className="text-slate-500 font-medium">Submitted IP</span>
                                <span className="font-mono text-xs text-slate-600">{selectedRegistration.ip_address || 'N/A'}</span>
                            </div>
                            <div className="flex justify-between py-1 border-b border-slate-50">
                                <span className="text-slate-500 font-medium">Submission Date</span>
                                <span className="text-slate-800">{new Date(selectedRegistration.created_at).toLocaleString()}</span>
                            </div>
                            <div className="flex justify-between items-center py-2">
                                <span className="text-slate-500 font-medium">Current Status</span>
                                <div>{getStatusBadge(selectedRegistration.status)}</div>
                            </div>
                        </div>

                        {/* Status Change Buttons */}
                        <div className="rounded-2xl bg-slate-50 p-4 space-y-2">
                            <p className="text-xs font-bold text-slate-600 uppercase tracking-wider">Change Status</p>
                            <div className="flex flex-wrap gap-2">
                                {['pending', 'confirmed', 'rejected', 'cancelled'].map((st) => (
                                    <button
                                        key={st}
                                        onClick={() => handleStatusUpdate(selectedRegistration.id, st)}
                                        disabled={updatingId === selectedRegistration.id}
                                        className={`rounded-xl px-3 py-1.5 text-xs font-bold capitalize transition ${
                                            selectedRegistration.status === st
                                                ? 'bg-blue-600 text-white shadow-sm'
                                                : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-100'
                                        }`}
                                    >
                                        {st}
                                    </button>
                                ))}
                            </div>
                        </div>

                        <div className="flex justify-end gap-2 pt-2">
                            <button
                                onClick={() => setSelectedRegistration(null)}
                                className="rounded-xl border border-slate-200 px-5 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-50"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </>
    );
}

RegistrationsIndex.layout = (page) => <AdminLayout>{page}</AdminLayout>;
