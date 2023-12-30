

let login = document.querySelector("#login");
let signup = document.querySelector("#signup");
let menu_mobile = document.querySelector("#menu_mobile");
let register = document.querySelector("#register");
let link_signup = document.querySelector("#link_signup");
let link_login = document.querySelector("#link_login");
let signup_mobile = document.querySelector("#signup_mobile");
if (document.querySelector("#link_login") !== null && document.querySelector("#link_signup") !== null && document.querySelector("#signup_mobile") !== null) {
    link_login.onclick = ()=>{
        signup.style.display = "none";
        login.style.display = "flex";
    }
    link_signup.onclick = ()=>{
        signup.style.display = "flex";
        login.style.display = "none";
    }
    signup_mobile.onclick = ()=>{
        menu_mobile.style.display = "none";
        register.style.display = "flex";
    }
}
let aside = document.querySelector("#aside");
let menu = document.querySelector("#menu");
menu.onclick = ()=>{
    aside.classList.toggle("transform");
    register.style.display = "none";
    menu_mobile.style.display = "flex";
}