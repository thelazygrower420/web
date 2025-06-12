/*
    File: main.js
    Project: theLazyGrower
    Version: 2.1.0
    Description: Main JS with robust universal click-to-open dropdown logic.
*/

// --- Theme Functions ---
function applyTheme(theme) { /* ... */ }
function toggleTheme() { /* ... */ }
function setInitialTheme() { /* ... */ }

// --- Navigation Functions ---
function handleActiveNav() {
    const currentPagePath = window.location.pathname;
    const navItems = document.querySelectorAll('.main-nav .nav-links > li');

    navItems.forEach(item => {
        // Handle dropdown parents
        if (item.classList.contains('has-dropdown')) {
            const linksInside = item.querySelectorAll('a');
            let isParentActive = false;
            linksInside.forEach(link => {
                if (new URL(link.href).pathname === currentPagePath) {
                    isParentActive = true;
                    link.classList.add('active-link');
                }
            });
            if (isParentActive) {
                item.classList.add('active-parent');
                item.querySelector('.nav-button')?.classList.add('active-link');
            }
        } else { // Handle regular links
            const link = item.querySelector('a');
            if (link && new URL(link.href).pathname === currentPagePath) {
                link.classList.add('active-link');
            }
        }
    });
}

function initializeDropdowns() {
    const dropdownToggles = document.querySelectorAll('.has-dropdown > .nav-button');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent click from bubbling to document
            const parentLi = toggle.parentElement;
            const wasOpen = parentLi.classList.contains('is-open');

            // Close all other dropdowns first
            document.querySelectorAll('.has-dropdown').forEach(d => d.classList.remove('is-open'));

            // If it wasn't already open, open it
            if (!wasOpen) {
                parentLi.classList.add('is-open');
            }
        });
    });

    // Close dropdowns if user clicks anywhere else
    document.addEventListener('click', () => {
        document.querySelectorAll('.has-dropdown.is-open').forEach(d => d.classList.remove('is-open'));
    });
}


// --- Component Initializers (Hero Slider, etc.) ---
function initializeHeroSlider() { /* ... */ }


// --- INITIALIZE THEME IMMEDIATELY ---
setInitialTheme();


// --- RUN AFTER DOM IS FULLY LOADED ---
document.addEventListener('DOMContentLoaded', () => {
    // handleAgeGate(); // Should be in utils.js or here

    const navToggle = document.querySelector('.nav-toggle');
    const navLinksList = document.querySelector('.nav-links');
    if (navToggle && navLinksList) {
        navToggle.addEventListener('click', () => navLinksList.classList.toggle('active'));
    }

    const themeToggleButton = document.getElementById('theme-toggle');
    if (themeToggleButton) {
        themeToggleButton.addEventListener('click', toggleTheme);
    }

    
    updateDateTime('current-year', 'current-datetime');
    
    // Initialize all interactive components
    handleActiveNav();
    initializeHeroSlider();
    initializeDropdowns();
});

// Full functions included for completeness
function applyTheme(theme) { document.documentElement.setAttribute('data-theme', theme); localStorage.setItem('theme', theme); }
function toggleTheme() { const currentTheme = document.documentElement.getAttribute('data-theme') || 'light'; const newTheme = currentTheme === 'dark' ? 'light' : 'dark'; applyTheme(newTheme); }
function setInitialTheme() { const savedTheme = localStorage.getItem('theme'); const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches; if (savedTheme) { applyTheme(savedTheme); } else if (systemPrefersDark) { applyTheme('dark'); } else { applyTheme('light'); } }
function updateDateTime(yearId, dateTimeId) { const yearEl = document.getElementById(yearId); const dateTimeEl = document.getElementById(dateTimeId); if (yearEl) { yearEl.textContent = new Date().getFullYear(); } if(dateTimeEl) { dateTimeEl.textContent = new Date().toISOString().slice(0, 19).replace('T', ' '); }}
function initializeHeroSlider() {
    const slider = document.querySelector('.hero-slider'); if (!slider) return;
    const slides = slider.querySelectorAll('.hero-slide'); const prevButton = slider.querySelector('.slider-nav.prev'); const nextButton = slider.querySelector('.slider-nav.next'); const dotsContainer = slider.querySelector('.slider-dots');
    if (slides.length <= 1) { if(prevButton) prevButton.style.display = 'none'; if(nextButton) nextButton.style.display = 'none'; if(dotsContainer) dotsContainer.style.display = 'none'; if(slides.length > 0) slides[0].classList.add('active'); return; };
    let currentSlide = 0, slideInterval;
    slides.forEach((_, i) => { const dot = document.createElement('button'); dot.classList.add('slider-dot'); dot.setAttribute('aria-label', `Go to slide ${i + 1}`); dot.addEventListener('click', () => { showSlide(i); resetInterval(); }); dotsContainer.appendChild(dot); });
    const dots = dotsContainer.querySelectorAll('.slider-dot');
    function showSlide(index) { slides.forEach((s, i) => { s.classList.remove('active'); if(dots[i]) dots[i].classList.remove('active'); }); currentSlide = (index + slides.length) % slides.length; slides[currentSlide].classList.add('active'); if(dots[currentSlide]) dots[currentSlide].classList.add('active'); }
    function next() { showSlide(currentSlide + 1); }
    function prev() { showSlide(currentSlide - 1); }
    function startInterval() { slideInterval = setInterval(next, 10000); }
    function resetInterval() { clearInterval(slideInterval); startInterval(); }
    if(nextButton) nextButton.addEventListener('click', () => { next(); resetInterval(); });
    if(prevButton) prevButton.addEventListener('click', () => { prev(); resetInterval(); });
    slider.addEventListener('mouseenter', () => clearInterval(slideInterval));
    slider.addEventListener('mouseleave', startInterval);
    showSlide(0);
    startInterval();
}