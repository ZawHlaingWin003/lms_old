let date = document.querySelector('#date');
let time = document.querySelector('#time');
let date_obj_1 = new Date().toDateString();
date.innerHTML = date_obj_1;

setInterval(() => {
    let date_obj_2 = new Date();
    let time_string = `${date_obj_2.getHours()} : ${date_obj_2.getMinutes()} : ${date_obj_2.getSeconds()}`;
    time.innerHTML = time_string;
}, 1000);
