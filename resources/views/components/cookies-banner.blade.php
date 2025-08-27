{{-- resources/views/components/cookies-banner.blade.php --}}

<!-- Cookies Banner -->
<div id="cookies-banner" class="cookies-banner" style="display: none;">
    <div class="cookies-content">
        <div class="cookies-text">
            <h4>🍪 Gestion des cookies</h4>
            <p>Nous utilisons des cookies pour améliorer votre expérience, analyser le trafic et personnaliser le contenu. Vos données restent privées et sécurisées.</p>
        </div>
        <div class="cookies-buttons">
            <button id="accept-cookies" class="btn-cookies accept">Accepter tout</button>
            <button id="decline-cookies" class="btn-cookies decline">Refuser</button>
            <button id="manage-cookies" class="btn-cookies manage">Personnaliser</button>
        </div>
    </div>
</div>

<!-- Modal de gestion des cookies -->
<div id="cookies-modal" class="cookies-modal" style="display: none;">
    <div class="cookies-modal-content">
        <div class="cookies-modal-header">
            <h3>🔧 Paramètres des cookies</h3>
            <span id="close-cookies-modal" class="close">&times;</span>
        </div>
        <div class="cookies-modal-body">
            <div class="cookies-intro">
                <p>Nous respectons votre vie privée. Vous pouvez choisir les types de cookies que vous souhaitez autoriser.</p>
            </div>

            <div class="cookie-category">
                <div class="cookie-category-header">
                    <div class="category-info">
                        <h4>🔒 Cookies essentiels</h4>
                        <span class="category-badge required">Requis</span>
                    </div>
                    <label class="switch disabled">
                        <input type="checkbox" checked disabled>
                        <span class="slider round"></span>
                    </label>
                </div>
                <p>Ces cookies sont indispensables au fonctionnement du site web. Ils incluent la gestion des sessions et la sécurité.</p>
            </div>

            <div class="cookie-category">
                <div class="cookie-category-header">
                    <div class="category-info">
                        <h4>📊 Cookies analytiques</h4>
                        <span class="category-badge optional">Optionnel</span>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="analytics-cookies" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
                <p>Ces cookies nous aident à comprendre comment les visiteurs utilisent notre site pour l'améliorer. Aucune donnée personnelle identifiable n'est collectée.</p>
                <div class="cookie-details">
                    <small><strong>Données collectées :</strong> pages visitées, durée de visite, type d'appareil, pays (approximatif)</small>
                </div>
            </div>

            <div class="cookie-category">
                <div class="cookie-category-header">
                    <div class="category-info">
                        <h4>🎨 Cookies de préférences</h4>
                        <span class="category-badge optional">Optionnel</span>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="preferences-cookies">
                        <span class="slider round"></span>
                    </label>
                </div>
                <p>Ces cookies permettent de mémoriser vos préférences (langue, thème, etc.) pour personnaliser votre expérience.</p>
            </div>
        </div>
        <div class="cookies-modal-footer">
            <div class="footer-info">
                <small>Vos choix sont conservés pendant 1 an. Vous pouvez les modifier à tout moment via les paramètres.</small>
            </div>
            <div class="footer-buttons">
                <button id="accept-selected" class="btn-cookies accept">Accepter la sélection</button>
                <button id="accept-all-modal" class="btn-cookies secondary">Accepter tout</button>
            </div>
        </div>
    </div>
</div>

<style>
/* === COOKIES BANNER STYLES === */
.cookies-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 24px 20px;
    box-shadow: 0 -4px 25px rgba(0,0,0,0.15);
    z-index: 9999;
    animation: slideUpBanner 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    border-top: 3px solid #f39c12;
}

