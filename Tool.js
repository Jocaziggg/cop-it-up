const src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js";



const slider = document.querySelector(".slider");

const btn_start = document.querySelector(".btn_start");

const btn_NEXT1 = document.querySelector(".btn_NEXT1");

const btn_NEXT2 = document.querySelector("#btn_NEXT2");

const btn_NEXT3 = document.querySelector("#btn_NEXT3");

const btn_NEWR = document.querySelector("#btn_NEWR");

const btn_COMPLETE1 = document.querySelector("#btn_COMPLETE1");

const errorMessage = document.getElementById("errorMessage");

const errorMessage2 = document.getElementById("errorMessage2");

const errorMessage1 = document.getElementById("errorMessage1");

const swiperer = document.getElementById("swiperer");

//const btn_REPORT = document.querySelector('#btn_REPORT');



const indicatorParents = document.querySelector(".controls ul");



var sectionIndex = 0;



document.querySelectorAll(".controls li").forEach(function (indicator, ind) {

  indicator.addEventListener("click", function () {

    sectionIndex = ind;

    document.querySelector(".controls .selected").classList.remove("selected");

    indicator.classList.add("selected");

    slider.style.transform = "translate(" + sectionIndex * -20 + "%)";

    slider.scrollTo({

      top: 0,

    });

  });

});



btn_NEXT1.addEventListener("click", (e) => {

  var room_name = document.getElementById("room_name").value;

  var wall_surface = document.getElementById("room_S-Walls").value;

  var floor_surface = document.getElementById("room_S-Floor").value;

  var ceiling_surface = document.getElementById("room_S-ceiling").value;

  var windows_surface = document.getElementById("room_S-Windows").value;

  var doors_surface = document.getElementById("room_S-Doors").value;

  var tempout = document.getElementById("room_Temp-out").value;

  var tempin = document.getElementById("room_Temp-in").value;

  var Podloga = document.getElementById("Podloga").value;

  var IznadSobe = document.getElementById("Iznadsobe").value;

  var Ventila = document.getElementById("Ventilacija").value;

  //document.querySelector('.controls .selected').classList.remove('selected');

  // indicatorParents.children[sectionIndex].classList.add('selected');

  //  slider.style.transform = 'translateX(-40%)';

  // slider.scrollTo({

  //     top: 0

  //  })

  //  document.getElementById("li3").style.display="inline";



  const errors = [];



  if (room_name.trim() === "") {

    errors.push("- Room name is required");

  }

  if (wall_surface.trim() === "") {

    errors.push("- Wall surface is required");

  }

  if (floor_surface.trim() === "") {

    errors.push("- Floor surface is required");

  }

  if (ceiling_surface.trim() === "") {

    errors.push("- Ceiling surface is required");

  }

  if (windows_surface.trim() === "") {

    errors.push("- Window surface is required");

  }

  if (doors_surface.trim() === "") {

    errors.push("- door surface is required");

  }

  if (tempout.trim() === "") {

    errors.push(

      "- 'Minimum expected temperature outside' is a required measure for the calculation. Please add a value to this field. (For example: -12)"

    );

  }

  if (tempin.trim() === "") {

    errors.push(

      "- Desired temperature inside is a required measure for the calculation. Please add a desired temperature that you would like to have in this room. (For example 25)"

    );

  }

  if (Podloga.trim() === "select") {

    errors.push(

      "- 'The room lies on' information is required. Please select one of the options."

    );

  }

  if (IznadSobe.trim() === "select") {

    errors.push(

      "- 'The room lies under' information is required. Please select one of the options."

    );

  }

  if (Ventila.trim() === "select") {

    errors.push("- Please select the ventilation type in this room.");

  }



  if (errors.length > 0) {

    // e.preventDefault();



    errorMessage.hasAttribute("hidden") &&

      errorMessage.toggleAttribute("hidden");



    errorMessage.innerHTML = errors.join("<br> ");



    return false;

  } else {

    while (errors.length > 0) {

      errors.pop();

    }



    //document.getElementById("li3").style.display="inline";

  }



  $(".section2").addClass("hide");

  $(".section4").addClass("hide");

  $(".section5").addClass("hide");

  $(".section3").removeClass("hide");

  $(".section6").addClass("hide");



  window.scrollTo({

    top: 0,

  });

});



