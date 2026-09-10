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




//cookie printing
let nam = document.getElementById("name");
let phone = document.getElementById("ph");


function save_cooki() {
    let see = nam.value;
    let n = phone.value;
    if (see.length === 0) {
        alert("you should enter the name");
    }
    if (n.toString().length < 10 || n.toString().length > 10) {
        alert("hey Phone number length should be a lenght of 10")
    }
    else {
        document.cookie = "name=" + encodeURIComponent(nam.value) + "; max-age=86400; path=/";
        document.cookie = "ph=" + encodeURIComponent(phone.value) + "; max-age=86400; path=/";
        alert("data saved successfully")
    }
}
function load_cookie() {
    /*console.log(document.cookie);*/

    let cook = document.cookie
    let a = cook.split(";")
    nam.innerText = a[0]
    ph.innerText = a[1]
};

//JQuery activity here
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

$(document).ready(function () {

    $("#sent").autocomplete({
        source: technologies
    });

    $("#myDialog").dialog({
        autoOpen: false,
        modal: true,

        buttons: {
            "OK": function () {
                $(this).dialog("close");
            },

            "Cancel": function () {
                $(this).dialog("close");
            }
        }
    });
    $("#tabs").tabs();

    $("#accordion").accordion({
        collapsible: true,
        heightStyle: "content"
    });
    $("button").button({
        icon: "ui-icon-disk",
        "filter": "brightness(0) invert(1)"
    });
    $("a").css("text-decoration", "none");
    $("#date_func").attr("text", "date");
    $("#date_func").datepicker({
        dateFormat: "dd/mm/yy"
    });
    $("#date_func").css("background-color", "#F3CD97")
    $("#full_body").css("background-color", "#F3CD97");
    $("input").css({
        "border": "none",
        "padding": "10px",
        "border-radius": "10px",

    });
    $("table,th,td").css("border", "2px solid #FF1A00 ");
    $("#tbl").each(function () {
        $(this).css("color", "#CC0000");
    });
    $("#mypage-footer").hide();

    $("#mypage-footer").before("<div><h2>Reference</h2><h3>1. <a href='https://www.w3schools.com/jquery/jquery_events.asp'>Refer here for the Jquery</a></h3></div>");
    $("footer").css({
        "background-color": "#BC4F4F", "color": "white",
        "justify-content": "space-evenly",
        "padding": "10px",
        "margin": "10px 0px 10px 0px",
        "border-radius": "10px"

    });

    // $("#mypage-footer").toogle();
    //    $("#mypage-header").mouseenter(function(){
    //         $(this).css("font-size","10px");
    //     });


    $("#mypage-header").css({
        "height": "10px",
        "overflow": "hidden",
        "text-align": "center"
    });

    $("#mypage-header").on("mouseenter", function () {

        $(this).css("height", "50px");
    });

    $("#mypage-header").on("mouseleave", function () {

        $(this).css("height", "10px");

    });

    $("#full_body").css({
        "padding": "10px",
        "margin": "10px"
    })



    // $("#mypage-header").css({"height":"10px","overflow":"hidden"})

    // $("#mypage-header").on("mouseenter", function(){
    //     $(this).css("font-size","30px");
    // });
    // $("#mypage-header").on("mouseleave", function(){
    //     $(this).css("font-size","10px");
    // });
    $("#mypage-footer").slideDown(10000, function () {
        $("#myDialog").dialog("open");
    });

});
$(".dis").css({
    "display": "flex",
    "border": "1px solid white",
    "border-radius": "10px",
    "padding": "10px",
    "width": "50%",
    "margin": "20px",
    "padding-left": "30px"

})
$(".b").css({
    "display": "flex",
    "padding": "10px",
    "width": "96%",
    "margin": "20px",
    "border": "1px solid white",
    "border-radius": "10px",
    "background-color": "#E98B50"

})
$("button").css({
    "padding": "10px",
    "font-size": "20px",
    "background-color": "lightgreen",
    "color": "brown",
    "border-radius": "10px"
})
// a. Change the background color to #FFFF88 and 
// remove the border for all input elements in the
//  page. Change table border color to #FF1A00 and 
//  text to #CC0000.

$("#contact-info").css({
    "display": "flex",
    "justify-content": "space-evenly",
    "align-items": "center"
});
$("#tbl").css({
    "background-color": "#FEF2A0",
    "margin-left": "30px",

})
$("td").css({
    "padding": "10px"
})


$("#head").css({
    "background-color": "#FEF2A0",
    "border": "1px solid white",
    "border-radius": "10px",
    "margin": "30px"

})

$(window).on("load", function () {

    $("#myDialog").dialog("open");

});