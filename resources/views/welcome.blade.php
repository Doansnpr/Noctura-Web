<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NOCTURA – Sleep Intelligence</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,400;1,9..144,700&family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root {
  /* ── Login-synced palette ── */
  --navy:         #0d1b35;
  --navy-mid:     #152345;
  --navy-light:   #1e3264;
  --navy-xlight:  #243a73;
  --accent:       #4a8ef5;
  --accent-glow:  rgba(74,142,245,0.25);
  --accent-soft:  rgba(74,142,245,0.10);
  --accent-mid:   rgba(74,142,245,0.18);
  --accent-border:rgba(74,142,245,0.28);
  --white:        #ffffff;
  --off-white:    #f4f8ff;
  --surface:      #eef5ff;
  --surface-2:    #ddeaff;
  --border:       rgba(74,142,245,0.14);
  --border-mid:   rgba(74,142,245,0.22);
  --text-body:    #334155;
  --text-muted:   #6480a8;
  --text-soft:    #98b4d4;
  --font-display: 'Fraunces', serif;
  --font-body:    'Sora', sans-serif;
  --ease-spring:  cubic-bezier(0.34,1.56,0.64,1);
  --ease-out:     cubic-bezier(0.19,1,0.22,1);
  --ease-smooth:  cubic-bezier(0.25,0.46,0.45,0.94);
  --r-sm: 10px; --r-md: 16px; --r-lg: 22px; --r-xl: 32px; --r-pill: 999px;
}

html { scroll-behavior:smooth; font-size:15px; }
body {
  font-family: var(--font-body);
  background: #f0f5ff;
  color: var(--navy);
  line-height: 1.7;
  overflow-x: hidden;
  -webkit-font-smoothing: antialiased;
  cursor: none;
}

/* ── CURSOR ── */
.cursor { position:fixed;width:10px;height:10px;background:var(--accent);border-radius:50%;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);box-shadow:0 0 8px var(--accent-glow); }
.cursor-ring { position:fixed;width:30px;height:30px;border:1.5px solid rgba(74,142,245,0.4);border-radius:50%;pointer-events:none;z-index:9998;transition:transform 0.35s var(--ease-smooth),width 0.3s var(--ease-spring),height 0.3s var(--ease-spring);transform:translate(-50%,-50%); }
.cursor-ring.hovered { width:52px;height:52px;border-color:rgba(74,142,245,0.65); }
@media(max-width:768px){.cursor,.cursor-ring{display:none}body{cursor:auto}}

/* ── BACKGROUND DOTS ── */
.bg-dots {
  position:fixed;inset:0;z-index:0;pointer-events:none;
  background-image:radial-gradient(rgba(74,142,245,0.07) 1px,transparent 1px);
  background-size:28px 28px;
}

/* ── LAYOUT ── */
.container { width:100%;padding:0 5%;position:relative;z-index:2; }

/* ── TYPOGRAPHY ── */
h1,h2,h3,h4 { font-family:var(--font-display);line-height:1.12; color:var(--navy); }
h1 { font-size:clamp(2.2rem,5.5vw,3.8rem);font-weight:700;letter-spacing:-0.01em; }
h2 { font-size:clamp(1.7rem,3.8vw,2.8rem);font-weight:700;letter-spacing:-0.01em; }
h3 { font-size:1.05rem;font-weight:600; }
h4 { font-size:0.92rem;font-weight:600; }
p  { color:var(--text-muted);font-size:0.875rem;line-height:1.8;font-weight:400; }
a  { text-decoration:none;color:inherit; }

.gradient-text {
  background:linear-gradient(135deg, var(--navy-light) 0%, var(--accent) 60%);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
  font-style:italic;
}

/* ── TAG ── */
.tag { display:inline-flex;align-items:center;gap:0.5rem;font-family:var(--font-body);font-size:0.65rem;font-weight:600;letter-spacing:0.22em;text-transform:uppercase;color:var(--navy-light);background:linear-gradient(135deg,rgba(74,142,245,0.12),rgba(30,50,100,0.08));border:1.5px solid rgba(74,142,245,0.3);padding:0.3rem 0.9rem;border-radius:var(--r-pill);margin-bottom:1.2rem;box-shadow:0 2px 10px rgba(74,142,245,0.1); }
.tag-dot { width:5px;height:5px;border-radius:50%;background:var(--accent);animation:blink 2s ease infinite; }
@keyframes blink{0%,100%{opacity:1}50%{opacity:0.3}}

/* ── CARD ── */
.card { background:var(--white);border:1px solid var(--border);border-radius:var(--r-lg);transition:all 0.35s var(--ease-smooth);box-shadow:0 2px 12px rgba(74,142,245,0.07); }
.card:hover { border-color:var(--accent-border);box-shadow:0 8px 32px rgba(74,142,245,0.12);transform:translateY(-4px); }

/* ── BUTTONS ── */
.btn-primary { display:inline-flex;align-items:center;gap:0.6rem;padding:0.8rem 1.8rem;border-radius:var(--r-pill);font-family:var(--font-body);font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--white);background:var(--navy);border:none;box-shadow:0 4px 20px rgba(13,27,53,0.22);transition:all 0.3s var(--ease-spring);cursor:none;position:relative;overflow:hidden; }
.btn-primary::before { content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.07),transparent);transition:left 0.5s; }
.btn-primary:hover { background:var(--navy-light);transform:translateY(-2px);box-shadow:0 8px 28px rgba(13,27,53,0.28); }
.btn-primary:hover::before { left:100%; }

.btn-ghost { display:inline-flex;align-items:center;gap:0.6rem;padding:0.8rem 1.8rem;border-radius:var(--r-pill);font-family:var(--font-body);font-size:0.78rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--navy);border:1.5px solid var(--border-mid);background:transparent;transition:all 0.3s var(--ease-smooth);cursor:none; }
.btn-ghost:hover { color:var(--accent);border-color:var(--accent-border);background:var(--accent-soft); }

/* ── NAVBAR ── */
.navbar { position:fixed;top:20px;left:50%;transform:translateX(-50%);width:calc(100% - 48px);z-index:1000;background:rgba(240,245,255,0.88);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border:1px solid rgba(74,142,245,0.18);border-radius:var(--r-xl);padding:0.72rem 1.5rem;display:flex;align-items:center;justify-content:space-between;transition:all 0.4s var(--ease-smooth);box-shadow:0 4px 20px rgba(74,142,245,0.10); }
.navbar.scrolled { background:rgba(232,240,254,0.97);box-shadow:0 8px 36px rgba(74,142,245,0.18); }
.nav-brand { display:flex;align-items:center;gap:0.65rem; }
.nav-logo-svg { width:28px;height:28px; }
.nav-name { font-family:var(--font-display);font-size:1rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--navy); }
.nav-links { display:flex;align-items:center;gap:2rem;list-style:none; }
.nav-links a { font-size:0.78rem;font-weight:500;color:var(--text-muted);transition:color 0.25s;cursor:none; }
.nav-links a:hover { color:var(--navy); }
.nav-cta { font-size:0.75rem!important;font-weight:700!important;color:var(--white)!important;background:var(--navy)!important;padding:0.46rem 1.2rem!important;border-radius:var(--r-pill)!important;border:none!important;box-shadow:0 3px 12px rgba(13,27,53,0.22);transition:all 0.3s var(--ease-spring)!important;letter-spacing:0.08em!important;text-transform:uppercase!important; }
.nav-cta:hover { background:var(--navy-light)!important;color:var(--white)!important;transform:translateY(-1px);box-shadow:0 6px 20px rgba(13,27,53,0.28)!important; }
.nav-toggle { display:none;flex-direction:column;gap:5px;background:none;border:none;cursor:none;padding:5px; }
.nav-toggle span { display:block;width:20px;height:1.5px;background:var(--navy);border-radius:2px;transition:0.3s; }

/* ── HERO ── */
.hero { min-height:100svh;display:flex;align-items:center;padding:8rem 5% 5rem;position:relative;background:linear-gradient(160deg,#dce8ff 0%,#e8f0fe 50%,#f0f5ff 100%);overflow:hidden; }

/* Decorative blobs */
.hero-blob-1 { position:absolute;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(74,142,245,0.16) 0%,transparent 65%);top:-200px;right:-100px;pointer-events:none;z-index:0; }
.hero-blob-3 { position:absolute;width:350px;height:350px;border-radius:50%;background:radial-gradient(circle,rgba(74,142,245,0.13) 0%,transparent 70%);top:10%;left:5%;pointer-events:none;z-index:0; }
.hero-blob-2 { position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(74,142,245,0.10) 0%,transparent 70%);bottom:-100px;left:-80px;pointer-events:none;z-index:0; }

.hero-inner { width:100%;display:grid;grid-template-columns:1.05fr 0.95fr;gap:4%;align-items:center;position:relative;z-index:1; }

.hero-eyebrow { display:flex;align-items:center;gap:0.8rem;margin-bottom:1.6rem;opacity:0;animation:fadeUp 0.8s 0.1s var(--ease-out) forwards; }
.eyebrow-badge { font-family:var(--font-body);font-size:0.65rem;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:var(--accent);background:var(--accent-soft);border:1px solid var(--accent-border);padding:0.28rem 0.82rem;border-radius:var(--r-pill); }
.eyebrow-line { flex:1;height:1px;background:linear-gradient(90deg,var(--accent-border),transparent); }

