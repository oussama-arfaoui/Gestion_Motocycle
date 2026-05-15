@extends('layouts.admin')

@section('page-title')
    {{ __('Website Builder') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('themes.theme') }}">{{ __('Themes') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Website Builder') }}</li>
@endsection

@push('css-page')
<style>
/* ── Google Font ── */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

/* ── Root variables ── */
:root {
    --sidebar-bg: #0f0f1a;
    --sidebar-surface: #1a1a2e;
    --sidebar-border: rgba(255,255,255,.07);
    --sidebar-text: #e2e8f0;
    --sidebar-muted: #8892a4;
    --accent: #7c3aed;
    --accent-glow: rgba(124,58,237,.35);
    --accent2: #06b6d4;
    --accent3: #f59e0b;
    --preview-bg: #e8eaf0;
    --chrome-bg: #2d2d3b;
    --chrome-bar: #23232f;
}

/* ── Main layout ── */
.ws-builder-wrap {
    display: flex;
    height: calc(100vh - 185px);
    min-height: 620px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,.22), 0 0 0 1px rgba(255,255,255,.06);
}

/* ── LEFT DARK PANEL ── */
.ws-left {
    width: 320px;
    min-width: 300px;
    background: var(--sidebar-bg);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
}
.ws-left::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 200px;
    background: radial-gradient(ellipse at top left, rgba(124,58,237,.18) 0%, transparent 70%);
    pointer-events: none;
}

/* Header */
.ws-left-header {
    padding: 20px 18px 14px;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
    border-bottom: 1px solid var(--sidebar-border);
}
.ws-left-header .header-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    background: rgba(124,58,237,.2);
    border: 1px solid rgba(124,58,237,.4);
    border-radius: 20px;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #a78bfa;
    margin-bottom: 8px;
}
.ws-left-header h3 {
    font-size: 1.05rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 2px;
    letter-spacing: -.3px;
}
.ws-left-header p {
    font-size: .72rem;
    color: var(--sidebar-muted);
    margin: 0;
}

/* Sections list */
.ws-sections {
    overflow-y: auto;
    flex: 1;
    padding: 10px 0;
    position: relative;
    z-index: 1;
}
.ws-sections::-webkit-scrollbar { width: 3px; }
.ws-sections::-webkit-scrollbar-track { background: transparent; }
.ws-sections::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }

/* Section toggle */
.ws-section-item { border-bottom: 1px solid var(--sidebar-border); }
.ws-section-toggle {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 11px 18px;
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: .82rem;
    font-weight: 600;
    color: var(--sidebar-text);
    transition: background .15s, color .15s;
    text-align: left;
    gap: 8px;
}
.ws-section-toggle:hover { background: rgba(255,255,255,.05); }
.ws-section-toggle.active {
    background: rgba(124,58,237,.15);
    color: #c4b5fd;
    box-shadow: inset 3px 0 0 #7c3aed;
}
.ws-icon-wrap {
    width: 30px; height: 30px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    font-size: 14px;
    transition: transform .2s;
}
.ws-section-toggle:hover .ws-icon-wrap { transform: scale(1.1); }
.ws-chevron {
    transition: transform .25s cubic-bezier(.4,0,.2,1);
    color: var(--sidebar-muted);
    flex-shrink: 0;
}
.ws-section-toggle.active .ws-chevron { transform: rotate(180deg); color: #a78bfa; }

/* Section body */
.ws-section-body {
    display: none;
    padding: 14px 18px 18px;
    background: rgba(255,255,255,.03);
    border-top: 1px solid var(--sidebar-border);
    animation: slideDown .2s ease;
}
.ws-section-body.show { display: block; }
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
}
.ws-section-body .form-label {
    font-size: .7rem;
    font-weight: 700;
    color: var(--sidebar-muted);
    text-transform: uppercase;
    letter-spacing: .8px;
    margin-bottom: 5px;
    display: block;
}
.ws-section-body .form-control,
.ws-section-body .form-select {
    font-size: .8rem;
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 7px;
    color: #e2e8f0;
    padding: 7px 10px;
    transition: border-color .15s, box-shadow .15s;
}
.ws-section-body .form-control::placeholder { color: rgba(255,255,255,.25); }
.ws-section-body .form-control:focus,
.ws-section-body .form-select:focus {
    background: rgba(255,255,255,.1);
    border-color: #7c3aed;
    box-shadow: 0 0 0 3px rgba(124,58,237,.25);
    color: #fff;
    outline: none;
}
.ws-section-body .form-select option { background: #1e1e2e; color: #e2e8f0; }

/* Toggle row */
.ws-toggle-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 7px 0;
    font-size: .8rem;
    color: var(--sidebar-text);
}
.ws-toggle-row .form-check-input {
    width: 36px; height: 20px;
    cursor: pointer;
    background-color: rgba(255,255,255,.15);
    border-color: rgba(255,255,255,.2);
}
.ws-toggle-row .form-check-input:checked {
    background-color: #7c3aed;
    border-color: #7c3aed;
}

/* Status badge */
.section-enable-badge {
    font-size: .62rem;
    padding: 2px 6px;
    border-radius: 12px;
    font-weight: 700;
    letter-spacing: .3px;
}

/* Left footer */
.ws-left-footer {
    padding: 14px 18px;
    border-top: 1px solid var(--sidebar-border);
    flex-shrink: 0;
    background: rgba(0,0,0,.2);
    position: relative;
    z-index: 1;
}
.ws-btn-save {
    width: 100%;
    padding: 11px 14px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(270deg, #7c3aed, #6d28d9, #5b21b6, #7c3aed);
    background-size: 300% 300%;
    color: #fff;
    font-size: .82rem;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: transform .2s, box-shadow .2s;
    animation: gradient-shift 4s ease infinite, pulse-glow-purple 3s ease-in-out infinite;
    letter-spacing: .4px;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    font-size: .74rem;
}
.ws-btn-save::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(105deg, transparent 40%, rgba(255,255,255,.22) 50%, transparent 60%);
    animation: shimmer-slide 2.8s ease-in-out infinite;
}
.ws-btn-save:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 10px 30px rgba(124,58,237,.7);
}

