<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NOCTURA – Sleep Intelligence</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

/* ────────────────────────────────────────
   Google Fonts Import (Playfair Display + Inter)
   Letakkan di <head> HTML atau di sini dengan @import
──────────────────────────────────────── */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

/* ── VARIABLES & RESET ── */
:root {
  --navy: #050d2e;
  --navy-mid: #0c1a50;
  --navy-soft: #152380;
  --blue: #3a5ce8;
  --blue-light: #6b87f0;
  --blue-pale: #dde6ff;
  --white: #ffffff;
  --off: #f4f6ff;
  --text-900: #050d2e;
  --text-700: #2a3560;
  --text-500: #6270a0;
  --text-400: #8898c8;
  --green: #22c55e;
  --amber: #f59e0b;
  --danger: #ef4444;

  --radius-sm: 10px;
  --radius-md: 18px;
  --radius-lg: 28px;
  --radius-xl: 40px;

  --shadow-sm: 0 4px 16px rgba(5, 13, 46, 0.04);
  --shadow-md: 0 12px 40px rgba(5, 13, 46, 0.08);
  --shadow-lg: 0 24px 80px rgba(5, 13, 46, 0.12);
  --transition: 0.35s cubic-bezier(0.25, 0.8, 0.25, 1.2);
  --ease-out-expo: cubic-bezier(0.19, 1, 0.22, 1);
}

html {
  scroll-behavior: smooth;
  font-size: 16px;
}

body {
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
  color: var(--text-900);
  background: var(--white);
  line-height: 1.7;
  overflow-x: hidden;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  font-weight: 400;
}

/* ── TYPOGRAPHY ── */
h1, h2, h3, h4,
.nav-name, .stat-num, .step-num,
.metric-val, .footer-col h5,
.phone-brand, .section-tag {
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
  letter-spacing: 0em;
  font-weight: 700;
}

h1, h2, h3, h4 {
  line-height: 1.2;
}

h1 { font-size: clamp(2.4rem, 6vw, 3.8rem); }
h2 { font-size: clamp(1.8rem, 4vw, 2.8rem); }
h3 { font-size: 1.35rem; }
h4 { font-size: 1.05rem; }

p {
  color: var(--text-500);
  font-size: 1rem;
  line-height: 1.8;
  font-weight: 400;
}

em { font-style: italic; color: var(--blue); }
strong { font-weight: 600; color: var(--text-700); }
a { text-decoration: none; color: inherit; transition: color var(--transition); }

.max-w { max-width: 1200px; margin: 0 auto; padding: 0 5%; }

.section-tag {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.72rem;
  font-weight: 600;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--blue);
  background: rgba(58, 92, 232, 0.06);
  padding: 0.4rem 1rem;
  border-radius: 50px;
  border: 1px solid rgba(58, 92, 232, 0.15);
  margin-bottom: 1.2rem;
  backdrop-filter: blur(4px);
}

.section-title { color: var(--text-900); margin-bottom: 1.2rem; }
.section-sub {
  max-width: 560px;
  font-size: 1rem;
  line-height: 1.85;
  color: var(--text-500);
  font-weight: 400;
}

/* ── REVEAL ANIMATIONS ── */
.reveal {
  opacity: 0;
  transform: translateY(32px);
  transition: opacity 0.8s var(--ease-out-expo), transform 0.8s var(--ease-out-expo);
}
.reveal.visible {
  opacity: 1;
  transform: none;
}
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.2s; }
.reveal-delay-3 { transition-delay: 0.3s; }
.reveal-delay-4 { transition-delay: 0.4s; }

/* ────────────────────────────────────────
   NAVBAR
──────────────────────────────────────── */
.navbar {
  background: rgba(255, 255, 255, 0.85);
  backdrop-filter: blur(18px);
  -webkit-backdrop-filter: blur(18px);
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 1000;
  padding: 0.9rem 5%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  transition: background var(--transition), box-shadow var(--transition), padding var(--transition);
}

.navbar.scrolled {
  background: rgba(255, 255, 255, 0.96);
  box-shadow: 0 2px 24px rgba(5, 13, 46, 0.06), 0 0 0 1px rgba(58, 92, 232, 0.05);
  padding: 0.65rem 5%;
}

.nav-brand {
  display: flex;
  align-items: center;
  gap: 0.7rem;
  z-index: 2;
}

.nav-logo {
  width: 36px;
  height: 36px;
  flex-shrink: 0;
}

.nav-name {
  font-size: 1.3rem;
  font-weight: 700;
  letter-spacing: 0.1em;
  color: var(--navy);
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 2.2rem;
  list-style: none;
}

.nav-links a {
  font-size: 0.88rem;
  font-weight: 600;
  color: var(--text-700);
  position: relative;
  padding: 0.2rem 0;
  transition: color var(--transition);
}

.nav-links a::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 0;
  height: 2px;
  background: var(--blue);
  border-radius: 2px;
  transition: width var(--transition);
}

.nav-links a:hover {
  color: var(--blue);
}

.nav-links a:hover::after {
  width: 100%;
}

.nav-cta {
  background: var(--navy) !important;
  color: var(--white) !important;
  padding: 0.5rem 1.3rem !important;
  border-radius: 50px !important;
  font-size: 0.84rem !important;
  font-weight: 600 !important;
  transition: all var(--transition) !important;
  border: 1px solid transparent;
  letter-spacing: 0.02em;
}
.nav-cta::after { display: none !important; }
.nav-cta:hover {
  background: var(--blue) !important;
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(58, 92, 232, 0.35);
}

/* Hamburger */
.nav-toggle {
  display: none;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 6px;
  z-index: 3;
}
.nav-toggle span {
  display: block;
  width: 24px;
  height: 2.5px;
  background: var(--navy);
  border-radius: 3px;
  transition: var(--transition);
}

/* ────────────────────────────────────────
   HERO
──────────────────────────────────────── */
.hero {
  min-height: 100svh;
  background: var(--navy);
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  padding: 7rem 5% 5rem;
}

.hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse 75% 55% at 70% 35%, rgba(58,92,232,0.25) 0%, transparent 70%),
              radial-gradient(ellipse 50% 50% at 10% 80%, rgba(21,35,128,0.45) 0%, transparent 70%);
  pointer-events: none;
}

.hero-stars {
  position: absolute;
  inset: 0;
  pointer-events: none;
  overflow: hidden;
}

.star {
  position: absolute;
  background: rgba(255,255,255,0.7);
  border-radius: 50%;
  animation: twinkle var(--dur, 3s) var(--delay, 0s) infinite alternate;
}

@keyframes twinkle {
  0% { opacity: 0.15; transform: scale(0.7); }
  100% { opacity: 1; transform: scale(1.15); }
}

.hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4%;
  align-items: center;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.6rem;
  font-size: 0.72rem;
  font-weight: 600;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: rgba(221,230,255,0.9);
  background: rgba(58,92,232,0.25);
  padding: 0.4rem 1.1rem;
  border-radius: 50px;
  border: 1px solid rgba(58,92,232,0.4);
  margin-bottom: 1.6rem;
  animation: fadein 0.8s ease forwards;
  backdrop-filter: blur(6px);
}

.badge-dot {
  width: 7px; height: 7px;
  border-radius: 50%;
  background: var(--blue-light);
  box-shadow: 0 0 0 3px rgba(107,135,240,0.4);
  animation: pulse-dot 2s ease infinite;
}

@keyframes pulse-dot {
  0%, 100% { box-shadow: 0 0 0 3px rgba(107,135,240,0.4); }
  50% { box-shadow: 0 0 0 6px rgba(107,135,240,0); }
}

@keyframes fadein {
  from { opacity: 0; transform: translateY(14px); }
  to { opacity: 1; transform: none; }
}

.hero-title {
  color: var(--white);
  margin-bottom: 1.5rem;
  animation: fadein 0.9s 0.1s ease both;
  font-weight: 700;
  letter-spacing: 0;
}

.hero-sub {
  color: rgba(221,230,255,0.75);
  font-size: 1rem;
  max-width: 460px;
  animation: fadein 0.9s 0.2s ease both;
  font-weight: 400;
}

.hero-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-top: 2.2rem;
  animation: fadein 0.9s 0.3s ease both;
}

.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 0.7rem;
  background: var(--blue);
  color: var(--white);
  padding: 0.9rem 2rem;
  border-radius: 50px;
  font-size: 0.92rem;
  font-weight: 600;
  transition: all var(--transition);
  box-shadow: 0 8px 28px rgba(58,92,232,0.4);
  border: 1px solid transparent;
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
}
.btn-primary:hover {
  background: var(--blue-light);
  transform: translateY(-3px);
  box-shadow: 0 14px 38px rgba(58,92,232,0.5);
}

.btn-outline {
  display: inline-flex;
  align-items: center;
  gap: 0.7rem;
  border: 1px solid rgba(221,230,255,0.35);
  color: rgba(221,230,255,0.9);
  padding: 0.9rem 2rem;
  border-radius: 50px;
  font-size: 0.92rem;
  font-weight: 500;
  transition: all var(--transition);
  background: transparent;
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
}
.btn-outline:hover {
  border-color: rgba(221,230,255,0.8);
  color: var(--white);
  background: rgba(255,255,255,0.08);
  transform: translateY(-2px);
}

