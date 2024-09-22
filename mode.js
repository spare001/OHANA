// mode-toggle.js

// Apply the saved mode before the page fully loads
(function applySavedMode() {
    const savedMode = localStorage.getItem('mode');
    if (savedMode) {
        document.documentElement.classList.add(savedMode); // Apply to <html> to avoid flashing
    }
})();

// Function to toggle dark/light mode
function toggleDarkMode(buttonId, iconId) {
    const toggleButton = document.getElementById(buttonId);
    const body = document.body;
    const toggleIcon = document.getElementById(iconId);

    // Load the saved mode from localStorage
    const savedMode = localStorage.getItem('mode');
    if (savedMode) {
        body.classList.add(savedMode);
        toggleIcon.classList.toggle('fa-moon', savedMode === 'light-mode');
        toggleIcon.classList.toggle('fa-sun', savedMode === 'dark-mode');
    }

    toggleButton.addEventListener('click', function() {
        if (body.classList.contains('dark-mode')) {
            body.classList.remove('dark-mode');
            body.classList.add('light-mode');
            localStorage.setItem('mode', 'light-mode');
            toggleIcon.classList.remove('fa-sun');
            toggleIcon.classList.add('fa-moon');
        } else {
            body.classList.remove('light-mode');
            body.classList.add('dark-mode');
            localStorage.setItem('mode', 'dark-mode');
            toggleIcon.classList.remove('fa-moon');
            toggleIcon.classList.add('fa-sun');
        }
    });
}

// Initialize dark/light mode toggles
document.addEventListener('DOMContentLoaded', function() {
    toggleDarkMode('toggle-mode-sm', 'toggle-icon-sm');
    toggleDarkMode('toggle-mode', 'toggle-icon');

    var unavailableDates = [
    { title: 'Unavailable', start: '2024-09-20', allDay: true, backgroundColor: 'red', borderColor: 'red' },
    { title: 'Unavailable', start: '2024-09-21', allDay: true, backgroundColor: 'red', borderColor: 'red' },
];

});
