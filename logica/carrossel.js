
const track = document.querySelector('.carousel-track');
const cards = document.querySelectorAll('.card');
const prev = document.querySelector('.prev');
const next = document.querySelector('.next');

let index = 0;
const visibleCards = 3;

next.addEventListener('click', () => {
    if (index < cards.length - visibleCards) {
        index++;
        track.style.transform = `translateX(-${index * (100 / visibleCards)}%)`;
    }
});

prev.addEventListener('click', () => {
    if (index > 0) {
        index--;
        track.style.transform = `translateX(-${index * (100 / visibleCards)}%)`;
    }
});

