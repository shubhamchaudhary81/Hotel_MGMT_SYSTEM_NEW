// bootstrap.js (or your main JS entry)
import './bootstrap';
import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Make Alpine globally available
window.Alpine = Alpine;

// --- CONTACT FORM HANDLER ---
function formHandler(type) {
    return {
        // Form fields
        form: {
            name: '',
            email: '',
            subject: '',
            message: ''
        },
        // Validation errors
        errors: {},
        // Loading state
        loading: false,

        // Submit function
        submit() {
            // Clear previous errors
            this.errors = {};

            // --- SIMPLE VALIDATION ---
            if (!this.form.name) this.errors.name = 'Required field';
            if (!this.form.email || !this.validateEmail(this.form.email)) this.errors.email = 'Valid email required';
            if (!this.form.subject) this.errors.subject = 'Select a subject';
            if (!this.form.message) this.errors.message = 'Required field';

            // Stop if there are errors
            if (Object.keys(this.errors).length > 0) return;

            // Set loading state
            this.loading = true;

            // --- SIMULATED FORM SUBMISSION ---
            setTimeout(() => {
                alert('Message sent successfully!');
                this.loading = false;
                // Reset form
                this.form = { name: '', email: '', subject: '', message: '' };
            }, 2000);
        },

        // Simple email validation
        validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    };
}

// Make formHandler globally accessible to Alpine
window.formHandler = formHandler;

// --- ALPINE START ---
Alpine.start();

// --- AOS ANIMATIONS INIT ---
AOS.init({
    duration: 600,      // animation duration in ms
    easing: 'ease-in-out',
    once: true,         // animate only once
    offset: 60          // offset in px before animation triggers
});
