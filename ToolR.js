// src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js";

const btn_REPORT = document.querySelector("#btn_REPORT");
const btn_COMPLETE12 = document.querySelector("#btn_COMPLETE1");
//const btn_DELROOM = document.querySelector("#del_room");

btn_COMPLETE12.addEventListener("click", function () {
  var current_solution = document.getElementById("current_solution").value;
  //document.querySelector('.controls .selected').classList.remove('selected');
  // indicatorParents.children[sectionIndex].classList.add('selected');
  //  slider.style.transform = 'translateX(-40%)';
  // slider.scrollTo({
  //     top: 0
  //  })
  //  document.getElementById("li3").style.display="inline";

  $.getJSON("https://api.ipify.org/?format=json", function (e) {
    $.post(
      "Report.php",
      {
        ip: e.ip,
        cursol: current_solution,
      },
      function (data, status) {
        console.log("Data: " + data + "\nStatus: " + status);
      }
    );
  });
});
// btn_DELROOM.addEventListener("click", function () {
//   var hidid = document.getElementById("hidid").value;

//   $.post("function.php", {
//       hidID: hidid,
//     });
//     /*function(data,status){
//         console.log("Data: " + data + "\nStatus: " + status);
//         inputs.forEach(input => input.value='');
//     });*/

//     $(".Rbox").load(window.location.href + " .Rbox");
// });

const delete_room = (id) => {
  $.post("function.php", {
    hidID: id,
  }).done(function() {
    location.reload();
  });
};
