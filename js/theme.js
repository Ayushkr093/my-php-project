// theme.js

const storageKey = 'theme-preference';

/**
 * Determine user's preferred color scheme:
 * - From localStorage if set
 * - From system preference otherwise
 */
const getColorPreference = () => {
  if (localStorage.getItem(storageKey)) {
    return localStorage.getItem(storageKey);
  }
  return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
};

/**
 * Apply the theme to the document:
 * - Sets data-theme attribute
 * - Applies Tailwind's dark/light class
 * - Updates theme toggle button aria-label
 */
const reflectPreference = () => {
  document.documentElement.setAttribute('data-theme', theme.value);

  document.documentElement.classList.toggle('dark', theme.value === 'dark');
  document.documentElement.classList.toggle('light', theme.value === 'light');

  const toggleBtn = document.querySelector('#theme-toggle');
  if (toggleBtn) {
    toggleBtn.setAttribute('aria-label', theme.value);
  }
};

/**
 * Save the current preference to localStorage and apply it.
 */
const setPreference = () => {
  localStorage.setItem(storageKey, theme.value);
  reflectPreference();
};

/**
 * Toggle between light and dark theme
 */
const onClickToggle = () => {
  theme.value = theme.value === 'light' ? 'dark' : 'light';
  setPreference();
};

// Theme state object
const theme = {
  value: getColorPreference(),
};

// Immediately reflect preference to avoid flash
reflectPreference();

// Handle DOM content loaded
window.addEventListener('DOMContentLoaded', () => {
  reflectPreference();

  // Theme toggle button
  const toggleButton = document.querySelector('#theme-toggle');
  if (toggleButton) {
    toggleButton.addEventListener('click', onClickToggle);
  }

  // Optional notification close
  const closeNotification = document.getElementById('close-notification');
  if (closeNotification) {
    closeNotification.addEventListener('click', () => {
      document.getElementById('notification-bar')?.remove();
    });
  }
});

// Sync with system theme changes
window
  .matchMedia('(prefers-color-scheme: dark)')
  .addEventListener('change', ({ matches: isDark }) => {
    theme.value = isDark ? 'dark' : 'light';
    setPreference();
  });
