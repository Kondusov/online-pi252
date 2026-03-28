// let dinamicText = document.getElementById('dinamicText');
// let dinamicText = document.getElementsByName('h2');
// let dinamicText = document.getElementsByTagName('h2');
// let dinamicText = document.querySelector('h2');
// let dinamicText = document.querySelectorAll('h2');
let dinamicText = document.querySelector('#dinamicText');
console.log(dinamicText);
console.log(dinamicText.textContent);
dinamicText.textContent = 'Новый динамик текст';