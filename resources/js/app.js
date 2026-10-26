import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

window.addLike = async function (postId) {
    try {
        const { data } = await window.axios.post('/like', { post_id: postId }, {
            headers: { Accept: 'application/json' },
        });

        if (data.success) {
            const element = document.getElementById('like_' + postId);
            element.textContent = parseInt(element.textContent, 10) + 1;
            element.closest('[data-like]')?.classList.add('text-indigo-600');
        } else {
            alert('You already liked this post');
        }
    } catch (error) {
        if (error.response?.status === 401) {
            alert('Only register users can like a post');
        } else {
            console.error(error);
        }
    }
};