@keyframes slideUpBanner {
    from {
        transform: translateY(100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.cookies-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 30px;
}

.cookies-text h4 {
    margin: 0 0 12px 0;
    color: #f39c12;
    font-size: 1.3rem;
    font-weight: 600;
}

.cookies-text p {
    margin: 0;
    font-size: 15px;
    line-height: 1.5;
    opacity: 0.95;
}

.cookies-buttons {
    display: flex;
    gap: 12px;
    flex-shrink: 0;
    align-items: center;
}

.btn-cookies {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-transform: none;
    position: relative;
    overflow: hidden;
}

.btn-cookies::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-cookies:hover::before {
    left: 100%;
}

.btn-cookies.accept {
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    color: white;
    box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
}

.btn-cookies.accept:hover {
    background: linear-gradient(135deg, #229954, #27ae60);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
}

.btn-cookies.decline {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.btn-cookies.decline:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
}

.btn-cookies.manage {
    background: transparent;
    color: #f39c12;
    border: 2px solid #f39c12;
}

.btn-cookies.manage:hover {
    background: #f39c12;
    color: #2c3e50;
    transform: translateY(-2px);
}

.btn-cookies.secondary {
    background: transparent;
    color: #3498db;
    border: 1px solid #3498db;
}

.btn-cookies.secondary:hover {
    background: #3498db;
    color: white;
}

/* === MODAL STYLES === */
.cookies-modal {
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(5px);
    animation: modalFadeIn 0.3s ease-out;
    display: flex;
    align-items: center;
    justify-content: center;
}

@keyframes modalFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.cookies-modal-content {
    background: white;
    border-radius: 16px;
    width: 95%;
    max-width: 650px;
    max-height: 90vh;
    overflow-y: auto;
    animation: modalSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

@keyframes modalSlideIn {
    from {
        transform: translateY(-30px) scale(0.95);
        opacity: 0;
    }
    to {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
}

.cookies-modal-header {
    padding: 24px 30px 20px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #f8f9fa, #fff);
    border-radius: 16px 16px 0 0;
}

.cookies-modal-header h3 {
    margin: 0;
    color: #2c3e50;
    font-size: 1.4rem;
    font-weight: 600;
}

.close {
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    color: #bdc3c7;
    transition: color 0.3s ease;
    padding: 8px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
}

.close:hover {
    color: #e74c3c;
    background: rgba(231, 76, 60, 0.1);
}

.cookies-modal-body {
    padding: 30px;
}

.cookies-intro {
    margin-bottom: 25px;
    padding: 20px;
    background: linear-gradient(135deg, #ebf3fd, #f8f9fa);
    border-radius: 10px;
    border-left: 4px solid #3498db;
}

.cookies-intro p {
    margin: 0;
    color: #2c3e50;
    font-size: 15px;
    line-height: 1.5;
}

.cookie-category {
    margin-bottom: 25px;
    padding: 20px;
    border: 1px solid #ecf0f1;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.cookie-category:hover {
    border-color: #bdc3c7;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.cookie-category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.category-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.category-info h4 {
    margin: 0;
    color: #2c3e50;
    font-size: 1.1rem;
    font-weight: 600;
}

.category-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.category-badge.required {
    background: #e8f5e8;
    color: #27ae60;
}

.category-badge.optional {
    background: #e3f2fd;
    color: #3498db;
}

.cookie-category p {
    margin: 0 0 10px 0;
    color: #5a6c7d;
    line-height: 1.5;
    font-size: 14px;
}

.cookie-details {
    margin-top: 10px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 6px;
}

.cookie-details small {
    color: #7f8c8d;
    font-size: 12px;
    line-height: 1.4;
}

/* === SWITCH STYLES === */
.switch {
    position: relative;
    display: inline-block;
    width: 54px;
    height: 28px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #bdc3c7;
    transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 28px;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
}

.slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 4px;
    bottom: 4px;
    background: white;
    transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

input:checked + .slider {
    background: linear-gradient(135deg, #27ae60, #2ecc71);
}

input:checked + .slider:before {
    transform: translateX(26px);
}

.switch.disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.switch.disabled .slider {
    cursor: not-allowed;
}

/* === MODAL FOOTER === */
.cookies-modal-footer {
    padding: 20px 30px 30px;
    border-top: 1px solid #eee;
    background: #f8f9fa;
    border-radius: 0 0 16px 16px;
}

.footer-info {
    margin-bottom: 20px;
}

.footer-info small {
    color: #7f8c8d;
    line-height: 1.4;
}

.footer-buttons {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .cookies-content {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }

    .cookies-buttons {
        justify-content: center;
        flex-wrap: wrap;
        width: 100%;
    }

    .btn-cookies {
        flex: 1;
        min-width: 120px;
    }

    .cookies-modal-content {
        width: 98%;
        margin: 1%;
        max-height: 95vh;
    }

    .cookies-modal-header,
    .cookies-modal-body,
    .cookies-modal-footer {
        padding-left: 20px;
        padding-right: 20px;
    }

    .cookie-category-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .footer-buttons {
        flex-direction: column;
    }

    .footer-buttons .btn-cookies {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .cookies-banner {
        padding: 20px 15px;
    }

    .cookies-text h4 {
        font-size: 1.1rem;
    }

    .cookies-text p {
        font-size: 14px;
    }

    .cookies-buttons {
        gap: 8px;
    }

    .btn-cookies {
        padding: 10px 16px;
        font-size: 13px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const banner = document.getElementById('cookies-banner');
    const modal = document.getElementById('cookies-modal');
    const acceptBtn = document.getElementById('accept-cookies');
    const declineBtn = document.getElementById('decline-cookies');
    const manageBtn = document.getElementById('manage-cookies');
    const closeModal = document.getElementById('close-cookies-modal');
    const acceptSelected = document.getElementById('accept-selected');
    const acceptAllModal = document.getElementById('accept-all-modal');

    // Check cookies status on page load
    checkCookieStatus();

    // Event listeners
    acceptBtn?.addEventListener('click', acceptAllCookies);
    declineBtn?.addEventListener('click', declineAllCookies);
    manageBtn?.addEventListener('click', openModal);
    closeModal?.addEventListener('click', closeModalHandler);
    acceptSelected?.addEventListener('click', acceptSelectedCookies);
    acceptAllModal?.addEventListener('click', acceptAllCookies);

    // Close modal when clicking outside
    modal?.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModalHandler();
        }
    });

    // Functions
    function checkCookieStatus() {
        fetch('/cookies/status', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.show_banner && banner) {
                setTimeout(() => {
                    banner.style.display = 'block';
                }, 500); // Small delay for better UX
            }
        })
        .catch(error => {
            console.log('Cookie status check failed:', error);
            // Show banner by default if check fails
            if (banner) {
                banner.style.display = 'block';
            }
        });
    }

    function acceptAllCookies() {
        sendCookiePreference('accept')
            .then(() => {
                hideBanner();
                closeModalHandler();
                showNotification('✅ Tous les cookies ont été acceptés', 'success');
            });
    }

    function declineAllCookies() {
        sendCookiePreference('decline')
            .then(() => {
                hideBanner();
                closeModalHandler();
                showNotification('ℹ️ Seuls les cookies essentiels sont utilisés', 'info');
            });
    }

    function acceptSelectedCookies() {
        const analyticsAccepted = document.getElementById('analytics-cookies')?.checked || false;
        const preferencesAccepted = document.getElementById('preferences-cookies')?.checked || false;

        const preferences = {
            analytics: analyticsAccepted,
            preferences: preferencesAccepted
        };

        const action = analyticsAccepted || preferencesAccepted ? 'accept' : 'decline';

        sendCookiePreference(action, preferences)
            .then(() => {
                hideBanner();
                closeModalHandler();
                showNotification('✅ Vos préférences ont été enregistrées', 'success');
            });
    }

    function sendCookiePreference(action, preferences = null) {
        const url = action === 'accept' ? '/cookies/accept' : '/cookies/decline';
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ preferences: preferences })
        })
        .then(response => response.json())
        .catch(error => {
            console.error('Cookie preference error:', error);
            showNotification('⚠️ Erreur lors de la sauvegarde', 'error');
        });
    }

    function openModal() {
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModalHandler() {
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }

    function hideBanner() {
        if (banner) {
            banner.style.animation = 'slideUpBanner 0.4s cubic-bezier(0.4, 0, 0.2, 1) reverse';
            setTimeout(() => {
                banner.style.display = 'none';
            }, 400);
        }
    }

    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.cookie-notification');
        existingNotifications.forEach(n => n.remove());

        const notification = document.createElement('div');
        notification.className = `cookie-notification cookie-notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close" onclick="this.parentElement.parentElement.remove()">&times;</button>
            </div>
        `;

        // Notification styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 300px;
            max-width: 400px;
            padding: 0;
            border-radius: 12px;
            color: white;
            font-weight: 500;
            z-index: 10001;
            animation: slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
        `;

        const colors = {
            success: 'linear-gradient(135deg, #27ae60, #2ecc71)',
            error: 'linear-gradient(135deg, #e74c3c, #c0392b)',
            info: 'linear-gradient(135deg, #3498db, #2980b9)',
            warning: 'linear-gradient(135deg, #f39c12, #e67e22)'
        };

        notification.style.background = colors[type] || colors.info;

        // Add notification content styles
        const style = document.createElement('style');
        style.textContent = `
            .cookie-notification .notification-content {
                padding: 16px 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
            }

            .cookie-notification .notification-message {
                flex: 1;
                font-size: 14px;
                line-height: 1.4;
            }

            .cookie-notification .notification-close {
                background: rgba(255,255,255,0.2);
                border: none;
                color: white;
                width: 28px;
                height: 28px;
                border-radius: 50%;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                font-weight: bold;
                transition: background 0.3s ease;
                flex-shrink: 0;
            }

            .cookie-notification .notification-close:hover {
                background: rgba(255,255,255,0.3);
            }

            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @media (max-width: 768px) {
                .cookie-notification {
                    right: 10px !important;
                    left: 10px !important;
                    min-width: auto !important;
                    max-width: none !important;
                }
            }
        `;

        if (!document.querySelector('#cookie-notification-styles')) {
            style.id = 'cookie-notification-styles';
            document.head.appendChild(style);
        }

        document.body.appendChild(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.style.animation = 'slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1) reverse';
                setTimeout(() => {
                    notification.remove();
                }, 400);
            }
        }, 5000);
    }

    // Handle ESC key to close modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal && modal.style.display === 'flex') {
            closeModalHandler();
        }
    });

    // Handle cookies settings link (if you want to add a link in footer to reopen settings)
    window.openCookieSettings = function() {
        openModal();
    };

    // Optional: Add smooth scroll behavior for better UX
    document.documentElement.style.scrollBehavior = 'smooth';
});

// Export functions for external use if needed
window.CookieManager = {
    acceptAll: function() {
        document.getElementById('accept-cookies')?.click();
    },
    declineAll: function() {
        document.getElementById('decline-cookies')?.click();
    },
    openSettings: function() {
        document.getElementById('manage-cookies')?.click();
    }
};
</script>
