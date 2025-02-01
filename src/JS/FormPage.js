// JavaScript for toggling between Sign Up and Login sections
const signUpSection = document.querySelector('.signUp');
const loginSection = document.querySelector('.login');
const loginLink = document.getElementById('login-link');
const signupLink = document.getElementById('signup-link');

// Hide the Login section by default
loginSection.style.display = 'none';

// Add event listeners to toggle between sections
loginLink.addEventListener('click', () => {
    signUpSection.style.display = 'none';
loginSection.style.display = 'flex';
});

signupLink.addEventListener('click', () => {
    loginSection.style.display = 'none';
signUpSection.style.display = 'flex';
});