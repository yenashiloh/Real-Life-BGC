document.addEventListener('DOMContentLoaded', function() {
    const loadingSpinner = document.getElementById('loading-spinner');
    const wrapper = document.querySelector('.wrapper');
    let contentLoaded = false;

    // Set initial styles
    loadingSpinner.style.display = 'flex';
    wrapper.style.opacity = '0';
    wrapper.style.transition = 'opacity 0.3s ease-in-out';

    function showContent() {
        if (contentLoaded) return;
        contentLoaded = true;

        // Wait for one full spin (1000ms) before fading out
        setTimeout(() => {
            loadingSpinner.style.opacity = '0';
            wrapper.style.opacity = '1';

            setTimeout(() => {
                loadingSpinner.style.display = 'none';
            }, 300); // Fade out duration
        }, 1000); // Duration of one full spin
    }

    // Start the process as soon as the DOM is ready
    showContent();
});