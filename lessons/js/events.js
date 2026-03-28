function getDataForm(){
    let message = document.querySelector('#q').value;
    let age = document.querySelector('#age').value;
    // console.log(message, age);
    return [message,age];
}
let main_form = document.querySelector('form');
main_form.addEventListener('submit', (event)=>{
    event.preventDefault();
    let resultElem = document.getElementById('dinamicText');
    resultElem.textContent = `Сообщение: ${getDataForm()[0]}/ Возраст: ${getDataForm()[1]}`; 
});

document.addEventListener('keypress', (event)=>{
    console.log(event.key);
});
document.addEventListener('contextmenu', (event)=>{
    event.preventDefault();
    console.log('right click');
});