/* Phone mockup */
.hero-visual {
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  animation: fadein 1s 0.4s ease both;
}

.app-preview {
  position: relative;
  width: 100%;
  max-width: 360px;
}

.float-card {
  position: absolute;
  z-index: 10;
  background: rgba(255,255,255,0.95);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: var(--radius-md);
  padding: 0.7rem 1.2rem;
  font-size: 0.78rem;
  font-weight: 500;
  color: var(--text-700);
  display: flex;
  align-items: center;
  gap: 0.6rem;
  box-shadow: var(--shadow-md);
}
.float-card-1 { top: 10%; left: -12%; animation: float-y 4.5s ease infinite alternate; }
.float-card-2 { bottom: 18%; right: -10%; animation: float-y 5.5s 1s ease infinite alternate; }
.float-dot {
  width: 8px; height: 8px;
  border-radius: 50%;
  flex-shrink: 0;
}

@keyframes float-y {
  0% { transform: translateY(0); }
  100% { transform: translateY(-12px); }
}

.phone-shell {
  width: 230px;
  margin: 0 auto;
  background: linear-gradient(150deg, #0f1d6b, #071048);
  border-radius: 38px;
  border: 2px solid rgba(221,230,255,0.18);
  box-shadow: 0 40px 90px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.06) inset;
  overflow: hidden;
  position: relative;
}

.phone-notch {
  width: 85px;
  height: 24px;
  background: var(--navy);
  border-radius: 0 0 18px 18px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

.phone-screen-header {
  background: linear-gradient(160deg, var(--navy-soft), var(--navy));
  padding: 1rem 1.2rem 0.8rem;
  text-align: center;
}

.phone-moon-wrap svg {
  width: 44px;
  height: 44px;
  margin: 0 auto 0.4rem;
  display: block;
}

.phone-brand {
  color: var(--white);
  font-size: 0.92rem;
  font-weight: 700;
  letter-spacing: 0.12em;
}
.phone-brand-sub {
  color: rgba(221,230,255,0.6);
  font-size: 0.6rem;
  letter-spacing: 0.15em;
  margin-top: 0.15rem;
  font-weight: 400;
  text-transform: uppercase;
}

.phone-wave {
  height: 26px;
  background: linear-gradient(160deg, var(--navy-soft), var(--navy));
  clip-path: ellipse(100% 100% at 50% 0%);
  margin-top: -1px;
}

.phone-body {
  background: #f4f6ff;
  padding: 1rem 1.2rem 1.5rem;
}

.phone-greeting {
  font-size: 0.72rem;
  font-weight: 500;
  color: var(--text-700);
  margin-bottom: 0.9rem;
}

.phone-sleep-score {
  background: var(--white);
  border-radius: var(--radius-sm);
  padding: 0.9rem;
  display: flex;
  align-items: center;
  gap: 0.9rem;
  box-shadow: var(--shadow-sm);
  margin-bottom: 0.8rem;
}

.score-ring { width: 44px; height: 44px; flex-shrink: 0; }
.score-label { font-size: 0.62rem; color: var(--text-500); margin-bottom: 0.15rem; font-weight: 500; }
.score-val { font-size: 0.8rem; font-weight: 700; color: var(--text-700); }

.phone-mini-chart {
  background: var(--white);
  border-radius: var(--radius-sm);
  padding: 0.8rem;
  box-shadow: var(--shadow-sm);
  margin-bottom: 0.8rem;
}

.mini-chart-title { font-size: 0.6rem; color: var(--text-500); margin-bottom: 0.5rem; font-weight: 500; }
.mini-bars { display: flex; gap: 5px; align-items: flex-end; height: 38px; }
.mini-bar { flex: 1; background: #dde6ff; border-radius: 3px 3px 0 0; transition: height 0.4s ease; }
.mini-bar.active { background: var(--blue); }

.phone-tags { display: flex; gap: 0.45rem; flex-wrap: wrap; margin-top: 0.4rem; }
.phone-tag {
  font-size: 0.57rem;
  padding: 0.25rem 0.6rem;
  border-radius: 50px;
  background: rgba(58,92,232,0.1);
  color: var(--blue);
  font-weight: 500;
}

/* ────────────────────────────────────────
   STATS BAR
──────────────────────────────────────── */
.stats-bar {
  background: var(--off);
  border-top: 1px solid rgba(58,92,232,0.08);
  border-bottom: 1px solid rgba(58,92,232,0.08);
  padding: 3rem 5%;
}
.stats-inner {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2.5rem;
  max-width: 1200px;
  margin: 0 auto;
}
.stat { text-align: center; }
.stat-num {
  font-size: 2.1rem;
  font-weight: 700;
  color: var(--navy);
  line-height: 1;
  margin-bottom: 0.4rem;
  letter-spacing: 0;
}
.accent { color: var(--blue); }
.stat-label {
  font-size: 0.84rem;
  color: var(--text-500);
  line-height: 1.5;
  font-weight: 400;
}

/* ────────────────────────────────────────
   SECTION SHARED
──────────────────────────────────────── */
section { padding: 7rem 5%; }

/* ────────────────────────────────────────
   PAIN POINTS
──────────────────────────────────────── */
.pain { background: var(--white); }
.pain-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 5%;
  align-items: start;
  max-width: 1200px;
  margin: 0 auto;
}
.pain-cards { display: flex; flex-direction: column; gap: 1.1rem; margin-top: 2.2rem; }
.pain-card {
  background: var(--off);
  border: 1px solid rgba(58,92,232,0.08);
  border-radius: var(--radius-md);
  padding: 1.3rem 1.5rem;
  display: flex;
  gap: 1.2rem;
  align-items: flex-start;
  transition: all var(--transition);
}
.pain-card:hover {
  box-shadow: var(--shadow-md);
  transform: translateX(6px);
  border-color: rgba(58,92,232,0.15);
}
.pain-icon {
  width: 44px; height: 44px;
  border-radius: 14px;
  background: rgba(58,92,232,0.08);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.pain-card h4 {
  font-size: 0.97rem;
  font-weight: 600;
  margin-bottom: 0.3rem;
  color: var(--text-900);
}
.pain-card p { font-size: 0.88rem; margin: 0; }

.data-card {
  background: var(--navy);
  border-radius: var(--radius-lg);
  padding: 2.4rem;
  box-shadow: var(--shadow-lg);
  position: relative;
  overflow: hidden;
}
.data-card::before {
  content: '';
  position: absolute;
  top: -40%; right: -20%;
  width: 320px; height: 320px;
  border-radius: 50%;
  background: radial-gradient(rgba(58,92,232,0.35), transparent 70%);
  pointer-events: none;
}
.data-title {
  color: rgba(255,255,255,0.75);
  font-size: 0.82rem;
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  margin-bottom: 1.8rem;
}
.bar-chart { display: flex; flex-direction: column; gap: 1.2rem; }
.bar-row { display: flex; align-items: center; gap: 0.9rem; }
.bar-lbl { width: 95px; font-size: 0.82rem; color: rgba(221,230,255,0.85); flex-shrink: 0; font-weight: 400; }
.bar-track { flex: 1; height: 8px; background: rgba(255,255,255,0.08); border-radius: 4px; overflow: hidden; }
.bar-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--blue), var(--blue-light));
  border-radius: 4px;
  width: 0;
  transition: width 1.4s var(--ease-out-expo);
}
.bar-fill.animated { width: var(--w); }
.bar-pct { font-size: 0.82rem; color: var(--blue-light); font-weight: 700; width: 32px; text-align: right; }
.data-note {
  margin-top: 1.8rem;
  padding: 1.1rem;
  background: rgba(58,92,232,0.18);
  border-radius: var(--radius-sm);
  border-left: 4px solid var(--blue-light);
  font-size: 0.84rem;
  color: rgba(221,230,255,0.8);
  line-height: 1.7;
  font-weight: 400;
}

