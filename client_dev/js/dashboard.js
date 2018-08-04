import "../css/iconos.css";
import "../css/dashboard.css";

let $ = require("jquery");
let formRegister = document.getElementById("formRegister");
let btnRegister = document.getElementById("register_submit");
let messageBirth = document.getElementById("messageBirth");
let messageDni = document.getElementById("messageDni");
let dniInput = document.getElementById("dni");

let formRegisterTeacher = e => {
  e.preventDefault();
  let inputs = document.fregister.elements;
  let dataRegister = [];

  for (let i = 0; i < inputs.length; i++) {
    if (inputs[i].type != "submit") {
      dataRegister.push(inputs[i].value);
    }
  }
  formRegisterRequestAjax(dataRegister);
};

let formRegisterRequestAjax = dataRegister => {
  $.ajax({
    type: "POST",
    url: "http://localhost:8080/contratos/public/dashboard",
    data: { dataRegister: dataRegister }
  })
    .done(rpt => {
      changeTextBtn(rpt);
    })
    .catch(e => {
      console.error(e.message);
    });
};

let changeTextBtn = rpt => {
  if (rpt[0] == 1) {
    messageBirth.textContent = " ";
    messageDni.textContent = " ";

    let p = document.createElement("p");
    p.textContent = "Docente Registrado";
    p.style.color = "#2A355A";
    p.style.textAlign = "justify";
    p.style.fontWeight = "bold";
    btnRegister.replaceWith(p);
  } else if (rpt[0] == 3) {
    messageBirth.textContent = rpt[1];
  } else if (rpt[0] == 4) {
    messageDni.textContent = rpt[1];
  }
};

let onlyNumbers = e => {
  let key = window.event ? e.which : e.keyCode;
  if (key < 48 || key > 57) {
    e.preventDefault();
  }
};

formRegister.addEventListener("submit", formRegisterTeacher);
dniInput.addEventListener("keypress", onlyNumbers);
