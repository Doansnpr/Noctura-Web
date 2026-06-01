<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Dashboard Admin - Noctura</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Poppins:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <div class="sidebar-overlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo text-center py-2">
                <a href="<?php echo e(route('dashboard')); ?>" class="d-block">
                    <img src="<?php echo e(asset('assets/img/logo-noctura.png')); ?>" 
                        alt="Noctura Logo" 
                        class="brand-logo-full">
                    
                    <img src="<?php echo e(asset('assets/img/icon-noctura.png')); ?>" 
                        alt="Noctura Icon" 
                        class="brand-logo-icon">
                </a>
            </div>
        </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Main Menu</div>

            <a href="<?php echo e(route('dashboard')); ?>" class="nav-item active" data-nav="dashboard">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                <span>Dashboard</span>
            </a>

            <div class="nav-group" id="masterDataGroup">
                <div class="nav-item master-data-trigger">
                    <div class="trigger-text">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <ellipse cx="12" cy="5" rx="9" ry="3" />
                            <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5" />
                            <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3" />
                        </svg>
                        <span>Master Data</span>
                    </div>
                    <svg class="dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M9 18l6-6-6-6" />
                    </svg>
                </div>
                <div class="sub-nav">
                    <div class="flyout-title">Master Data</div>
                    <a href="<?php echo e(route('akun.index')); ?>" class="sub-nav-item" data-sub="akun">
                        <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <span>Kelola Akun</span>
                    </a>
                    <a href="<?php echo e(url('/edukasi')); ?>" class="sub-nav-item" data-sub="edu">
                        <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                        <span>Kelola Edukasi</span>
                    </a>
                </div>
            </div>

            <a href="<?php echo e(route('visualisasi')); ?>" class="nav-item <?php echo e(request()->routeIs('visualisasi') ? 'active' : ''); ?>" data-nav="visualisasi">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="9" width="4" height="12" rx="1" />
                    <rect x="10" y="5" width="4" height="16" rx="1" />
                    <rect x="17" y="2" width="4" height="19" rx="1" />
                </svg>
                <span>Visualisasi</span>
            </a>

            <a href="<?php echo e(route('monitoring-prediksi.index')); ?>" class="nav-item <?php echo e(request()->routeIs('monitoring-prediksi.*') ? 'active' : ''); ?>">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.07 4.93A10 10 0 1 1 4.93 19.07"/>
                    <path d="M12 2v2M12 20v2M2 12h2M20 12h2"/>
                </svg>
                <span>Monitoring Prediksi</span>
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <header class="topbar">
            <button class="sidebar-toggle-btn" id="sidebarToggleBtn" title="Toggle Sidebar">
                <svg class="toggle-icon" id="toggleIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </button>

            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                </svg>
            </button>

            <div class="topbar-divider"></div>

            <div class="topbar-actions">
                <div class="notif-wrapper">
    <button type="button" class="icon-btn notif-btn" id="notifBtn" title="Notifikasi">
        <?php if(($topbarNotificationCount ?? 0) > 0): ?>
            <div class="notif-dot"></div>
            <span class="notif-count">
                <?php echo e(($topbarNotificationCount ?? 0) > 9 ? '9+' : $topbarNotificationCount); ?>

            </span>
        <?php endif; ?>

        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
        </svg>
    </button>

    <div class="notif-dropdown" id="notifDropdown">
        <div class="notif-head">
            <div>
                <div class="notif-title">Notifikasi</div>
                <div class="notif-sub">
                    <?php echo e($topbarNotificationCount ?? 0); ?> aktivitas baru hari ini
                </div>
            </div>
        </div>

        <div class="notif-list">
            <?php $__empty_1 = true; $__currentLoopData = ($topbarNotifications ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e($notif['url']); ?>" class="notif-item">
                    <div class="notif-item-icon <?php echo e($notif['type']); ?>">
                        <?php if($notif['type'] === 'prediction'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                            </svg>
                        <?php else: ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        <?php endif; ?>
                    </div>

                    <div class="notif-item-body">
                        <div class="notif-item-top">
                            <strong><?php echo e($notif['title']); ?></strong>
                            <span><?php echo e($notif['time']); ?></span>
                        </div>
                        <p><?php echo e($notif['message']); ?></p>
                        <small><?php echo e($notif['meta']); ?></small>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="notif-empty">
                    Belum ada notifikasi baru.
                </div>
            <?php endif; ?>
        </div>

        <div class="notif-foot">
            <a href="<?php echo e(route('monitoring-prediksi.index')); ?>">Lihat monitoring prediksi</a>
        </div>
    </div>
</div>

                <!-- Profile Button with Dropdown -->
                <div class="icon-btn profile-btn" id="profileBtn" title="Profil">
                    <div class="profile-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>

                    <!-- Dropdown Menu -->
                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="dropdown-header">
                            <div class="dropdown-avatar">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                            <div>
                                <div class="dropdown-name">
                                    <?php echo e(auth()->user()->username ?? auth()->user()->email ?? 'Admin Noctura'); ?>

                                </div>
                                <div class="dropdown-email">
                                    <?php echo e(auth()->user()->email ?? '-'); ?>

                                </div>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>

                        <form action="<?php echo e(route('logout')); ?>" method="POST" id="logoutForm" onsubmit="handleLogoutSubmit(event)">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item dropdown-logout" id="logoutBtn">
                                <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                    <polyline points="16 17 21 12 16 7"/>
                                    <line x1="21" y1="12" x2="9" y2="12"/>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="dashboard-body" id="mainContent">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <script>
        (function() {
            'use strict';

            const body            = document.body;
            const toggleBtn       = document.getElementById('sidebarToggleBtn');
            const mobileToggle    = document.getElementById('mobileMenuToggle');
            const overlay         = document.querySelector('.sidebar-overlay');
            const toggleIcon      = document.getElementById('toggleIcon');
            const masterGroup     = document.getElementById('masterDataGroup');
            const trigger         = document.querySelector('.master-data-trigger');
            const subNavOriginal  = masterGroup?.querySelector('.sub-nav');
            const profileBtn      = document.getElementById('profileBtn');
            const profileDropdown = document.getElementById('profileDropdown');
            const notifBtn        = document.getElementById('notifBtn');
            const notifDropdown   = document.getElementById('notifDropdown');
            const profileModal    = document.getElementById('profileModal');
            const settingsModal   = document.getElementById('settingsModal');
            const openProfileBtn  = document.getElementById('openProfileModal');
            const openSettingsBtn = document.getElementById('openSettingsModal');
            const closeProfileBtn = document.getElementById('closeProfileModal');
            const closeSettingsBtn       = document.getElementById('closeSettingsModal');
            const cancelSettingsBtn      = document.getElementById('cancelSettings');
            const closeProfileFooterBtn  = document.getElementById('closeProfileBtn');

            let flyoutEl = null;

            // ── Flyout ──
            function buildFlyout() {
                if (flyoutEl || !subNavOriginal) return;
                flyoutEl = document.createElement('div');
                flyoutEl.className = 'sub-nav-flyout';
                flyoutEl.innerHTML = subNavOriginal.innerHTML;
                document.body.appendChild(flyoutEl);
                flyoutEl.querySelectorAll('.sub-nav-item').forEach(item => {
                    item.addEventListener('click', () => {
                        const sub = item.dataset.sub;
                        document.querySelectorAll('.nav-item, .sub-nav-item').forEach(el => el.classList.remove('active'));
                        item.classList.add('active');
                        const mirror = subNavOriginal.querySelector(`[data-sub="${sub}"]`);
                        if (mirror) mirror.classList.add('active');
                        closeFlyout();
                    });
                });
            }

            function openFlyout() {
                if (!trigger) return;
                buildFlyout();
                const rect = trigger.getBoundingClientRect();
                const viewH = window.innerHeight;
                const flyH = 220;
                let topPos = rect.top;
                if (topPos + flyH > viewH - 16) topPos = viewH - flyH - 16;
                const arrowTop = (rect.top + rect.height / 2) - topPos - 6;
                flyoutEl.style.top = topPos + 'px';
                flyoutEl.style.setProperty('--arrow-top', arrowTop + 'px');
                requestAnimationFrame(() => flyoutEl?.classList.add('visible'));
            }

            function closeFlyout() {
                if (!flyoutEl) return;
                flyoutEl.classList.remove('visible');
                if (masterGroup) masterGroup.classList.remove('open');
            }

            function closeProfileDropdown() {
                profileDropdown?.classList.remove('visible');
                profileBtn?.classList.remove('active');
            }

            function closeNotifDropdown() {
                notifDropdown?.classList.remove('visible');
                notifBtn?.classList.remove('active');
            }

            function toggleNotifDropdown(e) {
                if (e) {
                    e.stopPropagation();
                    e.preventDefault();
                }

                if (!notifDropdown) return;

                const isVisible = notifDropdown.classList.contains('visible');

                closeFlyout();
                closeProfileDropdown();

                if (isVisible) {
                    closeNotifDropdown();
                } else {
                    notifDropdown.classList.add('visible');
                    notifBtn?.classList.add('active');
                }
            }

            function toggleProfileDropdown(e) {
                if (e) {
                    e.stopPropagation();
                    e.preventDefault();
                }

                if (!profileDropdown) return;

                const isVisible = profileDropdown.classList.contains('visible');

                closeFlyout();
                closeNotifDropdown();

                if (isVisible) {
                    closeProfileDropdown();
                } else {
                    closeProfileDropdown();
                    profileDropdown.classList.add('visible');
                    profileBtn?.classList.add('active');
                }
            }

            function toggleNotifDropdown(e) {
                if (e) {
                    e.stopPropagation();
                    e.preventDefault();
                }

                if (!notifDropdown) return;

                const isVisible = notifDropdown.classList.contains('visible');

                closeFlyout();
                closeProfileDropdown();

                if (isVisible) {
                    closeNotifDropdown();
                } else {
                    closeNotifDropdown();
                    notifDropdown.classList.add('visible');
                    notifBtn?.classList.add('active');
                }
            }

            // ── Modals ──
            function openModal(modal) {
                if (!modal) return;
                closeProfileDropdown();
                modal.classList.add('visible');
                document.body.style.overflow = 'hidden';
            }

            function closeModal(modal) {
                if (!modal) return;
                modal.classList.remove('visible');
                document.body.style.overflow = '';
            }

            // ── Logout ──
            window.handleLogoutSubmit = function() { closeProfileDropdown(); return true; };

            document.addEventListener('DOMContentLoaded', function() {
                const logoutBtn  = document.getElementById('logoutBtn');
                const logoutForm = document.getElementById('logoutForm');
                if (logoutBtn && logoutForm) {
                    logoutBtn.addEventListener('click', function() {
                        setTimeout(() => { logoutForm.removeEventListener('submit', window.handleLogoutSubmit); logoutForm.submit(); }, 150);
                    });
                }
            });

            // ── Flash ──
            function showFlashMessage(message, type = 'info') {
                const existing = document.querySelector('.flash-message');
                if (existing) existing.remove();
                const flash = document.createElement('div');
                flash.className = `flash-message flash-${type}`;
                let iconSvg = '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>';
                if (type === 'success') iconSvg = '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>';
                if (type === 'error')   iconSvg = '<circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>';
                flash.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">${iconSvg}</svg><span>${message}</span><button class="flash-close">&times;</button>`;
                const colors = { success: { bg:'#ecfdf5',border:'#a7f3d0',text:'#065f46' }, error: { bg:'#fef2f2',border:'#fecaca',text:'#991b1b' }, info: { bg:'#eff6ff',border:'#bfdbfe',text:'#1e40af' } };
                const c = colors[type] || colors.info;
                Object.assign(flash.style, { position:'fixed', top:'20px', right:'20px', padding:'12px 16px', background:c.bg, border:`1.5px solid ${c.border}`, borderRadius:'12px', color:c.text, fontSize:'13px', fontWeight:'500', display:'flex', alignItems:'center', gap:'10px', zIndex:'5000', boxShadow:'0 4px 16px rgba(0,0,0,0.1)', animation:'slideIn 0.3s ease' });
                const closeBtn = flash.querySelector('.flash-close');
                if (closeBtn) { Object.assign(closeBtn.style, { background:'none', border:'none', color:'inherit', fontSize:'18px', cursor:'pointer', marginLeft:'8px', opacity:'0.7' }); closeBtn.addEventListener('click', () => flash.remove()); }
                document.body.appendChild(flash);
                setTimeout(() => { flash.style.animation = 'slideOut 0.3s ease'; setTimeout(() => flash.remove(), 300); }, 4000);
            }

            // ── Sidebar ──
            function isCollapsed() { return body.classList.contains('sidebar-collapsed'); }
            function updateToggleIcon() {
                if (!toggleIcon) return;
                toggleIcon.innerHTML = isCollapsed() ? '<polyline points="9 18 15 12 9 6"/>' : '<polyline points="15 18 9 12 15 6"/>';
            }

            // ── Active state ──
            const navItems = document.querySelectorAll('.nav-item[data-nav]');
            const subItems = document.querySelectorAll('.sub-nav-item');

            function clearActive() { navItems.forEach(i => i.classList.remove('active')); subItems.forEach(s => s.classList.remove('active')); }
            function setActiveFromUrl() {
                clearActive();
                const currentPath = window.location.pathname;
                subItems.forEach(el => {
                    const href = el.getAttribute('href');
                    if (href && currentPath === new URL(href, window.location.origin).pathname) {
                        el.classList.add('active');
                        if (el.closest('.sub-nav') && masterGroup) masterGroup.classList.add('open');
                    }
                });
                navItems.forEach(el => {
                    const href = el.getAttribute('href');
                    if (href && currentPath === new URL(href, window.location.origin).pathname) el.classList.add('active');
                });
            }

            // ── Init ──
            if (localStorage.getItem('sidebarCollapsed') === 'true') body.classList.add('sidebar-collapsed');
            updateToggleIcon();
            setActiveFromUrl();

            if (toggleBtn) {
                toggleBtn.addEventListener('click', e => {
                    e.stopPropagation();
                    closeFlyout(); closeProfileDropdown();
                    if (masterGroup) masterGroup.classList.remove('open');
                    body.classList.toggle('sidebar-collapsed');
                    localStorage.setItem('sidebarCollapsed', isCollapsed());
                    updateToggleIcon();
                });
            }

            const closeSidebar = () => body.classList.remove('sidebar-open');
            if (mobileToggle) mobileToggle.addEventListener('click', () => body.classList.toggle('sidebar-open'));
            if (overlay) overlay.addEventListener('click', closeSidebar);

            document.addEventListener('click', e => {
                if (window.innerWidth <= 768) {
                    const sidebar = document.querySelector('.sidebar');
                    if (sidebar && !sidebar.contains(e.target) && !(mobileToggle && mobileToggle.contains(e.target)) && body.classList.contains('sidebar-open')) closeSidebar();
                }
                if (flyoutEl?.classList.contains('visible') && !flyoutEl.contains(e.target) && trigger && !trigger.contains(e.target)) closeFlyout();
                if (profileDropdown?.classList.contains('visible') && !profileDropdown.contains(e.target) && profileBtn && !profileBtn.contains(e.target)) closeProfileDropdown();
                if (profileModal && e.target === profileModal) closeModal(profileModal);
                if (settingsModal && e.target === settingsModal) closeModal(settingsModal);
                if (
                    notifDropdown?.classList.contains('visible') &&
                    !notifDropdown.contains(e.target) &&
                    notifBtn &&
                    !notifBtn.contains(e.target)
                ) {
                    closeNotifDropdown();
                }
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) closeSidebar();
                if (flyoutEl?.classList.contains('visible')) openFlyout();
                if (window.innerWidth <= 768) closeProfileDropdown();
            });

            if (trigger) {
                trigger.addEventListener('click', e => {
                    e.preventDefault(); e.stopPropagation(); closeProfileDropdown();
                    if (isCollapsed()) {
                        if (flyoutEl?.classList.contains('visible')) closeFlyout();
                        else { openFlyout(); if (masterGroup) masterGroup.classList.add('open'); }
                    } else {
                        if (flyoutEl) closeFlyout();
                        if (masterGroup) masterGroup.classList.toggle('open');
                    }
                });
            }

            if (profileBtn) profileBtn.addEventListener('click', toggleProfileDropdown);
            if (notifBtn) notifBtn.addEventListener('click', toggleNotifDropdown);
            navItems.forEach(item => item.addEventListener('click', function() { clearActive(); this.classList.add('active'); }));
            subItems.forEach(sub  => sub.addEventListener('click', function()  { clearActive(); this.classList.add('active'); }));
            window.addEventListener('popstate', setActiveFromUrl);

            if (openProfileBtn)       openProfileBtn.addEventListener('click',  e => { e.preventDefault(); openModal(profileModal); });
            if (closeProfileBtn)      closeProfileBtn.addEventListener('click',      () => closeModal(profileModal));
            if (closeProfileFooterBtn) closeProfileFooterBtn.addEventListener('click', () => closeModal(profileModal));

            if (openSettingsBtn) {
                openSettingsBtn.addEventListener('click', e => {
                    e.preventDefault();
                    showFlashMessage('Fitur pengaturan akan segera hadir!', 'info');
                });
            }
            if (closeSettingsBtn)  closeSettingsBtn.addEventListener('click',  () => closeModal(settingsModal));
            if (cancelSettingsBtn) cancelSettingsBtn.addEventListener('click', () => closeModal(settingsModal));
            if (profileModal) profileModal.addEventListener('click', e => { if (e.target === profileModal) closeModal(profileModal); });
            if (settingsModal) settingsModal.addEventListener('click', e => { if (e.target === settingsModal) closeModal(settingsModal); });
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    closeModal(profileModal);
                    closeModal(settingsModal);
                    closeProfileDropdown();
                    closeNotifDropdown();
                }
            });

            if (!document.querySelector('#flash-styles')) {
                const style = document.createElement('style');
                style.id = 'flash-styles';
                style.textContent = `@keyframes slideIn{from{transform:translateX(100%);opacity:0}to{transform:translateX(0);opacity:1}}@keyframes slideOut{from{transform:translateX(0);opacity:1}to{transform:translateX(100%);opacity:0}}`;
                document.head.appendChild(style);
            }
        })();
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH D:\xampp\htdocs\sleep-detection-backend\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>