.hero-title { opacity:0;animation:fadeUp 0.9s 0.2s var(--ease-out) forwards;margin-bottom:1.4rem; }
.hero-sub { opacity:0;animation:fadeUp 0.9s 0.3s var(--ease-out) forwards;max-width:440px;margin-bottom:2.2rem;font-size:0.9rem; }
.hero-actions { display:flex;gap:0.9rem;flex-wrap:wrap;opacity:0;animation:fadeUp 0.9s 0.4s var(--ease-out) forwards; }
.hero-trust { margin-top:2.2rem;display:flex;align-items:center;gap:0.9rem;opacity:0;animation:fadeUp 0.9s 0.5s var(--ease-out) forwards; }
.trust-avatars { display:flex; }
.trust-avatar { width:28px;height:28px;border-radius:50%;border:2px solid var(--white);margin-left:-7px;background:linear-gradient(135deg,var(--navy-light),var(--accent));display:flex;align-items:center;justify-content:center;font-size:0.55rem;font-weight:700;color:var(--white); }
.trust-avatar:first-child { margin-left:0; }
.trust-text { font-size:0.77rem;color:var(--text-muted);font-weight:400; }
.trust-text strong { color:var(--navy);font-weight:600; }
@keyframes fadeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:none}}

/* ── PHONE MOCKUP (Perfect Real Phone Aspect Ratio - 275px x 480px) ── */
.hero-visual { position:relative;opacity:0;animation:fadeUp 1s 0.5s var(--ease-out) forwards; width: 275px; margin: 0 auto; }
.phone-shadow { position:absolute;width:240px;height:240px;border-radius:50%;background:radial-gradient(circle,rgba(74,142,245,0.22),transparent 70%);bottom:-25px;left:50%;transform:translateX(-50%);filter:blur(22px);z-index:0; }
.phone-frame {
  width:275px;
  height:480px; /* Slender, compact, strictly smartphone layout */
  margin:0 auto;
  position:relative;
  z-index:1;
  background:#f4f8ff;
  border:10px solid #091124;
  border-radius:38px;
  box-shadow:0 24px 64px rgba(13,27,53,0.22), 0 0 30px rgba(74,142,245,0.1);
  overflow:hidden;
  animation:phone-float 5s ease-in-out infinite;
  display: flex;
  flex-direction: column;
}
@keyframes phone-float{0%,100%{transform:translateY(0) rotate(-0.3deg)}50%{transform:translateY(-10px) rotate(0.3deg)}}