/* ────────────────────────────────────────
   SOLUTION
──────────────────────────────────────── */
.solution {
  background: linear-gradient(160deg, var(--navy) 0%, var(--navy-mid) 100%);
  position: relative;
  overflow: hidden;
}
.solution::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse 65% 65% at 100% 50%, rgba(58,92,232,0.18) 0%, transparent 70%);
  pointer-events: none;
}
.solution .section-tag { color: var(--blue-light); background: rgba(107,135,240,0.18); border-color: rgba(107,135,240,0.25); }
.solution .section-title { color: var(--white); text-align: center; }
.solution .section-sub { color: rgba(221,230,255,0.65); text-align: center; margin: 0 auto 3.5rem; }
.solution-cards {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.8rem;
  max-width: 1200px;
  margin: 0 auto;
}
.sol-card {
  background: rgba(255,255,255,0.06);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(221,230,255,0.1);
  border-radius: var(--radius-lg);
  padding: 2.2rem;
  transition: all var(--transition);
}
.sol-card:hover {
  background: rgba(255,255,255,0.1);
  transform: translateY(-6px);
  border-color: rgba(107,135,240,0.3);
}
.sol-icon {
  width: 52px; height: 52px;
  border-radius: 16px;
  background: rgba(58,92,232,0.3);
  border: 1px solid rgba(58,92,232,0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.4rem;
}
.sol-card h3 {
  color: var(--white);
  font-size: 1.05rem;
  font-weight: 700;
  margin-bottom: 0.7rem;
}
.sol-card p { color: rgba(221,230,255,0.65); font-size: 0.88rem; margin: 0; font-weight: 400; }

/* ────────────────────────────────────────
   SHOWCASE
──────────────────────────────────────── */
.showcase { background: var(--off); padding: 7rem 5%; }
.showcase-inner {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 6%;
  align-items: center;
}
.screens-wrap { position: relative; height: 440px; }
.screen-card {
  position: absolute;
  background: var(--white);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-md);
  border: 1px solid rgba(58,92,232,0.1);
  padding: 1.2rem 1.4rem;
  font-size: 0.72rem;
  transition: all var(--transition);
}
.screen-card-1 { width: 210px; top: 0; left: 5%; z-index: 3; animation: float-y 5.5s ease infinite alternate; }
.screen-card-2 { width: 200px; top: 42%; left: 32%; z-index: 2; animation: float-y 6.5s 1.5s ease infinite alternate; }
.screen-card-3 { width: 210px; bottom: 0; left: 12%; z-index: 1; animation: float-y 5s 0.5s ease infinite alternate; }
.sc-header { display: flex; align-items: center; gap: 0.7rem; margin-bottom: 1rem; }
.sc-icon-wrap {
  width: 26px; height: 26px;
  border-radius: 8px;
  background: var(--navy);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.sc-title { font-weight: 700; color: var(--text-700); font-size: 0.75rem; }
.sc-sub { color: var(--text-400); font-size: 0.62rem; margin-top: 0.1rem; font-weight: 400; }
.sc-score-ring-wrap { display: flex; justify-content: center; margin-bottom: 0.9rem; }
.sc-bars { display: flex; flex-direction: column; gap: 0.6rem; }
.sc-bar-row { display: flex; align-items: center; gap: 0.5rem; }
.sc-bar-lbl { width: 75px; font-size: 0.62rem; color: var(--text-500); font-weight: 400; }
.sc-bar-track { flex: 1; height: 5px; background: var(--off); border-radius: 3px; overflow: hidden; }
.sc-bar-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--blue), var(--blue-light));
  border-radius: 3px;
  transition: width 1.4s ease;
}
.sc-article { display: flex; flex-direction: column; gap: 0.7rem; }
.sc-article-item { display: flex; gap: 0.7rem; align-items: flex-start; }
.sc-article-thumb { width: 36px; height: 36px; border-radius: 10px; background: #dde6ff; flex-shrink: 0; }
.sc-article-t { font-size: 0.62rem; font-weight: 700; color: var(--text-700); line-height: 1.4; }
.sc-article-s { font-size: 0.57rem; color: var(--text-400); margin-top: 0.2rem; font-weight: 400; }

.why-item { display: flex; gap: 1.2rem; align-items: flex-start; }
.why-bullet {
  width: 32px; height: 32px;
  border-radius: 50%;
  background: rgba(58,92,232,0.08);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  margin-top: 0.2rem;
}
.why-item h4 {
  font-size: 0.97rem;
  font-weight: 600;
  margin-bottom: 0.25rem;
  color: var(--text-900);
}
.why-item p { font-size: 0.88rem; margin: 0; font-weight: 400; }

/* ────────────────────────────────────────
   FEATURES
──────────────────────────────────────── */
.features { background: var(--white); }
.features-header {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  max-width: 1200px;
  margin: 0 auto 3.5rem;
}
.tab-switcher {
  display: inline-flex;
  background: var(--off);
  border-radius: 60px;
  padding: 5px;
  border: 1px solid rgba(58,92,232,0.1);
}
.tab-btn {
  background: none;
  border: none;
  cursor: pointer;
  padding: 0.6rem 1.5rem;
  border-radius: 60px;
  font-size: 0.88rem;
  color: var(--text-500);
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
  font-weight: 500;
  transition: all var(--transition);
}
.tab-btn.active {
  background: var(--white);
  color: var(--navy);
  font-weight: 700;
  box-shadow: var(--shadow-sm);
}
.features-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.8rem;
  max-width: 1200px;
  margin: 0 auto;
}
.feat-card {
  background: var(--off);
  border: 1px solid rgba(58,92,232,0.06);
  border-radius: var(--radius-lg);
  padding: 1.8rem;
  display: flex;
  gap: 1.3rem;
  align-items: flex-start;
  transition: all var(--transition);
}
.feat-card:hover {
  box-shadow: var(--shadow-md);
  transform: translateY(-4px);
  background: var(--white);
  border-color: rgba(58,92,232,0.12);
}
.feat-icon {
  width: 48px; height: 48px;
  border-radius: 14px;
  background: rgba(58,92,232,0.08);
  border: 1px solid rgba(58,92,232,0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.feat-content h4 {
  font-size: 0.97rem;
  font-weight: 600;
  margin-bottom: 0.4rem;
  color: var(--text-900);
}
.feat-content p { font-size: 0.88rem; margin: 0; line-height: 1.75; font-weight: 400; }

/* ────────────────────────────────────────
   HOW IT WORKS
──────────────────────────────────────── */
.how {
  background: var(--navy);
  position: relative;
  overflow: hidden;
}
.how::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse 70% 50% at 20% 50%, rgba(21,35,128,0.7) 0%, transparent 70%);
  pointer-events: none;
}
.how .max-w { text-align: center; }
.how .section-tag { color: var(--blue-light); background: rgba(107,135,240,0.18); border-color: rgba(107,135,240,0.25); }
.how .section-title { color: var(--white); margin-bottom: 1rem; }
.how .section-sub { color: rgba(221,230,255,0.65); margin: 0 auto 4rem; }

.steps {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
}
.steps::before {
  content: '';
  position: absolute;
  top: 30px;
  left: calc(12.5% + 16px);
  width: calc(75% - 32px);
  height: 1px;
  background: linear-gradient(90deg, rgba(58,92,232,0.5), rgba(107,135,240,0.7), rgba(58,92,232,0.5));
  z-index: 0;
}
.step {
  background: rgba(255,255,255,0.06);
  backdrop-filter: blur(8px);
  border: 1px solid rgba(221,230,255,0.12);
  border-radius: var(--radius-lg);
  padding: 2.2rem 1.5rem;
  text-align: center;
  position: relative;
  z-index: 1;
  transition: all var(--transition);
}
.step:hover {
  background: rgba(255,255,255,0.12);
  transform: translateY(-6px);
}
.step-num {
  width: 58px; height: 58px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--navy-soft), var(--blue));
  border: 2px solid rgba(107,135,240,0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.3rem;
  font-weight: 700;
  color: var(--white);
  margin: 0 auto 1.4rem;
  position: relative;
  z-index: 1;
  box-shadow: 0 0 0 8px rgba(58,92,232,0.18);
}
.step h4 {
  color: var(--white);
  font-size: 0.97rem;
  font-weight: 600;
  margin-bottom: 0.6rem;
}
.step p { color: rgba(221,230,255,0.65); font-size: 0.86rem; margin: 0; font-weight: 400; }

/* ────────────────────────────────────────
   WHY NOCTURA
──────────────────────────────────────── */
.why { background: var(--off); }
.why-inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 6%;
  max-width: 1200px;
  margin: 0 auto;
  align-items: center;
}
.why-list { display: flex; flex-direction: column; gap: 1.4rem; margin-top: 2.2rem; }
.why-visual { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
.metric-card {
  background: var(--white);
  border: 1px solid rgba(58,92,232,0.08);
  border-radius: var(--radius-lg);
  padding: 1.6rem 1.3rem;
  transition: all var(--transition);
}
.metric-card:hover {
  box-shadow: var(--shadow-md);
  transform: translateY(-4px);
}
.metric-emoji { font-size: 1.8rem; margin-bottom: 0.7rem; display: block; line-height: 1; }
.metric-val {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--navy);
  letter-spacing: 0;
  display: block;
  line-height: 1.2;
  margin-bottom: 0.4rem;
}
.metric-val span {
  display: block;
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
  font-size: 0.78rem;
  font-weight: 400;
  color: var(--text-500);
  margin-top: 0.4rem;
  line-height: 1.5;
}

/* ────────────────────────────────────────
   TESTIMONIALS
──────────────────────────────────────── */
.testimonials { background: var(--white); }
.testimonials .max-w { text-align: center; }
.testi-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.8rem;
  max-width: 1200px;
  margin: 3.5rem auto 0;
}
.testi-card {
  background: var(--off);
  border: 1px solid rgba(58,92,232,0.08);
  border-radius: var(--radius-lg);
  padding: 2rem;
  text-align: left;
  transition: all var(--transition);
}
.testi-card:hover {
  box-shadow: var(--shadow-md);
  transform: translateY(-5px);
  border-color: rgba(58,92,232,0.15);
}
.testi-stars { color: var(--amber); font-size: 1rem; letter-spacing: 0.1em; margin-bottom: 1rem; }
.testi-text {
  font-size: 0.9rem;
  line-height: 1.8;
  margin-bottom: 1.5rem;
  color: var(--text-700);
  font-style: italic;
  font-weight: 400;
}
.testi-author { display: flex; align-items: center; gap: 0.8rem; }
.testi-avatar {
  width: 42px; height: 42px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--navy-soft), var(--blue));
  color: var(--white);
  font-size: 0.88rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.testi-name { font-weight: 700; font-size: 0.88rem; color: var(--text-700); }
