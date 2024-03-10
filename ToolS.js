src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js";

const slider = document.querySelector('.slider');
const btn_start = document.querySelector('.btn_start');
const btn_NEXT1 = document.querySelector('.btn_NEXT1');
const btn_NEXT2 = document.querySelector('#btn_NEXT2');
const btn_NEXT3 = document.querySelector('#btn_NEXT3');
const btn_NEWR = document.querySelector('#btn_NEWR');
const btn_COMPLETE1 = document.querySelector('#btn_COMPLETE1');
const errorMessage = document.getElementById("errorMessage");
const errorMessage2 = document.getElementById("errorMessage2");
const errorMessage1 = document.getElementById("errorMessage1");
const swiperer = document.getElementById('swiperer');
//const btn_REPORT = document.querySelector('#btn_REPORT');


const indicatorParents = document.querySelector('.controls ul');

var sectionIndex = 0;

document.querySelectorAll('.controls li').forEach(function(indicator, ind){
    indicator.addEventListener('click', function() {
        sectionIndex = ind;
        document.querySelector('.controls .selected').classList.remove('selected');
        indicator.classList.add('selected');
        slider.style.transform = 'translate(' + (sectionIndex) * -20 + '%)';
        slider.scrollTo({
            top: 0
        })
    });

});


btn_start.addEventListener('click', function(){

    var conf = document.getElementById('confirm').checked;

    const errors = [];

    if(conf === false){errors.push("You need to accept the terms and conditions")}

    if(errors.length > 0){
        //e.preventDefault();
        errorMessage1.toggleAttribute('hidden');
        errorMessage1.innerHTML = errors.join('<br> ');
    }
else{
    // document.querySelector('.controls .selected').classList.remove('selected');
    // indicatorParents.children[sectionIndex].classList.add('selected');
    // slider.style.transform = 'translateX(-20%)';
    // document.getElementById("li2").style.display="inline";

    $(".section1").addClass('hide');
    $(".section2").removeClass('hide');
    $.getJSON("https://ipapi.co/json", function(e) {
    //$.getJSON("https://ipapi.co/json/", function(e) {
        //https://api.ipify.org/?format=json
        
        $.post("script1.php",
        {
          ip: e.ip,
          isp: e.org,
          country: e.country_name,
          city: e.region,
          currency: e.currency,
          confirm: conf
        },
        function(data,status){
          console.log("Data: " + data + "\nStatus: " + status);
        });
    
        location.href = 'calculator4.php';

}
    
    );

    
    
}


});

