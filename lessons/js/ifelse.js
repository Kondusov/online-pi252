// к true приведется 1, "любая не пустая строка", "любое число - кроме ноля"
// к false приведется 0, "пустая строка", null, undefined.
let user_name = 'test Name';
let user_age;

if(user_name && user_age){
    console.log('if отработал '+ 'имя: ' +user_name + 'возраст: '+ user_age);
}else if(user_name || user_age){
    console.log('elseif отработал ' +user_age);
}else{
    console.log('else отработал');
}
