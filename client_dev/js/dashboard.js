import "../css/iconos.css"
import "../css/dashboard.css"
import validate  from  "./validation.js"


let $ = require('jquery')
let formRegister = document.getElementById("formRegister")
let btnRegister = document.getElementById("register_submit")



let formRegisterTeacher = (e) => {
    e.preventDefault()
    let inputs = document.fregister.elements;
    validate(inputs)
    let dataRegister = [];

    for(let i=0;i<inputs.length;i++){
    	 if(inputs[i].type != "submit"){
            dataRegister.push(inputs[i].value)
    	 }
    }
    formRegisterRequestAjax(dataRegister)
}


let formRegisterRequestAjax = (dataRegister) => {
	 	$.ajax({
		type: "POST",
		url: "http://localhost:8080/contratos/public/dashboard",
		data:{dataRegister:dataRegister}
	})
	.done((rpt) => {
		changeTextBtn(rpt)
	})
	.catch((e) => {
		console.error(e.message)
	})
}



let changeTextBtn = (bandera) => {
	  if(bandera == "correcto"){
          	  let p = document.createElement('p')
          	  p.textContent = "Docente Registrado"
          	  p.style.color = "#2A355A"
          	  p.style.textAlign = 'justify'
          	  p.style.fontWeight = 'bold'
              btnRegister.replaceWith(p)     
          }

          setTimeout(() => {
              location.reload()
          },1500)
	  }





formRegister.addEventListener("submit",formRegisterTeacher)







