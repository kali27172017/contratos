import "../css/panel.css";

let $ = require("jquery");
let form = document.getElementsByTagName("form");
let formId = document.getElementById("formId");
let tabs = document.querySelectorAll(".tab");
let panels = document.querySelectorAll(".hide");
let tableFaculty = document.getElementById("tableFaculty");

let anchors = tableFaculty.querySelectorAll("a");

anchors.forEach(item => {
  item.addEventListener("click", element => {
    element.preventDefault();
    let id = item.dataset.id;
    let action = item.dataset.option;
    actionsCrud(id, action);
  });
});

//document.getElementById("tableFaculty").deleteRow(1);

let actionsCrud = (id, action) => {
  $.ajax({
    type: "GET",
    url: `http://localhost:8080/contratos/public/panel/${id}-${action}`
  })
    .done(rpt => {
      console.log(rpt);
    })
    .catch(err => {
      console.log(err.message);
    });
};

tabs.forEach(tab => {
  tab.addEventListener("click", function(e) {
    e.preventDefault();
    let element = e.srcElement.id;
    selectedTabs(element);
  });
});

let selectedTabs = tab => {
  if (tab == "tabTeacher") {
    panels[0].classList.remove("hide");
    hidePanel(panels[1], panels[2]);
  } else if (tab == "tabSchool") {
    panels[1].classList.remove("hide");
    hidePanel(panels[0], panels[2]);
  } else {
    //requestFaculty();
    panels[2].classList.remove("hide");
    hidePanel(panels[0], panels[1]);
  }
};

let hidePanel = (p1, p2) => {
  p1.classList.add("hide");
  p2.classList.add("hide");
};