/* ── TOP BAR ── */
.ws-topbar {
    background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 50%, #16213e 100%);
    padding: 18px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    border-radius: 16px;
    margin-bottom: 16px;
    border: 1px solid rgba(255,255,255,.07);
    box-shadow: 0 8px 32px rgba(0,0,0,.2);
    position: relative;
    overflow: hidden;
}
.ws-topbar::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 180px; height: 180px;
    background: radial-gradient(circle, rgba(124,58,237,.3) 0%, transparent 70%);
    pointer-events: none;
}
.ws-topbar::after {
    content: '';
    position: absolute;
    bottom: -30px; left: 30%;
    width: 120px; height: 120px;
    background: radial-gradient(circle, rgba(6,182,212,.15) 0%, transparent 70%);
    pointer-events: none;
}
.ws-topbar-left h2 {
    font-size: 1.3rem;
    font-weight: 800;
    color: #fff;
    margin: 0 0 3px;
    letter-spacing: -.4px;
}
.ws-topbar-left p {
    font-size: .78rem;
    color: #8892a4;
    margin: 0;
}
.ws-topbar-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}
.ws-autosave {
    font-size: .72rem;
    padding: 5px 12px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: all .3s;
    font-weight: 600;
}
.ws-autosave.saving { background: rgba(245,158,11,.15); color: #f59e0b; border: 1px solid rgba(245,158,11,.3); }
.ws-autosave.saved  { background: rgba(16,185,129,.15); color: #10b981; border: 1px solid rgba(16,185,129,.3); }
.ws-autosave.idle   { background: rgba(255,255,255,.07); color: #8892a4; border: 1px solid rgba(255,255,255,.1); }
.ws-btn-publish {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    background: linear-gradient(270deg, #7c3aed, #06b6d4, #a855f7, #06b6d4, #7c3aed);
    background-size: 400% 400%;
    border: none;
    border-radius: 12px;
    color: #fff;
    font-size: .8rem;
    font-weight: 700;
    cursor: pointer;
    transition: transform .2s, box-shadow .2s;
    animation: gradient-shift 3.5s ease infinite, pulse-glow-cyan 2.8s ease-in-out infinite;
    letter-spacing: .5px;
    text-transform: uppercase;
    position: relative;
    overflow: hidden;
    z-index: 1;
}
.ws-btn-publish::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(105deg, transparent 35%, rgba(255,255,255,.28) 50%, transparent 65%);
    animation: shimmer-slide 2.2s ease-in-out infinite;
}
.ws-btn-publish::after {
    content: '';
    position: absolute;
    inset: -2px;
    border-radius: 14px;
    background: linear-gradient(270deg, #7c3aed, #06b6d4, #a855f7);
    background-size: 400% 400%;
    animation: gradient-shift 3.5s ease infinite;
    z-index: -1;
    filter: blur(8px);
    opacity: .7;
}
.ws-btn-publish:hover {
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 12px 35px rgba(124,58,237,.6);
}

/* ── MODE SELECTOR CARDS ── */
.ws-mode-section {
    margin-bottom: 16px;
}
.ws-mode-section .mode-header {
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #8892a4;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.ws-mode-section .mode-header::after {
    content: '';
    flex: 1;
    height: 1px;
    background: rgba(255,255,255,.08);
}
.ws-mode-cards {
    display: flex;
    gap: 10px;
}
.ws-mode-card {
    flex: 1;
    border: 1.5px solid rgba(255,255,255,.08);
    border-radius: 12px;
    padding: 14px 16px;
    cursor: pointer;
    transition: all .2s;
    background: rgba(255,255,255,.04);
    position: relative;
    overflow: hidden;
}
.ws-mode-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent 60%, rgba(124,58,237,.08));
    opacity: 0;
    transition: opacity .2s;
}
.ws-mode-card:hover { border-color: rgba(124,58,237,.5); transform: translateY(-1px); }
.ws-mode-card:hover::before { opacity: 1; }
.ws-mode-card.selected {
    border-color: #7c3aed;
    background: rgba(124,58,237,.12);
    box-shadow: 0 0 0 3px rgba(124,58,237,.15), inset 0 0 20px rgba(124,58,237,.05);
}
.ws-mode-card.selected::before { opacity: 1; }
.ws-mode-card .mode-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 9px;
    font-size: 18px;
}
.ws-mode-card h5 {
    font-size: .78rem;
    font-weight: 700;
    color: #e2e8f0;
    margin: 0 0 3px;
}
.ws-mode-card p {
    font-size: .68rem;
    color: #8892a4;
    margin: 0;
    line-height: 1.5;
}
.ws-mode-card .mode-check {
    position: absolute;
    top: 10px; right: 10px;
    width: 18px; height: 18px;
    border-radius: 50%;
    background: #7c3aed;
    display: none;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    color: #fff;
    font-weight: 700;
}
.ws-mode-card.selected .mode-check { display: flex; }

/* ── RIGHT PREVIEW PANEL ── */
.ws-right {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: var(--preview-bg);
    overflow: hidden;
}

/* Browser chrome */
.ws-browser-chrome {
    background: var(--chrome-bg);
    flex-shrink: 0;
    padding: 0;
}
.ws-chrome-titlebar {
    display: flex;
    align-items: center;
    padding: 10px 16px;
    gap: 10px;
    background: var(--chrome-bar);
}
.chrome-dots {
    display: flex;
    gap: 5px;
    flex-shrink: 0;
}
.chrome-dot {
    width: 11px; height: 11px;
    border-radius: 50%;
}
.dot-red    { background: #ff5f57; }
.dot-yellow { background: #ffbd2e; }
.dot-green  { background: #28ca41; }
.chrome-url-bar {
    flex: 1;
    background: rgba(255,255,255,.08);
    border-radius: 6px;
    padding: 5px 12px;
    display: flex;
    align-items: center;
    gap: 6px;
    overflow: hidden;
}
.chrome-url-bar .lock-icon { color: #10b981; font-size: 10px; flex-shrink: 0; }
.chrome-url-text {
    font-size: .72rem;
    color: rgba(255,255,255,.6);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    flex: 1;
}
.ws-chrome-toolbar {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    gap: 8px;
    border-top: 1px solid rgba(255,255,255,.05);
}
.ws-device-btns { display: flex; gap: 4px; }
.ws-device-btn {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 5px 13px;
    border: 1px solid rgba(255,255,255,.1);
    background: rgba(255,255,255,.04);
    border-radius: 8px;
    cursor: pointer;
    color: rgba(255,255,255,.45);
    font-size: .73rem;
    font-weight: 600;
    letter-spacing: .3px;
    transition: all .2s cubic-bezier(.4,0,.2,1);
    position: relative;
    overflow: hidden;
}
.ws-device-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(124,58,237,.0), rgba(124,58,237,.18));
    opacity: 0;
    transition: opacity .2s;
}
.ws-device-btn:hover {
    border-color: rgba(124,58,237,.5);
    color: #c4b5fd;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(124,58,237,.25);
}
.ws-device-btn:hover::before { opacity: 1; }
.ws-device-btn.active {
    background: rgba(124,58,237,.18);
    border-color: rgba(124,58,237,.7);
    color: #c4b5fd;
    box-shadow: 0 0 0 3px rgba(124,58,237,.15), 0 4px 14px rgba(124,58,237,.3);
    font-weight: 700;
}
.ws-device-btn.active::before { opacity: 1; }
.ws-chrome-actions {
    margin-left: auto;
    display: flex;
    gap: 5px;
}
.ws-chrome-action-btn {
    width: 30px; height: 30px;
    display: flex; align-items: center; justify-content: center;
    border: 1px solid rgba(255,255,255,.1);
    background: rgba(255,255,255,.05);
    border-radius: 8px;
    cursor: pointer;
    color: rgba(255,255,255,.5);
    font-size: 12px;
    transition: all .2s cubic-bezier(.4,0,.2,1);
    text-decoration: none;
    position: relative;
    overflow: hidden;
}
.ws-chrome-action-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at center, rgba(124,58,237,.35), transparent 70%);
    opacity: 0;
    transition: opacity .2s;
}
.ws-chrome-action-btn:hover {
    background: rgba(124,58,237,.2);
    border-color: rgba(124,58,237,.5);
    color: #c4b5fd;
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(124,58,237,.3);
}
.ws-chrome-action-btn:hover::before { opacity: 1; }

/* Preview frame */
.ws-preview-frame {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    overflow: hidden;
    background: radial-gradient(ellipse at center, #dde2f0 0%, #c8cfe0 100%);
    transition: all .3s;
}
.ws-preview-frame iframe {
    background: #fff;
    border: none;
    border-radius: 6px;
    box-shadow:
        0 2px 4px rgba(0,0,0,.06),
        0 10px 40px rgba(0,0,0,.15),
        0 0 0 1px rgba(0,0,0,.06);
    transition: all .35s cubic-bezier(.4,0,.2,1);
}

/* ── INTEGRATE SECTION (below editor wrap) ── */
.ws-integrate-card {
    background: linear-gradient(135deg, #0f0f1a, #1a1a2e);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px;
    padding: 24px 28px;
    margin-top: 16px;
}
.ws-integrate-card h5 {
    font-size: .95rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 6px;
}
.ws-integrate-card p {
    font-size: .8rem;
    color: #8892a4;
    margin: 0 0 18px;
}
.ws-code-block {
    background: #090909;
    border: 1px solid rgba(255,255,255,.07);
    color: #7ee787;
    border-radius: 10px;
    padding: 16px 18px;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    font-size: .78rem;
    line-height: 1.8;
    position: relative;
    overflow-x: auto;
    white-space: pre;
}
.ws-code-block::before {
    content: 'HTML';
    position: absolute;
    top: 10px; left: 14px;
    font-size: .6rem;
    font-weight: 700;
    letter-spacing: 1px;
    color: #7c3aed;
    background: rgba(124,58,237,.15);
    padding: 2px 7px;
    border-radius: 4px;
    line-height: 1.4;
}
.ws-code-block code {
    display: block;
    margin-top: 22px;
}
.ws-copy-btn {
    position: absolute;
    top: 10px; right: 10px;
    padding: 5px 14px;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .5px;
    text-transform: uppercase;
    border-radius: 8px;
    background: rgba(6,182,212,.12);
    border: 1px solid rgba(6,182,212,.3);
    color: #67e8f9;
    cursor: pointer;
    transition: all .2s cubic-bezier(.4,0,.2,1);
    display: inline-flex;
    align-items: center;
    gap: 5px;
    overflow: hidden;
    position: absolute;
}
.ws-copy-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(105deg, transparent 40%, rgba(6,182,212,.18) 50%, transparent 60%);
    animation: shimmer-slide 2.5s ease-in-out infinite;
}
.ws-copy-btn:hover {
    background: rgba(6,182,212,.22);
    border-color: #06b6d4;
    color: #fff;
    box-shadow: 0 0 18px rgba(6,182,212,.4), 0 4px 10px rgba(6,182,212,.2);
    transform: translateY(-1px);
}
.ws-store-link-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 18px;
    background: rgba(16,185,129,.08);
    border: 1.5px solid rgba(16,185,129,.3);
    border-radius: 12px;
    font-size: .78rem;
    color: #34d399;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s cubic-bezier(.4,0,.2,1);
    animation: border-glow 2.5s ease-in-out infinite;
    position: relative;
    overflow: hidden;
    letter-spacing: .2px;
}
.ws-store-link-pill::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(105deg, transparent 38%, rgba(16,185,129,.12) 50%, transparent 62%);
    animation: shimmer-slide 3s ease-in-out infinite;
}
.ws-store-link-pill:hover {
    background: rgba(16,185,129,.16);
    border-color: #10b981;
    color: #fff;
    box-shadow: 0 0 20px rgba(16,185,129,.35), 0 6px 16px rgba(16,185,129,.2);
    transform: translateY(-2px);
}