.testi-role { font-size: 0.76rem; color: var(--text-400); margin-top: 0.15rem; font-weight: 400; }

/* ────────────────────────────────────────
   FAQ
──────────────────────────────────────── */
.faq { background: var(--off); }
.faq-inner {
  display: grid;
  grid-template-columns: 1fr 1.6fr;
  gap: 5%;
  max-width: 1200px;
  margin: 0 auto;
  align-items: start;
}
.faq-list { display: flex; flex-direction: column; gap: 0.6rem; }
.faq-item {
  background: var(--white);
  border-radius: var(--radius-md);
  border: 1px solid rgba(58,92,232,0.08);
  overflow: hidden;
  transition: box-shadow var(--transition);
}
.faq-item:hover { box-shadow: var(--shadow-sm); }
.faq-q {
  width: 100%;
  background: none;
  border: none;
  cursor: pointer;
  padding: 1.2rem 1.5rem;
  text-align: left;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
  font-size: 0.92rem;
  font-weight: 600;
  color: var(--text-700);
  transition: color var(--transition);
}
.faq-q:hover { color: var(--blue); }
.faq-chevron {
  width: 24px; height: 24px;
  border-radius: 50%;
  background: var(--off);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: transform 0.3s ease;
}
.faq-chevron svg { width: 12px; height: 12px; }
.faq-a { max-height: 0; overflow: hidden; transition: max-height 0.45s var(--ease-out-expo); }
.faq-a p { padding: 0 1.5rem 1.2rem; font-size: 0.88rem; color: var(--text-500); margin: 0; font-weight: 400; }
.faq-item.open .faq-chevron { transform: rotate(180deg); }
.faq-item.open .faq-a { max-height: 240px; }

/* ────────────────────────────────────────
   CTA
──────────────────────────────────────── */
.cta-section {
  background: linear-gradient(145deg, var(--navy-mid), var(--navy));
  padding: 8rem 5%;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.cta-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse 60% 80% at 50% 50%, rgba(58,92,232,0.25) 0%, transparent 70%);
  pointer-events: none;
}
.cta-inner { position: relative; z-index: 1; max-width: 640px; margin: 0 auto; }
.cta-section .section-tag { color: var(--blue-light); background: rgba(107,135,240,0.18); border-color: rgba(107,135,240,0.25); }
.cta-section .section-title { color: var(--white); margin-bottom: 1.2rem; }
.cta-section .section-sub { color: rgba(221,230,255,0.7); margin: 0 auto 2.8rem; max-width: 440px; }
.store-btns { display: flex; gap: 1.2rem; justify-content: center; flex-wrap: wrap; margin-bottom: 2.2rem; }
.store-btn {
  display: flex;
  align-items: center;
  gap: 0.9rem;
  background: rgba(255,255,255,0.1);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.2);
  border-radius: var(--radius-md);
  padding: 0.9rem 1.8rem;
  color: var(--white);
  transition: all var(--transition);
}
.store-btn:hover {
  background: rgba(255,255,255,0.2);
  transform: translateY(-3px);
  border-color: rgba(255,255,255,0.45);
}
.store-btn-text small {
  display: block;
  font-size: 0.7rem;
  color: rgba(255,255,255,0.65);
  margin-bottom: 0.1rem;
  font-weight: 400;
}
.store-btn-text strong {
  display: block;
  font-size: 0.98rem;
  font-weight: 700;
}
.cta-disclaimer {
  font-size: 0.78rem;
  color: rgba(221,230,255,0.45);
  line-height: 1.7;
  max-width: 420px;
  margin: 0 auto;
  font-weight: 400;
}

/* ────────────────────────────────────────
   FOOTER
──────────────────────────────────────── */
footer {
  background: var(--navy);
  color: rgba(221,230,255,0.75);
  padding: 5.5rem 5% 2.5rem;
}
.footer-inner {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 3.5rem;
  max-width: 1200px;
  margin: 0 auto;
  padding-bottom: 3.5rem;
  border-bottom: 1px solid rgba(255,255,255,0.08);
}
.footer-brand p {
  font-size: 0.88rem;
  line-height: 1.8;
  color: rgba(221,230,255,0.55);
  max-width: 280px;
  margin-top: 1.2rem;
  font-weight: 400;
}
.footer-socials { display: flex; gap: 0.8rem; margin-top: 1.8rem; }
.social-btn {
  width: 36px; height: 36px;
  border-radius: 50%;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.12);
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(221,230,255,0.65);
  transition: all var(--transition);
}
.social-btn:hover {
  background: var(--blue);
  color: var(--white);
  border-color: var(--blue);
  transform: translateY(-2px);
}
.footer-col h5 {
  font-size: 0.97rem;
  font-weight: 700;
  color: var(--white);
  letter-spacing: 0;
  margin-bottom: 1.3rem;
}
.footer-col ul { list-style: none; }
.footer-col ul li { margin-bottom: 0.75rem; }
.footer-col ul a {
  font-size: 0.86rem;
  color: rgba(221,230,255,0.55);
  transition: color var(--transition);
  font-weight: 400;
}
.footer-col ul a:hover { color: var(--blue-light); }
.footer-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
  max-width: 1200px;
  margin: 2.5rem auto 0;
  font-size: 0.8rem;
  color: rgba(221,230,255,0.4);
  font-weight: 400;
}
.footer-bottom a { color: rgba(221,230,255,0.55); transition: color var(--transition); }
.footer-bottom a:hover { color: var(--blue-light); }

/* ────────────────────────────────────────
   RESPONSIVE
──────────────────────────────────────── */
@media (max-width: 1024px) {
  .hero-inner { grid-template-columns: 1fr; text-align: center; }
  .hero-sub, .hero-actions { margin-left: auto; margin-right: auto; }
  .hero-actions { justify-content: center; }
  .hero-visual { justify-content: center; margin-top: 3.5rem; }
  .stats-inner { grid-template-columns: repeat(2, 1fr); }
  .pain-grid { grid-template-columns: 1fr; }
  .solution-cards { grid-template-columns: 1fr; }
  .showcase-inner { grid-template-columns: 1fr; }
  .screens-wrap { order: 2; height: 300px; }
  .features-header { grid-template-columns: 1fr; }
  .features-grid { grid-template-columns: 1fr; }
  .steps { grid-template-columns: repeat(2, 1fr); }
  .steps::before { display: none; }
  .why-inner { grid-template-columns: 1fr; }
  .testi-grid { grid-template-columns: 1fr; }
  .faq-inner { grid-template-columns: 1fr; }
  .footer-inner { grid-template-columns: 1fr 1fr; gap: 2.5rem; }
}

@media (max-width: 640px) {
  .stats-inner { grid-template-columns: 1fr 1fr; gap: 2rem; }
  .steps { grid-template-columns: 1fr; }
  .why-visual { grid-template-columns: 1fr 1fr; }
  .store-btns { flex-direction: column; align-items: center; }
  .footer-inner { grid-template-columns: 1fr; }
  .nav-links { display: none; }
  .nav-toggle { display: flex; }
}
</style>
</head>
<body>

<!-- ══════════ NAVBAR ══════════ -->
<nav class="navbar" id="navbar">
  <a href="#" class="nav-brand">
    <svg class="nav-logo" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
      <defs><mask id="m-nav"><rect width="36" height="36" fill="white"/><circle cx="23.06" cy="18" r="10.12" fill="black"/></mask></defs>
      <circle cx="18" cy="18" r="17" fill="#050d2e" stroke="#dde6ff" stroke-width="1.2"/>
      <circle cx="18" cy="18" r="13.68" fill="white" mask="url(#m-nav)"/>
    </svg>
    <span class="nav-name">NOCTURA</span>
  </a>
  <ul class="nav-links" id="navLinks">
    <li><a href="#fitur">Fitur</a></li>
    <li><a href="#cara-kerja">Cara Kerja</a></li>
    <li><a href="#kenapa">Keunggulan</a></li>
    <li><a href="#faq">FAQ</a></li>
    <li><a href="#login" class="nav-cta">Login</a></li>
  </ul>
  <button class="nav-toggle" onclick="toggleNav()" aria-label="Buka menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- ══════════ HERO ══════════ -->