btn_NEXT2.addEventListener("click", () => {

  // document.querySelector('.controls .selected').classList.remove('selected');

  // indicatorParents.children[sectionIndex].classList.add('selected');

  // slider.style.transform = 'translateX(-60%)';

  // slider.scrollTo({

  //     top: 0

  // })

  // document.getElementById("li4").style.display="inline";



  var vons = $("input[name='von[]']")

    .map(function () {

      return $(this).val();

    })

    .get();



  var durchgefuhrte_arbeitens = [];

  $("select[name='durchgefuhrte_arbeiten[]']").each(function () {

    var val = $(this).val();

    if (val !== "") durchgefuhrte_arbeitens.push(val);

  });



  var bezeichnung = $("input[name='bezeichnung[]']")

    .map(function () {

      return $(this).val();

    })

    .get();

  var mange = [];

  $("select[name='mange[]']").each(function () {

    var val = $(this).val();

    if (val !== "") mange.push(val);

  });



  var intern = $("input[name='intern[]']")

    .map(function () {

      return $(this).val();

    })

    .get();

  var offene_pukte = [];

  $("select[name='offene_pukte[]']").each(function () {

    var val = $(this).val();

    if (val !== "") offene_pukte.push(val);

  });



  const form_errors = [];



  if (durchgefuhrte_arbeitens.includes("Material")) {

    form_errors.push("- Please select the material of the wall layer or use a red 'Trash' button to remove the redundant field.");

  }

  if (vons.includes("")) {

    form_errors.push(

      "- Please add the tickness for all layers of the wall."

    );

  }

  if (mange.includes("Material")) {

    form_errors.push("- Please select the material of the floor layer or use a red 'Trash' button to remove the redundant field.");

  }

  if (bezeichnung.includes("")) {

    form_errors.push(

      "- Please add the tickness for all layers of the floor."

    );

  }

  if (offene_pukte.includes("Material")) {

    form_errors.push("- Please select the material of the ceiling layer or use a red 'Trash' button to remove the redundant field.");

  }

  if (intern.includes("")) {

    form_errors.push(

      "- Please add the tickness for all layers of the ceiling."

    );

  }



  if (form_errors.length > 0) {

    errorMessage2.hasAttribute("hidden") &&

      errorMessage2.toggleAttribute("hidden");

    errorMessage2.innerHTML = form_errors.join("<br> ");



    return false;

  } else {

    while (form_errors.length > 0) {

      form_errors.pop();

    }



    $(".section2").addClass("hide");

    $(".section3").addClass("hide");

    $(".section4").removeClass("hide");



    window.scrollTo({

      top: 0,

    });

  }

});



