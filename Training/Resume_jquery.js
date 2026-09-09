let num1=document.getElementById("one");
let num2=document.getElementById("two");
let valuee=document.getElementById("val");
//let button=document.getElementById("btn");
function Max(){
    let n1 = Number(num1.value);
    let n2 = Number(num2.value);
if(n1>n2){
    valuee.innerText=n1;
    console.log("num1 is larger");
}
else if(n1<n2){
    valuee.innerText=n2;
    console.log("num2 is larger");
    }
else{
    valuee.innerText=n1;
    console.log("both are same numbers");
    }

}
//for the revers string
let stri=document.getElementById("st");
let reversed=document.getElementById("rev");
function Reverse(){
    let s=stri.value
    if (s.length===0){
        alert ("please enter a value to make it revers");
    }
    else{
        let myarr=s.split("");
        let i=0
        let j=s.length-1
        while(i<j){
            let tem=myarr[i]
            myarr[i]=myarr[j]
            myarr[j]=tem
            i++
            j--
        }
        let revers_res=myarr.join("")
        reversed.innerText=revers_res
    }  
}


//For largetst words

let sent1=document.getElementById("sent");
let lar=document.getElementById("lar");

function find_largest(){
    let s1=sent1.value;
    if (s1.length===0){
        alert ("please enter a value to make it revers");
    }
    else{
        let ar=s1.split(",");
        let maxx=0
        let larword=""
        ar.map((word)=>{
            let len=word.length;
            if (len>maxx){
                larword=word;
                maxx=len;
            }
        })
        lar.innerText=larword;
    }
}




//cookie printing
let nam=document.getElementById("name");
let phone=document.getElementById("ph");


function save_cooki(){
    let see=nam.value;
    let n=phone.value;
    if (see.length===0 ){
        alert ("you should enter the name");
    }
    if (n.toString().length <10 || n.toString().length>10){
        alert ("hey Phone number length should be a lenght of 10")
    }
    else{
    document.cookie = "name=" + encodeURIComponent(nam.value) + "; max-age=86400; path=/";
    document.cookie = "ph=" + encodeURIComponent(phone.value) + "; max-age=86400; path=/";
    alert("data saved successfully")
    }
}
function load_cookie(){
    /*console.log(document.cookie);*/
    
    let cook=document.cookie
    let a=cook.split(";")
    nam.innerText=a[0]
    ph.innerText=a[1]
};

//JQuery activity here
 $(window).on("load", function(){
        
        alert("Page fully loaded");
    });
$(document).ready(function(){

   $("#full_body").css("background-color","#FFFF88 ");
   $("input").css("border","none");
    $("input").css("padding","10px");
    $("input").css("border-radius","10px");
   $("table,th,td").css("border","2px solid #FF1A00 ");
   $("#tbl").each(function(){
    $(this).css("color","#CC0000");
   });
   $("#mypage-footer").hide();
   
   $("#mypage-footer").before("<div></div>")
    // $("#mypage-footer").toogle();
//    $("#mypage-header").mouseenter(function(){
//         $(this).css("font-size","10px");
//     });
$("#mypage-header").css("height","10px")

$("#mypage-header").on("mouseenter", function(){
    $(this).css("font-size","30px");
});
$("#mypage-header").on("mouseleave", function(){
    $(this).css("font-size","10px");
});
   $("#mypage-footer").slideDown(10000,function(){
    alert("Slidedown after 10 seconds")
   });
    



});

// a. Change the background color to #FFFF88 and 
// remove the border for all input elements in the
//  page. Change table border color to #FF1A00 and 
//  text to #CC0000.

