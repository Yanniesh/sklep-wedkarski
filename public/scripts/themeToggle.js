document.addEventListener('DOMContentLoaded', function () {
    const root = document.documentElement;
    const themeToggleBtn = document.getElementById('themeToggleBtn');

    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        root.style.setProperty('--background', `var(--background-${savedTheme})`);
        root.style.setProperty('--text-color', `var(--text-${savedTheme})`);
        root.style.setProperty('--button', `var(--button-${savedTheme})`);
        root.style.setProperty('--table', `var(--table-${savedTheme})`);
    } else {
        dark();
        localStorage.setItem('theme', 'dark');
    }

    function toggleTheme() {
        if (root.style.getPropertyValue('--background') === 'var(--background-dark)') {
            light();
        } else {
            dark();
        }
    }
    function dark(){
        root.style.setProperty('--background', 'var(--background-dark)');
        root.style.setProperty('--text-color', 'var(--text-dark)');
        root.style.setProperty('--button', `var(--button-dark)`);
        root.style.setProperty('--table', `var(--table-dark)`);
        localStorage.setItem('theme', 'dark');
    }
    function light(){
        root.style.setProperty('--background', 'var(--background-light)');
        root.style.setProperty('--text-color', 'var(--text-light)');
        root.style.setProperty('--button', `var(--button-light)`);
        root.style.setProperty('--table', `var(--table-light)`);
        localStorage.setItem('theme', 'light');
    }
    themeToggleBtn.addEventListener('click', toggleTheme);
});
