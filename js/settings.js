

let design = document.querySelector("#design");
let truth = document.querySelector("#truth");
let all_btn = document.querySelector("#all");
let top_btn = document.querySelector("#top");
let menu = document.querySelector("#menu");
let find = document.querySelector("#find");
let forms = document.querySelector("#form");
let members = document.querySelector("#members");
let form_1 = document.querySelector("#form-1");
let form_2 = document.querySelector("#form-2");
let aside = document.querySelector("#aside");
let find_request = document.querySelector("#find-request");
let all_members = document.querySelector("#all-members");
let top_members = document.querySelector("#top-members");
design.onclick = ()=>{
    forms.style.display = "flex";
    members.style.display = "none";
    form_1.style.display = "flex";
    form_2.style.display = "none";
    find_request.style.display = "none";
}
truth.onclick = ()=>{
    forms.style.display = "flex";
    members.style.display = "none";
    form_1.style.display = "none";
    form_2.style.display = "flex";
    find_request.style.display = "none";
}
all_btn.onclick = ()=>{
    forms.style.display = "none";
    members.style.display = "flex";
    form_1.style.display = "none";
    form_2.style.display = "none";
    top_members.style.display = "none";
    all_members.style.display = "flex";
    find_request.style.display = "none";
}
top_btn.onclick = ()=>{
    forms.style.display = "none";
    members.style.display = "flex";
    form_1.style.display = "none";
    form_2.style.display = "none";
    find_request.style.display = "none";
    top_members.style.display = "flex";
    all_members.style.display = "none";
}
menu.onclick = ()=>{
    aside.style.display = "flex";
    forms.style.display = "none";
    members.style.display = "none";
    find_request.style.display = "none";
}
find.onclick = ()=>{
    forms.style.display = "none";
    members.style.display = "none";
    form_1.style.display = "none";
    form_2.style.display = "none";
    find_request.style.display = "flex";
    top_members.style.display = "none";
    all_members.style.display = "none";
}
if (window.screen.width <= 768) {
    console.log(window.screen.width);
    design.onclick = ()=>{
        forms.style.display = "flex";
        members.style.display = "none";
        form_1.style.display = "flex";
        form_2.style.display = "none";
        aside.style.display = "none";
        find_request.style.display = "none";
    }
    truth.onclick = ()=>{
        forms.style.display = "flex";
        members.style.display = "none";
        form_1.style.display = "none";
        form_2.style.display = "flex";
        aside.style.display = "none";
        find_request.style.display = "none";
    }
    all_btn.onclick = ()=>{
        forms.style.display = "none";
        members.style.display = "flex";
        form_1.style.display = "none";
        form_2.style.display = "none";
        aside.style.display = "none";
        find_request.style.display = "none";
    }
    top_btn.onclick = ()=>{
        forms.style.display = "none";
        members.style.display = "flex";
        form_1.style.display = "none";
        form_2.style.display = "none";
        aside.style.display = "none";
        find_request.style.display = "none";
    }
    all_btn.onclick = ()=>{
        forms.style.display = "none";
        members.style.display = "flex";
        form_1.style.display = "none";
        form_2.style.display = "none";
        top_members.style.display = "none";
        all_members.style.display = "flex";
        aside.style.display = "none";
        find_request.style.display = "none";
    }
    top_btn.onclick = ()=>{
        forms.style.display = "none";
        members.style.display = "flex";
        form_1.style.display = "none";
        form_2.style.display = "none";
        top_members.style.display = "flex";
        all_members.style.display = "none";
        aside.style.display = "none";
        find_request.style.display = "none";
    }
    find.onclick = ()=>{
        forms.style.display = "none";
        members.style.display = "none";
        form_1.style.display = "none";
        form_2.style.display = "none";
        find_request.style.display = "flex";
        aside.style.display = "none";
        top_members.style.display = "none";
        all_members.style.display = "none";
    }
}else
{
    console.log(false);
}
// let srcIMG = document.querySelector("#src").value;
// let find_btn = document.querySelector("#find_btn");
// find_btn.addEventListener("click",()=>{
// document.querySelector("#request_img").src = srcIMG;
// });
