const track = document.querySelector('.carousel-track');
const cards = document.querySelectorAll('.card');
const prev = document.querySelector('.prev');
const next = document.querySelector('.next');

let index = 0;

// Função para descobrir quantos cards estão visíveis na tela atual
function getVisibleCards() {
    return window.innerWidth <= 768 ? 1 : 3;
}

next.addEventListener('click', () => {
    const visibleCards = getVisibleCards();
    if (index < cards.length - visibleCards) {
        index++;
    } else {
        index = 0;
    }
    updateCarousel();
});

prev.addEventListener('click', () => {
    const visibleCards = getVisibleCards();
    if (index > 0) {
        index--;
    } else {
        index = cards.length - visibleCards;
    }
    updateCarousel();
});

function updateCarousel() {
    const visibleCards = getVisibleCards();
    
    // No mobile usamos 100% de deslocamento por card. No desktop usamos a proporção (33.33%)
    const step = window.innerWidth <= 768 ? 100 : (100 / visibleCards);
    
    track.style.transform = `translateX(-${index * step}%)`;
}

// Reseta o index se o usuário girar o celular ou mudar o tamanho da tela para não travar
window.addEventListener('resize', () => {
    index = 0;
    updateCarousel();
});