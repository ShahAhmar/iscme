import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { BookOpen, CheckCircle2, Code2, Cpu, Database, FileCode, HardDrive, Key, Layers, Lock, ShieldCheck, Terminal, Zap } from 'lucide-react';
import AdminLayout from '../../../Admin/AdminLayout';

export default function TechnicalManual() {
    const captchaCodeSnippet = `// 1. Generate Math Question (RegistrationController.php)
$num1 = rand(1, 15);
$num2 = rand(1, 15);
Session::put('registration_captcha_answer', $num1 + $num2);
return response()->json(['question' => "What is {$num1} + {$num2} ?"]);

// 2. Validate Submission (submit method)
$expected = Session::get('registration_captcha_answer');
if ((int)$request->captcha_user_answer !== (int)$expected) {
    return response()->json(['message' => 'Incorrect Security Captcha answer.'], 422);
}`;

    return (
        <>
            <Head title="Technical Manual - ISCME '27" />

            <div className="mb-8 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <div className="mb-1 flex items-center gap-2 text-xs font-black uppercase tracking-[.15em] text-indigo-600">
                        <Link href="/admin/docs" className="hover:underline text-indigo-600">Docs</Link>
                        <span>/</span>
                        <span>Developer Blueprint</span>
                    </div>
                    <h1 className="text-3xl font-black tracking-tight text-slate-900">Developer Technical Manual</h1>
                    <p className="mt-1 text-sm text-slate-500">Architecture, code standards, Security Captcha verification, routes, controllers, and deployment blueprints.</p>
                </div>

                <div className="flex gap-2">
                    <Link href="/admin/docs/user-manual" className="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 shadow-sm hover:bg-slate-50 transition no-underline">
                        &larr; User Manual
                    </Link>
                </div>
            </div>

            <div className="space-y-8">
                {/* Tech Stack */}
                <section className="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <div className="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                        <Cpu className="text-indigo-600" size={22} />
                        <h2 className="text-xl font-bold text-slate-900">1. Technology Stack Architecture</h2>
                    </div>

                    <div className="grid gap-4 sm:grid-cols-2 md:grid-cols-4">
                        <div className="rounded-xl border border-slate-100 bg-slate-50 p-4">
                            <span className="text-[10px] font-black uppercase tracking-wider text-slate-400">Backend Framework</span>
                            <h4 className="text-sm font-bold text-slate-900 mt-1">Laravel v11.x</h4>
                            <p className="text-xs text-slate-500 mt-1">PHP 8.2+, Eloquent ORM, Middleware Auth, Session Security</p>
                        </div>
                        <div className="rounded-xl border border-slate-100 bg-slate-50 p-4">
                            <span className="text-[10px] font-black uppercase tracking-wider text-slate-400">Frontend Adapter</span>
                            <h4 className="text-sm font-bold text-slate-900 mt-1">Inertia.js v1.x</h4>
                            <p className="text-xs text-slate-500 mt-1">Monolithic single-page app without building custom REST API wrappers</p>
                        </div>
                        <div className="rounded-xl border border-slate-100 bg-slate-50 p-4">
                            <span className="text-[10px] font-black uppercase tracking-wider text-slate-400">UI Engine</span>
                            <h4 className="text-sm font-bold text-slate-900 mt-1">React 18 + Tailwind</h4>
                            <p className="text-xs text-slate-500 mt-1">Framer Motion, Lucide Icons, Modern Glassmorphism Admin Theme</p>
                        </div>
                        <div className="rounded-xl border border-slate-100 bg-slate-50 p-4">
                            <span className="text-[10px] font-black uppercase tracking-wider text-slate-400">Build System</span>
                            <h4 className="text-sm font-bold text-slate-900 mt-1">Vite 7.x</h4>
                            <p className="text-xs text-slate-500 mt-1">Sass SCSS preprocessing, Rollup chunk minification & asset hashing</p>
                        </div>
                    </div>
                </section>

                {/* Controllers & Core Files */}
                <section className="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <div className="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                        <FileCode className="text-blue-600" size={22} />
                        <h2 className="text-xl font-bold text-slate-900">2. Key Controllers & Source Code Files</h2>
                    </div>

                    <div className="space-y-3 text-xs">
                        <div className="rounded-xl border border-slate-200/80 p-4">
                            <div className="flex items-center justify-between mb-1">
                                <span className="font-mono font-bold text-blue-700">App\Http\Controllers\RegistrationController.php</span>
                                <span className="rounded bg-blue-50 px-2 py-0.5 font-mono text-[10px] text-blue-700">Public Controller</span>
                            </div>
                            <p className="text-slate-600">
                                Handles public captcha generation (<code className="bg-slate-100 text-slate-800 px-1 py-0.5 rounded font-mono">captcha()</code>) and registration form submission validation (<code className="bg-slate-100 text-slate-800 px-1 py-0.5 rounded font-mono">submit()</code>). Validates Session math captcha, saves entry to database, and returns JSON response.
                            </p>
                        </div>

                        <div className="rounded-xl border border-slate-200/80 p-4">
                            <div className="flex items-center justify-between mb-1">
                                <span className="font-mono font-bold text-purple-700">App\Http\Controllers\Admin\RegistrationController.php</span>
                                <span className="rounded bg-purple-50 px-2 py-0.5 font-mono text-[10px] text-purple-700">Admin Controller</span>
                            </div>
                            <p className="text-slate-600">
                                Admin panel controller for viewing, filtering, searching, updating entry statuses (Pending/Confirmed/Rejected/Cancelled), and streaming live CSV exports.
                            </p>
                        </div>

                        <div className="rounded-xl border border-slate-200/80 p-4">
                            <div className="flex items-center justify-between mb-1">
                                <span className="font-mono font-bold text-emerald-700">App\Http\Controllers\Admin\SettingController.php</span>
                                <span className="rounded bg-emerald-50 px-2 py-0.5 font-mono text-[10px] text-emerald-700">Settings Controller</span>
                            </div>
                            <p className="text-slate-600">
                                Manages global settings including site title, contact details, registration status toggle, and registration fee categories JSON payload serialization.
                            </p>
                        </div>

                        <div className="rounded-xl border border-slate-200/80 p-4">
                            <div className="flex items-center justify-between mb-1">
                                <span className="font-mono font-bold text-amber-700">resources/js/Pages/Admin/Settings/Index.jsx</span>
                                <span className="rounded bg-amber-50 px-2 py-0.5 font-mono text-[10px] text-amber-700">React Component</span>
                            </div>
                            <p className="text-slate-600">
                                Uses Inertia <code className="bg-slate-100 text-slate-800 px-1 py-0.5 rounded font-mono">router.put()</code> payload dispatching with dynamic Category management array state.
                            </p>
                        </div>
                    </div>
                </section>

                {/* Captcha Security Architecture */}
                <section className="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <div className="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                        <Lock className="text-emerald-600" size={22} />
                        <h2 className="text-xl font-bold text-slate-900">3. Math Security Captcha Verification Flow</h2>
                    </div>

                    <div className="space-y-3 text-xs leading-relaxed text-slate-600">
                        <pre className="rounded-xl bg-slate-900 p-5 text-sky-300 font-mono text-[11px] overflow-x-auto leading-relaxed">
                            {captchaCodeSnippet}
                        </pre>
                    </div>
                </section>

                {/* Deployment & Commands */}
                <section className="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <div className="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                        <Terminal className="text-slate-800" size={22} />
                        <h2 className="text-xl font-bold text-slate-900">4. Deployment & Build Commands</h2>
                    </div>

                    <div className="space-y-3 text-xs">
                        <div className="rounded-xl border border-slate-100 bg-slate-50 p-4 space-y-2">
                            <h4 className="font-bold text-slate-800">Production Build Steps:</h4>
                            <ol className="list-decimal pl-5 space-y-1 text-slate-600 font-mono text-[11px]">
                                <li>composer install --no-dev --optimize-autoloader</li>
                                <li>npm run build</li>
                                <li>php artisan migrate --force</li>
                                <li>php artisan config:cache &amp;&amp; php artisan route:cache &amp;&amp; php artisan view:cache</li>
                            </ol>
                        </div>
                    </div>
                </section>
            </div>
        </>
    );
}

TechnicalManual.layout = (page) => <AdminLayout>{page}</AdminLayout>;
