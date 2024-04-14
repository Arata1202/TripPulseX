'use strict'
const btn = document.querySelector('.btn');
const block = document.querySelector('.block');
btn.addEventListener('click', () => {
    btn.classList.toggle('active');
    block.classList.toggle('active');
});

const safeArea = parseInt(getComputedStyle(document.footer).getPropertyValue("padding-bottom"));