/* Internal App Core Components */
.phone-top-bar { display:flex;justify-content:space-between;align-items:center;padding:0.6rem 1.1rem 0.35rem;font-size:0.52rem;color:var(--navy);font-weight:600;background:rgba(244,248,255,0.92);backdrop-filter:blur(10px);z-index:120; flex-shrink:0; position:relative; }
.phone-island { position:absolute;top:0.45rem;left:50%;transform:translateX(-50%);width:68px;height:13px;background:#091124;border-radius:20px;display:flex;align-items:center; }
.phone-cam { width:4px;height:4px;border-radius:50%;background:#1c2b4d; margin-left: auto; margin-right: 8px; }

/* Phone Inner Custom Scroll Container */
.phone-scroll-container {
  flex: 1;
  overflow-y: auto;
  overflow-x: hidden;
  scrollbar-width: none;
  padding: 0.4rem 0.75rem 5.5rem; /* Large safety offset protecting layouts from docked navs */
}
.phone-scroll-container::-webkit-scrollbar { display:none; }

.phone-content { 
  display: flex; 
  flex-direction: column; 
  gap: 0.75rem;
}

/* Header User Profile Row */
.ph-header { display:flex;align-items:center;justify-content:space-between;padding:0.1rem 0; }
.ph-user { display:flex;align-items:center;gap:0.45rem; }
.ph-avatar { width:30px;height:30px;border-radius:50%;background:#e2ecf9;display:flex;align-items:center;justify-content:center;position:relative; border:1px solid rgba(74,142,245,0.15); }
.ph-avatar-dot { position:absolute;bottom:0px;right:0px;width:6px;height:6px;border-radius:50%;background:#22c55e;border:1.2px solid #f4f8ff; }
.ph-avatar-icon { font-size:0.85rem; }
.ph-name { font-family:var(--font-body);font-size:0.76rem;font-weight:700;color:var(--navy);line-height:1.2; }
.ph-greet { font-size:0.55rem;color:var(--text-muted);font-weight:400; }
.ph-actions-row { display:flex;gap:0.35rem;align-items:center; }
.ph-btn-circle { width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.58rem; background:var(--white); border:1px solid rgba(74,142,245,0.1); color:var(--navy); position:relative; }
.ph-btn-circle.active { background:#3b82f6; color:var(--white); box-shadow:0 2px 6px rgba(59,130,246,0.25); }
.ph-badge-dot { position:absolute;top:1px;right:1px;width:4px;height:4px;background:#ef4444;border-radius:50%; }

/* Card 1: Tidur Semalam */
.ph-sleep-card { background:var(--white);border-radius:18px;padding:0.85rem;box-shadow:0 4px 16px rgba(13,27,53,0.02); border:1px solid rgba(74,142,245,0.08); }
.ph-sleep-header { display:flex;justify-content:space-between;align-items:center;margin-bottom:0.45rem; }
.ph-sleep-label { display:flex;align-items:center;gap:0.3rem;font-size:0.52rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:var(--text-muted); }
.ph-badge-exc { background:#f3e8ff;color:#6d28d9;font-size:0.48rem;font-weight:700;padding:0.15rem 0.45rem;border-radius:var(--r-pill);display:flex;align-items:center;gap:0.2rem; }
.ph-sleep-dur { display:flex;align-items:baseline;color:var(--navy);margin-bottom:0.05rem; }
.ph-sleep-dur .num { font-family:var(--font-body);font-size:1.6rem;font-weight:700; }
.ph-sleep-dur .unit { font-size:0.72rem;font-weight:600;color:var(--navy);margin-right:0.2rem; margin-left:0.05rem; }
.ph-sleep-time { font-size:0.52rem;color:var(--text-soft);font-weight:500;margin-bottom:0.6rem; }
.ph-sleep-bar { display:flex;height:5px;border-radius:4px;overflow:hidden;margin-bottom:0.45rem;gap:3px; }
.ph-bar-1 { flex:1.5;background:#c084fc; }
.ph-bar-2 { flex:2.5;background:#818cf8; }
.ph-bar-3 { flex:4;background:#93c5fd; }
.ph-bar-4 { flex:0.8;background:#e9d5ff; }
.ph-sleep-legend { display:flex;gap:0.5rem;flex-wrap:wrap;font-size:0.48rem;color:var(--text-muted);font-weight:500; }
.ph-leg { display:flex;align-items:center;gap:0.18rem; }
.ph-leg-dot { width:4px;height:4px;border-radius:50%; }
.ph-skor-row { display:flex;align-items:center;justify-content:space-between;margin-top:0.7rem;padding-top:0.65rem;border-top:1px solid #f1f5f9; }
.ph-skor-label { font-size:0.52rem;color:var(--text-muted);font-weight:600; }
.ph-skor-val { font-family:var(--font-body);font-size:1.15rem;font-weight:700;color:#4f46e5;line-height:1; }
.ph-skor-bars { display:flex;align-items:flex-end;gap:2px;height:18px; }
.ph-skor-bar { width:3.5px;border-radius:2px;background:#e2e8f0; }
.ph-skor-bar.on { background:#6366f1; }
.ph-skor-bar.active-bar { background:#4f46e5; }

/* Card 2: Target Malam Ini */
.ph-target-card { background:#e0edff; border-radius:14px; padding:0.7rem 0.8rem; display:flex; align-items:center; gap:0.6rem; border:1px solid rgba(74,142,245,0.1); }
.ph-target-icon { width:26px;height:26px;border-radius:8px;background:#2563eb;display:flex;align-items:center;justify-content:center;color:var(--white);font-size:0.75rem;flex-shrink:0; }
.ph-target-info { flex:1; min-width:0; }
.ph-target-lbl { font-size:0.48rem; font-weight:700; color:#1e40af; letter-spacing:0.03em; margin-bottom:0.05rem; }
.ph-target-vals { display:flex; align-items:center; gap:0.3rem; font-size:0.62rem; font-weight:700; color:var(--navy); }
.ph-target-badge { background:var(--white); color:#2563eb; font-size:0.46rem; font-weight:700; padding:0.05rem 0.25rem; border-radius:4px; }
.ph-target-right { text-align:right; font-size:0.5rem; color:#2563eb; font-weight:600; flex-shrink:0; }

/* Card 3: Mulai Prediksi */
.ph-prediksi-blue { background:linear-gradient(135deg,#0b42b3 0%,#1e64f0 100%);border-radius:16px;padding:0.85rem;display:flex;align-items:center;justify-content:space-between; box-shadow:0 4px 14px rgba(11,66,179,0.12); }
.ph-prediksi-title-large { font-family:var(--font-body);font-size:0.8rem;font-weight:700;color:var(--white);margin-bottom:0.15rem; }
.ph-prediksi-sub-white { font-size:0.55rem;color:rgba(255,255,255,0.85); }
.ph-prediksi-btn-icon { width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,0.18);display:flex;align-items:center;justify-content:center;font-size:0.8rem;color:var(--white); }

/* Grid Cards 4 & 5 (Log Tidur & Edukasi) */
.ph-menu-grid { display:grid; grid-template-columns:1fr 1fr; gap:0.6rem; }
.ph-menu-card { border-radius:16px; padding:0.8rem; position:relative; overflow:hidden; display:flex; flex-direction:column; justify-content:space-between; height:88px; border-bottom: 2.5px solid transparent; }
.ph-menu-card.purple { background:#f5f0ff; border-color:#c084fc; }
.ph-menu-card.green { background:#f0fdf4; border-color:#4ade80; }
.ph-menu-icon-wrap { width:24px; height:24px; border-radius:50%; background:var(--white); display:flex; align-items:center; justify-content:center; font-size:0.68rem; margin-bottom:0.8rem; box-shadow:0 1px 3px rgba(0,0,0,0.03); z-index:2; }
.ph-menu-card h4 { font-family:var(--font-body); font-size:0.68rem; font-weight:700; color:var(--navy); margin-bottom:0.05rem; z-index:2; }
.ph-menu-card span { font-size:0.5rem; font-weight:600; z-index:2; }
.ph-menu-card.purple span { color:#7c3aed; }
.ph-menu-card.green span { color:#16a34a; }
.ph-card-circle-decor { position:absolute; right:-10px; top:-10px; width:44px; height:44px; border-radius:50%; background:rgba(255,255,255,0.4); z-index:1; }

/* Card 6: Insight Hari Ini */
.ph-insight-card { background:#edf4fe; border-radius:14px; padding:0.75rem 0.85rem; border:1px solid rgba(74,142,245,0.1); }
.ph-insight-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:0.35rem; }
.ph-insight-lbl { display:flex; align-items:center; gap:0.25rem; font-size:0.48rem; font-weight:700; color:#1e40af; letter-spacing:0.03em; }
.ph-insight-badge { background:var(--white); color:#16a34a; font-size:0.46rem; font-weight:700; padding:0.1rem 0.4rem; border-radius:var(--r-pill); display:flex; align-items:center; gap:0.12rem; }
.ph-insight-badge::before { content:''; width:3px; height:3px; background:#16a34a; border-radius:50%; }
.ph-insight-desc { font-size:0.55rem; color:#1e3a8a; font-weight:500; line-height:1.4; }

/* Floating Action Button - FIXED OUTER ROOT LAYER */
.ph-fab { position:absolute; bottom:4.2rem; right:0.75rem; width:34px; height:34px; background:#5046e5; border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--white); font-size:0.85rem; box-shadow:0 4px 10px rgba(80,70,229,0.3); z-index:115; }

/* Premium Fixed Floating App Dock */
.ph-dock-container { position:absolute; bottom:0.55rem; left:0.55rem; right:0.55rem; z-index:110; }
.ph-bottom-dock { display:flex; justify-content:space-around; align-items:center; padding:0.35rem 0.2rem; background:rgba(255,255,255,0.96); backdrop-filter:blur(12px); border:1px solid rgba(74,142,245,0.12); border-radius:20px; box-shadow:0 6px 20px rgba(13,27,53,0.06); }
.ph-dock-item { display:flex; flex-direction:column; align-items:center; gap:0.08rem; font-size:0.44rem; color:var(--text-soft); font-weight:600; text-decoration:none; width:38px; }
.ph-dock-item.active { color:#0f295a; }
.ph-dock-icon-box { width:25px; height:25px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:0.72rem; }
.ph-dock-item.active .ph-dock-icon-box { background:#0f295a; color:var(--white); box-shadow:0 2px 6px rgba(15,41,90,0.2); }

/* ── DECORATIVE FLOAT PILLS (Perfected Compact Placement) ── */
.float-pill { 
  position:absolute;
  display:inline-flex !important;
  flex-direction:row !important;
  align-items:center !important;
  justify-content:flex-start !important;
  gap:0.4rem;
  background:#eef4ff;
  border:1px solid rgba(74,142,245,0.3);
  border-radius:var(--r-pill);
  padding:0.4rem 0.75rem;
  font-size:0.62rem;
  font-family:var(--font-body);
  font-weight:600;
  color:var(--navy);
  white-space:nowrap !important;
  box-shadow:0 8px 20px rgba(13,27,53,0.08);
  z-index:5; 
}
.float-pill-1 { top:15%; left:-20%; animation:float-y 4s ease-in-out infinite alternate; }
.float-pill-2 { bottom:18%; right:-18%; animation:float-y 5s 1s ease-in-out infinite alternate; }
.pill-icon { width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.58rem; flex-shrink:0; }
.pill-icon-green { background:rgba(34,197,94,0.15); }
.pill-icon-blue  { background:var(--accent-soft); }
@keyframes float-y{0%{transform:translateY(0)}100%{transform:translateY(-8px)}}

/* ── MARQUEE ── */
.marquee-section { position:relative;z-index:2;padding:1.3rem 0;overflow:hidden;border-top:1px solid var(--border);border-bottom:1px solid var(--border);background:linear-gradient(135deg,#ddeaff,#eef5ff); }
.marquee-track { display:flex;animation:marquee 26s linear infinite;width:max-content; }
.marquee-item { display:flex;align-items:center;gap:0.9rem;padding:0 2.8rem;white-space:nowrap; }
.marquee-num { font-family:var(--font-display);font-size:1.2rem;font-weight:700;background:linear-gradient(135deg,var(--navy-light),var(--accent));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text; }
.marquee-txt { font-size:0.78rem;color:var(--text-muted);font-weight:400; }
.marquee-sep { width:3px;height:3px;border-radius:50%;background:var(--border-mid); }
@keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}

/* ── SECTIONS ── */
.section-light { padding:7rem 5%;position:relative;z-index:2;background:linear-gradient(180deg,#f0f5ff 0%,#e8f0fe 100%); }
.section-alt   { padding:7rem 5%;position:relative;z-index:2;background:var(--surface);border-top:1px solid var(--border);border-bottom:1px solid var(--border); }
.section-header { margin-bottom:3rem; }

/* ── BENTO ── */
.bento-grid { display:grid;grid-template-columns:repeat(12,1fr);gap:1rem; }
.bento-card { background:linear-gradient(145deg,#f5f9ff,#ffffff);border:1px solid rgba(74,142,245,0.22);border-radius:var(--r-lg);padding:1.8rem;transition:all 0.35s var(--ease-smooth);overflow:hidden;position:relative;box-shadow:0 2px 12px rgba(74,142,245,0.07); }
.bento-card:hover { border-color:var(--accent-border);box-shadow:0 8px 28px rgba(74,142,245,0.18);transform:translateY(-3px);background:#f0f7ff; }
.bento-a{grid-column:1/6;grid-row:1/2}
.bento-b{grid-column:6/9;grid-row:1/2}
.bento-c{grid-column:9/13;grid-row:1/2}
.bento-d{grid-column:1/5;grid-row:2/3}
.bento-e{grid-column:5/13;grid-row:2/3}

.bento-card::before { content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:var(--r-lg) var(--r-lg) 0 0;background:linear-gradient(90deg,var(--accent-soft),transparent);opacity:0;transition:opacity 0.35s; }
.bento-card:hover::before { opacity:1; }

.bento-icon { width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1.1rem;font-size:1.1rem; }
.icon-blue  { background:var(--accent-soft);border:1px solid var(--accent-border); }
.icon-navy  { background:rgba(13,27,53,0.06);border:1px solid rgba(13,27,53,0.1); }
.icon-light { background:var(--surface);border:1px solid var(--border); }

.bento-card h3 { margin-bottom:0.5rem;font-size:0.95rem; }
.bento-card p  { font-size:0.82rem; }

.bento-chart { margin-top:1.3rem;display:flex;flex-direction:column;gap:0.72rem; }
.bento-bar-row { display:flex;align-items:center;gap:0.75rem; }
.bento-bar-lbl { width:76px;font-size:0.68rem;color:var(--text-muted);flex-shrink:0; }
.bento-bar-track { flex:1;height:6px;background:var(--surface-2,#eef2fa);border-radius:3px;overflow:hidden; }
.bento-bar-fill { height:100%;border-radius:3px;width:0;transition:width 1.6s var(--ease-out); }
.bento-bar-fill.animated { width:var(--w); }
.fill-1 { background:linear-gradient(90deg,var(--navy-light),var(--accent)); }
.fill-2 { background:linear-gradient(90deg,var(--navy-xlight),#6fa8ff); }
.fill-3 { background:linear-gradient(90deg,rgba(74,142,245,0.5),rgba(74,142,245,0.8)); }
.fill-4 { background:linear-gradient(90deg,rgba(74,142,245,0.3),rgba(74,142,245,0.55)); }
.bento-bar-pct { font-size:0.68rem;color:var(--navy);font-family:var(--font-display);font-weight:600;width:28px; }

.big-stat { font-family:var(--font-display);font-size:3.2rem;font-weight:700;line-height:1;margin-bottom:0.45rem;background:linear-gradient(135deg,var(--navy-light),var(--accent));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text; }
.bento-note { margin-top:1.1rem;padding:0.85rem;background:linear-gradient(135deg,rgba(74,142,245,0.10),rgba(30,50,100,0.06));border:1.5px solid rgba(74,142,245,0.25);border-radius:var(--r-sm);font-size:0.78rem;color:var(--navy);line-height:1.6;box-shadow:inset 0 1px 0 rgba(74,142,245,0.1); }

/* ── SOLUTION ── */
.solution-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem;margin-top:3rem; }
.sol-card { background:linear-gradient(145deg,#eef4ff,#ffffff);border:1px solid rgba(74,142,245,0.25);border-radius:var(--r-lg);padding:2rem;position:relative;overflow:hidden;transition:all 0.35s var(--ease-smooth);box-shadow:0 2px 12px rgba(74,142,245,0.09); }
.sol-card::after { content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--navy-light),var(--accent),#6fa8ff);opacity:0;transition:opacity 0.35s; }
.sol-card:hover { border-color:var(--accent);box-shadow:0 8px 32px rgba(74,142,245,0.20);transform:translateY(-5px);background:#f0f7ff; }
.sol-card:hover::after { opacity:1; }
.sol-num { font-family:var(--font-display);font-size:3rem;font-weight:700;line-height:1;opacity:0.05;position:absolute;top:1rem;right:1.3rem;color:var(--navy); }
.sol-card h3 { margin-bottom:0.5rem; } .sol-card p { font-size:0.82rem; }

/* ── FEATURES ── */
.tab-row { display:flex;align-items:center;gap:0.4rem;margin:2.5rem 0 2.2rem;background:#c7dcff;border:1px solid rgba(74,142,245,0.2);border-radius:var(--r-pill);padding:4px;width:fit-content; }
.tab-btn { padding:0.5rem 1.3rem;border-radius:var(--r-pill);border:none;font-family:var(--font-body);font-size:0.76rem;font-weight:600;color:var(--text-muted);background:transparent;cursor:none;transition:all 0.3s var(--ease-smooth); }
.tab-btn.active { background:var(--white);color:var(--navy);border:1px solid var(--border);box-shadow:0 2px 8px rgba(13,27,53,0.08); }
.feat-grid { display:grid;grid-template-columns:repeat(2,1fr);gap:1rem; }
.feat-card { background:linear-gradient(135deg,#f0f6ff,#ffffff);border:1px solid rgba(74,142,245,0.22);border-radius:var(--r-lg);padding:1.6rem;display:flex;gap:1.1rem;align-items:flex-start;transition:all 0.35s var(--ease-smooth);box-shadow:0 2px 10px rgba(74,142,245,0.08); }
.feat-card:hover { border-color:var(--accent);box-shadow:0 8px 24px rgba(74,142,245,0.18);transform:translateX(4px);background:#f0f7ff; }
.feat-icon { width:40px;height:40px;border-radius:11px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1rem; }
.feat-card h4 { margin-bottom:0.3rem; } .feat-card p { font-size:0.8rem; }

/* ── STEPS ── */
.steps-grid { display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-top:3rem;position:relative; }
.step-card { background:linear-gradient(145deg,#eef4ff,#f8fbff);border:1px solid rgba(74,142,245,0.25);border-radius:var(--r-lg);padding:1.8rem 1.4rem;text-align:center;position:relative;transition:all 0.35s var(--ease-smooth);box-shadow:0 2px 10px rgba(74,142,245,0.08); }
.step-card:hover { border-color:var(--accent);box-shadow:0 8px 24px rgba(74,142,245,0.18);transform:translateY(-5px);background:#f0f7ff; }
.step-connector { position:absolute;top:28px;right:-10%;width:20%;height:1px;background:linear-gradient(90deg,var(--accent-border),transparent);z-index:0;pointer-events:none; }
.step-num-badge { width:50px;height:50px;border-radius:50%;border:2px solid var(--accent);background:linear-gradient(135deg,rgba(74,142,245,0.15),rgba(30,50,100,0.1));display:flex;align-items:center;justify-content:center;margin:0 auto 1.2rem;font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--accent);box-shadow:0 4px 14px rgba(74,142,245,0.2); }
.step-card h4 { margin-bottom:0.45rem; } .step-card p { font-size:0.8rem; }

/* ── WHY ── */
.why-inner { display:grid;grid-template-columns:1fr 1fr;gap:6%;align-items:center; }
.why-list { display:flex;flex-direction:column;gap:1.2rem;margin-top:2rem; }
.why-item { display:flex;gap:0.9rem;align-items:flex-start;padding:0.9rem 1rem;background:linear-gradient(90deg,rgba(74,142,245,0.10),rgba(74,142,245,0.03));border-radius:var(--r-md);border-left:3px solid rgba(74,142,245,0.55); }
.why-check { width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,rgba(74,142,245,0.2),rgba(30,50,100,0.12));border:1.5px solid var(--accent);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:0.1rem;font-size:0.68rem;color:var(--accent);box-shadow:0 2px 10px rgba(74,142,245,0.18); }
.why-item h4 { margin-bottom:0.22rem; } .why-item p { font-size:0.8rem; }
.metrics-grid { display:grid;grid-template-columns:1fr 1fr;gap:0.9rem; }
.metric-card { background:linear-gradient(135deg,#dce8ff,#eef4ff);border:1px solid rgba(74,142,245,0.18);border-radius:var(--r-lg);padding:1.6rem 1.3rem;transition:all 0.35s var(--ease-smooth);box-shadow:0 2px 12px rgba(74,142,245,0.09); }
.metric-card:hover { border-color:var(--accent);box-shadow:0 8px 24px rgba(74,142,245,0.18);transform:translateY(-3px);background:#f0f7ff; }
.metric-emoji { font-size:1.6rem;display:block;margin-bottom:0.7rem; }
.metric-val { font-family:var(--font-display);font-size:1.45rem;font-weight:700;color:var(--navy);line-height:1.1;margin-bottom:0.35rem; }
.metric-desc { font-size:0.75rem;color:var(--text-muted);line-height:1.5; }

/* ── TESTIMONIALS ── */
.testi-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:3rem;text-align:left; }
.testi-card { background:linear-gradient(145deg,#f0f5ff,#ffffff);border:1px solid rgba(74,142,245,0.22);border-radius:var(--r-lg);padding:1.8rem;transition:all 0.35s var(--ease-smooth);box-shadow:0 2px 12px rgba(74,142,245,0.08); }
.testi-card:hover { border-color:var(--accent);box-shadow:0 8px 24px rgba(74,142,245,0.15);transform:translateY(-4px);background:#f0f7ff; }
.testi-quote { font-size:1.8rem;line-height:1;color:var(--accent);margin-bottom:0.9rem;font-family:Georgia,serif; }
.testi-text { font-size:0.83rem;color:var(--text-body);line-height:1.8;margin-bottom:1.3rem;font-style:italic; }
.testi-author { display:flex;align-items:center;gap:0.75rem; }
.testi-avatar { width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,var(--navy-light),var(--navy-xlight));display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:0.85rem;font-weight:700;color:var(--white);flex-shrink:0; }
.testi-name { font-family:var(--font-display);font-size:0.84rem;font-weight:700;margin-bottom:0.08rem;color:var(--navy); }
.testi-role { font-size:0.7rem;color:var(--text-muted); }
.testi-stars { color:var(--accent);font-size:0.75rem;letter-spacing:0.08em;margin-bottom:0.35rem; }

/* ── FAQ ── */
.faq-wrap { max-width:780px;margin:0 auto; }
.faq-grid { margin-top:3rem;display:flex;flex-direction:column;gap:0.7rem; }
.faq-item { background:linear-gradient(90deg,#f0f5ff,#ffffff);border:1px solid rgba(74,142,245,0.22);border-radius:var(--r-md);overflow:hidden;transition:border-color 0.3s;box-shadow:0 1px 8px rgba(74,142,245,0.08); }
.faq-item.open { border-color:var(--accent);box-shadow:0 4px 20px rgba(74,142,245,0.15);background:#f6faff; }
.faq-q { width:100%;background:none;border:none;cursor:none;padding:1.1rem 1.4rem;display:flex;justify-content:space-between;align-items:center;gap:1rem;font-family:var(--font-body);font-size:0.87rem;font-weight:600;color:var(--text-body);text-align:left;transition:color 0.25s; }
.faq-q:hover { color:var(--navy); }
.faq-item.open .faq-q { color:var(--navy); }
.faq-chevron { width:24px;height:24px;border-radius:50%;background:var(--surface);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:transform 0.35s var(--ease-smooth),background 0.25s; }
.faq-item.open .faq-chevron { transform:rotate(180deg);background:var(--accent);border-color:var(--accent);color:white; }
.faq-a { max-height:0;overflow:hidden;transition:max-height 0.45s var(--ease-out); }
.faq-a p { padding:0 1.4rem 1.1rem;font-size:0.83rem;margin:0; }
.faq-item.open .faq-a { max-height:240px; }

/* ── CTA ── */
.cta-wrap { max-width:860px;margin:0 auto; }
.cta-card { background:linear-gradient(135deg,var(--navy) 0%,var(--navy-light) 100%);border-radius:40px;padding:4.5rem 3.5rem;text-align:center;position:relative;overflow:hidden; }
.cta-card::before { content:'';position:absolute;inset:0;border-radius:40px;background:radial-gradient(ellipse 60% 55% at 50% 0%,rgba(74,142,245,0.18),transparent 65%);pointer-events:none; }
.cta-card h2 { margin-bottom:1.1rem;color:var(--white); }
.cta-card .gradient-text { background:linear-gradient(135deg,#fff 0%,rgba(74,142,245,0.9) 60%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text; }
.cta-card p { max-width:460px;margin:0 auto 2.5rem;color:rgba(255,255,255,0.55); }
.store-btns { display:flex;gap:0.9rem;justify-content:center;flex-wrap:wrap;margin-bottom:1.8rem; }
.store-btn { display:flex;align-items:center;gap:0.75rem;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.18);border-radius:var(--r-md);padding:0.8rem 1.5rem;color:var(--white);transition:all 0.3s var(--ease-spring);cursor:none; }
.store-btn:hover { background:rgba(255,255,255,0.15);border-color:rgba(255,255,255,0.35);transform:translateY(-3px); }
.store-btn-txt small { display:block;font-size:0.58rem;color:rgba(255,255,255,0.42);margin-bottom:0.08rem; }
.store-btn-txt strong { font-family:var(--font-display);font-size:0.9rem;font-weight:700; }
.cta-disclaimer { font-size:0.72rem;color:rgba(255,255,255,0.3);line-height:1.6; }

/* ── FOOTER ── */
footer { position:relative;z-index:2;border-top:1px solid rgba(255,255,255,0.07);padding:4.5rem 5% 2.2rem;background:var(--navy); }
.footer-grid { display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:2.5rem;padding-bottom:2.5rem;border-bottom:1px solid rgba(255,255,255,0.07); }
.footer-brand p { font-size:0.8rem;max-width:240px;margin-top:0.9rem;color:rgba(255,255,255,0.4); }
.footer-socials { display:flex;gap:0.6rem;margin-top:1.3rem; }
.social-btn { width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.35);transition:all 0.3s;cursor:none; }
.social-btn:hover { background:rgba(74,142,245,0.18);border-color:rgba(74,142,245,0.35);color:var(--accent);transform:translateY(-2px); }
.footer-col h5 { font-family:var(--font-body);font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:1.1rem;color:var(--white); }
.footer-col ul { list-style:none;display:flex;flex-direction:column;gap:0.55rem; }
.footer-col ul a { font-size:0.78rem;color:rgba(255,255,255,0.35);transition:color 0.25s;cursor:none; }
.footer-col ul a:hover { color:rgba(255,255,255,0.7); }
.footer-bottom { display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.9rem;font-size:0.72rem;color:rgba(255,255,255,0.28);margin-top:1.8rem; }
.footer-bottom a { color:rgba(255,255,255,0.28);transition:color 0.25s; }
.footer-bottom a:hover { color:var(--accent); }
.footer-name-white { color:var(--white); }

/* ── REVEAL ── */
.reveal { opacity:0;transform:translateY(22px);transition:opacity 0.75s var(--ease-out),transform 0.75s var(--ease-out); }
.reveal.visible { opacity:1;transform:translateY(0); }
.reveal-delay-1{transition-delay:0.08s}.reveal-delay-2{transition-delay:0.16s}.reveal-delay-3{transition-delay:0.24s}.reveal-delay-4{transition-delay:0.32s}

/* ── RESPONSIVE ── */
@media(max-width:1024px){
  .hero-inner{grid-template-columns:1fr;text-align:center}
  .hero-sub{margin:0 auto 2.2rem}.hero-actions{justify-content:center}.hero-trust{justify-content:center}.hero-visual{margin-top:3rem}
  .float-pill-1{left:-4%}.float-pill-2{right:-4%}
  .bento-a{grid-column:1/7}.bento-b{grid-column:7/10}.bento-c{grid-column:10/13}.bento-d{grid-column:1/6}.bento-e{grid-column:6/13}
  .solution-grid,.feat-grid{grid-template-columns:1fr}
  .steps-grid{grid-template-columns:repeat(2,1fr)}.why-inner{grid-template-columns:1fr}
  .testi-grid{grid-template-columns:1fr}.footer-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:768px){
  h1{font-size:2.1rem}
  .bento-a,.bento-b,.bento-c,.bento-d,.bento-e{grid-column:1/13}
  .metrics-grid{grid-template-columns:1fr 1fr}.nav-links{display:none}.nav-toggle{display:flex}
}
@media(max-width:480px){
  .cta-card{padding:2.8rem 1.4rem}.steps-grid{grid-template-columns:1fr}.footer-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>

<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>
<div class="bg-dots"></div>

<nav class="navbar" id="navbar">
  <a href="#" class="nav-brand">
    <svg class="nav-logo-svg" viewBox="0 0 28 28" fill="none">
      <defs><mask id="mn"><rect width="28" height="28" fill="white"/><circle cx="17.9" cy="14" r="7.9" fill="black"/></mask></defs>
      <circle cx="14" cy="14" r="13" fill="rgba(13,27,53,0.06)" stroke="rgba(13,27,53,0.15)" stroke-width="1"/>
      <circle cx="14" cy="14" r="10.6" fill="#0d1b35" mask="url(#mn)"/>
    </svg>
    <span class="nav-name">NOCTURA</span>
  </a>
  <ul class="nav-links" id="navLinks">
    <li><a href="#masalah">Masalah</a></li>
    <li><a href="#fitur">Fitur</a></li>
    <li><a href="#cara-kerja">Cara Kerja</a></li>
    <li><a href="#faq">FAQ</a></li>
    <li><a href="{{ route('login') }}" class="nav-cta">Login</a></li>
  </ul>
  <button class="nav-toggle" onclick="toggleNav()" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<section class="hero" id="home">
  <div class="hero-blob-1"></div>
  <div class="hero-blob-2"></div>
  <div class="hero-blob-3"></div>
  <div class="hero-inner container">
    <div>
      <div class="hero-eyebrow">
        <div class="eyebrow-badge">Sleep Intelligence Platform</div>
        <div class="eyebrow-line"></div>
      </div>
      <h1 class="hero-title">Kenali Risiko<br><span class="gradient-text">Gangguan Tidur</span><br>Lebih Awal.</h1>
      <p class="hero-sub">Deteksi dini insomnia, sleep apnea, dan gangguan tidur lainnya — langsung dari smartphone-mu. Gratis. Akurat. Berbasis riset medis.</p>
      <div class="hero-actions">
        <a href="#download" class="btn-primary">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M6 1L1 6h3v5h4V6h3L6 1z" fill="white"/></svg>
          Cek Risiko Tidurmu
        </a>
        <a href="#cara-kerja" class="btn-ghost">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2"/><path d="M4.5 4.5l3 1.5-3 1.5V4.5z" fill="currentColor"/></svg>
          Cara Kerja
        </a>
      </div>
      <div class="hero-trust">
        <div class="trust-avatars">
          <div class="trust-avatar">R</div><div class="trust-avatar">B</div>
          <div class="trust-avatar">D</div><div class="trust-avatar">A</div>
          <div class="trust-avatar">+</div>
        </div>
        <p class="trust-text"><strong>1.000+ pengguna</strong> sudah cek kualitas tidurnya</p>
      </div>
    </div>

    <div class="hero-visual">
      <!-- Floating Layer Badges -->
      <div class="float-pill float-pill-1">
        <div class="pill-icon pill-icon-green">✓</div>Prediksi Selesai
      </div>
      <div class="float-pill float-pill-2">
        <div class="pill-icon pill-icon-blue">🌙</div>Skor Tidur: 78/100
      </div>
      <div class="phone-shadow"></div>
      
      <!-- ── SLENDER SMARTPHONE FRAME ── -->
      <div class="phone-frame">
        <!-- Sticky Phone Status Bar -->
        <div class="phone-top-bar">
          <span>19.29</span>
          <div class="phone-island"><div class="phone-cam"></div></div>
          <div style="display:flex;gap:4px;align-items:center;">
            <span style="font-size:0.52rem;">📶</span><span style="font-size:0.52rem;">🔋</span><span>29%</span>
          </div>
        </div>

        <!-- Scrollable content area -->
        <div class="phone-scroll-container">
          <div class="phone-content">
            <!-- Top Profile Row -->
            <div class="ph-header">
              <div class="ph-user">
                <div class="ph-avatar">
                  <span class="ph-avatar-icon">👤</span>
                  <div class="ph-avatar-dot"></div>
                </div>
                <div>
                  <div class="ph-name">elisa</div>
                  <div class="ph-greet">Selamat malam</div>
                </div>
              </div>
              <div class="ph-actions-row">
                <div class="ph-btn-circle">🌙</div>
                <div class="ph-btn-circle active">🕒</div>
                <div class="ph-btn-circle">🔔<div class="ph-badge-dot"></div></div>
              </div>
            </div>

            <!-- Card 1: Tidur Semalam -->
            <div class="ph-sleep-card">
              <div class="ph-sleep-header">
                <div class="ph-sleep-label">🌙 TIDUR SEMALAM</div>
                <div class="ph-badge-exc"><span style="width:5px;height:5px;border-radius:50%;background:#6d28d9;display:inline-block;"></span> Excellent</div>
              </div>
              <div class="ph-sleep-dur">
                <span class="num">8</span><span class="unit">j</span><span class="num">0</span><span class="unit">m</span>
              </div>
              <div class="ph-sleep-time">22:00 - 06:00</div>
              <div class="ph-sleep-bar">
                <div class="ph-bar-1"></div>
                <div class="ph-bar-2"></div>
                <div class="ph-bar-3"></div>
                <div class="ph-bar-4"></div>
              </div>
              <div class="ph-sleep-legend">
                <div class="ph-leg"><div class="ph-leg-dot" style="background:#c084fc"></div>Ringan</div>
                <div class="ph-leg"><div class="ph-leg-dot" style="background:#818cf8"></div>Dalam</div>
                <div class="ph-leg"><div class="ph-leg-dot" style="background:#93c5fd"></div>REM</div>
              </div>
              <div class="ph-skor-row">
                <div>
                  <div class="ph-skor-label">Kualitas Skor</div>
                  <div class="ph-skor-val">96%</div>
                </div>
                <div class="ph-skor-bars">
                  <div class="ph-skor-bar" style="height:10px"></div>
                  <div class="ph-skor-bar" style="height:13px"></div>
                  <div class="ph-skor-bar" style="height:16px"></div>
                  <div class="ph-skor-bar on" style="height:19px"></div>
                  <div class="ph-skor-bar active-bar" style="height:22px"></div>
                </div>
              </div>
            </div>

            <!-- Card 2: Target Malam Ini -->
            <div class="ph-target-card">
              <div class="ph-target-icon">🏳</div>
              <div class="ph-target-info">
                <div class="ph-target-lbl">TARGET MALAM INI</div>
                <div class="ph-target-vals">
                  <span>22:30 → 06:30</span>
                  <span class="ph-target-badge">8j</span>
                </div>
              </div>
              <div class="ph-target-right">🕒 3j lagi</div>
            </div>

            <!-- Card 3: Mulai Prediksi -->
            <div class="ph-prediksi-blue">
              <div>
                <div class="ph-prediksi-title-large">Mulai Prediksi</div>
                <div class="ph-prediksi-sub-white">Analisis risiko tidur Anda</div>
              </div>
              <div class="ph-prediksi-btn-icon">🧠</div>
            </div>

            <!-- Menu Grid: Log Tidur & Edukasi -->
            <div class="ph-menu-grid">
              <div class="ph-menu-card purple">
                <div class="ph-card-circle-decor"></div>
                <div class="ph-menu-icon-wrap" style="color:#7c3aed;">✏️</div>
                <div>
                  <h4>Log Tidur</h4>
                  <span>› Catat manual</span>
                </div>
              </div>
              <div class="ph-menu-card green">
                <div class="ph-card-circle-decor"></div>
                <div class="ph-menu-icon-wrap" style="color:#16a34a;">📖</div>
                <div>
                  <h4>Edukasi</h4>
                  <span>› Info sehat</span>
                </div>
              </div>
            </div>

            <!-- Card 6: Insight Hari Ini -->
            <div class="ph-insight-card">
              <div class="ph-insight-header">
                <div class="ph-insight-lbl">💡 INSIGHT</div>
                <div class="ph-insight-badge">Sleep Apnea</div>
              </div>
              <div class="ph-insight-desc">
                Terdeteksi kemungkinan Sleep Apnea — gangguan pernapasan berulang saat tidur.
              </div>
            </div>
          </div>
        </div>

        <!-- Fixed Chat Bubble Above Scroll Layer -->
        <div class="ph-fab">💬</div>

        <!-- Fixed App Bottom Dock Nav -->
        <div class="ph-dock-container">
          <div class="ph-bottom-dock">
            <a href="#" class="ph-dock-item active">
              <div class="ph-dock-icon-box">🏠</div>
              <span>Home</span>
            </a>
            <a href="#" class="ph-dock-item">
              <div class="ph-dock-icon-box">🎯</div>
              <span>Prediksi</span>
            </a>
            <a href="#" class="ph-dock-item">
              <div class="ph-dock-icon-box">📊</div>
              <span>Visual</span>
            </a>
            <a href="#" class="ph-dock-item">
              <div class="ph-dock-icon-box">📚</div>
              <span>Edukasi</span>
            </a>
            <a href="#" class="ph-dock-item">
              <div class="ph-dock-icon-box">👤</div>
              <span>Profil</span>
            </a>
          </div>
        </div>

      </div>
      <!-- ── END OF PHONE MOCKUP ── -->
      
    </div>
  </div>
</section>

<div class="marquee-section">
  <div class="marquee-track">
    <div class="marquee-item"><span class="marquee-num">10%</span><span class="marquee-txt">Dewasa Indonesia alami insomnia</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">5 Menit</span><span class="marquee-txt">Waktu isi kuesioner</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">4 Jenis</span><span class="marquee-txt">Gangguan tidur terdeteksi</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">100% Gratis</span><span class="marquee-txt">Untuk semua fitur dasar</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">PSQI</span><span class="marquee-txt">Standar skrining medis tervalidasi</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">24/7</span><span class="marquee-txt">Akses kapan dan di mana saja</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">10%</span><span class="marquee-txt">Dewasa Indonesia alami insomnia</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">5 Menit</span><span class="marquee-txt">Waktu isi kuesioner</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">4 Jenis</span><span class="marquee-txt">Gangguan tidur terdeteksi</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">100% Gratis</span><span class="marquee-txt">Untuk semua fitur dasar</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">PSQI</span><span class="marquee-txt">Standar skrining medis tervalidasi</span><span class="marquee-sep"></span></div>
    <div class="marquee-item"><span class="marquee-num">24/7</span><span class="marquee-txt">Akses kapan dan di mana saja</span><span class="marquee-sep"></span></div>
  </div>
</div>

<section class="section-alt" id="masalah">
  <div class="container">
    <div class="section-header">
      <span class="tag reveal"><span class="tag-dot"></span>Mengapa Ini Penting</span>
      <h2 class="reveal">Gangguan Tidur Lebih Serius<br>dari yang <span class="gradient-text">Kamu Kira.</span></h2>
    </div>
    <div class="bento-grid reveal">
      <div class="bento-card bento-a">
        <div class="bento-icon icon-blue">📊</div>
        <h3>Prevalensi di Indonesia</h3>
        <p>Data menunjukkan gangguan tidur adalah masalah kesehatan publik yang diabaikan.</p>
        <div class="bento-chart" id="bentoChart">
          <div class="bento-bar-row"><div class="bento-bar-lbl">Insomnia</div><div class="bento-bar-track"><div class="bento-bar-fill fill-1" style="--w:67%"></div></div><div class="bento-bar-pct">67%</div></div>
          <div class="bento-bar-row"><div class="bento-bar-lbl">Sleep Apnea</div><div class="bento-bar-track"><div class="bento-bar-fill fill-2" style="--w:45%"></div></div><div class="bento-bar-pct">45%</div></div>
          <div class="bento-bar-row"><div class="bento-bar-lbl">Hypersomnia</div><div class="bento-bar-track"><div class="bento-bar-fill fill-3" style="--w:28%"></div></div><div class="bento-bar-pct">28%</div></div>
          <div class="bento-bar-row"><div class="bento-bar-lbl">Parasomnia</div><div class="bento-bar-track"><div class="bento-bar-fill fill-4" style="--w:18%"></div></div><div class="bento-bar-pct">18%</div></div>
        </div>
      </div>
      <div class="bento-card bento-b">
        <div class="bento-icon icon-navy">❤️</div>
        <div class="big-stat">3×</div>
        <h3>Risiko Penyakit</h3>
        <p>Kurang tidur meningkatkan risiko penyakit jantung & diabetes tipe 2 hingga 3 kali lipat.</p>
      </div>
      <div class="bento-card bento-c">
        <div class="bento-icon icon-light">⚡</div>
        <div class="big-stat">70%</div>
        <h3>Tidak Sadar</h3>
        <p>Penderita tidak menyadari bahwa mereka mengalami gangguan tidur yang serius.</p>
      </div>
      <div class="bento-card bento-d">
        <div class="bento-icon icon-blue">🧠</div>
        <h3>Produktivitas Turun</h3>
        <p>Gangguan tidur menyebabkan penurunan fokus, memori, dan kemampuan pengambilan keputusan yang signifikan.</p>
      </div>
      <div class="bento-card bento-e">
        <div class="bento-icon icon-navy">🔒</div>
        <h3>Akses Pemeriksaan Terbatas</h3>
        <p>Biaya sleep study yang mahal dan fasilitas yang terbatas membuat kebanyakan orang tidak pernah mendapat pemeriksaan yang tepat.</p>
        <div class="bento-note">💡 Hanya <strong>~30% penderita</strong> gangguan tidur yang mencari bantuan profesional akibat keterbatasan akses dan biaya di Indonesia.</div>
      </div>
    </div>
  </div>
</section>

<section class="section-light" id="solusi">
  <div class="container">
    <span class="tag reveal"><span class="tag-dot"></span>Solusi Kami</span>
    <h2 class="reveal">NOCTURA: Asisten Tidur <span class="gradient-text">Pribadi Kamu.</span></h2>
    <div class="solution-grid">
      <div class="sol-card card reveal">
        <div class="sol-num">01</div>
        <div class="bento-icon icon-blue" style="margin-bottom:1rem;">📱</div>
        <h3>Mudah Digunakan</h3>
        <p style="margin-top:0.45rem;">Tidak perlu perangkat khusus. Cukup smartphone-mu, kuesioner singkat, dan hasilnya langsung tersaji dalam hitungan detik.</p>
      </div>
      <div class="sol-card card reveal reveal-delay-1">
        <div class="sol-num">02</div>
        <div class="bento-icon icon-navy" style="margin-bottom:1rem;">🔬</div>
        <h3>Berbasis Riset Medis</h3>
        <p style="margin-top:0.45rem;">Kuesioner disusun berdasarkan standar skrining klinis tervalidasi Pittsburgh Sleep Quality Index (PSQI).</p>
      </div>
      <div class="sol-card card reveal reveal-delay-2">
        <div class="sol-num">03</div>
        <div class="bento-icon icon-light" style="margin-bottom:1rem;">🛡️</div>
        <h3>Privasi Terjaga</h3>
        <p style="margin-top:0.45rem;">Data kesehatanmu terenkripsi dan aman. Dikelola sesuai regulasi perlindungan data pribadi Indonesia.</p>
      </div>
    </div>
  </div>
</section>

<section class="section-alt" id="fitur">
  <div class="container">
    <span class="tag reveal"><span class="tag-dot"></span>Fitur Lengkap</span>
    <h2 class="reveal">Semua yang Kamu Butuhkan<br>untuk <span class="gradient-text">Tidur Lebih Baik.</span></h2>
    <div class="tab-row reveal">
      <button class="tab-btn active" onclick="switchTab('mobile',this)">📱 Mobile App</button>
      <button class="tab-btn" onclick="switchTab('web',this)">💻 Web Admin</button>
    </div>
    <div class="feat-grid" id="featMobile">
      <div class="feat-card card reveal"><div class="feat-icon icon-blue">🎯</div><div><h4>Prediksi Gangguan Tidur</h4><p style="margin-top:0.28rem;">Isi kuesioner singkat berbasis medis dan dapatkan hasil prediksi risiko gangguan tidur secara instan.</p></div></div>
      <div class="feat-card card reveal reveal-delay-1"><div class="feat-icon icon-navy">📈</div><div><h4>Riwayat & Tren Prediksi</h4><p style="margin-top:0.28rem;">Pantau perkembangan hasil prediksi dari waktu ke waktu dan pahami pola tidurmu.</p></div></div>
      <div class="feat-card card reveal reveal-delay-2"><div class="feat-icon icon-light">📊</div><div><h4>Visualisasi Data Tidur</h4><p style="margin-top:0.28rem;">Grafik interaktif yang mudah dipahami untuk memantau kualitas tidurmu setiap harinya.</p></div></div>
      <div class="feat-card card reveal reveal-delay-3"><div class="feat-icon icon-blue">📚</div><div><h4>Konten Edukasi Kuratif</h4><p style="margin-top:0.28rem;">Artikel, tips, dan informasi seputar kesehatan tidur untuk kebiasaan yang lebih baik.</p></div></div>
    </div>
    <div class="feat-grid" id="featWeb" style="display:none">
      <div class="feat-card card"><div class="feat-icon icon-blue">🗂️</div><div><h4>Manajemen Data Master</h4><p style="margin-top:0.28rem;">Kelola data pengguna, kuesioner, opsi jawaban, dan konten edukasi dari dashboard terpusat.</p></div></div>
      <div class="feat-card card"><div class="feat-icon icon-navy">📡</div><div><h4>Dashboard & Monitoring</h4><p style="margin-top:0.28rem;">Pantau hasil prediksi dan tren kesehatan tidur masyarakat secara agregat real-time.</p></div></div>
      <div class="feat-card card"><div class="feat-icon icon-light">👥</div><div><h4>Manajemen Pengguna</h4><p style="margin-top:0.28rem;">Kelola akun pengguna, pantau aktivitas, dan pastikan keamanan data seluruh platform.</p></div></div>
      <div class="feat-card card"><div class="feat-icon icon-blue">📥</div><div><h4>Laporan & Ekspor Data</h4><p style="margin-top:0.28rem;">Unduh laporan komprehensif untuk keperluan penelitian atau evaluasi layanan.</p></div></div>
    </div>
  </div>
</section>

<section class="section-light" id="cara-kerja">
  <div class="container">
    <span class="tag reveal"><span class="tag-dot"></span>Cara Kerja</span>
    <h2 class="reveal">Mulai dalam <span class="gradient-text">4 Langkah</span> Mudah.</h2>
    <div class="steps-grid">
      <div class="step-card reveal"><div class="step-num-badge">1</div><h4>Unduh Aplikasi</h4><p>Download NOCTURA gratis di Google Play atau App Store.</p><div class="step-connector"></div></div>
      <div class="step-card reveal reveal-delay-1"><div class="step-num-badge">2</div><h4>Jawab Kuesioner</h4><p>Isi pertanyaan singkat (5–10 menit) seputar kebiasaan tidurmu.</p><div class="step-connector"></div></div>
      <div class="step-card reveal reveal-delay-2"><div class="step-num-badge">3</div><h4>Dapatkan Hasil</h4><p>Terima prediksi risiko gangguan tidur beserta rekomendasi awal.</p><div class="step-connector"></div></div>
      <div class="step-card reveal reveal-delay-3"><div class="step-num-badge">4</div><h4>Pantau & Tingkatkan</h4><p>Lacak perkembangan dan baca konten edukasi untuk tidur lebih sehat.</p></div>
    </div>
  </div>
</section>

<section class="section-alt" id="kenapa">
  <div class="container">
    <div class="why-inner">
      <div>
        <span class="tag reveal"><span class="tag-dot"></span>Keunggulan Kami</span>
        <h2 class="reveal">Mengapa <span class="gradient-text">NOCTURA?</span></h2>
        <div class="why-list">
          <div class="why-item reveal"><div class="why-check">✓</div><div><h4>Akurat & Terpercaya</h4><p>Algoritma prediksi berbasis standar skrining medis yang tervalidasi secara klinis.</p></div></div>
          <div class="why-item reveal reveal-delay-1"><div class="why-check">⚡</div><div><h4>Cepat & Tanpa Ribet</h4><p>Hasil prediksi instan tanpa perlu buat janji dokter atau antrian panjang.</p></div></div>
          <div class="why-item reveal reveal-delay-2"><div class="why-check">📖</div><div><h4>Edukatif & Holistik</h4><p>Tidak hanya mendeteksi, tapi membekalimu dengan pengetahuan untuk tidur berkualitas.</p></div></div>
          <div class="why-item reveal reveal-delay-3"><div class="why-check">🔐</div><div><h4>Privasi & Keamanan Data</h4><p>Semua data kesehatan dienkripsi sesuai regulasi perlindungan data pribadi.</p></div></div>
        </div>
      </div>
      <div class="metrics-grid">
        <div class="metric-card card reveal"><span class="metric-emoji">😴</span><div class="metric-val">7–9 Jam</div><div class="metric-desc">Durasi tidur ideal orang dewasa per malam</div></div>
        <div class="metric-card card reveal reveal-delay-1"><span class="metric-emoji">⚡</span><div class="metric-val">&lt; 5 Mnt</div><div class="metric-desc">Rata-rata waktu penyelesaian kuesioner</div></div>
        <div class="metric-card card reveal reveal-delay-2"><span class="metric-emoji">🎯</span><div class="metric-val">PSQI</div><div class="metric-desc">Standar skrining kualitas tidur tervalidasi</div></div>
        <div class="metric-card card reveal reveal-delay-3"><span class="metric-emoji">🌙</span><div class="metric-val">24/7</div><div class="metric-desc">Akses kapan saja dan di mana saja</div></div>
      </div>
    </div>
  </div>
</section>

<section class="section-light" id="ulasan">
  <div class="container" style="text-align:center;">
    <span class="tag reveal"><span class="tag-dot"></span>Ulasan Pengguna</span>
    <h2 class="reveal">Mereka Sudah <span class="gradient-text">Merasakannya.</span></h2>
    <div class="testi-grid">
      <div class="testi-card reveal">
        <div class="testi-stars">★★★★★</div>
        <div class="testi-quote">"</div>
        <p class="testi-text">Aplikasinya simpel banget. Saya jadi tahu kalau kebiasaan begadang saya sudah masuk risiko insomnia ringan. Sekarang lebih disiplin tidur.</p>
        <div class="testi-author"><div class="testi-avatar">R</div><div><div class="testi-name">Rina Kusuma</div><div class="testi-role">Mahasiswi, 22 tahun</div></div></div>
      </div>
      <div class="testi-card reveal reveal-delay-1">
        <div class="testi-stars">★★★★★</div>
        <div class="testi-quote">"</div>
        <p class="testi-text">Saya tidak menyangka sering terbangun malam itu bisa jadi tanda sleep apnea. NOCTURA membantu saya sadar dan akhirnya konsultasi ke dokter.</p>
        <div class="testi-author"><div class="testi-avatar">B</div><div><div class="testi-name">Budi Santoso</div><div class="testi-role">Karyawan Swasta, 35 tahun</div></div></div>
      </div>
      <div class="testi-card reveal reveal-delay-2">
        <div class="testi-stars">★★★★☆</div>
        <div class="testi-quote">"</div>
        <p class="testi-text">Konten edukasinya sangat bermanfaat. Saya belajar banyak tentang sleep hygiene yang ternyata selama ini saya abaikan.</p>
        <div class="testi-author"><div class="testi-avatar">D</div><div><div class="testi-name">Dewi Rahayu</div><div class="testi-role">Ibu Rumah Tangga, 40 tahun</div></div></div>
      </div>
    </div>
  </div>
</section>

<section class="section-alt" id="faq">
  <div class="container" style="text-align:center;">
    <span class="tag reveal"><span class="tag-dot"></span>FAQ</span>
    <h2 class="reveal">Pertanyaan yang <span class="gradient-text">Sering Diajukan.</span></h2>
    <div class="faq-wrap">
      <div class="faq-grid reveal">
        <div class="faq-item"><button class="faq-q" onclick="toggleFaq(this)">Apakah NOCTURA menggantikan diagnosis dokter?<div class="faq-chevron"><svg width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M1.5 3L4.5 6L7.5 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></div></button><div class="faq-a"><p>Tidak. NOCTURA adalah alat skrining dini berbasis kuesioner. Hasil prediksi bukan diagnosis medis. Jika hasilnya menunjukkan risiko tinggi, sangat disarankan untuk berkonsultasi dengan dokter atau tenaga kesehatan.</p></div></div>
        <div class="faq-item"><button class="faq-q" onclick="toggleFaq(this)">Apakah aplikasi ini berbayar?<div class="faq-chevron"><svg width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M1.5 3L4.5 6L7.5 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></div></button><div class="faq-a"><p>NOCTURA sepenuhnya gratis untuk diunduh dan digunakan. Semua fitur dasar termasuk prediksi, riwayat, dan konten edukasi tersedia tanpa biaya.</p></div></div>
        <div class="faq-item"><button class="faq-q" onclick="toggleFaq(this)">Bagaimana keamanan data kesehatanku?<div class="faq-chevron"><svg width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M1.5 3L4.5 6L7.5 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></div></button><div class="faq-a"><p>Kami mengutamakan privasi pengguna. Semua data kesehatan dienkripsi menggunakan standar enkripsi terkini dan dikelola sesuai regulasi perlindungan data pribadi Indonesia.</p></div></div>
        <div class="faq-item"><button class="faq-q" onclick="toggleFaq(this)">Gangguan tidur apa saja yang bisa dideteksi?<div class="faq-chevron"><svg width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M1.5 3L4.5 6L7.5 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></div></button><div class="faq-a"><p>NOCTURA dapat mendeteksi risiko insomnia, sleep apnea, hypersomnia, dan parasomnia. Setiap hasil dilengkapi penjelasan dan rekomendasi awal yang sesuai.</p></div></div>
        <div class="faq-item"><button class="faq-q" onclick="toggleFaq(this)">Seberapa sering harus mengisi kuesioner?<div class="faq-chevron"><svg width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M1.5 3L4.5 6L7.5 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></div></button><div class="faq-a"><p>Disarankan minimal sebulan sekali atau setelah ada perubahan signifikan pada pola tidurmu. Fitur Riwayat membantu memantau tren dari waktu ke waktu.</p></div></div>
      </div>
    </div>
  </div>
</section>

<section class="section-light" id="download">
  <div class="container">
    <div class="cta-wrap">
      <div class="cta-card reveal">
        <span class="tag" style="margin-bottom:1.3rem;color:rgba(255,255,255,0.7);background:rgba(255,255,255,0.08);border-color:rgba(255,255,255,0.15);"><span class="tag-dot" style="background:rgba(255,255,255,0.7);"></span>Download Sekarang</span>
        <h2>Tidur Nyenyak Dimulai<br>dari <span class="gradient-text">Satu Langkah.</span></h2>
        <p style="margin-top:0.9rem;">Bergabunglah dengan ribuan pengguna yang sudah lebih peduli terhadap kualitas tidur mereka. Gratis, mudah, dan terpercaya.</p>
        <div class="store-btns">
          <a href="#" class="store-btn"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M11 2L4 8.5h3.5v8h7v-8H18L11 2z" stroke="white" stroke-width="1.4" stroke-linejoin="round"/></svg><div class="store-btn-txt"><small>Tersedia di</small><strong>Google Play</strong></div></a>
          <a href="#" class="store-btn"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M15 18c-1 1.4-2 2.8-3.2 2.8s-1.8-.75-3.2-.75S6.2 21 5 21C3.8 21 2.8 19.6 1.8 18c-1.8-2.8-2.8-6.5-1-9.2.9-1.8 2.7-2.8 4.5-2.8 1.4 0 2.3.75 3.2.75s1.8-.75 3.2-.75c1.6 0 3.2.9 4.1 2.3-3.2 1.8-2.7 6.4 0 7.3z" stroke="white" stroke-width="1.4" stroke-linejoin="round"/><path d="M12 2c-1.8 1.8-1.8 4.5 0 5.5" stroke="white" stroke-width="1.4" stroke-linecap="round"/></svg><div class="store-btn-txt"><small>Unduh di</small><strong>App Store</strong></div></a>
        </div>
        <p class="cta-disclaimer">⚠️ Hasil prediksi bukan diagnosis medis. Konsultasikan dengan dokter untuk pemeriksaan lebih lanjut.</p>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div style="display:flex;align-items:center;gap:0.6rem;">
          <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><defs><mask id="mf"><rect width="26" height="26" fill="white"/><circle cx="16.6" cy="13" r="7.3" fill="black"/></mask></defs><circle cx="13" cy="13" r="12" fill="rgba(255,255,255,0.05)" stroke="rgba(255,255,255,0.15)" stroke-width="1"/><circle cx="13" cy="13" r="9.8" fill="white" mask="url(#mf)"/></svg>
          <span class="footer-name-white" style="font-family:var(--font-display);font-size:0.95rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;">NOCTURA</span>
        </div>
        <p>Sistem Deteksi Dini Gangguan Tidur Berbasis Mobile. Membantu masyarakat Indonesia hidup lebih sehat melalui tidur yang berkualitas.</p>
        <div class="footer-socials">
          <a href="#" class="social-btn"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><rect x="1.5" y="1.5" width="9" height="9" rx="2.5" stroke="currentColor" stroke-width="1.1"/><circle cx="6" cy="6" r="2.1" stroke="currentColor" stroke-width="1.1"/><circle cx="9.2" cy="2.8" r="0.5" fill="currentColor"/></svg></a>
          <a href="#" class="social-btn"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M11 1.5H8.5L6 4.8 3.5 1.5H1L4.7 6.5 1 11H3.5L6 7.7 8.5 11H11L7.3 6.5 11 1.5Z" fill="currentColor"/></svg></a>
          <a href="#" class="social-btn"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><rect x="1" y="2.5" width="10" height="7" rx="1.1" stroke="currentColor" stroke-width="1.1"/><path d="M4.8 4.5l3.2 1.5-3.2 1.5V4.5z" fill="currentColor"/></svg></a>
        </div>
      </div>
      <div class="footer-col"><h5>Produk</h5><ul><li><a href="#fitur">Fitur Aplikasi</a></li><li><a href="#cara-kerja">Cara Kerja</a></li><li><a href="#download">Download</a></li><li><a href="#">Web Admin</a></li></ul></div>
      <div class="footer-col"><h5>Info</h5><ul><li><a href="#masalah">Gangguan Tidur</a></li><li><a href="#">Artikel Edukasi</a></li><li><a href="#faq">FAQ</a></li><li><a href="#">Tentang Kami</a></li></ul></div>
      <div class="footer-col"><h5>Legal</h5><ul><li><a href="#">Kebijakan Privasi</a></li><li><a href="#">Syarat Penggunaan</a></li><li><a href="#">Disclaimer Medis</a></li></ul></div>
    </div>
    <div class="footer-bottom">
      <p>© 2025 NOCTURA – Sleep Intelligence. Hak Cipta Dilindungi.</p>
      <p>Dibuat dengan ❤️ untuk tidur Indonesia · <a href="#">Kebijakan Privasi</a></p>
    </div>
  </div>
</footer>

<script>
// Cursor
const cursor=document.getElementById('cursor'),ring=document.getElementById('cursorRing');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;cursor.style.left=mx+'px';cursor.style.top=my+'px';});
function animRing(){rx+=(mx-rx)*0.12;ry+=(my-ry)*0.12;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(animRing);}
animRing();
document.querySelectorAll('a,button,.card,.bento-card,.feat-card,.step-card,.metric-card,.testi-card').forEach(el=>{
  el.addEventListener('mouseenter',()=>ring.classList.add('hovered'));
  el.addEventListener('mouseleave',()=>ring.classList.remove('hovered'));
});

// Scroll reveal
const obs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible');});
},{threshold:0.01,rootMargin:'0px 0px -20px 0px'});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));

// Bar chart animate on scroll
const barObs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{
    if(e.isIntersecting){
      e.target.querySelectorAll('.bento-bar-fill').forEach(b=>b.classList.add('animated'));
      barObs.unobserve(e.target);
    }
  });
},{threshold:0.3});
const bc=document.getElementById('bentoChart');
if(bc)barObs.observe(bc);

// Navbar scroll effect
window.addEventListener('scroll',()=>{
  document.getElementById('navbar').classList.toggle('scrolled',scrollY>60);
});

// FAQ accordion
function toggleFaq(btn){
  const item=btn.parentElement;
  const isOpen=item.classList.contains('open');
  document.querySelectorAll('.faq-item.open').forEach(i=>i.classList.remove('open'));
  if(!isOpen)item.classList.add('open');
}

// Feature tabs
function switchTab(tab,btn){
  document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('featMobile').style.display=tab==='mobile'?'grid':'none';
  document.getElementById('featWeb').style.display=tab==='web'?'grid':'none';
}

// Mobile nav toggle
function toggleNav(){
  const links=document.getElementById('navLinks');
  const open=links.style.display==='flex';
  if(open){links.style.display='none';return;}
  Object.assign(links.style,{ 
    display:'flex',flexDirection:'column',position:'absolute',
    top:'calc(100% + 10px)',left:'0',right:'0',
    background:'rgba(255,255,255,0.97)',backdropFilter:'blur(20px)',
    padding:'1.3rem 1.8rem',borderRadius:'18px',
    border:'1px solid rgba(13,27,53,0.1)',gap:'1.1rem',
    boxShadow:'0 20px 56px rgba(13,27,53,0.15)',zIndex:'999'
  });
}
document.querySelectorAll('#navLinks a').forEach(a=>a.addEventListener('click',()=>{
  if(window.innerWidth<=768)document.getElementById('navLinks').style.display='none';
}));
</script>
</body>
</html>