/* ── Form control color override ── */
.ws-section-body input[type="color"] {
    width: 36px; height: 32px;
    padding: 2px 3px;
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 6px;
    cursor: pointer;
}
</style>
@endpush

@section('content')
@php
    $menu     = $settings['menu']     ?? [];
    $hero     = $settings['hero']     ?? [];
    $brands_s = $settings['brands']   ?? [];
    $gamme    = $settings['gamme']    ?? [];
    $featured = $settings['featured'] ?? [];
    $video    = $settings['video']    ?? [];
    $cta      = $settings['cta']      ?? [];
    $footer   = $settings['footer']   ?? [];
    $social   = $footer['social']     ?? [];
    $curMode  = $settings['mode']     ?? 'integrate';
@endphp

{{-- ── TOP BAR ── --}}
<div class="ws-topbar">
    <div class="ws-topbar-left" style="position:relative;z-index:1;">
        <h2>
            <span style="background:linear-gradient(90deg,#c4b5fd,#67e8f9);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                ✦ Website Builder
            </span>
        </h2>
        <p>{{ __('Customize your storefront visually — changes save automatically.') }}</p>
    </div>
    <div class="ws-topbar-actions" style="position:relative;z-index:1;">
        <span class="ws-autosave idle" id="autosave-status">
            <svg width="8" height="8" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4" fill="currentColor"/></svg>
            <span id="autosave-text">{{ __('All changes saved') }}</span>
        </span>
        <button type="button" id="btn-publish" class="ws-btn-publish">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/></svg>
            {{ __('Publish') }}
        </button>
    </div>
