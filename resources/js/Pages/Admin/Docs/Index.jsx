import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { BookOpen, CheckCircle2, Code2, Database, Download, FileText, Globe, HelpCircle, Layers, ShieldCheck, Terminal, UserCheck, Zap } from 'lucide-react';
import AdminLayout from '../../../Admin/AdminLayout';

export default function DocsIndex() {
    return (
        <>
            <Head title="System Documentation - ISCME '27" />

            <div className="mb-8">
                <p className="mb-1 text-xs font-black uppercase tracking-[.15em] text-blue-600">Documentation Center</p>
                <h1 className="text-3xl font-black tracking-tight text-slate-900">System Documentation</h1>
                <p className="mt-2 text-sm text-slate-500 max-w-3xl">
                    Welcome to the official documentation hub for XXV ISCME 2027 Conference Management System.
                    Explore system architecture, user workflows, API contracts, database schemas, and deployment instructions.
                </p>
            </div>

            {/* Quick Links Cards */}
            <div className="grid gap-6 md:grid-cols-3 mb-10">
                <Link
                    href="/admin/docs/user-manual"
                    className="group flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:border-blue-300 hover:shadow-md transition no-underline"
                >
                    <div>
                        <div className="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-700 group-hover:bg-blue-600 group-hover:text-white transition">
                            <HelpCircle size={24} />
                        </div>
                        <h3 className="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition">User Manual</h3>
                        <p className="mt-2 text-xs leading-relaxed text-slate-500">
                            Step-by-step non-technical guide for managing registration entries, updating fee structures, editing pages with GrapesJS, and exporting CSV reports.
                        </p>
                    </div>
                    <span className="mt-5 inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 group-hover:translate-x-1 transition">
                        Read User Manual &rarr;
                    </span>
                </Link>

                <Link
                    href="/admin/docs/technical-manual"
                    className="group flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:border-indigo-300 hover:shadow-md transition no-underline"
                >
                    <div>
                        <div className="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-700 group-hover:bg-indigo-600 group-hover:text-white transition">
                            <Code2 size={24} />
                        </div>
                        <h3 className="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition">Technical Manual</h3>
                        <p className="mt-2 text-xs leading-relaxed text-slate-500">
                            Full developer guide covering Laravel 11 + Inertia.js architecture, GrapesJS integration, session math captcha security, and controllers.
                        </p>
                    </div>
                    <span className="mt-5 inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 group-hover:translate-x-1 transition">
                        Read Technical Manual &rarr;
                    </span>
                </Link>

                <div className="flex flex-col justify-between rounded-2xl border border-slate-200 bg-slate-900 p-6 text-white shadow-sm">
                    <div>
                        <div className="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-sky-500/20 text-sky-400">
                            <ShieldCheck size={24} />
                        </div>
                        <h3 className="text-lg font-bold text-white">System Status</h3>
                        <p className="mt-2 text-xs leading-relaxed text-slate-300">
                            Laravel v11.x · Inertia.js v1.x · React 18 · Vite · MySQL · GrapesJS Studio Builder
                        </p>
                    </div>
                    <div className="mt-5 flex items-center gap-2 text-xs font-bold text-emerald-400">
                        <span className="h-2 w-2 rounded-full bg-emerald-400 animate-pulse" />
                        All Core Services Operational
                    </div>
                </div>
            </div>

            {/* Architecture Overview */}
            <div className="space-y-8">
                <section className="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <div className="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                        <Layers className="text-blue-600" size={22} />
                        <h2 className="text-xl font-bold text-slate-900">System Overview & Core Modules</h2>
                    </div>

                    <div className="grid gap-6 md:grid-cols-2">
                        <div className="rounded-xl border border-slate-100 bg-slate-50/70 p-5">
                            <h3 className="font-bold text-slate-800 text-sm flex items-center gap-2 mb-2">
                                <UserCheck size={17} className="text-blue-600" />
                                1. Pre-Registration & Captcha Module
                            </h3>
                            <p className="text-xs text-slate-600 leading-relaxed mb-3">
                                Manages visitor submissions for XXV ISCME 2027. Includes real-time Math Security Captcha generation, AJAX submission without page refresh, and admin status management (Pending, Confirmed, Rejected, Cancelled).
                            </p>
                            <span className="inline-flex items-center gap-1 text-[11px] font-bold text-blue-700 bg-blue-100/70 px-2.5 py-1 rounded-md">
                                Endpoint: /register & /register/submit
                            </span>
                        </div>

                        <div className="rounded-xl border border-slate-100 bg-slate-50/70 p-5">
                            <h3 className="font-bold text-slate-800 text-sm flex items-center gap-2 mb-2">
                                <Globe size={17} className="text-emerald-600" />
                                2. Dynamic GrapesJS Page Engine
                            </h3>
                            <p className="text-xs text-slate-600 leading-relaxed mb-3">
                                Full visual page builder integration allowing administrators to design conference pages, hero banners, speaker lists, and schedules directly from the Admin Panel.
                            </p>
                            <span className="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-100/70 px-2.5 py-1 rounded-md">
                                Controller: FrontendController & PageController
                            </span>
                        </div>

                        <div className="rounded-xl border border-slate-100 bg-slate-50/70 p-5">
                            <h3 className="font-bold text-slate-800 text-sm flex items-center gap-2 mb-2">
                                <Zap size={17} className="text-amber-600" />
                                3. Category & Pricing Settings Sync
                            </h3>
                            <p className="text-xs text-slate-600 leading-relaxed mb-3">
                                Real-time dynamic fee structure manager. Any updates made in Admin Settings immediately sync with both the public website Fee Table and the Pre-Registration category select dropdown.
                            </p>
                            <span className="inline-flex items-center gap-1 text-[11px] font-bold text-amber-700 bg-amber-100/70 px-2.5 py-1 rounded-md">
                                Setting Key: registration_categories
                            </span>
                        </div>

                        <div className="rounded-xl border border-slate-100 bg-slate-50/70 p-5">
                            <h3 className="font-bold text-slate-800 text-sm flex items-center gap-2 mb-2">
                                <Download size={17} className="text-purple-600" />
                                4. Submissions CSV Data Exporter
                            </h3>
                            <p className="text-xs text-slate-600 leading-relaxed mb-3">
                                Export full registration records with complete metadata (Name, Email, Institution, Category, Paper ID, Status, IP, Timestamp) to standard CSV for Microsoft CMT cross-referencing.
                            </p>
                            <span className="inline-flex items-center gap-1 text-[11px] font-bold text-purple-700 bg-purple-100/70 px-2.5 py-1 rounded-md">
                                Route: /admin/registrations/export/csv
                            </span>
                        </div>
                    </div>
                </section>

                {/* Database Schema Summary */}
                <section className="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <div className="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                        <Database className="text-slate-800" size={22} />
                        <h2 className="text-xl font-bold text-slate-900">Database Schema Summary</h2>
                    </div>

                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-xs">
                            <thead className="bg-slate-50 text-slate-700 font-bold uppercase tracking-wider">
                                <tr>
                                    <th className="px-4 py-3 rounded-l-lg">Table Name</th>
                                    <th className="px-4 py-3">Key Fields</th>
                                    <th className="px-4 py-3">Purpose</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-slate-100 text-slate-600">
                                <tr>
                                    <td className="px-4 py-3 font-mono font-bold text-blue-700">registrations</td>
                                    <td className="px-4 py-3">id, full_name, email, institution, category, paper_id, status, ip_address</td>
                                    <td className="px-4 py-3">Stores pre-registration form entries from visitors</td>
                                </tr>
                                <tr>
                                    <td className="px-4 py-3 font-mono font-bold text-blue-700">site_settings</td>
                                    <td className="px-4 py-3">key, value (JSON), group</td>
                                    <td className="px-4 py-3">Stores site name, contact details, registration status, categories JSON</td>
                                </tr>
                                <tr>
                                    <td className="px-4 py-3 font-mono font-bold text-blue-700">pages</td>
                                    <td className="px-4 py-3">title, slug, html, css, is_published</td>
                                    <td className="px-4 py-3">Stores GrapesJS page builder content and stylesheets</td>
                                </tr>
                                <tr>
                                    <td className="px-4 py-3 font-mono font-bold text-blue-700">sponsors</td>
                                    <td className="px-4 py-3">name, logo, website_url, sort_order, is_published</td>
                                    <td className="px-4 py-3">Technical sponsors & partner logos (IEEE, USM, GAFTIM, TU Sofia)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </>
    );
}

DocsIndex.layout = (page) => <AdminLayout>{page}</AdminLayout>;