<section class="hero" id="home">
  <div class="hero-stars" id="heroStars"></div>
  <div class="hero-inner">
    <div class="hero-content">
      <div class="hero-badge"><span class="badge-dot"></span>Sleep Intelligence Platform</div>
      <h1 class="hero-title">Kenali Risiko<br><em>Gangguan Tidur</em><br>Lebih Dini</h1>
      <p class="hero-sub">Aplikasi mobile berbasis data untuk memprediksi potensi insomnia, sleep apnea, dan gangguan tidur lainnya — mudah, cepat, dan gratis langsung dari smartphone Anda.</p>
      <div class="hero-actions">
        <a href="#download" class="btn-primary">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 2C4.7 2 2 4.7 2 8s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6zm0 10.5c-2.5 0-4.5-2-4.5-4.5S5.5 3.5 8 3.5c.8 0 1.5.2 2.2.6C8.7 4.5 7.5 6.1 7.5 8s1.2 3.5 2.7 3.9c-.7.4-1.4.6-2.2.6z" fill="white"/></svg>
          Cek Resiko Tidur Anda
        </a>
        <a href="#cara-kerja" class="btn-outline">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M5 3l5 4-5 4V3z" fill="currentColor"/></svg>
          Lihat Cara Kerja
        </a>
      </div>
    </div>
    <div class="hero-visual">
      <div class="app-preview">
        <div class="float-card float-card-1"><span class="float-dot" style="background:#22c55e"></span>Prediksi Selesai ✓</div>
        <div class="float-card float-card-2"><span class="float-dot" style="background:#3a5ce8"></span>Skor Tidur: 78/100</div>
        <div class="phone-shell">
          <div class="phone-notch"></div>
          <div class="phone-screen-header">
            <div class="phone-moon-wrap">
              <svg viewBox="0 0 54 54" fill="none">
                <defs><mask id="m-phone"><rect width="54" height="54" fill="white"/><circle cx="34.59" cy="27" r="15.18" fill="black"/></mask></defs>
                <circle cx="27" cy="27" r="25.5" fill="rgba(255,255,255,.07)" stroke="rgba(255,255,255,.18)" stroke-width="1.5"/>
                <circle cx="27" cy="27" r="20.52" fill="white" mask="url(#m-phone)"/>
              </svg>
            </div>
            <div class="phone-brand">NOCTURA</div>
            <div class="phone-brand-sub">Sleep Intelligence</div>
          </div>
          <div class="phone-wave"></div>
          <div class="phone-body">
            <div class="phone-greeting">Selamat pagi, Budi 👋</div>
            <div class="phone-sleep-score">
              <svg class="score-ring" viewBox="0 0 42 42" fill="none">
                <circle cx="21" cy="21" r="17" stroke="#dde6ff" stroke-width="3.5"/>
                <circle cx="21" cy="21" r="17" stroke="url(#sg)" stroke-width="3.5" stroke-dasharray="81 26" stroke-dashoffset="27" stroke-linecap="round"/>
                <defs><linearGradient id="sg" x1="0" y1="0" x2="1" y2="0"><stop offset="0%" stop-color="#152591"/><stop offset="100%" stop-color="#3a5ce8"/></linearGradient></defs>
                <text x="21" y="25" text-anchor="middle" font-size="10" font-weight="700" fill="#050d2e">78</text>
              </svg>
              <div><div class="score-label">Skor Tidur</div><div class="score-val">Cukup Baik</div></div>
            </div>
            <div class="phone-mini-chart">
              <div class="mini-chart-title">Tren 7 Hari Terakhir</div>
              <div class="mini-bars">
                <div class="mini-bar" style="height:55%"></div>
                <div class="mini-bar" style="height:70%"></div>
                <div class="mini-bar" style="height:50%"></div>
                <div class="mini-bar active" style="height:85%"></div>
                <div class="mini-bar" style="height:65%"></div>
                <div class="mini-bar active" style="height:90%"></div>
                <div class="mini-bar active" style="height:78%"></div>
              </div>
            </div>
            <div class="phone-tags">
              <span class="phone-tag">Insomnia</span>
              <span class="phone-tag">Risiko Rendah</span>
              <span class="phone-tag">Update Minggu</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ STATS BAR ══════════ -->
<div class="stats-bar">
  <div class="stats-inner">
    <div class="stat reveal"><div class="stat-num"><span class="accent">10%</span></div><div class="stat-label">Dewasa Indonesia alami insomnia</div></div>
    <div class="stat reveal reveal-delay-1"><div class="stat-num"><span class="accent">5–10</span></div><div class="stat-label">Menit untuk isi kuesioner</div></div>
    <div class="stat reveal reveal-delay-2"><div class="stat-num"><span class="accent">4</span></div><div class="stat-label">Jenis gangguan tidur terdeteksi</div></div>
    <div class="stat reveal reveal-delay-3"><div class="stat-num"><span class="accent">100%</span></div><div class="stat-label">Gratis diunduh &amp; digunakan</div></div>
  </div>
</div>

<!-- ══════════ PAIN POINTS ══════════ -->
<section class="pain" id="masalah">
  <div class="max-w">
    <div class="pain-grid">
      <div>
        <span class="section-tag reveal">Mengapa Ini Penting</span>
        <h2 class="section-title reveal">Gangguan Tidur<br>Lebih Serius dari<br>yang Anda Kira</h2>
        <p class="section-sub reveal">Jutaan orang meremehkan kualitas tidur mereka — padahal dampaknya jauh lebih luas dari sekadar rasa lelah di pagi hari.</p>
        <div class="pain-cards">
          <div class="pain-card reveal">
            <div class="pain-icon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 2C5.6 2 2 5.6 2 10s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 3c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm0 9c-2 0-3.7-1-4.7-2.5.1-1.5 3.2-2.4 4.7-2.4s4.6.9 4.7 2.4c-1 1.5-2.7 2.5-4.7 2.5z" fill="#3a5ce8"/></svg></div>
            <div><h4>Risiko Penyakit Serius</h4><p>Kurang tidur berkualitas meningkatkan risiko penyakit jantung, diabetes tipe 2, dan gangguan mental hingga 3× lipat.</p></div>
          </div>
          <div class="pain-card reveal reveal-delay-1">
            <div class="pain-icon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"><ellipse cx="10" cy="8" rx="6" ry="6" stroke="#3a5ce8" stroke-width="1.5"/><path d="M10 14v4M7 18h6" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div>
            <div><h4>Penurunan Produktivitas</h4><p>Gangguan tidur menyebabkan penurunan fokus, memori, dan kemampuan pengambilan keputusan yang signifikan.</p></div>
          </div>
          <div class="pain-card reveal reveal-delay-2">
            <div class="pain-icon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="3" y="4" width="14" height="12" rx="2" stroke="#3a5ce8" stroke-width="1.5"/><path d="M7 8h6M7 11h4" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div>
            <div><h4>Akses Pemeriksaan Terbatas</h4><p>Biaya sleep study mahal dan fasilitas terbatas — kebanyakan orang tidak pernah mendapat pemeriksaan yang tepat.</p></div>
          </div>
        </div>
      </div>
      <div class="reveal">
        <div class="data-card">
          <div class="data-title">Prevalensi Gangguan Tidur di Indonesia</div>
          <div class="bar-chart">
            <div class="bar-row"><div class="bar-lbl">Insomnia</div><div class="bar-track"><div class="bar-fill" style="--w:67%"></div></div><div class="bar-pct">67%</div></div>
            <div class="bar-row"><div class="bar-lbl">Sleep Apnea</div><div class="bar-track"><div class="bar-fill" style="--w:45%"></div></div><div class="bar-pct">45%</div></div>
            <div class="bar-row"><div class="bar-lbl">Hypersomnia</div><div class="bar-track"><div class="bar-fill" style="--w:28%"></div></div><div class="bar-pct">28%</div></div>
            <div class="bar-row"><div class="bar-lbl">Parasomnia</div><div class="bar-track"><div class="bar-fill" style="--w:18%"></div></div><div class="bar-pct">18%</div></div>
          </div>
          <div class="data-note">💡 <strong>Tahukah Anda?</strong> Hanya ~30% penderita gangguan tidur yang mencari bantuan profesional akibat keterbatasan akses dan biaya.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ SOLUTION ══════════ -->
<section class="solution" id="solusi">
  <div class="max-w" style="text-align:center">
    <span class="section-tag reveal">Solusi Kami</span>
    <h2 class="section-title reveal">NOCTURA Hadir sebagai<br>Asisten Tidur Pribadi Anda</h2>
    <p class="section-sub reveal">Memanfaatkan teknologi prediksi berbasis data medis untuk membantu Anda memahami kualitas tidur dan mendeteksi potensi gangguan sejak awal.</p>
  </div>
  <div class="solution-cards max-w" style="margin-top:2.5rem">
    <div class="sol-card reveal">
      <div class="sol-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="5" y="2" width="14" height="20" rx="3" stroke="#6b87f0" stroke-width="1.5"/><circle cx="12" cy="17" r="1" fill="#6b87f0"/></svg></div>
      <h3>Mudah Digunakan</h3>
      <p>Tidak perlu perangkat khusus. Cukup smartphone Anda, kuesioner singkat, dan hasilnya langsung tersaji dalam hitungan detik.</p>
    </div>
    <div class="sol-card reveal reveal-delay-1">
      <div class="sol-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" stroke="#6b87f0" stroke-width="1.5" stroke-linecap="round"/></svg></div>
      <h3>Berbasis Riset Medis</h3>
      <p>Kuesioner disusun berdasarkan standar skrining klinis tervalidasi, termasuk Pittsburgh Sleep Quality Index (PSQI).</p>
    </div>
    <div class="sol-card reveal reveal-delay-2">
      <div class="sol-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="#6b87f0" stroke-width="1.5" stroke-linejoin="round"/></svg></div>
      <h3>Privasi Terjaga</h3>
      <p>Data kesehatan Anda terenkripsi dan aman. Kami menjaga kerahasiaan sesuai regulasi perlindungan data pribadi Indonesia.</p>
    </div>
  </div>
</section>

