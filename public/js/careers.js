// Billplz Careers Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functionality
    initNavigation();
    initJobDetails();
    initSmoothScrolling();
    initAnimations();
    initSubscribeForm();
    initTracking();
});

// Navigation functionality
function initNavigation() {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    if (navToggle && navLinks) {
        navToggle.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            navToggle.classList.toggle('active');
        });
    }
    
    // Close mobile menu when clicking on a link
    const navLinkElements = document.querySelectorAll('.nav-link');
    navLinkElements.forEach(link => {
        link.addEventListener('click', function() {
            if (navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
                navToggle.classList.remove('active');
            }
        });
    });
}

// Job details toggle functionality
function initJobDetails() {
    // This function is called from the HTML onclick attribute
    // It's defined globally so it can be accessed from inline onclick
}

function toggleJobDetails(button) {
    const jobCard = button.closest('.job-card');
    const jobDetails = jobCard.querySelector('.job-details');
    const icon = button.querySelector('i');
    const jobId = jobCard.getAttribute('data-job-id');
    
    if (jobDetails.style.display === 'none' || jobDetails.style.display === '') {
        // Show details
        jobDetails.style.display = 'block';
        jobDetails.classList.add('show');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
        button.innerHTML = '<i class="fas fa-chevron-up"></i> Hide Details';
        
        // Smooth scroll to details
        setTimeout(() => {
            jobDetails.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'nearest' 
            });
        }, 100);

        // Track view_details event
        if (jobId) {
            postTrack('view_details', jobId);
        }
    } else {
        // Hide details
        jobDetails.style.display = 'none';
        jobDetails.classList.remove('show');
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
        button.innerHTML = '<i class="fas fa-chevron-down"></i> View Details';
    }
}

// Tracking
function initTracking() {
    // Track page view once
    postTrack('page_view', null);
}

function postTrack(event, jobId) {
    try {
        fetch('/track', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ event: event, job_id: jobId, path: window.location.pathname })
        });
    } catch (e) {
        // no-op
    }
}

// Smooth scrolling for navigation links
function initSmoothScrolling() {
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetSection.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Initialize animations and effects
function initAnimations() {
    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animateElements = document.querySelectorAll('.job-card, .benefit-card, .contact-item');
    animateElements.forEach(el => {
        observer.observe(el);
    });
    
    // Add loading states to buttons
    const applyButtons = document.querySelectorAll('.btn-primary');
    applyButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.href && this.href.startsWith('mailto:')) {
                // Add loading state
                this.classList.add('loading');
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Opening Email...';
                
                // Reset after a short delay
                setTimeout(() => {
                    this.classList.remove('loading');
                    this.innerHTML = '<i class="fas fa-paper-plane"></i> Apply Now';
                }, 2000);
            }
        });
    });
}

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Handle window resize
window.addEventListener('resize', debounce(function() {
    // Close mobile menu on resize
    const navLinks = document.querySelector('.nav-links');
    const navToggle = document.querySelector('.nav-toggle');
    
    if (window.innerWidth > 768) {
        navLinks.classList.remove('active');
        navToggle.classList.remove('active');
    }
}, 250));

// Handle scroll events
window.addEventListener('scroll', debounce(function() {
    const header = document.querySelector('.header');
    
    if (window.scrollY > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
}, 10));

// Form validation (if forms are added in the future)
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Copy to clipboard functionality (for future use)
function copyToClipboard(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(function() {
            showNotification('Copied to clipboard!');
        });
    } else {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showNotification('Copied to clipboard!');
    }
}

// Subscribe form functionality
function initSubscribeForm() {
    const subscribeForm = document.getElementById('subscribeForm');
    const subscribeEmail = document.getElementById('subscribeEmail');
    const subscribeMessage = document.getElementById('subscribeMessage');
    
    if (subscribeForm) {
        subscribeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = subscribeEmail.value.trim();
            
            if (!email) {
                showFormMessage('Please enter your email address.', 'error');
                return;
            }
            
            if (!validateEmail(email)) {
                showFormMessage('Please enter a valid email address.', 'error');
                return;
            }
            
            // Show loading state
            showFormMessage('Subscribing you to job notifications...', 'loading');
            const submitBtn = subscribeForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subscribing...';
            submitBtn.disabled = true;
            
            // Submit form via AJAX
            const formData = new FormData(subscribeForm);
            
            fetch('/subscribe', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showFormMessage('Success! You\'ve been subscribed to job notifications. We\'ll notify you when new positions are available.', 'success');
                    subscribeEmail.value = '';
                } else {
                    showFormMessage(data.message || 'Something went wrong. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showFormMessage('Network error. Please check your connection and try again.', 'error');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
}

// Show form message
function showFormMessage(message, type) {
    const messageDiv = document.getElementById('subscribeMessage');
    if (messageDiv) {
        messageDiv.textContent = message;
        messageDiv.className = `form-message ${type}`;
        
        // Auto-hide success messages after 5 seconds
        if (type === 'success') {
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 5000);
        }
    }
}

// Show notification
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #2563eb;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 10000;
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .animate-in {
        animation: fadeInUp 0.6s ease forwards;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .header.scrolled {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    
    .nav-links.active {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 1rem;
    }
    
    .nav-toggle.active span:nth-child(1) {
        transform: rotate(-45deg) translate(-5px, 6px);
    }
    
    .nav-toggle.active span:nth-child(2) {
        opacity: 0;
    }
    
    .nav-toggle.active span:nth-child(3) {
        transform: rotate(45deg) translate(-5px, -6px);
    }
    
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }
    }
`;
document.head.appendChild(style);
