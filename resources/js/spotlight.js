/* efecto visual de spotlight en tarjetas */

document.addEventListener('DOMContentLoaded', () => {
    /** Pixels outside the footer where the border spotlight still fades in. */
    const FOOTER_SPOTLIGHT_PROXIMITY_PX = 180;

    const footers = () => document.querySelectorAll('.js-footer-border-spotlight');

    const setFooterSpotlightOpacities = (opacityValue) => {
        footers().forEach((el) => {
            el.style.setProperty('--footer-spotlight-opacity', opacityValue);
        });
    };

    const handleMouseMove = (e) => {
        document.querySelectorAll('.js-spotlight-card, .js-project-card').forEach((card) => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
            card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
        });

        footers().forEach((footer) => {
            const rect = footer.getBoundingClientRect();
            footer.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
            footer.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);

            const dx = Math.max(rect.left - e.clientX, 0, e.clientX - rect.right);
            const dy = Math.max(rect.top - e.clientY, 0, e.clientY - rect.bottom);
            const dist = Math.hypot(dx, dy);
            const opacity =
                dist >= FOOTER_SPOTLIGHT_PROXIMITY_PX ? 0 : 1 - dist / FOOTER_SPOTLIGHT_PROXIMITY_PX;

            footer.style.setProperty('--footer-spotlight-opacity', String(opacity));
        });
    };

    document.addEventListener('mousemove', handleMouseMove);
    document.documentElement.addEventListener('mouseleave', () => setFooterSpotlightOpacities('0'));
});