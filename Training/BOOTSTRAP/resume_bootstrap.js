let num1 = document.getElementById("one");
let num2 = document.getElementById("two");
let valuee = document.getElementById("val");
//let button=document.getElementById("btn");
function Max() {
    let n1 = Number(num1.value);
    let n2 = Number(num2.value);
    if (n1 > n2) {
        valuee.innerText = n1;
        console.log("num1 is larger");
    }
    else if (n1 < n2) {
        valuee.innerText = n2;
        console.log("num2 is larger");
    }
    else {
        valuee.innerText = n1;
        console.log("both are same numbers");
    }

}

//for the revers string
let stri = document.getElementById("st");
let reversed = document.getElementById("rev");
function Reverse() {
    let s = stri.value
    if (s.length === 0) {
        alert("please enter a value to make it revers");
    }
    else {
        let myarr = s.split("");
        let i = 0
        let j = s.length - 1
        while (i < j) {
            let tem = myarr[i]
            myarr[i] = myarr[j]
            myarr[j] = tem
            i++
            j--
        }
        let revers_res = myarr.join("")
        reversed.innerText = revers_res
    }
}


//For largetst words

let sent1 = document.getElementById("sent");
let lar = document.getElementById("lar");

function find_largest() {
    let s1 = sent1.value;
    if (s1.length === 0) {
        alert("please enter a value to make it revers");
    }
    else {
        let ar = s1.split(",");
        let maxx = 0
        let larword = ""
        ar.map((word) => {
            let len = word.length;
            if (len > maxx) {
                larword = word;
                maxx = len;
            }
        })
        lar.innerText = larword;
    }
}


// cooki in bootstrap
let nam = document.getElementById("name");
let phone = document.getElementById("ph");

let savedName = document.getElementById("savedName");
let savedPhone = document.getElementById("savedPhone");

let errorMsg = document.getElementById("errorMsg");


// ====================================
// SAVE COOKIE
// ====================================

function save_cooki() {

    let nameValue = nam.value.trim();
    let phoneValue = phone.value.trim();


    // Check name
    if (nameValue.length === 0) {

        errorMsg.innerText = "Please enter your name";

        return;
    }


    // Check phone number
    if (phoneValue.length !== 10) {

        errorMsg.innerText =
            "Phone number must contain exactly 10 digits";

        return;
    }


    // Check phone contains only numbers
    if (isNaN(phoneValue)) {

        errorMsg.innerText =
            "Phone number must contain only numbers";

        return;
    }


    // Save name cookie
    document.cookie =
        "name=" +
        encodeURIComponent(nameValue) +
        "; max-age=86400; path=/";


    // Save phone cookie
    document.cookie =
        "ph=" +
        encodeURIComponent(phoneValue) +
        "; max-age=86400; path=/";


    errorMsg.innerText = "";


    alert("Data saved successfully");


    // Load newly saved data
    load_cookie();


    // Close Bootstrap modal
    let modalElement =
        document.getElementById("cookieModal");

    let modal =
        bootstrap.Modal.getOrCreateInstance(modalElement);

    modal.hide();
}



// ====================================
// GET A COOKIE BY NAME
// ====================================

function getCookie(cookieName) {

    let cookies = document.cookie.split(";");


    for (let cookie of cookies) {

        let parts = cookie.trim().split("=");

        let key = parts[0];

        let value = parts[1];


        if (key === cookieName) {

            return decodeURIComponent(value);
        }
    }


    return null;
}



// ====================================
// LOAD COOKIE
// ====================================

function load_cookie() {

    let nameCookie = getCookie("name");

    let phoneCookie = getCookie("ph");


    // Put values inside inputs
    if (nameCookie !== null) {

        nam.value = nameCookie;

        savedName.innerText = nameCookie;
    }


    if (phoneCookie !== null) {

        phone.value = phoneCookie;

        savedPhone.innerText = phoneCookie;
    }
}



// ====================================
// LOAD COOKIE WHEN PAGE LOADS
// ====================================

window.addEventListener("load", function () {

    load_cookie();

});
let technologies = [
    "Python",
    "Django",
    "React",
    "JavaScript",
    "jQuery",
    "HTML",
    "CSS",
    "MySQL",
    "FastAPI"
];


// //cookie printing
// let nam = document.getElementById("name");
// let phone = document.getElementById("ph");


// function save_cooki() {
//     let see = nam.value;
//     let n = phone.value;
//     if (see.length === 0) {
//         alert("you should enter the name");
//     }
//     if (n.toString().length < 10 || n.toString().length > 10) {
//         alert("hey Phone number length should be a lenght of 10")
//     }
//     else {
//         document.cookie = "name=" + encodeURIComponent(nam.value) + "; max-age=86400; path=/";
//         document.cookie = "ph=" + encodeURIComponent(phone.value) + "; max-age=86400; path=/";
//         alert("data saved successfully")
//     }
// }
// function load_cookie() {
//     /*console.log(document.cookie);*/

//     let cook = document.cookie
//     let a = cook.split(";")
//     nam.innerText = a[0]
//     ph.innerText = a[1]
// }


// Js content For Tost 
const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')

if (toastTrigger) {
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
  toastTrigger.addEventListener('click', () => {
    toastBootstrap.show()
  })
}

// for footer alert msg to modal
$(document).ready(function () {
    $("#mypage-footer").hide();
    $("#mypage-footer").slideDown(10000, function () {

    let modalElement = document.getElementById("footerModal");

    let modal =
        bootstrap.Modal.getOrCreateInstance(modalElement);

    modal.show();

});
     $("#sent").autocomplete({
        source: technologies
    });
});