btn_COMPLETE1.addEventListener("click", () => {

  // document.querySelector('.controls .selected').classList.remove('selected');

  // indicatorParents.children[sectionIndex].classList.add('selected');

  // slider.style.transform = 'translateX(-80%)';

  // slider.scrollTo({

  //     top: 0

  // })

  // document.getElementById("li5").style.display="inline";

  let inputs = document.querySelectorAll("input");

  var room_name = document.getElementById("room_name").value;

  var wall_surface = document.getElementById("room_S-Walls").value;

  var floor_surface = document.getElementById("room_S-Floor").value;

  var ceiling_surface = document.getElementById("room_S-ceiling").value;

  var windows_surface = document.getElementById("room_S-Windows").value;

  var doors_surface = document.getElementById("room_S-Doors").value;

  var tempout = document.getElementById("room_Temp-out").value;

  var tempin = document.getElementById("room_Temp-in").value;

  var Podloga = document.getElementById("Podloga").value;

  var IznadSobe = document.getElementById("Iznadsobe").value;

  var Ventila = document.getElementById("Ventilacija").value;



  var vons = $("input[name='von[]']")

    .map(function () {

      return $(this).val();

    })

    .get();

  var durchgefuhrte_arbeitens = [];

  $("select[name='durchgefuhrte_arbeiten[]']").each(function () {

    var val = $(this).val();

    if (val !== "") durchgefuhrte_arbeitens.push(val);

  });



  var bezeichnung = $("input[name='bezeichnung[]']")

    .map(function () {

      return $(this).val();

    })

    .get();

  var mange = [];

  $("select[name='mange[]']").each(function () {

    var val = $(this).val();

    if (val !== "") mange.push(val);

  });



  var intern = $("input[name='intern[]']")

    .map(function () {

      return $(this).val();

    })

    .get();

  var offene_pukte = [];

  $("select[name='offene_pukte[]']").each(function () {

    var val = $(this).val();

    if (val !== "") offene_pukte.push(val);

  });



  var doors_u = document.getElementById("doorsu").value;

  /*var doors_t = document.getElementById('doorst').value;*/

  var windows_u = document.getElementById("windowsu").value;

  /*var windows_t = document.getElementById('windowst').value;*/



  var radiatorType1 = document.getElementById("radt").value;

  var radiatorSurface = document.getElementById("rads").value;

  var radiatorType2 = document.getElementById("radt2").value;

  /*var selection1 = document.getElementById('selection1').value;

    var tick1 = document.getElementById('tic1').value;

    var selection2 = document.getElementById('selection2').value;

    var tick2 = document.getElementById('tic2').value;

    var selection3 = document.getElementById('selection3').value;

    var tick3 = document.getElementById('tic3').value;



    var WindowL = document.getElementById('MatW2').value;

    var WindowLT = document.getElementById('MatW2Val').value;

    var DoorsL = document.getElementById('MatD2').value;

    var DoorsLT = document.getElementById('MatD2Val').value;*/



  $.getJSON("https://api.ipify.org/?format=json", function (e) {

    $.post(

      "script2.php",

      {

        ip: e.ip,

        roomName: room_name,

        wallSurface: wall_surface,

        floorSurface: floor_surface,

        ceilingSurface: ceiling_surface,

        windowsSurface: windows_surface,

        doorsSurface: doors_surface,

        tempOut: tempout,

        tempIn: tempin,

        vons: vons,

        durchgefuhrteArbeitens: durchgefuhrte_arbeitens,

        bezeichnung: bezeichnung,

        mange: mange,

        offenepukte: offene_pukte,

        intern: intern,

        doorsU: doors_u,

        windowsU: windows_u,

        radiatorT1: radiatorType1,

        radiatorS1: radiatorSurface,

        radiatorT2: radiatorType2,

        Podloga: Podloga,

        IznadS: IznadSobe,

        Ventilacija: Ventila,

        /*sel1: selection1,

            sel2: selection2,

            sel3: selection3,

            tickn1: tick1,

            tickn2: tick2,

            tickn3: tick3,

            WL: WindowL,

            WLT: WindowLT,

            DL: DoorsL,

            DLT: DoorsLT*/

      },

      function (data, status) {

        console.log("Data: " + data + "\nStatus: " + status);

        inputs.forEach((input) => (input.value = ""));

      }

    );

  });



  $(".section2").addClass("hide");

  $(".section3").addClass("hide");

  $(".section4").addClass("hide");

  $(".section5").removeClass("hide");

  $(".section6").addClass("hide");

});



