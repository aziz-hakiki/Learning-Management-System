import './bootstrap';

function initMobileDrawer() {
    const toggleBtn = document.querySelector('[data-nav-toggle]');
    const drawer = document.querySelector('[data-nav-drawer]');
    if (!toggleBtn || !drawer) return;

    const closeTriggers = drawer.querySelectorAll('[data-nav-close]');
    const focusableSelector = 'a[href], button:not([disabled]), input:not([disabled]), [tabindex]:not([tabindex="-1"])';

    const closeDrawer = (restoreFocus = true) => {
        drawer.hidden = true;
        toggleBtn.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('overflow-hidden');
        if (restoreFocus) {
            toggleBtn.focus();
        }
    };

    const openDrawer = () => {
        drawer.hidden = false;
        toggleBtn.setAttribute('aria-expanded', 'true');
        document.body.classList.add('overflow-hidden');
        const firstFocusable = drawer.querySelector(focusableSelector);
        if (firstFocusable) firstFocusable.focus();
    };

    toggleBtn.addEventListener('click', () => {
        const isOpen = toggleBtn.getAttribute('aria-expanded') === 'true';
        if (isOpen) {
            closeDrawer(true);
        } else {
            openDrawer();
        }
    });

    closeTriggers.forEach((btn) => {
        btn.addEventListener('click', () => closeDrawer(true));
    });

    drawer.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeDrawer(true);
            return;
        }
        if (event.key !== 'Tab') return;

        const focusables = [...drawer.querySelectorAll(focusableSelector)];
        if (focusables.length === 0) return;

        const first = focusables[0];
        const last = focusables[focusables.length - 1];
        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });
}

function initProgramTabs() {
    document.querySelectorAll('[data-tablist]').forEach((tablist) => {
        const tabs = [...tablist.querySelectorAll('[role="tab"]')];
        const root = tablist.closest('[data-tabs-root]') || document;

        const activateTab = (targetTab, shouldFocus = false) => {
            tabs.forEach((tab) => {
                const selected = tab === targetTab;
                const panelId = tab.getAttribute('aria-controls');
                const panel = panelId ? root.querySelector(`#${panelId}`) : null;

                tab.setAttribute('aria-selected', selected ? 'true' : 'false');
                tab.setAttribute('tabindex', selected ? '0' : '-1');
                if (panel) {
                    panel.hidden = !selected;
                }
            });

            if (shouldFocus) {
                targetTab.focus();
            }
        };

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => activateTab(tab, false));

            tab.addEventListener('keydown', (event) => {
                let nextIndex = null;
                if (event.key === 'ArrowRight') nextIndex = (index + 1) % tabs.length;
                if (event.key === 'ArrowLeft') nextIndex = (index - 1 + tabs.length) % tabs.length;
                if (event.key === 'Home') nextIndex = 0;
                if (event.key === 'End') nextIndex = tabs.length - 1;

                if (nextIndex !== null) {
                    event.preventDefault();
                    activateTab(tabs[nextIndex], true);
                }
            });
        });
    });
}

