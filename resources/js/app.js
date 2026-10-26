import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// shows a toast, see resources/views/components/toasts.blade.php; without a message it uses a generic error
window.notify = function (message, type = 'error') {
    window.dispatchEvent(new CustomEvent('notify', { detail: { message, type } }));
};

window.addLike = async function (postId) {
    try {
        const { data } = await window.axios.post('/like', { post_id: postId }, {
            headers: { Accept: 'application/json' },
        });

        if (data.success) {
            const element = document.getElementById('like_' + postId);
            element.textContent = parseInt(element.textContent, 10) + 1;
            const button = element.closest('[data-like]');
            button?.classList.add('text-indigo-600');
            button?.querySelector('svg')?.setAttribute('fill', 'currentColor');
        } else {
            window.notify(data.text, 'warning');
        }
    } catch (error) {
        if (error.response?.status === 401) {
            // the session expired, guests get a login link instead of the like button
            window.location.href = '/login';
        } else {
            console.error(error);
            window.notify();
        }
    }
};
