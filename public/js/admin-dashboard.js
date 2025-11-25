// ====================================
// Dashboard Admin - Scripts
// ====================================

document.addEventListener('DOMContentLoaded', function () {
    // Mobile sidebar toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.getElementById('sidebar');
    const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');

    if (mobileMenuBtn && sidebar && mobileSidebarOverlay) {
        mobileMenuBtn.addEventListener('click', function () {
            sidebar.classList.toggle('-translate-x-full');
            mobileSidebarOverlay.classList.toggle('hidden');
        });

        mobileSidebarOverlay.addEventListener('click', function () {
            sidebar.classList.add('-translate-x-full');
            mobileSidebarOverlay.classList.add('hidden');
        });
    }

    // Auto-hide success/error messages after 5 seconds
    const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(function () {
                alert.remove();
            }, 500);
        }, 5000);
    });

    // Confirmation dialogs for delete actions
    const deleteButtons = document.querySelectorAll('[data-confirm-delete]');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (e) {
            const message = this.getAttribute('data-confirm-delete') || 'Êtes-vous sûr de vouloir supprimer cet élément ?';
            if (!confirm(message)) {
                e.preventDefault();
                return false;
            }
        });
    });

    // Image preview on file input
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
    imageInputs.forEach(function (input) {
        input.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Recherche un élément de prévisualisation à proximité
                    let preview = input.closest('.form-group')?.querySelector('.image-preview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.className = 'image-preview mt-3 rounded-lg max-w-xs border border-gray-300';
                        input.parentNode.insertBefore(preview, input.nextSibling);
                    }
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // Tooltip initialization (si vous utilisez des tooltips)
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tooltip]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new Tooltip(tooltipTriggerEl);
    });

    // Table row actions highlight
    const tableRows = document.querySelectorAll('.admin-table tbody tr');
    tableRows.forEach(function (row) {
        row.addEventListener('mouseenter', function () {
            this.classList.add('bg-blue-50');
        });
        row.addEventListener('mouseleave', function () {
            this.classList.remove('bg-blue-50');
        });
    });

    // Copy to clipboard functionality
    const copyButtons = document.querySelectorAll('[data-copy]');
    copyButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const textToCopy = this.getAttribute('data-copy');
            navigator.clipboard.writeText(textToCopy).then(function () {
                // Show success feedback
                const originalText = button.innerHTML;
                button.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Copié!';
                setTimeout(function () {
                    button.innerHTML = originalText;
                }, 2000);
            });
        });
    });

    // Character counter for textareas
    const textareasWithLimit = document.querySelectorAll('textarea[maxlength]');
    textareasWithLimit.forEach(function (textarea) {
        const maxLength = textarea.getAttribute('maxlength');
        const counter = document.createElement('div');
        counter.className = 'text-xs text-gray-500 mt-1 text-right';
        counter.innerHTML = `<span class="current-count">0</span> / ${maxLength} caractères`;
        textarea.parentNode.appendChild(counter);

        textarea.addEventListener('input', function () {
            const currentLength = this.value.length;
            counter.querySelector('.current-count').textContent = currentLength;
            if (currentLength >= maxLength * 0.9) {
                counter.classList.add('text-orange-500');
            } else {
                counter.classList.remove('text-orange-500');
            }
        });
    });

    // Sortable tables (simple implementation)
    const sortableHeaders = document.querySelectorAll('[data-sortable]');
    sortableHeaders.forEach(function (header) {
        header.style.cursor = 'pointer';
        header.addEventListener('click', function () {
            const table = this.closest('table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const columnIndex = Array.from(this.parentNode.children).indexOf(this);
            const currentDirection = this.dataset.sortDirection || 'asc';
            const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';

            rows.sort(function (a, b) {
                const aValue = a.children[columnIndex].textContent.trim();
                const bValue = b.children[columnIndex].textContent.trim();
                return newDirection === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
            });

            rows.forEach(function (row) {
                tbody.appendChild(row);
            });

            this.dataset.sortDirection = newDirection;
        });
    });

    // Form validation enhancement
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            const requiredInputs = form.querySelectorAll('[required]');
            let isValid = true;

            requiredInputs.forEach(function (input) {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                    // Add error message if not exists
                    if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('form-error')) {
                        const error = document.createElement('p');
                        error.className = 'form-error';
                        error.textContent = 'Ce champ est requis';
                        input.parentNode.insertBefore(error, input.nextSibling);
                    }
                } else {
                    input.classList.remove('border-red-500');
                    if (input.nextElementSibling && input.nextElementSibling.classList.contains('form-error')) {
                        input.nextElementSibling.remove();
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    });

    // Smooth scroll to top button
    const scrollTopBtn = document.getElementById('scroll-to-top');
    if (scrollTopBtn) {
        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.remove('hidden');
            } else {
                scrollTopBtn.classList.add('hidden');
            }
        });

        scrollTopBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});

// Utility function: Format numbers
function formatNumber(num) {
    return new Intl.NumberFormat('fr-FR').format(num);
}

// Utility function: Format date
function formatDate(date, format = 'short') {
    const options = format === 'short'
        ? { year: 'numeric', month: 'short', day: 'numeric' }
        : { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Intl.DateTimeFormat('fr-FR', options).format(new Date(date));
}

// Utility function: Show toast notification
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 animate-slide-in ${
        type === 'success' ? 'bg-green-600' : type === 'error' ? 'bg-red-600' : 'bg-blue-600'
    }`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(function () {
        toast.style.transition = 'opacity 0.3s ease-out';
        toast.style.opacity = '0';
        setTimeout(function () {
            toast.remove();
        }, 300);
    }, 3000);
}
