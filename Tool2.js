const slider = document.querySelector('.slider');

var sectionIndex = 0;

document.querySelectorAll('.controls li').forEach(function(indicator, ind){
    indicator.addEventListener('click', function() {
        slider.style.transform = 'translate(' + (ind) * -20 + '%)';
    });

});