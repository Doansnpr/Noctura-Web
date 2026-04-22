<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOCTURA – Sleep Intelligence</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --white: #ffffff;
            --off-white: #f8f9ff;
            --soft-gray: #f2f4fb;
            --light-blue: #eef1ff;
            --mid-blue: #dde3ff;
            --accent: #3a5ce8;
            --accent-soft: #5b7df5;
            --accent-light: rgba(58,92,232,0.08);
            --navy: #071048;
            --navy-mid: #1a2d9a;
            --text-dark: #0d1640;
            --text-mid: #4a567a;
            --text-muted: #8590b8;
            --border: rgba(58,92,232,0.12);
            --shadow-soft: 0 4px 32px rgba(58,92,232,0.08);
            --shadow-card: 0 2px 20px rgba(13,22,64,0.07);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--white);
            color: var(--text-dark);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ── NAVBAR ── */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 1.1rem 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(58,92,232,0.08);
            transition: all 0.3s ease;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            text-decoration: none;
        }

        /* SVG Moon Logo */
        .nav-logo {
            width: 36px; height: 36px;
            flex-shrink: 0;
        }

        .nav-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            color: var(--navy);
            letter-spacing: 0.1em;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2.4rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-mid);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 400;
            transition: color 0.2s;
        }

        .nav-links a:hover { color: var(--accent); }

        .nav-cta {
            background: var(--navy) !important;
            color: white !important;
            padding: 0.5rem 1.4rem !important;
            border-radius: 50px !important;
            font-weight: 500 !important;
            font-size: 0.875rem !important;
            transition: all 0.3s ease !important;
        }

        .nav-cta:hover {
            background: var(--accent) !important;
            transform: translateY(-1px) !important;
        }

        .nav-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.3rem;
        }

        .nav-toggle span {
            display: block;
            width: 22px; height: 2px;
            background: var(--navy);
            margin: 4px 0;
            transition: all 0.3s;
            border-radius: 2px;
        }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            padding: 8rem 5% 5rem;
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: var(--white);
        }

        /* Soft background blobs */
        .hero-blob-1 {
            position: absolute;
            width: 700px; height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(58,92,232,0.06) 0%, transparent 70%);
            top: -200px; right: -150px;
            pointer-events: none;
        }

        .hero-blob-2 {
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(58,92,232,0.04) 0%, transparent 70%);
            bottom: 0; left: -100px;
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 5rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--light-blue);
            border: 1px solid var(--mid-blue);
            border-radius: 50px;
            padding: 0.35rem 1rem;
            font-size: 0.75rem;
            color: var(--accent);
            font-weight: 500;
            margin-bottom: 1.5rem;
            letter-spacing: 0.04em;
        }

        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--accent);
            animation: pulse 2s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.4rem, 4vw, 3.6rem);
            line-height: 1.12;
            color: var(--text-dark);
            margin-bottom: 1.4rem;
            font-weight: 700;
        }

        .hero-title em {
            font-style: italic;
            color: var(--accent);
        }

        .hero-sub {
            font-size: 1rem;
            color: var(--text-muted);
            max-width: 460px;
            margin-bottom: 2.5rem;
            font-weight: 300;
            line-height: 1.75;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--navy);
            color: white;
            text-decoration: none;
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 28px rgba(7,16,72,0.18);
            transition: all 0.3s ease;
            letter-spacing: 0.01em;
        }

        .btn-primary:hover {
            background: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(58,92,232,0.28);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: transparent;
            color: var(--text-mid);
            text-decoration: none;
            padding: 0.875rem 1.8rem;
            border-radius: 50px;
            font-weight: 400;
            font-size: 0.9rem;
            border: 1.5px solid var(--border);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--light-blue);
        }

        /* ── HERO VISUAL ── */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* App Preview Card */
        .app-preview {
            position: relative;
            animation: floatUp 6s ease-in-out infinite;
        }

        @keyframes floatUp {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-14px); }
        }

        .phone-shell {
            width: 260px;
            background: var(--white);
            border-radius: 38px;
            border: 1.5px solid rgba(58,92,232,0.12);
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(13,22,64,0.14), 0 8px 24px rgba(13,22,64,0.06);
            position: relative;
        }

        .phone-notch {
            width: 80px; height: 22px;
            background: var(--text-dark);
            border-radius: 0 0 16px 16px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .phone-screen-header {
            background: linear-gradient(160deg, var(--navy) 0%, var(--navy-mid) 100%);
            padding: 1.5rem 1.4rem 2.5rem;
            text-align: center;
        }

        /* SVG Moon in phone header */
        .phone-moon-wrap {
            width: 54px; height: 54px;
            margin: 0 auto 0.8rem;
        }

        .phone-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            letter-spacing: 0.18em;
            color: white;
            font-weight: 700;
        }

        .phone-brand-sub {
            font-size: 0.58rem;
            color: rgba(255,255,255,0.5);
            letter-spacing: 0.12em;
            margin-top: 0.1rem;
        }

        .phone-wave-divider {
            height: 32px;
            background: var(--white);
            position: relative;
            top: 0;
        }

        .phone-wave-divider svg {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            width: 100%;
        }

        .phone-body {
            background: var(--white);
            padding: 0 1.2rem 1.4rem;
        }

        .phone-sleep-score {
            background: var(--light-blue);
            border-radius: 16px;
            padding: 0.9rem 1rem;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .score-ring {
            width: 40px; height: 40px;
            flex-shrink: 0;
        }

        .score-label {
            font-size: 0.6rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .score-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: var(--navy);
            font-weight: 700;
            line-height: 1.1;
        }

        .phone-mini-chart {
            background: var(--soft-gray);
            border-radius: 12px;
            padding: 0.7rem 0.9rem;
            margin-bottom: 0.8rem;
        }

        .mini-chart-title {
            font-size: 0.58rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .mini-bars {
            display: flex;
            align-items: flex-end;
            gap: 4px;
            height: 28px;
        }

        .mini-bar {
            flex: 1;
            background: var(--mid-blue);
            border-radius: 3px;
            transition: background 0.3s;
        }

        .mini-bar.active { background: var(--accent); }

        .phone-tags {
            display: flex;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        .phone-tag {
            font-size: 0.55rem;
            background: var(--light-blue);
            color: var(--accent);
            border-radius: 20px;
            padding: 0.2rem 0.6rem;
            font-weight: 500;
            border: 1px solid var(--mid-blue);
        }

        /* Floating cards around phone */
        .float-card {
            position: absolute;
            background: var(--white);
            border-radius: 14px;
            padding: 0.7rem 1rem;
            box-shadow: 0 8px 32px rgba(13,22,64,0.1);
            border: 1px solid var(--border);
            font-size: 0.72rem;
            color: var(--text-dark);
            font-weight: 500;
            white-space: nowrap;
        }

        .float-card-1 {
            top: 60px; right: -100px;
            animation: floatCard1 5s ease-in-out infinite;
        }

        .float-card-2 {
            bottom: 100px; left: -90px;
            animation: floatCard2 7s ease-in-out infinite;
        }

        @keyframes floatCard1 {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @keyframes floatCard2 {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(6px); }
        }

        .float-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.4rem;
        }

        /* ── STATS BAR ── */
        .stats-bar {
            background: var(--navy);
            padding: 2.8rem 5%;
        }

        .stats-inner {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }

        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            color: white;
            line-height: 1;
            font-weight: 700;
        }

        .stat-num .accent { color: #8aa4f8; }

        .stat-label {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.5);
            margin-top: 0.35rem;
            font-weight: 300;
        }

        /* ── SECTION SHARED ── */
        section { padding: 6rem 5%; }

        .section-tag {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.8rem;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.9rem, 3vw, 2.8rem);
            line-height: 1.2;
            color: var(--text-dark);
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .section-sub {
            font-size: 0.975rem;
            color: var(--text-muted);
            font-weight: 300;
            line-height: 1.75;
        }

        .max-w { max-width: 1200px; margin: 0 auto; }

        /* ── PAIN SECTION ── */
        .pain { background: var(--off-white); }

        .pain-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
            margin-top: 3.5rem;
        }

        .pain-cards {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 2rem;
        }

        .pain-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.3rem 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-card);
        }

        .pain-card:hover {
            transform: translateX(5px);
            box-shadow: 0 6px 30px rgba(58,92,232,0.1);
            border-color: rgba(58,92,232,0.2);
        }

        .pain-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            background: var(--light-blue);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .pain-card h4 {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.2rem;
        }

        .pain-card p { font-size: 0.8rem; color: var(--text-muted); line-height: 1.55; }

        /* Data card */
        .data-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: var(--shadow-soft);
        }

        .data-title {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            letter-spacing: 0.04em;
            font-weight: 600;
            text-transform: uppercase;
        }

        .bar-chart { display: flex; flex-direction: column; gap: 1rem; }

        .bar-row { display: flex; align-items: center; gap: 1rem; }

        .bar-lbl { font-size: 0.75rem; color: var(--text-mid); width: 88px; flex-shrink: 0; font-weight: 500; }

        .bar-track {
            flex: 1; height: 8px;
            background: var(--soft-gray);
            border-radius: 10px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--navy-mid), var(--accent));
            animation: growBar 1.8s ease forwards;
            transform-origin: left;
        }

        @keyframes growBar {
            from { transform: scaleX(0); }
            to { transform: scaleX(1); }
        }

        .bar-pct { font-size: 0.72rem; color: var(--accent); font-weight: 600; width: 30px; text-align: right; }

        .data-note {
            margin-top: 1.5rem;
            padding: 0.9rem 1rem;
            background: var(--light-blue);
            border-radius: 12px;
            font-size: 0.72rem;
            color: var(--text-mid);
            line-height: 1.55;
        }

        /* ── SOLUTION ── */
        .solution { background: var(--white); text-align: center; }
        .solution .section-sub { margin: 0 auto; max-width: 520px; }

        .solution-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3.5rem;
        }

        .sol-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.2rem 1.8rem;
            text-align: left;
            transition: all 0.35s ease;
            box-shadow: var(--shadow-card);
        }

        .sol-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 48px rgba(58,92,232,0.1);
            border-color: rgba(58,92,232,0.2);
        }

        .sol-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            background: var(--light-blue);
            border: 1px solid var(--mid-blue);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.2rem;
        }

        .sol-card h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.6rem;
        }

        .sol-card p { font-size: 0.82rem; color: var(--text-muted); line-height: 1.65; }

        /* ── APP SHOWCASE ── */
        .showcase {
            background: var(--off-white);
            padding: 6rem 5%;
        }

        .showcase-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            align-items: center;
            gap: 5rem;
        }

        .screens-wrap {
            position: relative;
            height: 460px;
        }

        .screen-card {
            position: absolute;
            background: var(--white);
            border-radius: 24px;
            padding: 1.6rem;
            box-shadow: 0 20px 60px rgba(13,22,64,0.12);
            border: 1px solid var(--border);
            width: 220px;
        }

        .screen-card-1 {
            top: 0; left: 20px;
            animation: floatScreen1 7s ease-in-out infinite;
        }

        .screen-card-2 {
            top: 80px; left: 180px;
            animation: floatScreen2 8s ease-in-out infinite;
        }

        .screen-card-3 {
            bottom: 0; left: 60px;
            animation: floatScreen3 6s ease-in-out infinite;
        }

        @keyframes floatScreen1 {
            0%, 100% { transform: translateY(0px) rotate(-2deg); }
            50% { transform: translateY(-12px) rotate(-2deg); }
        }

        @keyframes floatScreen2 {
            0%, 100% { transform: translateY(0px) rotate(2deg); }
            50% { transform: translateY(-8px) rotate(2deg); }
        }

        @keyframes floatScreen3 {
            0%, 100% { transform: translateY(0px) rotate(-1deg); }
            50% { transform: translateY(-10px) rotate(-1deg); }
        }

        .sc-header {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid var(--border);
        }

        .sc-icon-wrap {
            width: 30px; height: 30px;
            background: var(--navy);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }

        .sc-title { font-size: 0.72rem; font-weight: 600; color: var(--text-dark); }
        .sc-sub { font-size: 0.6rem; color: var(--text-muted); }

        .sc-score-ring-wrap { display: flex; justify-content: center; margin-bottom: 0.9rem; }

        .sc-bars { display: flex; flex-direction: column; gap: 0.4rem; }

        .sc-bar-row { display: flex; align-items: center; gap: 0.5rem; }

        .sc-bar-lbl { font-size: 0.58rem; color: var(--text-muted); width: 60px; }

        .sc-bar-track {
            flex: 1; height: 5px;
            background: var(--soft-gray);
            border-radius: 5px; overflow: hidden;
        }

        .sc-bar-fill {
            height: 100%; border-radius: 5px;
            background: linear-gradient(90deg, var(--navy-mid), var(--accent));
        }

        .sc-article {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .sc-article-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.5rem;
            background: var(--soft-gray);
            border-radius: 8px;
        }

        .sc-article-thumb {
            width: 30px; height: 30px;
            background: var(--mid-blue);
            border-radius: 6px;
            flex-shrink: 0;
        }

        .sc-article-t { font-size: 0.58rem; font-weight: 600; color: var(--text-dark); line-height: 1.3; }
        .sc-article-s { font-size: 0.55rem; color: var(--text-muted); }

        /* ── FEATURES ── */
        .features { background: var(--white); }

        .features-header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: end;
            margin-bottom: 3rem;
        }

        .tab-switcher {
            display: inline-flex;
            background: var(--soft-gray);
            border-radius: 50px;
            padding: 4px;
        }

        .tab-btn {
            padding: 0.48rem 1.3rem;
            border-radius: 50px;
            border: none;
            background: transparent;
            color: var(--text-muted);
            font-size: 0.82rem;
            cursor: pointer;
            transition: all 0.25s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 400;
        }

        .tab-btn.active {
            background: var(--white);
            color: var(--text-dark);
            font-weight: 500;
            box-shadow: 0 2px 12px rgba(13,22,64,0.08);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
        }

        .feat-card {
            background: var(--off-white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            gap: 1.1rem;
            transition: all 0.3s ease;
        }

        .feat-card:hover {
            background: var(--white);
            box-shadow: 0 8px 32px rgba(58,92,232,0.08);
            border-color: rgba(58,92,232,0.18);
        }

        .feat-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            background: var(--light-blue);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .feat-content h4 { font-size: 0.9rem; font-weight: 600; color: var(--text-dark); margin-bottom: 0.3rem; }
        .feat-content p { font-size: 0.78rem; color: var(--text-muted); line-height: 1.55; }

        /* ── HOW IT WORKS ── */
        .how { background: var(--navy); text-align: center; }
        .how .section-tag { color: #8aa4f8; }
        .how .section-title { color: white; }
        .how .section-sub { color: rgba(255,255,255,0.5); margin: 0 auto; max-width: 500px; }

        .steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-top: 3.5rem;
            position: relative;
        }

        .steps::before {
            content: '';
            position: absolute;
            top: 32px; left: 14%; right: 14%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(138,164,248,0.3), rgba(138,164,248,0.5), rgba(138,164,248,0.3), transparent);
        }

        .step { position: relative; z-index: 1; }

        .step-num {
            width: 58px; height: 58px;
            background: rgba(255,255,255,0.06);
            border: 1.5px solid rgba(138,164,248,0.25);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: #8aa4f8;
            margin: 0 auto 1.2rem;
        }

        .step h4 { font-size: 0.9rem; font-weight: 600; color: white; margin-bottom: 0.4rem; }
        .step p { font-size: 0.78rem; color: rgba(255,255,255,0.45); line-height: 1.55; }

        /* ── WHY ── */
        .why { background: var(--white); }

        .why-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .why-list { display: flex; flex-direction: column; gap: 1.4rem; margin-top: 2rem; }

        .why-item { display: flex; align-items: flex-start; gap: 1rem; }

        .why-bullet {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: var(--light-blue);
            border: 1px solid var(--mid-blue);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .why-item h4 { font-size: 0.9rem; font-weight: 600; color: var(--text-dark); margin-bottom: 0.2rem; }
        .why-item p { font-size: 0.8rem; color: var(--text-muted); line-height: 1.55; }

        .why-visual { display: flex; flex-direction: column; gap: 1rem; }

        .metric-card {
            background: var(--off-white);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 1.4rem 1.6rem;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-card);
        }

        .metric-card:hover {
            transform: translateX(-5px);
            box-shadow: 0 8px 32px rgba(58,92,232,0.08);
        }

        .metric-emoji { font-size: 1.8rem; }

        .metric-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            color: var(--text-dark);
            font-weight: 700;
            line-height: 1;
        }

        .metric-val span {
            font-size: 0.78rem;
            color: var(--text-muted);
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: block;
            font-weight: 300;
            margin-top: 0.2rem;
        }

        /* ── TESTIMONIALS ── */
        .testimonials { background: var(--off-white); text-align: center; }
        .testimonials .section-sub { margin: 0 auto 3.5rem; max-width: 520px; }

        .testi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .testi-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2rem;
            text-align: left;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-card);
        }

        .testi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(58,92,232,0.08);
            border-color: rgba(58,92,232,0.2);
        }

        .testi-stars { color: #f59e0b; font-size: 0.85rem; margin-bottom: 1rem; letter-spacing: 0.1em; }

        .testi-text {
            font-size: 0.86rem;
            color: var(--text-mid);
            line-height: 1.7;
            font-style: italic;
            margin-bottom: 1.5rem;
            font-weight: 300;
        }

        .testi-author { display: flex; align-items: center; gap: 0.75rem; }

        .testi-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--navy), var(--accent));
            display: flex; align-items: center; justify-content: center;
            font-size: 0.88rem;
            font-weight: 600;
            color: white;
        }

        .testi-name { font-size: 0.82rem; font-weight: 600; color: var(--text-dark); }
        .testi-role { font-size: 0.72rem; color: var(--text-muted); }

        /* ── FAQ ── */
        .faq { background: var(--white); }

        .faq-inner {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 5rem;
        }

        .faq-list { display: flex; flex-direction: column; gap: 0.75rem; }

        .faq-item {
            background: var(--off-white);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .faq-q {
            width: 100%;
            background: transparent;
            border: none;
            padding: 1.2rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            cursor: pointer;
            color: var(--text-dark);
            font-size: 0.875rem;
            font-weight: 500;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-align: left;
            transition: background 0.2s;
        }

        .faq-q:hover { background: rgba(58,92,232,0.03); }

        .faq-chevron {
            width: 18px; height: 18px;
            border-radius: 50%;
            background: var(--light-blue);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: transform 0.3s;
        }

        .faq-chevron svg { width: 10px; height: 10px; }

        .faq-item.open .faq-chevron { transform: rotate(180deg); background: var(--accent); }
        .faq-item.open .faq-chevron svg path { stroke: white; }

        .faq-a { max-height: 0; overflow: hidden; transition: max-height 0.35s ease; }
        .faq-item.open .faq-a { max-height: 200px; }

        .faq-a p {
            padding: 0 1.4rem 1.2rem;
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.65;
            border-top: 1px solid var(--border);
            padding-top: 0.8rem;
            font-weight: 300;
        }

        /* ── CTA ── */
        .cta-section { background: var(--navy); padding: 6rem 5%; text-align: center; }

        .cta-inner {
            max-width: 680px;
            margin: 0 auto;
            position: relative;
        }

        .cta-blob {
            position: absolute;
            width: 400px; height: 200px;
            background: radial-gradient(circle, rgba(58,92,232,0.3) 0%, transparent 70%);
            top: -80px; left: 50%; transform: translateX(-50%);
            pointer-events: none;
        }

        .cta-section .section-tag { color: #8aa4f8; }
        .cta-section .section-title { color: white; font-size: 2.5rem; }
        .cta-section .section-sub { color: rgba(255,255,255,0.5); max-width: 480px; margin: 0 auto 2.5rem; }

        .store-btns {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .store-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 14px;
            padding: 0.9rem 1.6rem;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
        }

        .store-btn:hover {
            background: rgba(255,255,255,0.12);
            transform: translateY(-2px);
        }

        .store-btn-text { text-align: left; }
        .store-btn-text small { display: block; font-size: 0.65rem; color: rgba(255,255,255,0.5); }
        .store-btn-text strong { font-size: 0.88rem; font-weight: 500; }

        .cta-disclaimer {
            margin-top: 1.5rem;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.3);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--off-white);
            border-top: 1px solid var(--border);
            padding: 3.5rem 5% 2rem;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 2.5rem;
        }

        .footer-brand p {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 0.8rem;
            line-height: 1.65;
            max-width: 230px;
            font-weight: 300;
        }

        .footer-socials { display: flex; gap: 0.6rem; margin-top: 1.2rem; }

        .social-btn {
            width: 34px; height: 34px;
            border-radius: 8px;
            background: var(--white);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .social-btn:hover {
            background: var(--light-blue);
            color: var(--accent);
            border-color: rgba(58,92,232,0.2);
        }

        .footer-col h5 { font-size: 0.82rem; font-weight: 600; color: var(--text-dark); margin-bottom: 1rem; }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.5rem; }
        .footer-col ul a { font-size: 0.78rem; color: var(--text-muted); text-decoration: none; transition: color 0.2s; font-weight: 300; }
        .footer-col ul a:hover { color: var(--accent); }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-bottom p { font-size: 0.73rem; color: var(--text-muted); }
        .footer-bottom a { color: var(--accent); text-decoration: none; }

        /* ── SVG ICONS ── */
        /* (all icons inline SVG, no external icon fonts) */

        /* ── SCROLL REVEAL ── */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }

        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .hero-inner { grid-template-columns: 1fr; text-align: center; }
            .hero-sub { margin: 0 auto 2.5rem; }
            .hero-actions { justify-content: center; }
            .hero-visual { display: none; }
            .stats-inner { grid-template-columns: repeat(2, 1fr); }
            .pain-grid { grid-template-columns: 1fr; }
            .solution-cards { grid-template-columns: 1fr 1fr; }
            .steps { grid-template-columns: 1fr 1fr; }
            .steps::before { display: none; }
            .why-inner { grid-template-columns: 1fr; }
            .testi-grid { grid-template-columns: 1fr 1fr; }
            .faq-inner { grid-template-columns: 1fr; }
            .footer-inner { grid-template-columns: 1fr 1fr; }
            .showcase-inner { grid-template-columns: 1fr; }
            .screens-wrap { display: none; }
            .features-header { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-toggle { display: block; }
            .solution-cards { grid-template-columns: 1fr; }
            .features-grid { grid-template-columns: 1fr; }
            .testi-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 480px) {
            .stats-inner { grid-template-columns: 1fr 1fr; }
            .footer-inner { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- ── NAVBAR ── -->
    <nav class="navbar" id="navbar">
        <a href="#" class="nav-brand">
            <!-- SVG Moon Logo -->
            <svg class="nav-logo" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="18" cy="18" r="17" fill="#071048" stroke="#dde3ff" stroke-width="1"/>
                <path d="M22 11.5C19 11.5 14 13.5 14 18C14 22.5 19 24.5 22 24.5C18.5 24.5 11 22 11 18C11 14 18.5 11.5 22 11.5Z" fill="white"/>
            </svg>
            <span class="nav-name">NOCTURA</span>
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="#fitur">Fitur</a></li>
            <li><a href="#cara-kerja">Cara Kerja</a></li>
            <li><a href="#kenapa">Keunggulan</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#download" class="nav-cta">Download</a></li>
        </ul>
        <button class="nav-toggle" onclick="toggleNav()" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </nav>

    <!-- ── HERO ── -->
    <section class="hero" id="home">
        <div class="hero-blob-1"></div>
        <div class="hero-blob-2"></div>

        <div class="hero-inner">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="badge-dot"></span>
                    Sleep Intelligence Platform
                </div>
                <h1 class="hero-title">
                    Kenali Risiko<br>
                    <em>Gangguan Tidur</em><br>
                    Lebih Dini
                </h1>
                <p class="hero-sub">
                    Aplikasi mobile berbasis data untuk memprediksi potensi insomnia, sleep apnea, dan gangguan tidur lainnya — mudah, cepat, dan gratis langsung dari smartphone Anda.
                </p>
                <div class="hero-actions">
                    <a href="#download" class="btn-primary">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 2C4.7 2 2 4.7 2 8s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6zm0 10.5c-2.5 0-4.5-2-4.5-4.5S5.5 3.5 8 3.5c.8 0 1.5.2 2.2.6C8.7 4.5 7.5 6.1 7.5 8s1.2 3.5 2.7 3.9c-.7.4-1.4.6-2.2.6z" fill="white"/></svg>
                        Coba Prediksi Sekarang
                    </a>
                    <a href="#cara-kerja" class="btn-outline">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M5 3l5 4-5 4V3z" fill="currentColor"/></svg>
                        Lihat Cara Kerja
                    </a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="app-preview">
                    <!-- Floating Cards -->
                    <div class="float-card float-card-1">
                        <span class="float-dot" style="background:#22c55e;"></span>Prediksi Selesai ✓
                    </div>
                    <div class="float-card float-card-2">
                        <span class="float-dot" style="background:#3a5ce8;"></span>Skor Tidur: 78/100
                    </div>

                    <div class="phone-shell">
                        <div class="phone-notch"></div>
                        <div class="phone-screen-header">
                            <!-- SVG Moon in phone -->
                            <div class="phone-moon-wrap">
                                <svg viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="27" cy="27" r="26" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
                                    <path d="M33 17C27.5 17 20 20 20 27C20 34 27.5 37 33 37C26 37 15 33 15 27C15 21 26 17 33 17Z" fill="white"/>
                                </svg>
                            </div>
                            <div class="phone-brand">NOCTURA</div>
                            <div class="phone-brand-sub">Sleep Intelligence</div>
                        </div>
                        <!-- Wave shape -->
                        <div style="background: linear-gradient(180deg, #1a2d9a 0%, transparent 100%); height: 24px;"></div>
                        <div class="phone-body">
                            <div style="font-size:0.65rem; font-weight:700; color:var(--text-dark); margin-bottom:0.8rem;">Selamat pagi, Budi 👋</div>

                            <div class="phone-sleep-score">
                                <svg class="score-ring" viewBox="0 0 40 40" fill="none">
                                    <circle cx="20" cy="20" r="16" stroke="#dde3ff" stroke-width="3"/>
                                    <circle cx="20" cy="20" r="16" stroke="#3a5ce8" stroke-width="3" stroke-dasharray="78 22" stroke-dashoffset="25" stroke-linecap="round"/>
                                    <text x="20" y="24" text-anchor="middle" font-size="9" font-weight="700" fill="#071048">78</text>
                                </svg>
                                <div>
                                    <div class="score-label">Skor Tidur</div>
                                    <div class="score-val">Cukup Baik</div>
                                </div>
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

    <!-- ── STATS BAR ── -->
    <div class="stats-bar">
        <div class="stats-inner max-w">
            <div class="stat reveal">
                <div class="stat-num"><span class="accent">10%</span></div>
                <div class="stat-label">Dewasa Indonesia alami insomnia</div>
            </div>
            <div class="stat reveal reveal-delay-1">
                <div class="stat-num"><span class="accent">5–10</span></div>
                <div class="stat-label">Menit untuk isi kuesioner</div>
            </div>
            <div class="stat reveal reveal-delay-2">
                <div class="stat-num"><span class="accent">4</span></div>
                <div class="stat-label">Jenis gangguan tidur terdeteksi</div>
            </div>
            <div class="stat reveal reveal-delay-3">
                <div class="stat-num"><span class="accent">100%</span></div>
                <div class="stat-label">Gratis diunduh & digunakan</div>
            </div>
        </div>
    </div>

    <!-- ── PAIN POINT ── -->
    <section class="pain" id="masalah">
        <div class="max-w">
            <div class="pain-grid">
                <div>
                    <span class="section-tag reveal">Mengapa Ini Penting</span>
                    <h2 class="section-title reveal">Gangguan Tidur<br>Lebih Serius dari<br>yang Anda Kira</h2>
                    <p class="section-sub reveal">Jutaan orang meremehkan kualitas tidur mereka — padahal dampaknya jauh lebih luas dari sekadar rasa lelah di pagi hari.</p>
                    <div class="pain-cards">
                        <div class="pain-card reveal">
                            <div class="pain-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 2C5.6 2 2 5.6 2 10s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 3c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm0 9c-2 0-3.7-1-4.7-2.5.1-1.5 3.2-2.4 4.7-2.4s4.6.9 4.7 2.4c-1 1.5-2.7 2.5-4.7 2.5z" fill="#3a5ce8"/></svg>
                            </div>
                            <div>
                                <h4>Risiko Penyakit Serius</h4>
                                <p>Kurang tidur berkualitas meningkatkan risiko penyakit jantung, diabetes tipe 2, dan gangguan mental hingga 3x lipat.</p>
                            </div>
                        </div>
                        <div class="pain-card reveal reveal-delay-1">
                            <div class="pain-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><ellipse cx="10" cy="8" rx="6" ry="6" stroke="#3a5ce8" stroke-width="1.5"/><path d="M10 14v4M7 18h6" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg>
                            </div>
                            <div>
                                <h4>Penurunan Produktivitas</h4>
                                <p>Gangguan tidur menyebabkan penurunan fokus, memori, dan kemampuan pengambilan keputusan yang signifikan.</p>
                            </div>
                        </div>
                        <div class="pain-card reveal reveal-delay-2">
                            <div class="pain-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="3" y="4" width="14" height="12" rx="2" stroke="#3a5ce8" stroke-width="1.5"/><path d="M7 8h6M7 11h4" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg>
                            </div>
                            <div>
                                <h4>Akses Pemeriksaan Terbatas</h4>
                                <p>Biaya sleep study mahal dan fasilitas terbatas — kebanyakan orang tidak pernah mendapat pemeriksaan yang tepat.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="reveal">
                    <div class="data-card">
                        <div class="data-title">Prevalensi Gangguan Tidur di Indonesia</div>
                        <div class="bar-chart">
                            <div class="bar-row">
                                <div class="bar-lbl">Insomnia</div>
                                <div class="bar-track"><div class="bar-fill" style="width:67%"></div></div>
                                <div class="bar-pct">67%</div>
                            </div>
                            <div class="bar-row">
                                <div class="bar-lbl">Sleep Apnea</div>
                                <div class="bar-track"><div class="bar-fill" style="width:45%"></div></div>
                                <div class="bar-pct">45%</div>
                            </div>
                            <div class="bar-row">
                                <div class="bar-lbl">Hypersomnia</div>
                                <div class="bar-track"><div class="bar-fill" style="width:28%"></div></div>
                                <div class="bar-pct">28%</div>
                            </div>
                            <div class="bar-row">
                                <div class="bar-lbl">Parasomnia</div>
                                <div class="bar-track"><div class="bar-fill" style="width:18%"></div></div>
                                <div class="bar-pct">18%</div>
                            </div>
                        </div>
                        <div class="data-note">
                            💡 <strong>Tahukah Anda?</strong> Hanya ~30% penderita gangguan tidur yang mencari bantuan profesional akibat keterbatasan akses dan biaya.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── SOLUTION ── -->
    <section class="solution" id="solusi">
        <div class="max-w">
            <span class="section-tag reveal">Solusi Kami</span>
            <h2 class="section-title reveal">NOCTURA Hadir sebagai<br>Asisten Tidur Pribadi Anda</h2>
            <p class="section-sub reveal">Memanfaatkan teknologi prediksi berbasis data medis untuk membantu Anda memahami kualitas tidur dan mendeteksi potensi gangguan sejak awal.</p>
            <div class="solution-cards">
                <div class="sol-card reveal">
                    <div class="sol-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="5" y="2" width="14" height="20" rx="3" stroke="#3a5ce8" stroke-width="1.5"/><circle cx="12" cy="17" r="1" fill="#3a5ce8"/></svg>
                    </div>
                    <h3>Mudah Digunakan</h3>
                    <p>Tidak perlu perangkat khusus. Cukup smartphone Anda, kuesioner singkat, dan hasilnya langsung tersaji dalam hitungan detik.</p>
                </div>
                <div class="sol-card reveal reveal-delay-1">
                    <div class="sol-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </div>
                    <h3>Berbasis Riset Medis</h3>
                    <p>Kuesioner disusun berdasarkan standar skrining klinis tervalidasi, termasuk Pittsburgh Sleep Quality Index (PSQI).</p>
                </div>
                <div class="sol-card reveal reveal-delay-2">
                    <div class="sol-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="#3a5ce8" stroke-width="1.5" stroke-linejoin="round"/></svg>
                    </div>
                    <h3>Privasi Terjaga</h3>
                    <p>Data kesehatan Anda terenkripsi dan aman. Kami menjaga kerahasiaan sesuai regulasi perlindungan data pribadi Indonesia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ── APP SHOWCASE ── -->
    <section class="showcase" id="tampilan">
        <div class="showcase-inner">
            <div class="screens-wrap">
                <!-- Screen 1: Dashboard -->
                <div class="screen-card screen-card-1">
                    <div class="sc-header">
                        <div class="sc-icon-wrap">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="7.5" fill="#071048"/>
                                <path d="M10.5 5C8.5 5 5.5 6 5.5 8C5.5 10 8.5 11 10.5 11C8 11 3.5 9.5 3.5 8C3.5 6.5 8 5 10.5 5Z" fill="white"/>
                            </svg>
                        </div>
                        <div>
                            <div class="sc-title">Dashboard Tidur</div>
                            <div class="sc-sub">Minggu ini</div>
                        </div>
                    </div>
                    <div class="sc-score-ring-wrap">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                            <circle cx="40" cy="40" r="32" stroke="#eef1ff" stroke-width="6"/>
                            <circle cx="40" cy="40" r="32" stroke="#3a5ce8" stroke-width="6" stroke-dasharray="155 46" stroke-dashoffset="50" stroke-linecap="round"/>
                            <text x="40" y="38" text-anchor="middle" font-size="18" font-weight="700" fill="#071048">78</text>
                            <text x="40" y="52" text-anchor="middle" font-size="8" fill="#8590b8">skor tidur</text>
                        </svg>
                    </div>
                    <div class="sc-bars">
                        <div class="sc-bar-row"><div class="sc-bar-lbl">Insomnia</div><div class="sc-bar-track"><div class="sc-bar-fill" style="width:25%"></div></div></div>
                        <div class="sc-bar-row"><div class="sc-bar-lbl">Sleep Apnea</div><div class="sc-bar-track"><div class="sc-bar-fill" style="width:15%"></div></div></div>
                        <div class="sc-bar-row"><div class="sc-bar-lbl">Hypersomnia</div><div class="sc-bar-track"><div class="sc-bar-fill" style="width:10%"></div></div></div>
                    </div>
                </div>

                <!-- Screen 2: Riwayat -->
                <div class="screen-card screen-card-2">
                    <div class="sc-header">
                        <div class="sc-icon-wrap">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="7.5" fill="#071048"/>
                                <path d="M10.5 5C8.5 5 5.5 6 5.5 8C5.5 10 8.5 11 10.5 11C8 11 3.5 9.5 3.5 8C3.5 6.5 8 5 10.5 5Z" fill="white"/>
                            </svg>
                        </div>
                        <div>
                            <div class="sc-title">Riwayat Prediksi</div>
                            <div class="sc-sub">3 hasil terakhir</div>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:0.5rem;">
                        <div style="background:var(--soft-gray);border-radius:8px;padding:0.5rem 0.6rem;display:flex;justify-content:space-between;align-items:center;">
                            <div style="font-size:0.6rem;font-weight:600;color:var(--text-dark);">15 Jan 2025</div>
                            <div style="font-size:0.55rem;background:#dcfce7;color:#16a34a;padding:0.15rem 0.5rem;border-radius:10px;">Risiko Rendah</div>
                        </div>
                        <div style="background:var(--soft-gray);border-radius:8px;padding:0.5rem 0.6rem;display:flex;justify-content:space-between;align-items:center;">
                            <div style="font-size:0.6rem;font-weight:600;color:var(--text-dark);">1 Jan 2025</div>
                            <div style="font-size:0.55rem;background:#fef9c3;color:#ca8a04;padding:0.15rem 0.5rem;border-radius:10px;">Risiko Sedang</div>
                        </div>
                        <div style="background:var(--soft-gray);border-radius:8px;padding:0.5rem 0.6rem;display:flex;justify-content:space-between;align-items:center;">
                            <div style="font-size:0.6rem;font-weight:600;color:var(--text-dark);">15 Des 2024</div>
                            <div style="font-size:0.55rem;background:#dcfce7;color:#16a34a;padding:0.15rem 0.5rem;border-radius:10px;">Risiko Rendah</div>
                        </div>
                    </div>
                </div>

                <!-- Screen 3: Edukasi -->
                <div class="screen-card screen-card-3">
                    <div class="sc-header">
                        <div class="sc-icon-wrap">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="7.5" fill="#071048"/>
                                <path d="M10.5 5C8.5 5 5.5 6 5.5 8C5.5 10 8.5 11 10.5 11C8 11 3.5 9.5 3.5 8C3.5 6.5 8 5 10.5 5Z" fill="white"/>
                            </svg>
                        </div>
                        <div>
                            <div class="sc-title">Edukasi Tidur</div>
                            <div class="sc-sub">Artikel pilihan</div>
                        </div>
                    </div>
                    <div class="sc-article">
                        <div class="sc-article-item">
                            <div class="sc-article-thumb"></div>
                            <div>
                                <div class="sc-article-t">Tips Sleep Hygiene untuk Tidur Lebih Nyenyak</div>
                                <div class="sc-article-s">3 min baca</div>
                            </div>
                        </div>
                        <div class="sc-article-item">
                            <div class="sc-article-thumb" style="background:#c7d2fe;"></div>
                            <div>
                                <div class="sc-article-t">Mengenal Sleep Apnea: Gejala & Penanganan</div>
                                <div class="sc-article-s">5 min baca</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Showcase text -->
            <div>
                <span class="section-tag reveal">Tampilan Aplikasi</span>
                <h2 class="section-title reveal">Dirancang untuk<br>Kemudahan Anda</h2>
                <p class="section-sub reveal" style="max-width:420px;">Antarmuka yang bersih dan intuitif memudahkan Anda memantau kesehatan tidur setiap hari — tanpa perlu keahlian teknis apapun.</p>
                <div style="margin-top:2rem; display:flex; flex-direction:column; gap:1rem;">
                    <div class="why-item reveal reveal-delay-1">
                        <div class="why-bullet">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l4 4 6-7" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <h4>Dashboard interaktif</h4>
                            <p>Visualisasi tren tidur Anda dalam grafik yang mudah dibaca.</p>
                        </div>
                    </div>
                    <div class="why-item reveal reveal-delay-2">
                        <div class="why-bullet">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l4 4 6-7" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <h4>Riwayat prediksi lengkap</h4>
                            <p>Pantau perkembangan dari waktu ke waktu secara detail.</p>
                        </div>
                    </div>
                    <div class="why-item reveal reveal-delay-3">
                        <div class="why-bullet">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l4 4 6-7" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <h4>Konten edukasi kuratif</h4>
                            <p>Artikel dan tips praktis tentang kesehatan tidur setiap minggu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FEATURES ── -->
    <section class="features" id="fitur">
        <div class="max-w">
            <div class="features-header">
                <div>
                    <span class="section-tag reveal">Fitur Lengkap</span>
                    <h2 class="section-title reveal">Semua yang Anda<br>Butuhkan untuk<br>Tidur Lebih Baik</h2>
                </div>
                <div style="display:flex;flex-direction:column;justify-content:flex-end;gap:1rem;">
                    <p class="section-sub reveal" style="max-width:360px;">Tersedia dua ekosistem terintegrasi — aplikasi mobile untuk pengguna, dan dashboard web untuk tenaga kesehatan.</p>
                    <div class="reveal">
                        <div class="tab-switcher">
                            <button class="tab-btn active" onclick="switchTab('mobile', this)">📱 Mobile App</button>
                            <button class="tab-btn" onclick="switchTab('web', this)">💻 Web Admin</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="features-grid" id="featMobile">
                <div class="feat-card reveal">
                    <div class="feat-icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="8" stroke="#3a5ce8" stroke-width="1.5"/><path d="M11 7v4l3 2" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </div>
                    <div class="feat-content">
                        <h4>Prediksi Gangguan Tidur</h4>
                        <p>Isi kuesioner singkat berbasis medis dan dapatkan hasil prediksi risiko gangguan tidur Anda saat ini secara instan.</p>
                    </div>
                </div>
                <div class="feat-card reveal reveal-delay-1">
                    <div class="feat-icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M3 5h16M3 9h16M3 13h10" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </div>
                    <div class="feat-content">
                        <h4>Riwayat Prediksi</h4>
                        <p>Pantau perkembangan hasil prediksi dari waktu ke waktu untuk memahami tren kualitas tidur Anda.</p>
                    </div>
                </div>
                <div class="feat-card reveal reveal-delay-2">
                    <div class="feat-icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M3 17l5-6 4 4 4-8 4 5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div class="feat-content">
                        <h4>Visualisasi Data Tidur</h4>
                        <p>Lihat tren kualitas tidur Anda dalam bentuk grafik interaktif yang mudah dipahami dan informatif.</p>
                    </div>
                </div>
                <div class="feat-card reveal reveal-delay-3">
                    <div class="feat-icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M4 19V8l7-5 7 5v11H4z" stroke="#3a5ce8" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 19v-6h4v6" stroke="#3a5ce8" stroke-width="1.5" stroke-linejoin="round"/></svg>
                    </div>
                    <div class="feat-content">
                        <h4>Konten Edukasi</h4>
                        <p>Baca artikel, tips, dan informasi seputar kesehatan tidur untuk meningkatkan kebiasaan tidur yang lebih baik.</p>
                    </div>
                </div>
            </div>

            <div class="features-grid" id="featWeb" style="display:none;">
                <div class="feat-card reveal">
                    <div class="feat-icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><rect x="3" y="3" width="16" height="16" rx="2" stroke="#3a5ce8" stroke-width="1.5"/><path d="M3 8h16" stroke="#3a5ce8" stroke-width="1.5"/><path d="M8 3v5" stroke="#3a5ce8" stroke-width="1.5"/></svg>
                    </div>
                    <div class="feat-content">
                        <h4>Manajemen Data Master</h4>
                        <p>Kelola data pengguna, pertanyaan kuesioner, opsi jawaban, dan konten edukasi dari satu dashboard terpusat.</p>
                    </div>
                </div>
                <div class="feat-card reveal reveal-delay-1">
                    <div class="feat-icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M3 17l5-6 4 4 4-8 4 5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div class="feat-content">
                        <h4>Dashboard & Monitoring</h4>
                        <p>Pantau hasil prediksi dan tren kesehatan tidur masyarakat secara agregat dan anonim secara real-time.</p>
                    </div>
                </div>
                <div class="feat-card reveal reveal-delay-2">
                    <div class="feat-icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="8" r="3" stroke="#3a5ce8" stroke-width="1.5"/><path d="M4 19c0-4 3.1-7 7-7s7 3 7 7" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </div>
                    <div class="feat-content">
                        <h4>Manajemen Pengguna</h4>
                        <p>Kelola akun pengguna, pantau aktivitas, dan pastikan keamanan data seluruh pengguna platform.</p>
                    </div>
                </div>
                <div class="feat-card reveal reveal-delay-3">
                    <div class="feat-icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M4 14l4-4 4 4 4-6" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15 19H4a1 1 0 01-1-1V4" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </div>
                    <div class="feat-content">
                        <h4>Laporan & Ekspor Data</h4>
                        <p>Unduh laporan komprehensif untuk keperluan penelitian atau evaluasi layanan kesehatan tidur.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── HOW IT WORKS ── -->
    <section class="how" id="cara-kerja">
        <div class="max-w">
            <span class="section-tag reveal">Cara Kerja</span>
            <h2 class="section-title reveal">Mulai dalam 4 Langkah Mudah</h2>
            <p class="section-sub reveal">Tidak perlu keahlian medis. Siapa pun dapat menggunakan NOCTURA dengan mudah dan mendapat hasil yang bermakna.</p>
            <div class="steps">
                <div class="step reveal">
                    <div class="step-num">1</div>
                    <h4>Unduh Aplikasi</h4>
                    <p>Download NOCTURA secara gratis di Google Play Store atau Apple App Store.</p>
                </div>
                <div class="step reveal reveal-delay-1">
                    <div class="step-num">2</div>
                    <h4>Jawab Kuesioner</h4>
                    <p>Isi pertanyaan singkat (5–10 menit) seputar kebiasaan dan kualitas tidur Anda.</p>
                </div>
                <div class="step reveal reveal-delay-2">
                    <div class="step-num">3</div>
                    <h4>Dapatkan Hasil</h4>
                    <p>Terima hasil prediksi risiko gangguan tidur beserta penjelasan dan rekomendasi awal.</p>
                </div>
                <div class="step reveal reveal-delay-3">
                    <div class="step-num">4</div>
                    <h4>Pantau & Tingkatkan</h4>
                    <p>Lacak perkembangan dan baca konten edukasi untuk pola tidur yang lebih sehat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ── WHY NOCTURA ── -->
    <section class="why" id="kenapa">
        <div class="max-w">
            <div class="why-inner">
                <div>
                    <span class="section-tag reveal">Keunggulan Kami</span>
                    <h2 class="section-title reveal">Mengapa Memilih NOCTURA?</h2>
                    <p class="section-sub reveal" style="max-width:420px;">Bukan sekadar pelacak tidur biasa — NOCTURA adalah sistem deteksi dini yang dirancang untuk memberikan dampak nyata.</p>
                    <div class="why-list">
                        <div class="why-item reveal">
                            <div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l4 4 6-7" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                            <div><h4>Akurat & Terpercaya</h4><p>Algoritma prediksi dikembangkan berdasarkan standar skrining medis tervalidasi secara klinis.</p></div>
                        </div>
                        <div class="why-item reveal reveal-delay-1">
                            <div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 2v3M8 11v3M2 8h3M11 8h3" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div>
                            <div><h4>Cepat & Tanpa Ribet</h4><p>Hasil prediksi instan tanpa perlu membuat janji dokter atau menunggu antrian panjang.</p></div>
                        </div>
                        <div class="why-item reveal reveal-delay-2">
                            <div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 5h10M3 8h8M3 11h6" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div>
                            <div><h4>Edukatif & Holistik</h4><p>Tidak hanya mendeteksi, tetapi membekali Anda dengan pengetahuan untuk tidur lebih berkualitas.</p></div>
                        </div>
                        <div class="why-item reveal reveal-delay-3">
                            <div class="why-bullet"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 2L5 5H3a1 1 0 00-1 1v4a1 1 0 001 1h2l3 3V2z" stroke="#3a5ce8" stroke-width="1.5" stroke-linejoin="round"/><path d="M11 5.5a3 3 0 010 5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div>
                            <div><h4>Privasi & Keamanan Data</h4><p>Semua data kesehatan dienkripsi dan dikelola sesuai regulasi perlindungan data pribadi.</p></div>
                        </div>
                    </div>
                </div>
                <div class="why-visual">
                    <div class="metric-card reveal">
                        <div class="metric-emoji">😴</div>
                        <div><div class="metric-val">7–9 Jam<span>Durasi tidur ideal orang dewasa per malam</span></div></div>
                    </div>
                    <div class="metric-card reveal reveal-delay-1">
                        <div class="metric-emoji">⚡</div>
                        <div><div class="metric-val">&lt; 5 Mnt<span>Rata-rata waktu penyelesaian kuesioner</span></div></div>
                    </div>
                    <div class="metric-card reveal reveal-delay-2">
                        <div class="metric-emoji">🎯</div>
                        <div><div class="metric-val">PSQI<span>Standar skrining kualitas tidur yang digunakan</span></div></div>
                    </div>
                    <div class="metric-card reveal reveal-delay-3">
                        <div class="metric-emoji">🌙</div>
                        <div><div class="metric-val">24/7<span>Akses kapan saja dan di mana saja</span></div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── TESTIMONIALS ── -->
    <section class="testimonials" id="ulasan">
        <div class="max-w">
            <span class="section-tag reveal">Ulasan Pengguna</span>
            <h2 class="section-title reveal">Mereka Sudah Merasakannya</h2>
            <p class="section-sub reveal">Bergabunglah dengan ribuan pengguna yang sudah lebih peduli terhadap kualitas tidur mereka bersama NOCTURA.</p>
            <div class="testi-grid">
                <div class="testi-card reveal">
                    <div class="testi-stars">★★★★★</div>
                    <p class="testi-text">"Aplikasinya simpel banget. Saya jadi tahu kalau kebiasaan begadang saya sudah masuk risiko insomnia ringan. Sekarang saya lebih disiplin tidur."</p>
                    <div class="testi-author">
                        <div class="testi-avatar">R</div>
                        <div><div class="testi-name">Rina Kusuma</div><div class="testi-role">Mahasiswi, 22 tahun</div></div>
                    </div>
                </div>
                <div class="testi-card reveal reveal-delay-1">
                    <div class="testi-stars">★★★★★</div>
                    <p class="testi-text">"Saya tidak menyangka sering terbangun malam itu bisa jadi tanda sleep apnea. NOCTURA membantu saya sadar dan akhirnya konsultasi ke dokter."</p>
                    <div class="testi-author">
                        <div class="testi-avatar">B</div>
                        <div><div class="testi-name">Budi Santoso</div><div class="testi-role">Karyawan Swasta, 35 tahun</div></div>
                    </div>
                </div>
                <div class="testi-card reveal reveal-delay-2">
                    <div class="testi-stars">★★★★☆</div>
                    <p class="testi-text">"Konten edukasinya sangat bermanfaat. Saya belajar banyak tentang sleep hygiene yang ternyata selama ini saya abaikan."</p>
                    <div class="testi-author">
                        <div class="testi-avatar">D</div>
                        <div><div class="testi-name">Dewi Rahayu</div><div class="testi-role">Ibu Rumah Tangga, 40 tahun</div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FAQ ── -->
    <section class="faq" id="faq">
        <div class="max-w">
            <div class="faq-inner">
                <div>
                    <span class="section-tag reveal">FAQ</span>
                    <h2 class="section-title reveal">Pertanyaan yang Sering Diajukan</h2>
                    <p class="section-sub reveal">Belum menemukan jawaban? Hubungi kami melalui email atau media sosial.</p>
                    <a href="mailto:hello@noctura.id" class="btn-outline" style="margin-top:2rem; display:inline-flex;">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="9" rx="1" stroke="currentColor" stroke-width="1.2"/><path d="M1 4l6 4 6-4" stroke="currentColor" stroke-width="1.2"/></svg>
                        Hubungi Kami
                    </a>
                </div>
                <div class="faq-list reveal">
                    <div class="faq-item">
                        <button class="faq-q" onclick="toggleFaq(this)">
                            Apakah NOCTURA menggantikan diagnosis dokter?
                            <div class="faq-chevron"><svg viewBox="0 0 10 10" fill="none"><path d="M2 3.5L5 6.5L8 3.5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div>
                        </button>
                        <div class="faq-a"><p>Tidak. NOCTURA adalah alat skrining dini berbasis kuesioner. Hasil prediksi bukan diagnosis medis. Jika hasil menunjukkan risiko tinggi, sangat disarankan untuk berkonsultasi dengan dokter atau tenaga kesehatan untuk pemeriksaan lebih lanjut.</p></div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-q" onclick="toggleFaq(this)">
                            Apakah aplikasi ini berbayar?
                            <div class="faq-chevron"><svg viewBox="0 0 10 10" fill="none"><path d="M2 3.5L5 6.5L8 3.5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div>
                        </button>
                        <div class="faq-a"><p>NOCTURA sepenuhnya gratis untuk diunduh dan digunakan untuk fitur-fitur dasar termasuk prediksi, riwayat, dan akses konten edukasi. Kami percaya setiap orang berhak mendapat akses informasi kesehatan tidur yang baik.</p></div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-q" onclick="toggleFaq(this)">
                            Bagaimana keamanan data kesehatan saya?
                            <div class="faq-chevron"><svg viewBox="0 0 10 10" fill="none"><path d="M2 3.5L5 6.5L8 3.5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div>
                        </button>
                        <div class="faq-a"><p>Kami mengutamakan privasi pengguna. Semua data kesehatan dienkripsi menggunakan standar enkripsi terkini dan dikelola sesuai regulasi perlindungan data pribadi yang berlaku di Indonesia.</p></div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-q" onclick="toggleFaq(this)">
                            Gangguan tidur apa saja yang bisa dideteksi?
                            <div class="faq-chevron"><svg viewBox="0 0 10 10" fill="none"><path d="M2 3.5L5 6.5L8 3.5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div>
                        </button>
                        <div class="faq-a"><p>NOCTURA dapat mendeteksi risiko insomnia, sleep apnea, hypersomnia, dan parasomnia berdasarkan pola jawaban kuesioner yang Anda berikan. Setiap hasil dilengkapi penjelasan dan rekomendasi awal.</p></div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-q" onclick="toggleFaq(this)">
                            Seberapa sering saya harus mengisi kuesioner?
                            <div class="faq-chevron"><svg viewBox="0 0 10 10" fill="none"><path d="M2 3.5L5 6.5L8 3.5" stroke="#3a5ce8" stroke-width="1.5" stroke-linecap="round"/></svg></div>
                        </button>
                        <div class="faq-a"><p>Disarankan minimal sebulan sekali atau setelah ada perubahan signifikan pada pola tidur Anda. Fitur Riwayat membantu Anda memantau tren dari waktu ke waktu.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CTA ── -->
    <section class="cta-section" id="download">
        <div class="cta-inner reveal">
            <div class="cta-blob"></div>
            <span class="section-tag">Download Sekarang</span>
            <h2 class="section-title">Tidur Nyenyak Dimulai<br>dari Satu Langkah Kecil</h2>
            <p class="section-sub">Bergabunglah dengan ribuan pengguna yang sudah lebih peduli terhadap kesehatan tidur mereka. Gratis, mudah, dan tepercaya.</p>
            <div class="store-btns">
                <a href="#" class="store-btn">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><path d="M4 20.5L14 4l10 16.5H4z" fill="white" opacity="0.2"/><path d="M6 22l8-14 8 14" stroke="white" stroke-width="1.5" stroke-linejoin="round"/><path d="M9.5 16.5h9" stroke="white" stroke-width="1.5" stroke-linecap="round"/></svg>
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

    <!-- ── FOOTER ── -->
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <a href="#" class="nav-brand" style="text-decoration:none;">
                    <svg class="nav-logo" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="18" cy="18" r="17" fill="#071048" stroke="#dde3ff" stroke-width="1"/>
                        <path d="M22 11.5C19 11.5 14 13.5 14 18C14 22.5 19 24.5 22 24.5C18.5 24.5 11 22 11 18C11 14 18.5 11.5 22 11.5Z" fill="white"/>
                    </svg>
                    <span class="nav-name">NOCTURA</span>
                </a>
                <p>Sistem Deteksi Dini Gangguan Tidur Berbasis Mobile. Membantu masyarakat Indonesia hidup lebih sehat melalui tidur yang berkualitas.</p>
                <div class="footer-socials">
                    <a href="#" class="social-btn" title="Instagram">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="2" y="2" width="10" height="10" rx="3" stroke="currentColor" stroke-width="1.2"/><circle cx="7" cy="7" r="2.5" stroke="currentColor" stroke-width="1.2"/><circle cx="10.5" cy="3.5" r="0.6" fill="currentColor"/></svg>
                    </a>
                    <a href="#" class="social-btn" title="Twitter">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1.5 1.5L12.5 12.5M12.5 1.5L1.5 12.5" stroke="currentColor" stroke-width="0.01"/><path d="M13 1.5H9.5L7 5.5 4.5 1.5H1L5.5 7.5 1 12.5H4.5L7 8.5 9.5 12.5H13L8.5 7.5 13 1.5Z" fill="currentColor"/></svg>
                    </a>
                    <a href="#" class="social-btn" title="YouTube">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="8" rx="2" stroke="currentColor" stroke-width="1.2"/><path d="M5.5 5l3.5 2-3.5 2V5z" fill="currentColor"/></svg>
                    </a>
                    <a href="#" class="social-btn" title="Email">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="8" rx="1" stroke="currentColor" stroke-width="1.2"/><path d="M1 4l6 4 6-4" stroke="currentColor" stroke-width="1.2"/></svg>
                    </a>
                </div>
            </div>
            <div class="footer-col">
                <h5>Produk</h5>
                <ul>
                    <li><a href="#fitur">Fitur Aplikasi</a></li>
                    <li><a href="#cara-kerja">Cara Kerja</a></li>
                    <li><a href="#download">Download</a></li>
                    <li><a href="#">Web Admin</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Informasi</h5>
                <ul>
                    <li><a href="#masalah">Gangguan Tidur</a></li>
                    <li><a href="#">Artikel Edukasi</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Legal</h5>
                <ul>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat Penggunaan</a></li>
                    <li><a href="#">Disclaimer Medis</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 NOCTURA - Sleep Intelligence. Hak Cipta Dilindungi.</p>
            <p>Dibuat dengan ❤️ untuk kesehatan tidur Indonesia · <a href="#">Kebijakan Privasi</a></p>
        </div>
    </footer>

    <script>
        // ── SCROLL REVEAL
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // ── NAVBAR SCROLL
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 60) {
                nav.style.boxShadow = '0 4px 24px rgba(13,22,64,0.08)';
            } else {
                nav.style.boxShadow = 'none';
            }
        });

        // ── FAQ TOGGLE
        function toggleFaq(btn) {
            const item = btn.parentElement;
            const isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        }

        // ── TAB SWITCHER
        function switchTab(tab, btn) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('featMobile').style.display = tab === 'mobile' ? 'grid' : 'none';
            document.getElementById('featWeb').style.display = tab === 'web' ? 'grid' : 'none';
        }

        // ── MOBILE NAV
        function toggleNav() {
            const links = document.getElementById('navLinks');
            if (links.style.display === 'flex') {
                links.style.display = 'none';
            } else {
                links.style.cssText = 'display:flex;flex-direction:column;position:absolute;top:100%;left:0;right:0;background:rgba(255,255,255,0.97);backdrop-filter:blur(20px);padding:1.5rem 5%;border-bottom:1px solid rgba(58,92,232,0.08);gap:1.2rem;box-shadow:0 12px 30px rgba(13,22,64,0.1);';
            }
        }
    </script>
</body>
</html>