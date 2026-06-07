import './bootstrap';
document.addEventListener('DOMContentLoaded', function() {
    // We only poll if the user is authenticated as a citizen (role: masyarakat).
    // The poll endpoint will fail (401/403) for guests/admins and automatically stop polling.
    const toastContainerId = 'toast-notification-container';
    
    // Create toast container globally on the body if not exists
    let toastContainer = document.getElementById(toastContainerId);
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = toastContainerId;
        toastContainer.className = 'fixed top-6 right-6 z-50 flex flex-col gap-3 max-w-sm w-full pointer-events-none';
        document.body.appendChild(toastContainer);
    }
    // Keep track of already displayed toast notification IDs to prevent showing them again in the same session
    const displayedToasts = new Set();
    function fetchNotifications() {
        axios.get('/masyarakat/notifications/unread')
            .then(response => {
                const notifications = response.data;
                updateBellUI(notifications);
                
                notifications.forEach(notification => {
                    if (!displayedToasts.has(notification.id)) {
                        displayedToasts.add(notification.id);
                        showToast(notification);
                    }
                });
            })
            .catch(error => {
                // Silently stop if unauthorized (401) or forbidden (403)
                if (error.response && (error.response.status === 401 || error.response.status === 403)) {
                    clearInterval(pollInterval);
                }
            });
    }
    function updateBellUI(notifications) {
        const count = notifications.length;
        const countBadges = document.querySelectorAll('#notification-count-badge');
        const listContainers = document.querySelectorAll('#notification-list');
        countBadges.forEach(badge => {
            if (count > 0) {
                badge.textContent = count;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        });
        listContainers.forEach(container => {
            if (count === 0) {
                container.innerHTML = `
                    <div class="p-6 text-center text-slate-400 text-xs">
                        Tidak ada notifikasi baru.
                    </div>
                `;
            } else {
                let html = '';
                notifications.forEach(item => {
                    html += `
                        <div class="p-4 hover:bg-slate-50 transition-colors flex flex-col gap-1 text-left">
                            <div class="flex justify-between items-start">
                                <span class="text-xs font-bold text-[#1E3A5F]">${item.title}</span>
                                <button onclick="window.markNotificationRead(${item.id})" class="text-[10px] text-blue-600 hover:underline">Tandai dibaca</button>
                            </div>
                            <p class="text-xs text-slate-600">${item.message}</p>
                            <span class="text-[9px] text-slate-400 mt-1">${new Date(item.created_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'})}</span>
                        </div>
                    `;
                });
                container.innerHTML = html;
            }
        });
    }
    function showToast(notification) {
        const toast = document.createElement('div');
        toast.className = 'pointer-events-auto bg-white/95 backdrop-blur-md border border-slate-100 shadow-2xl rounded-2xl p-5 flex gap-4 transition-all duration-500 ease-out';
        toast.style.transform = 'translateX(120%)';
        toast.style.opacity = '0';
        toast.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.5s ease';
        
        toast.innerHTML = `
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 text-blue-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-slate-800">${notification.title}</h4>
                <p class="text-xs text-slate-500 mt-1">${notification.message}</p>
                <div class="mt-3 flex gap-2">
                    <button onclick="window.markNotificationRead(${notification.id}, this)" class="text-xs font-bold text-blue-600 hover:underline">Tandai Dibaca</button>
                </div>
            </div>
            <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600 self-start">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;
        toastContainer.appendChild(toast);
        
        // Trigger reflow to apply initial transform
        toast.offsetHeight;
        
        // Animate in
        toast.style.transform = 'translateX(0)';
        toast.style.opacity = '1';
        
        // Auto-remove after 8 seconds
        setTimeout(() => {
            toast.style.transform = 'translateX(120%)';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 500);
        }, 8000);
    }
    // Toggle dropdown
    document.addEventListener('click', function(e) {
        const bellBtn = e.target.closest('#notification-bell-btn');
        const dropdown = document.getElementById('notification-dropdown');
        
        if (bellBtn) {
            e.stopPropagation();
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        } else if (dropdown && !e.target.closest('#notification-dropdown')) {
            dropdown.classList.add('hidden');
        }
    });
    // Global helper functions
    window.markNotificationRead = function(id, buttonEl) {
        axios.post(`/masyarakat/notifications/${id}/read`)
            .then(() => {
                if (buttonEl) {
                    const toast = buttonEl.closest('.pointer-events-auto');
                    if (toast) {
                        toast.style.transform = 'translateX(120%)';
                        toast.style.opacity = '0';
                        setTimeout(() => toast.remove(), 500);
                    }
                }
                // Refresh list and badge
                fetchNotifications();
            })
            .catch(error => console.error(error));
    };
    window.markAllNotificationsRead = function() {
        axios.post('/masyarakat/notifications/mark-all-read')
            .then(() => {
                fetchNotifications();
            })
            .catch(error => console.error(error));
    };
    // Run immediately and then start interval
    fetchNotifications();
    const pollInterval = setInterval(fetchNotifications, 4000);
});