function initCatalogLiveFilter() {
    const form = document.querySelector('[data-program-filter-form]');
    const resultsContainer = document.querySelector('[data-program-results]');
    const loadingBox = document.querySelector('[data-filter-loading]');
    const errorBox = document.querySelector('[data-filter-error]');
    const statusLive = document.querySelector('[data-filter-status]');
    const retryBtn = document.querySelector('[data-filter-retry]');
    if (!form || !resultsContainer || !loadingBox || !errorBox) return;

    const filterUrl = form.getAttribute('data-filter-url');
    if (!filterUrl) return;

    const runFilter = async (categoryOverride = null) => {
        const categoryInput = form.querySelector('input[name="category"]');
        const searchInput = form.querySelector('input[name="q"]');
        if (categoryOverride !== null && categoryInput) {
            categoryInput.value = categoryOverride;
        }

        const params = new URLSearchParams();
        if (categoryInput?.value) params.set('category', categoryInput.value);
        if (searchInput?.value.trim()) params.set('q', searchInput.value.trim());

        form.querySelectorAll('[data-category-btn]').forEach((btn) => {
            const isActive = (btn.getAttribute('data-category-btn') || '') === (categoryInput?.value || '');
            btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        loadingBox.hidden = false;
        errorBox.hidden = true;
        resultsContainer.classList.add('opacity-50');

        try {
            const response = await fetch(`${filterUrl}?${params.toString()}`, {
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const payload = await response.json();
            resultsContainer.innerHTML = payload.html;
            const queryString = params.toString();
            const nextUrl = queryString ? `${form.action}?${queryString}` : form.action;
            window.history.replaceState({}, '', nextUrl);

            if (statusLive) {
                statusLive.textContent = `Menampilkan ${payload.count} program pelatihan.`;
            }
        } catch {
            errorBox.hidden = false;
            if (statusLive) {
                statusLive.textContent = 'Gagal memuat daftar program pelatihan.';
            }
        } finally {
            loadingBox.hidden = true;
            resultsContainer.classList.remove('opacity-50');
        }
    };

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        runFilter();
    });

    form.querySelectorAll('[data-category-btn]').forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault();
            runFilter(btn.getAttribute('data-category-btn') || '');
        });
    });

    resultsContainer.addEventListener('click', (event) => {
        const resetTrigger = event.target.closest('[data-reset-program-filter]');
        if (!resetTrigger) return;
        event.preventDefault();
        const searchInput = form.querySelector('input[name="q"]');
        if (searchInput) searchInput.value = '';
        runFilter('');
    });

    if (retryBtn) {
        retryBtn.addEventListener('click', () => runFilter());
    }
}

function initErrorSummaryFocus() {
    const summary = document.querySelector('[data-error-summary]') || document.getElementById('error-summary');
    if (summary && !summary.hidden) {
        summary.focus();
    }
}

function initDialogs() {
    document.querySelectorAll('[data-dialog-open]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const id = trigger.getAttribute('data-dialog-open');
            const dialog = id ? document.getElementById(id) : null;
            if (dialog && typeof dialog.showModal === 'function') {
                dialog.dataset.returnFocus = trigger.id || '';
                dialog.showModal();
            }
        });
    });

    document.querySelectorAll('dialog[data-portal-dialog]').forEach((dialog) => {
        dialog.querySelectorAll('[data-dialog-close]').forEach((btn) => {
            btn.addEventListener('click', () => dialog.close());
        });

        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) {
                dialog.close();
            }
        });
    });
}

function initNavDropdowns() {
    const roots = [...document.querySelectorAll('[data-dropdown-root]')];
    if (roots.length === 0) return;

    const closeAll = (exceptRoot = null) => {
        roots.forEach((root) => {
            if (root === exceptRoot) return;
            const btn = root.querySelector('[data-dropdown-toggle]');
            const panel = root.querySelector('[data-dropdown-panel]');
            if (btn) btn.setAttribute('aria-expanded', 'false');
            if (panel) panel.hidden = true;
        });
    };

    roots.forEach((root) => {
        const btn = root.querySelector('[data-dropdown-toggle]');
        const panel = root.querySelector('[data-dropdown-panel]');
        if (!btn || !panel) return;

        btn.addEventListener('click', (event) => {
            event.stopPropagation();
            const willOpen = panel.hidden;
            closeAll(root);
            panel.hidden = !willOpen;
            btn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
        });

        btn.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowDown') {
                event.preventDefault();
                closeAll(root);
                panel.hidden = false;
                btn.setAttribute('aria-expanded', 'true');
                const firstLink = panel.querySelector('a[href]');
                if (firstLink) firstLink.focus();
            } else if (event.key === 'Escape') {
                panel.hidden = true;
                btn.setAttribute('aria-expanded', 'false');
            }
        });

        root.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !panel.hidden) {
                panel.hidden = true;
                btn.setAttribute('aria-expanded', 'false');
                btn.focus();
            }
        });
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('[data-dropdown-root]')) {
            closeAll();
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initNavDropdowns();
    initMobileDrawer();
    initProgramTabs();
    initCatalogLiveFilter();
    initErrorSummaryFocus();
    initDialogs();
});
