import "../css/iconos.css"
import "../css/admin.css"



let $ = require('jquery')
let form = document.getElementById('formAdmin') 
let icon_admin =  document.getElementById('icon_admin')
let icon_password = document.getElementById('icon_clave')


//Logica para login Administrador
let formLogin = (e)  => {
	e.preventDefault()  
	let admin  = form.administrador.value
	let clave = form.clave.value
	formRequestAjax(admin,clave)
}



let formRequestAjax  = (...data) => {
	$.ajax({
		type: "POST",
		url: "http://localhost:80/contratos/public/",
		data:{admin:data[0],clave:data[1]}
	})
	.done((clase) => {
		     if(clase[2]){
                removeStyles('fa-times','cross')    
		        icon_admin.classList.add(clase[0],clase[1])
		        icon_password.classList.add(clase[0],clase[1])
		        redirectionDashboard()
		     }else{
		     	removeStyles('fa-check','check')
		     	icon_admin.classList.add(clase[0],clase[1])
		     	icon_password.classList.add(clase[0],clase[1])
		     }
		    
	})
	.catch((e) => {
		console.error(e.message)
	})
}



let removeStyles  = (clase1,clase2) => {
   icon_admin.classList.remove(clase1,clase2) 
   icon_password.classList.remove(clase1,clase2)
}



let redirectionDashboard = () => {
	setTimeout(() => {
	   document.location.href = location.href + "dashboard"
	},600)
}



form.addEventListener('submit',formLogin)