<!-- ══════════ SHOWCASE ══════════ -->
<section class="showcase" id="tampilan">
  <div class="showcase-inner">
    <div class="screens-wrap reveal">
      <div class="screen-card screen-card-1">
        <div class="sc-header">
          <div class="sc-icon-wrap"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><defs><mask id="m-sc1"><rect width="14" height="14" fill="white"/><circle cx="8.97" cy="7" r="3.94" fill="black"/></mask></defs><circle cx="7" cy="7" r="6.5" fill="#050d2e"/><circle cx="7" cy="7" r="5.32" fill="white" mask="url(#m-sc1)"/></svg></div>
          <div><div class="sc-title">Dashboard Tidur</div><div class="sc-sub">Minggu ini</div></div>
        </div>
        <div class="sc-score-ring-wrap">
          <svg width="84" height="84" viewBox="0 0 84 84" fill="none">
            <circle cx="42" cy="42" r="34" stroke="#eef2ff" stroke-width="6"/>
            <circle cx="42" cy="42" r="34" stroke="url(#dg)" stroke-width="6" stroke-dasharray="163 50" stroke-dashoffset="54" stroke-linecap="round"/>
            <defs><linearGradient id="dg" x1="0" y1="0" x2="1" y2="0"><stop offset="0%" stop-color="#152591"/><stop offset="100%" stop-color="#3a5ce8"/></linearGradient></defs>
            <text x="42" y="40" text-anchor="middle" font-size="20" font-weight="700" fill="#050d2e">78</text>
            <text x="42" y="54" text-anchor="middle" font-size="8" fill="#6270a0">skor tidur</text>
          </svg>
        </div>
        <div class="sc-bars">
          <div class="sc-bar-row"><div class="sc-bar-lbl">Insomnia</div><div class="sc-bar-track"><div class="sc-bar-fill" style="width:25%"></div></div></div>
          <div class="sc-bar-row"><div class="sc-bar-lbl">Sleep Apnea</div><div class="sc-bar-track"><div class="sc-bar-fill" style="width:15%"></div></div></div>
          <div class="sc-bar-row"><div class="sc-bar-lbl">Hypersomnia</div><div class="sc-bar-track"><div class="sc-bar-fill" style="width:10%"></div></div></div>
        </div>
      </div>
      <div class="screen-card screen-card-2">
        <div class="sc-header">
          <div class="sc-icon-wrap"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><defs><mask id="m-sc2"><rect width="14" height="14" fill="white"/><circle cx="8.97" cy="7" r="3.94" fill="black"/></mask></defs><circle cx="7" cy="7" r="6.5" fill="#050d2e"/><circle cx="7" cy="7" r="5.32" fill="white" mask="url(#m-sc2)"/></svg></div>
          <div><div class="sc-title">Riwayat Prediksi</div><div class="sc-sub">3 hasil terakhir</div></div>
        </div>
        <div style="display:flex;flex-direction:column;gap:.5rem;">
          <div style="background:#f4f6ff;border-radius:8px;padding:.5rem .65rem;display:flex;justify-content:space-between;align-items:center;">
            <div style="font-size:.6rem;font-weight:500;color:#2a3560;">15 Jan 2025</div>
            <div style="font-size:.55rem;background:#dcfce7;color:#16a34a;padding:.18rem .55rem;border-radius:20px;font-weight:500;">Risiko Rendah</div>
          </div>
          <div style="background:#f4f6ff;border-radius:8px;padding:.5rem .65rem;display:flex;justify-content:space-between;align-items:center;">
            <div style="font-size:.6rem;font-weight:500;color:#2a3560;">1 Jan 2025</div>
            <div style="font-size:.55rem;background:#fef9c3;color:#92400e;padding:.18rem .55rem;border-radius:20px;font-weight:500;">Risiko Sedang</div>
          </div>
          <div style="background:#f4f6ff;border-radius:8px;padding:.5rem .65rem;display:flex;justify-content:space-between;align-items:center;">
            <div style="font-size:.6rem;font-weight:500;color:#2a3560;">15 Des 2024</div>
            <div style="font-size:.55rem;background:#dcfce7;color:#16a34a;padding:.18rem .55rem;border-radius:20px;font-weight:500;">Risiko Rendah</div>
          </div>
        </div>
      </div>
      <div class="screen-card screen-card-3">
        <div class="sc-header">
          <div class="sc-icon-wrap"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><circle cx="7" cy="7" r="6.5" fill="#050d2e"/><path d="M9 4.5C7.5 4.5 5 5.5 5 7C5 8.5 7.5 9.5 9 9.5C7 9.5 3.5 8.5 3.5 7C3.5 5.5 7 4.5 9 4.5Z" fill="white"/></svg></div>
          <div><div class="sc-title">Edukasi Tidur</div><div class="sc-sub">Artikel pilihan</div></div>
        </div>
        <div class="sc-article">
          <div class="sc-article-item">
            <div class="sc-article-thumb"></div>
            <div><div class="sc-article-t">Tips Sleep Hygiene untuk Tidur Lebih Nyenyak</div><div class="sc-article-s">3 min baca</div></div>
          </div>
          <div class="sc-article-item">
            <div class="sc-article-thumb" style="background:#c7d2fe;"></div>
            <div><div class="sc-article-t">Mengenal Sleep Apnea: Gejala &amp; Penanganan</div><div class="sc-article-s">5 min baca</div></div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <span class="section-tag reveal">Tampilan Aplikasi</span>
      <h2 class="section-title reveal">Dirancang untuk<br>Kemudahan Anda</h2>
      <p class="section-sub reveal">Antarmuka yang bersih dan intuitif memudahkan Anda memantau kesehatan tidur setiap hari — tanpa perlu keahlian teknis apapun.</p>
      <div style="margin-top:2rem;display:flex;flex-direction:column;gap:1rem;">
        <div class="why-item reveal reveal-delay-1">
          <div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l4 4 6-7" stroke="#3a5ce8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div><h4>Dashboard interaktif</h4><p>Visualisasi tren tidur Anda dalam grafik yang mudah dibaca.</p></div>
        </div>
        <div class="why-item reveal reveal-delay-2">
          <div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l4 4 6-7" stroke="#3a5ce8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div><h4>Riwayat prediksi lengkap</h4><p>Pantau perkembangan dari waktu ke waktu secara detail.</p></div>
        </div>
        <div class="why-item reveal reveal-delay-3">
          <div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l4 4 6-7" stroke="#3a5ce8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div><h4>Konten edukasi kuratif</h4><p>Artikel dan tips praktis tentang kesehatan tidur setiap minggu.</p></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ FEATURES ══════════ -->
<section class="features" id="fitur">
  <div class="max-w">
    <div class="features-header">
      <div>
        <span class="section-tag reveal">Fitur Lengkap</span>
        <h2 class="section-title reveal">Semua yang Anda<br>Butuhkan untuk<br>Tidur Lebih Baik</h2>
      </div>
      <div style="display:flex;flex-direction:column;justify-content:flex-end;gap:1rem;">
        <p class="section-sub reveal" style="max-width:360px;">Tersedia dua ekosistem terintegrasi — aplikasi mobile untuk pengguna, dan dashboard web untuk tenaga kesehatan.</p>
        <div class="reveal"><div class="tab-switcher"><button class="tab-btn active" onclick="switchTab('mobile',this)">📱 Mobile App</button><button class="tab-btn" onclick="switchTab('web',this)">💻 Web Admin</button></div></div>
      </div>
    </div>
    <div class="features-grid" id="featMobile">
      <div class="feat-card reveal"><div class="feat-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="8" stroke="#3a5ce8" stroke-width="1.5"/><path d="M11 7v4l3 2" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div><div class="feat-content"><h4>Prediksi Gangguan Tidur</h4><p>Isi kuesioner singkat berbasis medis dan dapatkan hasil prediksi risiko gangguan tidur Anda saat ini secara instan.</p></div></div>
      <div class="feat-card reveal reveal-delay-1"><div class="feat-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M3 5h16M3 9h16M3 13h10" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div><div class="feat-content"><h4>Riwayat Prediksi</h4><p>Pantau perkembangan hasil prediksi dari waktu ke waktu untuk memahami tren kualitas tidur Anda.</p></div></div>
      <div class="feat-card reveal reveal-delay-2"><div class="feat-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M3 17l5-6 4 4 4-8 4 5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><div class="feat-content"><h4>Visualisasi Data Tidur</h4><p>Lihat tren kualitas tidur Anda dalam bentuk grafik interaktif yang mudah dipahami dan informatif.</p></div></div>
      <div class="feat-card reveal reveal-delay-3"><div class="feat-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M4 19V8l7-5 7 5v11H4z" stroke="#3a5ce8" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 19v-6h4v6" stroke="#3a5ce8" stroke-width="1.5" stroke-linejoin="round"/></svg></div><div class="feat-content"><h4>Konten Edukasi</h4><p>Baca artikel, tips, dan informasi seputar kesehatan tidur untuk meningkatkan kebiasaan tidur yang lebih baik.</p></div></div>
    </div>
    <div class="features-grid" id="featWeb" style="display:none;">
      <div class="feat-card reveal"><div class="feat-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><rect x="3" y="3" width="16" height="16" rx="2" stroke="#3a5ce8" stroke-width="1.5"/><path d="M3 8h16M8 3v5" stroke="#3a5ce8" stroke-width="1.5"/></svg></div><div class="feat-content"><h4>Manajemen Data Master</h4><p>Kelola data pengguna, pertanyaan kuesioner, opsi jawaban, dan konten edukasi dari satu dashboard terpusat.</p></div></div>
      <div class="feat-card reveal reveal-delay-1"><div class="feat-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M3 17l5-6 4 4 4-8 4 5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><div class="feat-content"><h4>Dashboard &amp; Monitoring</h4><p>Pantau hasil prediksi dan tren kesehatan tidur masyarakat secara agregat dan anonim secara real-time.</p></div></div>
      <div class="feat-card reveal reveal-delay-2"><div class="feat-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="8" r="3" stroke="#3a5ce8" stroke-width="1.5"/><path d="M4 19c0-4 3.1-7 7-7s7 3 7 7" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div><div class="feat-content"><h4>Manajemen Pengguna</h4><p>Kelola akun pengguna, pantau aktivitas, dan pastikan keamanan data seluruh pengguna platform.</p></div></div>
      <div class="feat-card reveal reveal-delay-3"><div class="feat-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M4 14l4-4 4 4 4-6" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15 19H4a1 1 0 01-1-1V4" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div><div class="feat-content"><h4>Laporan &amp; Ekspor Data</h4><p>Unduh laporan komprehensif untuk keperluan penelitian atau evaluasi layanan kesehatan tidur.</p></div></div>
    </div>
  </div>
