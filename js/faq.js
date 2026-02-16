document.addEventListener('click', function (e) {
    const button = e.target.closest('.faq-question');

    const item = button.closest('.faq-item');
    const isOpen = item.classList.contains('active');

    item.classList.toggle('active');
    button.setAttribute('aria-expanded', !isOpen);
});