</div>

{{-- ── MAIN EDITOR WRAP ── --}}
<div class="ws-builder-wrap">

    {{-- ────────── LEFT DARK PANEL ────────── --}}
    <div class="ws-left">

        {{-- Header --}}
        <div class="ws-left-header">
            <div class="header-badge">
                <svg width="9" height="9" viewBox="0 0 9 9"><circle cx="4.5" cy="4.5" r="4.5" fill="#a78bfa"/></svg>
                Visual Editor
            </div>
            <h3>{{ __('Sections') }}</h3>
            <p>{{ __('Click a section to expand its settings') }}</p>
        </div>

        {{-- Mode selector --}}
        <div style="padding:14px 18px 10px;border-bottom:1px solid rgba(255,255,255,.07);position:relative;z-index:1;">
            <div class="ws-mode-section">
                <div class="mode-header">{{ __('Mode') }}</div>
                <div class="ws-mode-cards">
                    <label class="ws-mode-card {{ $curMode === 'integrate' ? 'selected' : '' }}" id="card-integrate" for="mode-integrate">
                        <div class="mode-check">✓</div>
                        <div class="mode-icon" style="background:rgba(124,58,237,.2);">🔗</div>
                        <input type="radio" name="ws_mode" id="mode-integrate" value="integrate" class="d-none"
                            {{ $curMode === 'integrate' ? 'checked' : '' }}>
                        <h5>{{ __('Integrate') }}</h5>
                        <p>{{ __('Embed into existing site') }}</p>
                    </label>
                    <label class="ws-mode-card {{ $curMode === 'build' ? 'selected' : '' }}" id="card-build" for="mode-build">
                        <div class="mode-check">✓</div>
                        <div class="mode-icon" style="background:rgba(245,158,11,.15);">🏗️</div>
                        <input type="radio" name="ws_mode" id="mode-build" value="build" class="d-none"
                            {{ $curMode === 'build' ? 'checked' : '' }}>
                        <h5>{{ __('Build') }}</h5>
                        <p>{{ __('Design visually') }}</p>
                    </label>
                </div>
            </div>
        </div>

        {{-- Sections accordion --}}
        <div class="ws-sections" id="ws-sections">

            {{-- 1. MENU --}}
            <div class="ws-section-item">
                <button class="ws-section-toggle" onclick="toggleSection('menu')">
                    <div class="d-flex align-items-center gap-2">
                        <span class="ws-icon-wrap" style="background:linear-gradient(135deg,#3730a3,#6d28d9);">🧭</span>
                        <span>{{ __('Menu & Header') }}</span>
                    </div>
                    <svg class="ws-chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="ws-section-body" id="section-menu">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Background Color') }}</label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="color" class="ws-input" name="menu[bg_color]" value="{{ $menu['bg_color'] ?? '#ffffff' }}">
                            <input type="text" class="form-control ws-input" name="menu[bg_color_text]" value="{{ $menu['bg_color'] ?? '#ffffff' }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Text Color') }}</label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="color" class="ws-input" name="menu[text_color]" value="{{ $menu['text_color'] ?? '#333333' }}">
                            <input type="text" class="form-control ws-input" name="menu[text_color_text]" value="{{ $menu['text_color'] ?? '#333333' }}">
                        </div>
                    </div>
                    <div class="ws-toggle-row">
                        <span>{{ __('Sticky Header') }}</span>
                        <input type="checkbox" class="form-check-input ws-input" name="menu[sticky]" value="1" {{ !empty($menu['sticky']) ? 'checked' : '' }}>
                    </div>
                </div>
            </div>

            {{-- 2. HERO --}}
            <div class="ws-section-item">
                <button class="ws-section-toggle" onclick="toggleSection('hero')">
                    <div class="d-flex align-items-center gap-2">
                        <span class="ws-icon-wrap" style="background:linear-gradient(135deg,#be185d,#e11d48);">🎯</span>
                        <span>{{ __('Hero Section') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="section-enable-badge {{ !empty($hero['enabled']) ? 'bg-success' : 'bg-secondary' }} text-white">
                            {{ !empty($hero['enabled']) ? 'ON' : 'OFF' }}
                        </span>
                        <svg class="ws-chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                </button>
                <div class="ws-section-body" id="section-hero">
                    <div class="ws-toggle-row mb-3">
                        <span style="font-weight:600;">{{ __('Enable Hero') }}</span>
                        <input type="checkbox" class="form-check-input ws-input" name="hero[enabled]" value="1" {{ !empty($hero['enabled']) ? 'checked' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Title') }}</label>
                        <input type="text" class="form-control ws-input" name="hero[title]" value="{{ $hero['title'] ?? '' }}" placeholder="{{ __('Welcome to Our Store') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Subtitle') }}</label>
                        <input type="text" class="form-control ws-input" name="hero[subtitle]" value="{{ $hero['subtitle'] ?? '' }}" placeholder="{{ __('Discover our collection') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('CTA Button Text') }}</label>
                        <input type="text" class="form-control ws-input" name="hero[cta_text]" value="{{ $hero['cta_text'] ?? '' }}" placeholder="{{ __('Shop Now') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('CTA Button Link') }}</label>
                        <input type="url" class="form-control ws-input" name="hero[cta_link]" value="{{ $hero['cta_link'] ?? '' }}" placeholder="https://...">
                    </div>
                </div>
            </div>

            {{-- 3. BRANDS --}}
            <div class="ws-section-item">
                <button class="ws-section-toggle" onclick="toggleSection('brands')">
                    <div class="d-flex align-items-center gap-2">
                        <span class="ws-icon-wrap" style="background:linear-gradient(135deg,#065f46,#059669);">🏷️</span>
                        <span>{{ __('Brands') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="section-enable-badge {{ !empty($brands_s['enabled']) ? 'bg-success' : 'bg-secondary' }} text-white">
                            {{ !empty($brands_s['enabled']) ? 'ON' : 'OFF' }}
                        </span>
                        <svg class="ws-chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                </button>
                <div class="ws-section-body" id="section-brands">
                    <div class="ws-toggle-row mb-3">
                        <span style="font-weight:600;">{{ __('Enable Brands') }}</span>
                        <input type="checkbox" class="form-check-input ws-input" name="brands[enabled]" value="1" {{ !empty($brands_s['enabled']) ? 'checked' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Section Title') }}</label>
                        <input type="text" class="form-control ws-input" name="brands[title]" value="{{ $brands_s['title'] ?? '' }}" placeholder="{{ __('Our Brands') }}">
                    </div>
                    <div class="ws-toggle-row mb-2">
                        <span>{{ __('Enable Carousel') }}</span>
                        <input type="checkbox" class="form-check-input ws-input" name="brands[carousel]" value="1" {{ !empty($brands_s['carousel']) ? 'checked' : '' }}>
                    </div>
                    @if($brands->count())
                    <div class="mt-2">
                        <label class="form-label">{{ __('Available Brands') }}</label>
                        <div style="display:flex;flex-wrap:wrap;gap:4px;margin-top:4px;">
                            @foreach($brands as $b)
                            <span style="padding:2px 8px;background:rgba(124,58,237,.18);border:1px solid rgba(124,58,237,.3);border-radius:6px;font-size:.68rem;color:#c4b5fd;">{{ $b->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- 4. NOTRE GAMME --}}
            <div class="ws-section-item">
                <button class="ws-section-toggle" onclick="toggleSection('gamme')">
                    <div class="d-flex align-items-center gap-2">
                        <span class="ws-icon-wrap" style="background:linear-gradient(135deg,#92400e,#d97706);">🏍️</span>
                        <span>{{ __('Notre Gamme') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="section-enable-badge {{ !empty($gamme['enabled']) ? 'bg-success' : 'bg-secondary' }} text-white">
                            {{ !empty($gamme['enabled']) ? 'ON' : 'OFF' }}
                        </span>
                        <svg class="ws-chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                </button>
                <div class="ws-section-body" id="section-gamme">
                    <div class="ws-toggle-row mb-3">
                        <span style="font-weight:600;">{{ __('Enable Section') }}</span>
                        <input type="checkbox" class="form-check-input ws-input" name="gamme[enabled]" value="1" {{ !empty($gamme['enabled']) ? 'checked' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Section Title') }}</label>
                        <input type="text" class="form-control ws-input" name="gamme[title]" value="{{ $gamme['title'] ?? '' }}" placeholder="{{ __('Notre Gamme') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Category') }}</label>
                        <select class="form-select ws-input" name="gamme[category_id]">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ ($gamme['category_id'] ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Layout') }}</label>
                        <select class="form-select ws-input" name="gamme[layout]">
                            <option value="grid" {{ ($gamme['layout'] ?? 'grid') === 'grid' ? 'selected' : '' }}>{{ __('Grid') }}</option>
                            <option value="list" {{ ($gamme['layout'] ?? '') === 'list' ? 'selected' : '' }}>{{ __('List') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- 5. EN VEDETTE --}}
            <div class="ws-section-item">
                <button class="ws-section-toggle" onclick="toggleSection('featured')">
                    <div class="d-flex align-items-center gap-2">
                        <span class="ws-icon-wrap" style="background:linear-gradient(135deg,#7f1d1d,#dc2626);">⭐</span>
                        <span>{{ __('En Vedette') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="section-enable-badge {{ !empty($featured['enabled']) ? 'bg-success' : 'bg-secondary' }} text-white">
                            {{ !empty($featured['enabled']) ? 'ON' : 'OFF' }}
                        </span>
                        <svg class="ws-chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                </button>
                <div class="ws-section-body" id="section-featured">
                    <div class="ws-toggle-row mb-3">
                        <span style="font-weight:600;">{{ __('Enable Section') }}</span>
                        <input type="checkbox" class="form-check-input ws-input" name="featured[enabled]" value="1" {{ !empty($featured['enabled']) ? 'checked' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Display Limit') }}</label>
                        <input type="number" class="form-control ws-input" name="featured[limit]" value="{{ $featured['limit'] ?? 8 }}" min="2" max="24">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Ordering') }}</label>
                        <select class="form-select ws-input" name="featured[ordering]">
                            <option value="latest"     {{ ($featured['ordering'] ?? 'latest') === 'latest'     ? 'selected' : '' }}>{{ __('Latest') }}</option>
                            <option value="oldest"     {{ ($featured['ordering'] ?? '') === 'oldest'           ? 'selected' : '' }}>{{ __('Oldest') }}</option>
                            <option value="price_asc"  {{ ($featured['ordering'] ?? '') === 'price_asc'        ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                            <option value="price_desc" {{ ($featured['ordering'] ?? '') === 'price_desc'       ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- 6. VIDEO --}}
            <div class="ws-section-item">
                <button class="ws-section-toggle" onclick="toggleSection('video')">
                    <div class="d-flex align-items-center gap-2">
                        <span class="ws-icon-wrap" style="background:linear-gradient(135deg,#4c1d95,#7c3aed);">🎬</span>
                        <span>{{ __('Video') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="section-enable-badge {{ !empty($video['enabled']) ? 'bg-success' : 'bg-secondary' }} text-white">
                            {{ !empty($video['enabled']) ? 'ON' : 'OFF' }}
                        </span>
                        <svg class="ws-chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                </button>
                <div class="ws-section-body" id="section-video">
                    <div class="ws-toggle-row mb-3">
                        <span style="font-weight:600;">{{ __('Enable Video') }}</span>
                        <input type="checkbox" class="form-check-input ws-input" name="video[enabled]" value="1" {{ !empty($video['enabled']) ? 'checked' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Video URL') }}</label>
                        <input type="url" class="form-control ws-input" name="video[url]" value="{{ $video['url'] ?? '' }}" placeholder="https://youtube.com/...">
                    </div>
                    <div class="ws-toggle-row">
                        <span>{{ __('Autoplay') }}</span>
                        <input type="checkbox" class="form-check-input ws-input" name="video[autoplay]" value="1" {{ !empty($video['autoplay']) ? 'checked' : '' }}>
                    </div>
                </div>
            </div>

            {{-- 7. CTA --}}
            <div class="ws-section-item">
                <button class="ws-section-toggle" onclick="toggleSection('cta')">
                    <div class="d-flex align-items-center gap-2">
                        <span class="ws-icon-wrap" style="background:linear-gradient(135deg,#9a3412,#ea580c);">📣</span>
                        <span>{{ __('Call To Action') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="section-enable-badge {{ !empty($cta['enabled']) ? 'bg-success' : 'bg-secondary' }} text-white">
                            {{ !empty($cta['enabled']) ? 'ON' : 'OFF' }}
                        </span>
                        <svg class="ws-chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                </button>
                <div class="ws-section-body" id="section-cta">
                    <div class="ws-toggle-row mb-3">
                        <span style="font-weight:600;">{{ __('Enable CTA') }}</span>
                        <input type="checkbox" class="form-check-input ws-input" name="cta[enabled]" value="1" {{ !empty($cta['enabled']) ? 'checked' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Title') }}</label>
                        <input type="text" class="form-control ws-input" name="cta[title]" value="{{ $cta['title'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control ws-input" name="cta[description]" rows="2">{{ $cta['description'] ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Button Text') }}</label>
                        <input type="text" class="form-control ws-input" name="cta[btn_text]" value="{{ $cta['btn_text'] ?? '' }}" placeholder="{{ __('Contact Us') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Button Link') }}</label>
                        <input type="url" class="form-control ws-input" name="cta[btn_link]" value="{{ $cta['btn_link'] ?? '' }}" placeholder="https://...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Background Color') }}</label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="color" class="ws-input" name="cta[bg_color]" value="{{ $cta['bg_color'] ?? '#f8f9fa' }}">
                            <input type="text" class="form-control ws-input" name="cta[bg_color_text]" value="{{ $cta['bg_color'] ?? '#f8f9fa' }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 8. FOOTER --}}
            <div class="ws-section-item">
                <button class="ws-section-toggle" onclick="toggleSection('footer')">
                    <div class="d-flex align-items-center gap-2">
                        <span class="ws-icon-wrap" style="background:linear-gradient(135deg,#1e3a5f,#1d4ed8);">🔻</span>
                        <span>{{ __('Footer') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="section-enable-badge {{ !empty($footer['enabled']) ? 'bg-success' : 'bg-secondary' }} text-white">
                            {{ !empty($footer['enabled']) ? 'ON' : 'OFF' }}
                        </span>
                        <svg class="ws-chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                </button>
                <div class="ws-section-body" id="section-footer">
                    <div class="ws-toggle-row mb-3">
                        <span style="font-weight:600;">{{ __('Enable Footer') }}</span>
                        <input type="checkbox" class="form-check-input ws-input" name="footer[enabled]" value="1" {{ !empty($footer['enabled']) ? 'checked' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Copyright Text') }}</label>
                        <input type="text" class="form-control ws-input" name="footer[copyright]" value="{{ $footer['copyright'] ?? '' }}">
                    </div>
                    <label class="form-label" style="margin-top:4px;">{{ __('Social Media Links') }}</label>
                    <div class="mb-2 mt-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="background:#1877f2;color:#fff;border:0;min-width:32px;justify-content:center;font-weight:700;font-size:12px;">f</span>
                            <input type="url" class="form-control ws-input" name="footer[social][facebook]" value="{{ $social['facebook'] ?? '' }}" placeholder="https://facebook.com/...">
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);color:#fff;border:0;min-width:32px;justify-content:center;font-size:11px;">in</span>
                            <input type="url" class="form-control ws-input" name="footer[social][instagram]" value="{{ $social['instagram'] ?? '' }}" placeholder="https://instagram.com/...">
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="background:#1da1f2;color:#fff;border:0;min-width:32px;justify-content:center;font-size:11px;font-weight:700;">𝕏</span>
                            <input type="url" class="form-control ws-input" name="footer[social][twitter]" value="{{ $social['twitter'] ?? '' }}" placeholder="https://twitter.com/...">
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="background:#ff0000;color:#fff;border:0;min-width:32px;justify-content:center;font-size:11px;">▶</span>
                            <input type="url" class="form-control ws-input" name="footer[social][youtube]" value="{{ $social['youtube'] ?? '' }}" placeholder="https://youtube.com/...">
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- /ws-sections --}}

        {{-- Save button --}}
        <div class="ws-left-footer">
            <button type="button" id="btn-save-settings" class="ws-btn-save">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                {{ __('Save Settings') }}
            </button>
        </div>

    </div>{{-- /ws-left --}}

    {{-- ────────── RIGHT PREVIEW PANEL ────────── --}}
    <div class="ws-right">

        {{-- Browser chrome --}}
        <div class="ws-browser-chrome">
            <div class="ws-chrome-titlebar">
                <div class="chrome-dots">
                    <div class="chrome-dot dot-red"></div>
                    <div class="chrome-dot dot-yellow"></div>
                    <div class="chrome-dot dot-green"></div>
                </div>
                <div class="chrome-url-bar">
                    <span class="lock-icon">🔒</span>
                    <span class="chrome-url-text" id="preview-url-bar">{{ $storeUrl ?: 'No store URL' }}</span>
                </div>
            </div>
            <div class="ws-chrome-toolbar">
                <div class="ws-device-btns">
                    <button class="ws-device-btn active" onclick="setDevice('desktop')" id="dev-desktop">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        Desktop
                    </button>
                    <button class="ws-device-btn" onclick="setDevice('tablet')" id="dev-tablet">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                        Tablet
                    </button>
                    <button class="ws-device-btn" onclick="setDevice('mobile')" id="dev-mobile">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                        Mobile
                    </button>
                </div>
                <div class="ws-chrome-actions">
                    <button class="ws-chrome-action-btn" onclick="reloadPreview()" title="{{ __('Refresh') }}">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
                    </button>
                    <a href="{{ $storeUrl }}" target="_blank" class="ws-chrome-action-btn" title="{{ __('Open in new tab') }}">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Preview iframe --}}
        <div class="ws-preview-frame" id="preview-frame-wrap">
            @if($storeUrl)
                <iframe id="preview-iframe" src="{{ $storeUrl }}" width="100%" height="100%"
                    title="{{ __('Store Preview') }}" allowfullscreen></iframe>
            @else
                <div style="text-align:center;color:#6b7280;">
                    <div style="font-size:3.5rem;margin-bottom:16px;">🏪</div>
                    <div style="font-size:.9rem;font-weight:600;color:#374151;margin-bottom:6px;">{{ __('No store found') }}</div>
                    <div style="font-size:.78rem;">{{ __('Please create a store first.') }}</div>
                </div>
            @endif
        </div>

    </div>{{-- /ws-right --}}

</div>{{-- /ws-builder-wrap --}}

{{-- ── INTEGRATE CARD (below editor) ── --}}
<div id="section-integrate" class="ws-integrate-card"
    style="{{ $curMode !== 'integrate' ? 'display:none;' : '' }}">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
        <span style="font-size:1.2rem;">🔗</span>
        <h5>{{ __('Iframe Integration Code') }}</h5>
    </div>
    <p>{{ __('Copy the code below and paste it into your existing website where you want the store to appear.') }}</p>
    <div style="position:relative;">
        <div class="ws-code-block" id="iframe-code-display"><code>{{ $iframeCode }}</code></div>
        <button class="ws-copy-btn" id="btn-copy-iframe" onclick="copyIframeCode()">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
            {{ __('Copy') }}
        </button>
    </div>
    <div style="margin-top:16px;display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
        <a href="{{ $storeUrl }}" target="_blank" class="ws-store-link-pill">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            {{ __('Open Store') }} — {{ $storeUrl }}
        </a>
    </div>
</div>

{{-- ── BUILD INFO CARD (below editor) ── --}}
<div id="section-build" class="ws-integrate-card"
    style="{{ $curMode !== 'build' ? 'display:none;' : '' }}">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
        <span style="font-size:1.2rem;">🏗️</span>
        <h5>{{ __('Website Builder Mode') }}</h5>
    </div>
    <p>{{ __('Use the visual editor on the left to customize every section of your storefront. Changes are saved automatically and previewed in real time.') }}</p>
</div>

@endsection

@push('script-page')
<script>
const SAVE_URL  = "{{ route('website.settings.save') }}";
const CSRF      = "{{ csrf_token() }}";
const STORE_URL = "{{ $storeUrl }}";

/* ── Accordion toggle ──────────────────────── */
function toggleSection(id) {
    const body   = document.getElementById('section-' + id);
    const toggle = body.previousElementSibling;
    const isOpen = body.classList.contains('show');

    document.querySelectorAll('.ws-section-body').forEach(b => b.classList.remove('show'));
    document.querySelectorAll('.ws-section-toggle').forEach(t => t.classList.remove('active'));

    if (!isOpen) {
        body.classList.add('show');
        toggle.classList.add('active');
    }
    feather.replace();
}

/* ── Mode selector ─────────────────────────── */
document.querySelectorAll('input[name="ws_mode"]').forEach(radio => {
    radio.addEventListener('change', function () {
        const mode = this.value;
        document.getElementById('card-integrate').classList.toggle('selected', mode === 'integrate');
        document.getElementById('card-build').classList.toggle('selected', mode === 'build');
        document.getElementById('section-integrate').style.display = mode === 'integrate' ? '' : 'none';
        document.getElementById('section-build').style.display     = mode === 'build'      ? '' : 'none';
        scheduleAutosave();
    });
});

document.querySelectorAll('.ws-mode-card').forEach(card => {
    card.addEventListener('click', function () {
        const radio = this.querySelector('input[type="radio"]');
        if (radio) { radio.checked = true; radio.dispatchEvent(new Event('change')); }
    });
});

/* ── Device preview ────────────────────────── */
const deviceSizes = {
    desktop: { width: '100%',  height: '100%' },
    tablet:  { width: '768px', height: '100%' },
    mobile:  { width: '375px', height: '100%' },
};
function setDevice(d) {
    const iframe = document.getElementById('preview-iframe');
    if (!iframe) return;
    document.querySelectorAll('.ws-device-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('dev-' + d).classList.add('active');
    iframe.style.width  = deviceSizes[d].width;
    iframe.style.height = deviceSizes[d].height;
    iframe.style.maxWidth = deviceSizes[d].width;
}

function reloadPreview() {
    const iframe = document.getElementById('preview-iframe');
    if (iframe) {
        iframe.src = STORE_URL + '?ws_preview=' + Date.now();
    }
}

/* ── Collect form data ─────────────────────── */
function collectSettings() {
    const data = {};
    const mode = document.querySelector('input[name="ws_mode"]:checked');
    data.mode = mode ? mode.value : 'integrate';

    document.querySelectorAll('.ws-input').forEach(input => {
        const name = input.name;
        if (!name) return;

        const keys = name.replace(/\]/g, '').split('[');
        let ref = data;
        keys.forEach((k, i) => {
            if (i === keys.length - 1) {
                if (input.type === 'checkbox') {
                    ref[k] = input.checked ? 1 : 0;
                } else {
                    ref[k] = input.value;
                }
            } else {
                if (!ref[k] || typeof ref[k] !== 'object') ref[k] = {};
                ref = ref[k];
            }
        });
    });
    return data;
}

/* ── AJAX save ─────────────────────────────── */
let saveTimer = null;
function setAutosaveStatus(state, text) {
    const el = document.getElementById('autosave-status');
    const tx = document.getElementById('autosave-text');
    el.className = 'ws-autosave ' + state;
    tx.textContent = text;
}

function saveSettings(callback) {
    const data = collectSettings();
    data._token = CSRF;

    setAutosaveStatus('saving', '{{ __("Saving...") }}');

    fetch(SAVE_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify(data),
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            setAutosaveStatus('saved', '✓ {{ __("Saved") }}');
            setTimeout(() => setAutosaveStatus('idle', '{{ __("All changes saved") }}'), 2500);
            if (callback) callback();
        }
    })
    .catch(() => setAutosaveStatus('idle', '⚠ {{ __("Save failed") }}'));
}

function scheduleAutosave() {
    clearTimeout(saveTimer);
    setAutosaveStatus('saving', '{{ __("Unsaved changes...") }}');
    saveTimer = setTimeout(() => {
        saveSettings(() => reloadPreview());
    }, 800);
}

/* ── Bind all inputs ───────────────────────── */
document.querySelectorAll('.ws-input').forEach(input => {
    const evt = (input.type === 'checkbox' || input.type === 'color') ? 'change' : 'input';
    input.addEventListener(evt, scheduleAutosave);
});

/* ── Publish button ────────────────────────── */
document.getElementById('btn-publish').addEventListener('click', function () {
    saveSettings(() => {
        reloadPreview();
        const btn = this;
        btn.innerHTML = '<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg> {{ __("Published!") }}';
        btn.style.background = 'linear-gradient(135deg,#059669,#10b981)';
        setTimeout(() => {
            btn.innerHTML = '<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/></svg> {{ __("Publish") }}';
            btn.style.background = '';
        }, 2500);
    });
});
document.getElementById('btn-save-settings').addEventListener('click', function () {
    saveSettings(() => reloadPreview());
});

/* ── Copy iframe code ──────────────────────── */
function copyIframeCode() {
    const code = document.getElementById('iframe-code-display').innerText.trim();
    navigator.clipboard.writeText(code).then(() => {
        const btn = document.getElementById('btn-copy-iframe');
        const orig = btn.innerHTML;
        btn.innerHTML = '✓ {{ __("Copied!") }}';
        btn.style.background = 'rgba(16,185,129,.3)';
        btn.style.borderColor = '#10b981';
        btn.style.color = '#10b981';
        setTimeout(() => {
            btn.innerHTML = orig;
            btn.style.background = '';
            btn.style.borderColor = '';
            btn.style.color = '';
        }, 2000);
    });
}

/* ── Color pickers sync text ───────────────── */
document.querySelectorAll('input[type="color"]').forEach(picker => {
    picker.addEventListener('input', function () {
        const sibling = this.nextElementSibling;
        if (sibling && sibling.type === 'text') sibling.value = this.value;
    });
});

/* ── Init ──────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function () {
    setDevice('desktop');
    if (typeof feather !== 'undefined') feather.replace();
});
</script>
@endpush