</section>

<!-- ══════════ HOW IT WORKS ══════════ -->
<section class="how" id="cara-kerja">
  <div class="max-w">
    <span class="section-tag reveal">Cara Kerja</span>
    <h2 class="section-title reveal">Mulai dalam 4 Langkah Mudah</h2>
    <p class="section-sub reveal">Tidak perlu keahlian medis. Siapa pun dapat menggunakan NOCTURA dengan mudah dan mendapat hasil yang bermakna.</p>
    <div class="steps">
      <div class="step reveal"><div class="step-num">1</div><h4>Unduh Aplikasi</h4><p>Download NOCTURA secara gratis di Google Play Store atau Apple App Store.</p></div>
      <div class="step reveal reveal-delay-1"><div class="step-num">2</div><h4>Jawab Kuesioner</h4><p>Isi pertanyaan singkat (5–10 menit) seputar kebiasaan dan kualitas tidur Anda.</p></div>
      <div class="step reveal reveal-delay-2"><div class="step-num">3</div><h4>Dapatkan Hasil</h4><p>Terima hasil prediksi risiko gangguan tidur beserta penjelasan dan rekomendasi awal.</p></div>
      <div class="step reveal reveal-delay-3"><div class="step-num">4</div><h4>Pantau &amp; Tingkatkan</h4><p>Lacak perkembangan dan baca konten edukasi untuk pola tidur yang lebih sehat.</p></div>
    </div>
  </div>
</section>

<!-- ══════════ WHY NOCTURA ══════════ -->
<section class="why" id="kenapa">
  <div class="max-w">
    <div class="why-inner">
      <div>
        <span class="section-tag reveal">Keunggulan Kami</span>
        <h2 class="section-title reveal">Mengapa Memilih NOCTURA?</h2>
        <p class="section-sub reveal">Bukan sekadar pelacak tidur biasa — NOCTURA adalah sistem deteksi dini yang dirancang untuk memberikan dampak nyata.</p>
        <div class="why-list">
          <div class="why-item reveal"><div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l4 4 6-7" stroke="#3a5ce8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div><div><h4>Akurat &amp; Terpercaya</h4><p>Algoritma prediksi dikembangkan berdasarkan standar skrining medis tervalidasi secara klinis.</p></div></div>
          <div class="why-item reveal reveal-delay-1"><div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 2v3M8 11v3M2 8h3M11 8h3" stroke="#3a5ce8" stroke-width="1.8" stroke-linecap="round"/></svg></div><div><h4>Cepat &amp; Tanpa Ribet</h4><p>Hasil prediksi instan tanpa perlu membuat janji dokter atau menunggu antrian panjang.</p></div></div>
          <div class="why-item reveal reveal-delay-2"><div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 5h10M3 8h8M3 11h6" stroke="#3a5ce8" stroke-width="1.8" stroke-linecap="round"/></svg></div><div><h4>Edukatif &amp; Holistik</h4><p>Tidak hanya mendeteksi, tetapi membekali Anda dengan pengetahuan untuk tidur lebih berkualitas.</p></div></div>
          <div class="why-item reveal reveal-delay-3"><div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 2L5 5H3a1 1 0 00-1 1v4a1 1 0 001 1h2l3 3V2z" stroke="#3a5ce8" stroke-width="1.5" stroke-linejoin="round"/><path d="M11 5.5a3 3 0 010 5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div><div><h4>Privasi &amp; Keamanan Data</h4><p>Semua data kesehatan dienkripsi dan dikelola sesuai regulasi perlindungan data pribadi.</p></div></div>
        </div>
      </div>
      <div class="why-visual">
        <div class="metric-card reveal"><span class="metric-emoji">😴</span><div class="metric-val">7–9 Jam<span>Durasi tidur ideal orang dewasa per malam</span></div></div>
        <div class="metric-card reveal reveal-delay-1"><span class="metric-emoji">⚡</span><div class="metric-val">&lt; 5 Mnt<span>Rata-rata waktu penyelesaian kuesioner</span></div></div>
        <div class="metric-card reveal reveal-delay-2"><span class="metric-emoji">🎯</span><div class="metric-val">PSQI<span>Standar skrining kualitas tidur yang digunakan</span></div></div>
        <div class="metric-card reveal reveal-delay-3"><span class="metric-emoji">🌙</span><div class="metric-val">24/7<span>Akses kapan saja dan di mana saja</span></div></div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ TESTIMONIALS ══════════ -->
<section class="testimonials" id="ulasan">
  <div class="max-w">
    <span class="section-tag reveal">Ulasan Pengguna</span>
    <h2 class="section-title reveal">Mereka Sudah Merasakannya</h2>
    <p class="section-sub reveal" style="margin:0 auto">Bergabunglah dengan ribuan pengguna yang sudah lebih peduli terhadap kualitas tidur mereka bersama NOCTURA.</p>
    <div class="testi-grid">
      <div class="testi-card reveal"><div class="testi-stars">★★★★★</div><p class="testi-text">"Aplikasinya simpel banget. Saya jadi tahu kalau kebiasaan begadang saya sudah masuk risiko insomnia ringan. Sekarang saya lebih disiplin tidur."</p><div class="testi-author"><div class="testi-avatar">R</div><div><div class="testi-name">Rina Kusuma</div><div class="testi-role">Mahasiswi, 22 tahun</div></div></div></div>
      <div class="testi-card reveal reveal-delay-1"><div class="testi-stars">★★★★★</div><p class="testi-text">"Saya tidak menyangka sering terbangun malam itu bisa jadi tanda sleep apnea. NOCTURA membantu saya sadar dan akhirnya konsultasi ke dokter."</p><div class="testi-author"><div class="testi-avatar">B</div><div><div class="testi-name">Budi Santoso</div><div class="testi-role">Karyawan Swasta, 35 tahun</div></div></div></div>
      <div class="testi-card reveal reveal-delay-2"><div class="testi-stars">★★★★☆</div><p class="testi-text">"Konten edukasinya sangat bermanfaat. Saya belajar banyak tentang sleep hygiene yang ternyata selama ini saya abaikan."</p><div class="testi-author"><div class="testi-avatar">D</div><div><div class="testi-name">Dewi Rahayu</div><div class="testi-role">Ibu Rumah Tangga, 40 tahun</div></div></div></div>
    </div>
  </div>
</section>

<!-- ══════════ FAQ ══════════ -->
<section class="faq" id="faq">
  <div class="max-w">
    <div class="faq-inner">
      <div>
        <span class="section-tag reveal">FAQ</span>
        <h2 class="section-title reveal">Pertanyaan yang Sering Diajukan</h2>
        <p class="section-sub reveal">Belum menemukan jawaban? Hubungi kami melalui email atau media sosial.</p>
        <a href="mailto:hello@noctura.id" class="btn-outline" style="margin-top:2rem;display:inline-flex;border-color:rgba(58,92,232,.3);color:var(--text-700);">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="9" rx="1" stroke="currentColor" stroke-width="1.2"/><path d="M1 4l6 4 6-4" stroke="currentColor" stroke-width="1.2"/></svg>
          Hubungi Kami
        </a>
      </div>
      <div class="faq-list reveal">
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">Apakah NOCTURA menggantikan diagnosis dokter?<div class="faq-chevron"><svg viewBox="0 0 10 10" fill="none"><path d="M2 3.5L5 6.5L8 3.5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div></button>
          <div class="faq-a"><p>Tidak. NOCTURA adalah alat skrining dini berbasis kuesioner. Hasil prediksi bukan diagnosis medis. Jika hasil menunjukkan risiko tinggi, sangat disarankan untuk berkonsultasi dengan dokter atau tenaga kesehatan untuk pemeriksaan lebih lanjut.</p></div>
        </div>
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">Apakah aplikasi ini berbayar?<div class="faq-chevron"><svg viewBox="0 0 10 10" fill="none"><path d="M2 3.5L5 6.5L8 3.5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div></button>
          <div class="faq-a"><p>NOCTURA sepenuhnya gratis untuk diunduh dan digunakan untuk fitur-fitur dasar termasuk prediksi, riwayat, dan akses konten edukasi. Kami percaya setiap orang berhak mendapat akses informasi kesehatan tidur yang baik.</p></div>
        </div>
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">Bagaimana keamanan data kesehatan saya?<div class="faq-chevron"><svg viewBox="0 0 10 10" fill="none"><path d="M2 3.5L5 6.5L8 3.5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div></button>
          <div class="faq-a"><p>Kami mengutamakan privasi pengguna. Semua data kesehatan dienkripsi menggunakan standar enkripsi terkini dan dikelola sesuai regulasi perlindungan data pribadi yang berlaku di Indonesia.</p></div>
        </div>
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">Gangguan tidur apa saja yang bisa dideteksi?<div class="faq-chevron"><svg viewBox="0 0 10 10" fill="none"><path d="M2 3.5L5 6.5L8 3.5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div></button>
          <div class="faq-a"><p>NOCTURA dapat mendeteksi risiko insomnia, sleep apnea, hypersomnia, dan parasomnia berdasarkan pola jawaban kuesioner yang Anda berikan. Setiap hasil dilengkapi penjelasan dan rekomendasi awal.</p></div>
        </div>
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">Seberapa sering saya harus mengisi kuesioner?<div class="faq-chevron"><svg viewBox="0 0 10 10" fill="none"><path d="M2 3.5L5 6.5L8 3.5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div></button>
          <div class="faq-a"><p>Disarankan minimal sebulan sekali atau setelah ada perubahan signifikan pada pola tidur Anda. Fitur Riwayat membantu Anda memantau tren dari waktu ke waktu.</p></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ CTA ══════════ -->