btn_NEWR.addEventListener("click", function () {

  // document.querySelector('.controls .selected').classList.remove('selected');

  // indicatorParents.children[sectionIndex].classList.add('selected');

  // slider.style.transform = 'translateX(-20%)';

  // slider.scrollTo({

  //     top: 0

  // })

  // document.getElementById("li3").style.display="none";

  // document.getElementById("li4").style.display="none";

  // document.getElementById("li5").style.display="none";



  let inputs = document.querySelectorAll("input");

  var room_name = document.getElementById("room_name").value;

  var wall_surface = document.getElementById("room_S-Walls").value;

  var floor_surface = document.getElementById("room_S-Floor").value;

  var ceiling_surface = document.getElementById("room_S-ceiling").value;

  var windows_surface = document.getElementById("room_S-Windows").value;

  var doors_surface = document.getElementById("room_S-Doors").value;

  var tempout = document.getElementById("room_Temp-out").value;

  var tempin = document.getElementById("room_Temp-in").value;

  var Podloga = document.getElementById("Podloga").value;

  var IznadSobe = document.getElementById("Iznadsobe").value;

  var Ventila = document.getElementById("Ventilacija").value;

  //var obj1 = document.getElementById('radt');

  //var obj2 = document.getElementById('radt2');



  var vons = $("input[name='von[]']")

    .map(function () {

      return $(this).val();

    })

    .get();

  var durchgefuhrte_arbeitens = [];

  $("select[name='durchgefuhrte_arbeiten[]']").each(function () {

    var val = $(this).val();

    if (val !== "") durchgefuhrte_arbeitens.push(val);

  });



  var bezeichnung = $("input[name='bezeichnung[]']")

    .map(function () {

      return $(this).val();

    })

    .get();

  var mange = [];

  $("select[name='mange[]']").each(function () {

    var val = $(this).val();

    if (val !== "") mange.push(val);

  });



  var intern = $("input[name='intern[]']")

    .map(function () {

      return $(this).val();

    })

    .get();

  var offene_pukte = [];

  $("select[name='offene_pukte[]']").each(function () {

    var val = $(this).val();

    if (val !== "") offene_pukte.push(val);

  });



  var doors_u = document.getElementById("doorsu").value;

  /*var doors_t = document.getElementById('doorst').value;*/

  var windows_u = document.getElementById("windowsu").value;

  /*var windows_t = document.getElementById('windowst').value;*/



  var radiatorType1 = document.getElementById("radt").value;

  var radiatorSurface = document.getElementById("rads").value;

  var radiatorType2 = document.getElementById("radt2").value;

  /*var selection1 = document.getElementById('selection1').value;

    var tick1 = document.getElementById('tic1').value;

    var selection2 = document.getElementById('selection2').value;

    var tick2 = document.getElementById('tic2').value;

    var selection3 = document.getElementById('selection3').value;

    var tick3 = document.getElementById('tic3').value;



    var WindowL = document.getElementById('MatW2').value;

    var WindowLT = document.getElementById('MatW2Val').value;

    var DoorsL = document.getElementById('MatD2').value;

    var DoorsLT = document.getElementById('MatD2Val').value;*/



  $.getJSON("https://api.ipify.org/?format=json", function (e) {

    $.post("script2.php", {

      ip: e.ip,

      roomName: room_name,

      wallSurface: wall_surface,

      floorSurface: floor_surface,

      ceilingSurface: ceiling_surface,

      windowsSurface: windows_surface,

      doorsSurface: doors_surface,

      tempOut: tempout,

      tempIn: tempin,

      vons: vons,

      durchgefuhrteArbeitens: durchgefuhrte_arbeitens,

      bezeichnung: bezeichnung,

      mange: mange,

      offenepukte: offene_pukte,

      intern: intern,

      doorsU: doors_u,

      windowsU: windows_u,

      radiatorT1: radiatorType1,

      radiatorS1: radiatorSurface,

      radiatorT2: radiatorType2,

      Podloga: Podloga,

      IznadS: IznadSobe,

      Ventilacija: Ventila,

      /*sel1: selection1,

      sel2: selection2,

      sel3: selection3,

      tickn1: tick1,

      tickn2: tick2,

      tickn3: tick3,

      WL: WindowL,

      WLT: WindowLT,

      DL: DoorsL,

      DLT: DoorsLT*/

    }).done(() => {

      inputs.forEach((input) => (input.value = ""));

      location.reload();

    });

  });



  /* if(room_name.length > 0){

        swiperer.toggleAttribute('hidden');

    }*/



  //Podloga.selectedIndex = 0;

  //IznadSobe.selectedIndex = 0;

  //Ventila.selectedIndex = 0;

  //obj1.selectedIndex = 0;

  //obj2.selectedIndex = 0;

});



