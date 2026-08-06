import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { CheckCircle2, ChevronRight, Download, Edit3, Eye, FileText, Filter, HelpCircle, Layers, Lock, Plus, Save, Search, ShieldCheck, Sparkles, UserCheck } from 'lucide-react';
import AdminLayout from '../../../Admin/AdminLayout';

export default function UserManual() {
    return (
        <>
            <Head title="User Manual - ISCME '27" />

            <div className="mb-8 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <div className="mb-1 flex items-center gap-2 text-xs font-black uppercase tracking-[.15em] text-blue-600">
                        <Link href="/admin/docs" className="hover:underline text-blue-600">Docs</Link>
                        <span>/</span>
                        <span>Guide</span>
                    </div>
                    <h1 className="text-3xl font-black tracking-tight text-slate-900">Admin User Manual</h1>
                    <p className="mt-1 text-sm text-slate-500">Comprehensive non-technical guide for conference administrators and content editors.</p>
                </div>

                <div className="flex gap-2">
                    <Link href="/admin/docs/technical-manual" className="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 shadow-sm hover:bg-slate-50 transition no-underline">
                        Technical Manual &rarr;
                    </Link>
                </div>
            </div>

            {/* Quick Table of Contents */}
            <div className="mb-8 rounded-2xl border border-blue-100 bg-blue-50/60 p-5">
                <h3 className="text-xs font-black uppercase tracking-wider text-blue-900 mb-3">Quick Navigation Index</h3>
                <div className="grid gap-2 text-xs font-bold sm:grid-cols-2 md:grid-cols-4">
                    <a href="#section-1" className="flex items-center gap-1.5 text-blue-700 hover:text-blue-900 no-underline"><ChevronRight size={14} /> 1. Managing Pre-Registrations</a>
                    <a href="#section-2" className="flex items-center gap-1.5 text-blue-700 hover:text-blue-900 no-underline"><ChevronRight size={14} /> 2. Exporting CSV Submissions</a>
                    <a href="#section-3" className="flex items-center gap-1.5 text-blue-700 hover:text-blue-900 no-underline"><ChevronRight size={14} /> 3. Fee Categories & Pricing</a>
                    <a href="#section-4" className="flex items-center gap-1.5 text-blue-700 hover:text-blue-900 no-underline"><ChevronRight size={14} /> 4. Registration ON/OFF Control</a>
                </div>
            </div>

            <div className="space-y-8">
                {/* Section 1 */}
                <section id="section-1" className="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <div className="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                        <div className="grid h-10 w-10 place-items-center rounded-xl bg-blue-50 text-blue-700">
                            <UserCheck size={20} />
                        </div>
                        <div>
                            <h2 className="text-xl font-bold text-slate-900">1. Managing Pre-Registrations</h2>
                            <p className="text-xs text-slate-400">View, search, filter, and review visitor submissions.</p>
                        </div>
                    </div>

                    <div className="space-y-4 text-xs leading-relaxed text-slate-600">
                        <p>
                            All registrations submitted via the website's <code className="bg-slate-100 text-blue-700 px-1.5 py-0.5 rounded font-mono font-bold">/register</code> page land immediately under <strong className="text-slate-800">Submissions &rarr; Registrations</strong> in the Admin Panel.
                        </p>

                        <div className="rounded-xl border border-slate-100 bg-slate-50 p-4 space-y-2">
                            <h4 className="font-bold text-slate-800 text-xs">How to Review & Update Status:</h4>
                            <ol className="list-decimal pl-5 space-y-1 text-slate-600">
                                <li>Navigate to <strong className="text-slate-800">Submissions &rarr; Registrations</strong> in the sidebar.</li>
                                <li>Use the top search bar to find attendees by <strong className="text-slate-800">Full Name, Email, or Paper ID (Microsoft CMT)</strong>.</li>
                                <li>Click the <strong className="text-slate-800">Eye (View Details)</strong> button in the action column to open the submission details modal.</li>
                                <li>Update status between <span className="inline-block font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded">Pending</span>, <span className="inline-block font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">Confirmed</span>, <span className="inline-block font-bold text-rose-600 bg-rose-50 px-1.5 py-0.5 rounded">Rejected</span>, or <span className="inline-block font-bold text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">Cancelled</span>.</li>
                            </ol>
                        </div>
                    </div>
                </section>

                {/* Section 2 */}
                <section id="section-2" className="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <div className="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                        <div className="grid h-10 w-10 place-items-center rounded-xl bg-purple-50 text-purple-700">
                            <Download size={20} />
                        </div>
                        <div>
                            <h2 className="text-xl font-bold text-slate-900">2. Exporting CSV Submissions</h2>
                            <p className="text-xs text-slate-400">Download attendee lists for offline processing and CMT validation.</p>
                        </div>
                    </div>

                    <div className="space-y-4 text-xs leading-relaxed text-slate-600">
                        <p>
                            To download a complete report of all registration entries:
                        </p>

                        <div className="rounded-xl border border-slate-100 bg-slate-50 p-4 space-y-2">
                            <ol className="list-decimal pl-5 space-y-1 text-slate-600">
                                <li>Go to <strong className="text-slate-800">Submissions &rarr; Registrations</strong>.</li>
                                <li>Click the top right <strong className="text-purple-700 bg-purple-50 px-2 py-0.5 rounded font-bold">Export CSV</strong> button.</li>
                                <li>The browser will instantly download a spreadsheet containing: <code className="bg-slate-100 text-slate-800 px-1 py-0.5 rounded font-mono">ID, Full Name, Email, Institution, Category, Paper ID, Status, IP Address, Date Created</code>.</li>
                            </ol>
                        </div>
                    </div>
                </section>

                {/* Section 3 */}
                <section id="section-3" className="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <div className="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                        <div className="grid h-10 w-10 place-items-center rounded-xl bg-emerald-50 text-emerald-700">
                            <Layers size={20} />
                        </div>
                        <div>
                            <h2 className="text-xl font-bold text-slate-900">3. Editing Registration Categories & Pricing</h2>
                            <p className="text-xs text-slate-400">Add, edit, or delete fee structures shown on the public site.</p>
                        </div>
                    </div>

                    <div className="space-y-4 text-xs leading-relaxed text-slate-600">
                        <p>
                            Registration categories and pricing rates are dynamically managed directly from the Admin Panel without touching code:
                        </p>

                        <div className="rounded-xl border border-slate-100 bg-slate-50 p-4 space-y-2">
                            <ol className="list-decimal pl-5 space-y-1 text-slate-600">
                                <li>Go to <strong className="text-slate-800">System &rarr; Settings</strong> (<code className="bg-slate-100 text-blue-700 px-1 py-0.5 rounded font-mono">/admin/settings</code>).</li>
                                <li>Scroll to the <strong className="text-slate-800">Registration Fee Categories & Pricing</strong> section.</li>
                                <li>Edit existing Category Names (e.g. <em>International Authors</em>), Early Bird Fee (e.g. <em>$350</em>), and Regular Fee (e.g. <em>$400</em>).</li>
                                <li>Click <strong className="text-blue-700">+ Add Category</strong> to insert a new fee tier, or click the Trash icon to remove one.</li>
                                <li>Click <strong className="text-blue-700 font-bold">Save Global Settings</strong>. The public website Fee Table and Form Dropdown will update automatically!</li>
                            </ol>
                        </div>
                    </div>
                </section>

                {/* Section 4 */}
                <section id="section-4" className="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <div className="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                        <div className="grid h-10 w-10 place-items-center rounded-xl bg-rose-50 text-rose-700">
                            <Lock size={20} />
                        </div>
                        <div>
                            <h2 className="text-xl font-bold text-slate-900">4. Registration Status (OPEN / CLOSED Toggle)</h2>
                            <p className="text-xs text-slate-400">Turn online pre-registration ON or OFF with custom notice.</p>
                        </div>
                    </div>

                    <div className="space-y-4 text-xs leading-relaxed text-slate-600">
                        <p>
                            When registration deadlines pass or registration is temporarily paused, you can close the online form:
                        </p>

                        <div className="rounded-xl border border-slate-100 bg-slate-50 p-4 space-y-2">
                            <ol className="list-decimal pl-5 space-y-1 text-slate-600">
                                <li>Go to <strong className="text-slate-800">System &rarr; Settings</strong>.</li>
                                <li>Look for <strong className="text-slate-800">Pre-Registration Status Control</strong>.</li>
                                <li>Select <span className="font-bold text-rose-700">🔴 Registration CLOSED</span>.</li>
                                <li>Customize the message shown to visitors in the <strong>Closed Notice Message</strong> textarea.</li>
                                <li>Click <strong className="text-blue-700 font-bold">Save Global Settings</strong>. Visitors attempting to access <code className="bg-slate-100 text-blue-700 px-1 py-0.5 rounded font-mono">/register</code> will now see your custom notice instead of the submission form.</li>
                            </ol>
                        </div>
                    </div>
                </section>
            </div>
        </>
    );
}

UserManual.layout = (page) => <AdminLayout>{page}</AdminLayout>;
