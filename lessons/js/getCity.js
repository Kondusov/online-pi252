let user_city = prompt('Введите город');

function getCIty(city){
    switch (city) {
    case 'moscow':
        return 'Добро пожаловать в Москву!';
        break;
    case 'sochi':
        return 'Добро пожаловать в Сочи!';
        break;
    default:
        // console.log('Добро пожаловать в '+city);
        return `Добро пожаловать в ${city}`;
    }
}
console.log(getCIty(user_city));
///////////////////////////////////////
function getCIty_var2(city){
    if(city == 'moscov'){
        return 'Добро пожаловать в Москву';
    }
    else if(city == 'sochi'){
         return 'Добро пожаловать в Сочи';
    }else{
         return `Добро пожаловать в ${city}`;
    }
}
console.log(getCIty_var2(user_city));
