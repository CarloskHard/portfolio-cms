/* efecto visual de spotlight en tarjetas */

document.addEventListener('DOMContentLoaded', () => {
    const handleMouseMove = (e) => {
        const cards = document.querySelectorAll('.js-spotlight-card, .js-project-card');
        cards.forEach(card => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    };

    document.addEventListener('mousemove', handleMouseMove);
});