/*btn_REPORT.addEventListener('click', function() {



    

        //document.querySelector('.controls .selected').classList.remove('selected');

       // indicatorParents.children[sectionIndex].classList.add('selected');

       //  slider.style.transform = 'translateX(-40%)';

       // slider.scrollTo({

       //     top: 0

       //  })

       //  document.getElementById("li3").style.display="inline";

       $.getJSON("https://api.ipify.org/?format=json", function(e) {

        



       $.post("Report.php",

       {

           ip: e.ip

       

       },

       function(data,status){

           console.log("Data: " + data + "\nStatus: " + status);

           inputs.forEach(input => input.value='');

           

         });

     });



}); */



/* $.post("script2.php",

   {

        roomName: room_name,

        wallSurface: wall_surface,

        floorSurface: floor_surface,

        ceilingSurface: ceiling_surface,

        windowsSurface: windows_surface,

        doorsSurface: doors_surface,

        tempOut: tempout,

        tempIn: tempin

    },

    (function(data,status){

        console.log("Data: " + data + "\nStatus: " + status);

        inputs.forEach(input => input.value='');

      })

    



        );

    

    ;

    

}));*/



function show1() {

  var x = document.getElementById("rad1");

  var y = document.getElementById("rad2");

  var radio1 = document.getElementById("radio1");

  var radio2 = document.getElementById("radio2");



  if (x.style.display === "inline") {

    x.style.display = "none";

    x.style.opacity = "0";

    radio1.style.backgroundColor = "none";

  } else {

    x.style.display = "inline";

    x.style.opacity = "100%";

    radio1.style.backgroundColor = "#1BAE70";

    radio2.style.backgroundColor = "unset";

  }

  if (y.style.display === "inline") {

    y.style.display = "none";

  } else {

    y.style.display = "none";

  }

}



function show2() {

  var x = document.getElementById("rad2");

  var y = document.getElementById("rad1");



  var radio1 = document.getElementById("radio1");

  var radio2 = document.getElementById("radio2");



  if (x.style.display === "inline") {

    x.style.display = "none";

  } else {

    x.style.display = "inline";

    radio2.style.backgroundColor = "#1BAE70";

    radio1.style.backgroundColor = "unset";

  }

  if (y.style.display === "inline") {

    y.style.display = "none";

  } else {

    y.style.display = "none";

  }

}



function show3() {

  var y = document.getElementById("rad2");

  var z = document.getElementById("rad1");

  let inp1 = document.getElementById("Mat22");

  let inp2 = document.getElementById("Mat23");

  let inp3 = document.getElementById("Mat12");

  let inp4 = document.getElementById("Mat13");



  var radio1 = document.getElementById("radio1");

  var radio2 = document.getElementById("radio2");



  radio1.style.backgroundColor = "unset";

  radio2.style.backgroundColor = "unset";



  if (y.style.display === "inline") {

    y.style.display = "none";

  } else {

    y.style.display = "none";

  }

  if (z.style.display === "inline") {

    z.style.display = "none";

  } else {

    z.style.display = "none";

  }



  inp1 = "";

  inp2 = "";

  inp3.forEach((Mat12) => (Mat12.value = ""));

  inp4.forEach((Mat13) => (Mat13.value = ""));

}



function clear() {

  let inp1 = document.getElementById("Mat22");

  let inp2 = document.getElementById("Mat23");

  let inp3 = document.getElementById("Mat12");

  let inp4 = document.getElementById("Mat13");



  inp1.forEach((Mat22) => (Mat22.value = ""));

  inp2.forEach((Mat23) => (Mat23.value = ""));

  inp3.forEach((Mat12) => (Mat12.value = ""));

  inp4.forEach((Mat13) => (Mat13.value = ""));

}

