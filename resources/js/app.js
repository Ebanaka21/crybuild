import './bootstrap';

// Инициализация обработчиков при загрузке DOM
document.addEventListener('DOMContentLoaded', function() {
    // Обработчики для кнопок "В корзину"
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            addToCart(productId, this);
        });
    });

    // Инициализация слайдера баннеров
    initBannerSlider();
});

// Функция для сортировки каталога
window.handleSort = function(sortValue) {
    const params = new URLSearchParams(window.location.search);
    params.set('sort', sortValue);
    params.set('page', 1);
    window.location.href = window.location.pathname + '?' + params.toString();
};

// Функция для показа уведомлений
window.showNotification = function(message, type = 'success') {
    // Удаляем старое уведомление если есть
    const oldNotif = document.querySelector('.notification-toast');
    if (oldNotif) oldNotif.remove();

    const notif = document.createElement('div');
    notif.className = `notification-toast fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    }`;
    notif.textContent = message;
    document.body.appendChild(notif);

    setTimeout(() => notif.remove(), 3000);
};

// Функции для работы с товарами на странице
window.changeMainImage = function(src) {
    const mainImage = document.getElementById('mainImage');
    if (mainImage) mainImage.src = src;
};

window.incrementQuantity = function() {
    const input = document.getElementById('quantity');
    if (input) input.value = parseInt(input.value) + 1;
};

window.decrementQuantity = function() {
    const input = document.getElementById('quantity');
    if (input) {
        const currentValue = parseInt(input.value);
        const minValue = parseInt(input.getAttribute('min')) || 1;
        if (currentValue > minValue) {
            input.value = currentValue - 1;
        }
    }
};

// Функции для работы с корзиной, wishlist и отзывами
window.addToCart = function(productId, buttonEl = null, quantity = 1) {
    const quantityInput = document.getElementById('quantity');
    if (quantityInput) {
        quantity = parseInt(quantityInput.value);
    }

    // Добавляем loading state к кнопке
    if (buttonEl) {
        buttonEl.disabled = true;
        buttonEl.style.opacity = '0.6';
        const originalText = buttonEl.textContent;
        buttonEl.textContent = 'Добавляю...';
    }

    fetch('/api/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('✓ Товар добавлен в корзину!', 'success');
        } else {
            showNotification('✗ Ошибка при добавлении товара', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('✗ Ошибка сети', 'error');
    })
    .finally(() => {
        // Восстанавливаем состояние кнопки
        if (buttonEl) {
            buttonEl.disabled = false;
            buttonEl.style.opacity = '1';
            buttonEl.textContent = 'В корзину';
        }
    });
};

window.toggleWishlist = function(productId) {
    fetch('/api/wishlist/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
        } else if (data.message === 'Требуется авторизация') {
            showNotification('Пожалуйста, войдите в аккаунт', 'error');
            setTimeout(() => window.location.href = '/login', 1500);
        } else {
            showNotification('Ошибка при изменении wishlist', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Ошибка сети', 'error');
    });
};

window.submitReview = function(event, productId) {
    event.preventDefault();

    const rating = document.getElementById('ratingInput')?.value;
    const comment = document.getElementById('commentInput')?.value;

    if (!rating) {
        showNotification('Пожалуйста, выберите оценку', 'error');
        return;
    }

    fetch('/api/reviews/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId,
            rating: parseInt(rating),
            comment: comment
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('✓ Отзыв успешно отправлен!', 'success');
            const form = document.getElementById('reviewForm');
            if (form) form.reset();
            const ratingInput = document.getElementById('ratingInput');
            if (ratingInput) ratingInput.value = 0;
            setTimeout(() => location.reload(), 1500);
        } else if (data.message === 'Требуется авторизация') {
            showNotification('Пожалуйста, войдите в аккаунт', 'error');
            setTimeout(() => window.location.href = '/login', 1500);
        } else {
            showNotification('Ошибка при отправке отзыва', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Ошибка сети', 'error');
    });
};

// Слайдер баннеров
let currentSlide = 0;

function initBannerSlider() {
    const slides = document.querySelectorAll('.banner-slide');
    const totalSlides = slides.length;

    if (totalSlides === 0) return;

    window.showSlide = function(index) {
        currentSlide = index;

        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.remove('opacity-0', 'z-0');
                slide.classList.add('opacity-100', 'z-10');
            } else {
                slide.classList.remove('opacity-100', 'z-10');
                slide.classList.add('opacity-0', 'z-0');
            }
        });

        document.querySelectorAll('.banner-dot').forEach((dot, i) => {
            if (i === index) {
                dot.classList.remove('bg-white/50');
                dot.classList.add('bg-white');
            } else {
                dot.classList.remove('bg-white');
                dot.classList.add('bg-white/50');
            }
        });
    };

    window.nextSlide = function() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    };

    window.prevSlide = function() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    };

    // Автоматическая смена слайдов каждые 5 секунд
    if (totalSlides > 1) {
        setInterval(() => {
            nextSlide();
        }, 5000);
    }
}
