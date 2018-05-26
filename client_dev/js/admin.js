import "../css/admin.css"



let $ = require('jquery')
let form = document.getElementById('form')




//Logica para login Administrador
let formLogin = (e)  => {
	e.preventDefault()
	let formData  = new FormData(this)
	formRequestAjax(formData)
}



let formRequestAjax  = (data) => {
	$.ajax({
		type:'POST',
		url:'login'
	})
	.done((msg) => {
		console.log(msg)
	})
	.catch((e) => {
		console.error(e.message)
	})
}


/*

   $.ajax({
            method:'POST',
            url:'php/notificaciones.php'
          })
          .done(function(msg){
              var data = JSON.parse(msg);
              //console.log(data);
              
               template(data);

              /*if(document.body.contains(count)){
                 boton.removeChild(count);
              }
          })
*/





form.addEventListener('submit',formLogin)







