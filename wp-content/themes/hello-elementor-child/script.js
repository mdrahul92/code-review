document.addEventListener("DOMContentLoaded", function() {
    // Ensure that the collapsed class is applied correctly on page load
    document.querySelectorAll('.accordion-button').forEach(button => {
        let collapseElement = document.querySelector(button.getAttribute('data-bs-target'));
        if (!collapseElement.classList.contains('show')) {
            button.classList.add('collapsed');
        }
    });
});