<section class="cta-section" id="download">
  <div class="cta-inner reveal">
    <span class="section-tag">Download Sekarang</span>
    <h2 class="section-title">Tidur Nyenyak Dimulai<br>dari Satu Langkah Kecil</h2>
    <p class="section-sub">Bergabunglah dengan ribuan pengguna yang sudah lebih peduli terhadap kesehatan tidur mereka. Gratis, mudah, dan tepercaya.</p>
    <div class="store-btns">
      <a href="#" class="store-btn">
        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><path d="M6 22l8-14 8 14" stroke="white" stroke-width="1.5" stroke-linejoin="round"/><path d="M9.5 16.5h9" stroke="white" stroke-width="1.5" stroke-linecap="round"/></svg>
        <div class="store-btn-text"><small>Tersedia di</small><strong>Google Play</strong></div>
      </a>
      <a href="#" class="store-btn">
        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><path d="M20 22c-1 1.5-2 3-3.5 3s-2-.8-3.5-.8-2.5.8-3.5.8C8 25 7 23.5 6 22c-2-3-3-7-1-10 1-2 3-3 5-3 1.5 0 2.5.8 3.5.8s2-.8 3.5-.8c1.7 0 3.5 1 4.5 2.5-3.5 2-3 7 0 8z" stroke="white" stroke-width="1.5" stroke-linejoin="round"/><path d="M17 5c-2 2-2 5 0 6" stroke="white" stroke-width="1.5" stroke-linecap="round"/></svg>
        <div class="store-btn-text"><small>Unduh di</small><strong>App Store</strong></div>
      </a>
    </div>
    <p class="cta-disclaimer">⚠️ Hasil prediksi bukan diagnosis medis. Konsultasikan dengan dokter untuk pemeriksaan lebih lanjut.</p>
  </div>
</section>

<!-- ══════════ FOOTER ══════════ -->
<footer>
  <div class="footer-inner">
    <div class="footer-brand">
      <a href="#" class="nav-brand" style="text-decoration:none">
        <svg class="nav-logo" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <mask id="m-footer-crescent">
              <rect width="36" height="36" fill="white"/>
              <!-- punch-out circle: cx = 18 + r*0.37 = 18 + 13.68*0.37 ≈ 23.06, r = 13.68*0.74 ≈ 10.12 -->
              <circle cx="23.06" cy="18" r="10.12" fill="black"/>
            </mask>
          </defs>
          <!-- outer ring background -->
          <circle cx="18" cy="18" r="17" fill="#050d2e" stroke="#dde6ff" stroke-width="1.2"/>
          <!-- white crescent: full circle masked by punch-out -->
          <circle cx="18" cy="18" r="13.68" fill="white" mask="url(#m-footer-crescent)"/>
        </svg>
        <span class="nav-name" style="color:white">NOCTURA</span>
      </a>
      <p>Sistem Deteksi Dini Gangguan Tidur Berbasis Mobile. Membantu masyarakat Indonesia hidup lebih sehat melalui tidur yang berkualitas.</p>
      <div class="footer-socials">
        <a href="#" class="social-btn" title="Instagram"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="2" y="2" width="10" height="10" rx="3" stroke="currentColor" stroke-width="1.2"/><circle cx="7" cy="7" r="2.5" stroke="currentColor" stroke-width="1.2"/><circle cx="10.5" cy="3.5" r="0.6" fill="currentColor"/></svg></a>
        <a href="#" class="social-btn" title="X"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M13 1.5H9.5L7 5.5 4.5 1.5H1L5.5 7.5 1 12.5H4.5L7 8.5 9.5 12.5H13L8.5 7.5 13 1.5Z" fill="currentColor"/></svg></a>
        <a href="#" class="social-btn" title="YouTube"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="8" rx="2" stroke="currentColor" stroke-width="1.2"/><path d="M5.5 5l3.5 2-3.5 2V5z" fill="currentColor"/></svg></a>
        <a href="mailto:hello@noctura.id" class="social-btn" title="Email"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="8" rx="1" stroke="currentColor" stroke-width="1.2"/><path d="M1 4l6 4 6-4" stroke="currentColor" stroke-width="1.2"/></svg></a>
      </div>
    </div>
    <div class="footer-col"><h5>Produk</h5><ul><li><a href="#fitur">Fitur Aplikasi</a></li><li><a href="#cara-kerja">Cara Kerja</a></li><li><a href="#download">Download</a></li><li><a href="#">Web Admin</a></li></ul></div>
    <div class="footer-col"><h5>Informasi</h5><ul><li><a href="#masalah">Gangguan Tidur</a></li><li><a href="#">Artikel Edukasi</a></li><li><a href="#faq">FAQ</a></li><li><a href="#">Tentang Kami</a></li></ul></div>
    <div class="footer-col"><h5>Legal</h5><ul><li><a href="#">Kebijakan Privasi</a></li><li><a href="#">Syarat Penggunaan</a></li><li><a href="#">Disclaimer Medis</a></li></ul></div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 NOCTURA – Sleep Intelligence. Hak Cipta Dilindungi.</p>
    <p>Dibuat dengan ❤️ untuk kesehatan tidur Indonesia · <a href="#">Kebijakan Privasi</a></p>
  </div>
</footer>

<script>
// ── Star field
(function(){
  const c=document.getElementById('heroStars');
  for(let i=0;i<90;i++){
    const s=document.createElement('div');
    s.className='star';
    const sz=Math.random()*2+1;
    Object.assign(s.style,{
      width:sz+'px',height:sz+'px',
      top:Math.random()*100+'%',left:Math.random()*100+'%',
      '--dur':(Math.random()*3+2)+'s',
      '--delay':(-Math.random()*5)+'s',
    });
    c.appendChild(s);
  }
})();

// ── Scroll reveal
const obs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible')});
},{threshold:.08});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));

// ── Bar chart animate on scroll
const barObs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{
    if(e.isIntersecting){
      e.target.querySelectorAll('.bar-fill').forEach(b=>b.classList.add('animated'));
      barObs.unobserve(e.target);
    }
  });
},{threshold:.3});
const dataCard=document.querySelector('.data-card');
if(dataCard)barObs.observe(dataCard);

// ── Navbar scroll
window.addEventListener('scroll',()=>{
  document.getElementById('navbar').classList.toggle('scrolled',scrollY>60);
});

// ── FAQ accordion
function toggleFaq(btn){
  const item=btn.parentElement;
  const isOpen=item.classList.contains('open');
  document.querySelectorAll('.faq-item.open').forEach(i=>i.classList.remove('open'));
  if(!isOpen)item.classList.add('open');
}

// ── Feature tab
function switchTab(tab,btn){
  document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('featMobile').style.display=tab==='mobile'?'grid':'none';
  document.getElementById('featWeb').style.display=tab==='web'?'grid':'none';
}

// ── Mobile nav
function toggleNav(){
  const links=document.getElementById('navLinks');
  const open=links.style.display==='flex';
  if(open){links.style.display='none';return}
  Object.assign(links.style,{
    display:'flex',flexDirection:'column',
    position:'absolute',top:'100%',left:'0',right:'0',
    background:'rgba(255,255,255,.97)',backdropFilter:'blur(24px)',
    padding:'1.5rem 5%',borderBottom:'1px solid rgba(58,92,232,.1)',
    gap:'1.2rem',boxShadow:'0 16px 40px rgba(5,13,46,.12)',zIndex:'999'
  });
}
document.querySelectorAll('#navLinks a').forEach(a=>{
  a.addEventListener('click',()=>{
    if(window.innerWidth<=640)document.getElementById('navLinks').style.display='none';
  });
});
</script>
</body>
</html>