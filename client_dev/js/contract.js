import "../css/iconos.css"
import "../css/contract.css"
import $ from 'jquery'




let formTeacher = document.getElementById('formTeacher')
let formTeacherContract  = document.getElementById('saveContract')  

let dniTeacher = document.getElementById('search-dni')
let foundTitleTeacher = document.getElementById('search-foundTitle') 
let searchIconTeacher = document.getElementById('search-foundIcon')
let searchHiddenFound  = document.getElementById('search-foundHidden')


let loadContractLink  = document.getElementById('loadContractLink')





let formSearchTeacherRequest  = (e) => {
	e.preventDefault()

    $.ajax({
		type: "POST",
		url: "http://localhost:8080/contratos/public/contract/",
		data:{dni:dniTeacher.value}
	})
	.done((data) => {
	   let title  = `El Docente a Contratar es ${data[0]["nombre"].toUpperCase()}  
	                 ${data[0]["apellido"].toUpperCase()}`

	   searchIconTeacher.classList.remove('hide')         
	   foundTitleTeacher.textContent = title
	   searchHiddenFound.setAttribute("value",data[0]["id_docente"])
	   formTeacherContract.removeAttribute('disabled')
	})
	.catch((e) => {
		console.error(e)
	})
}





let formSaveContractTeacher  = (e)  => {
	 e.preventDefault()
     let dataContracts = []
     let inputs = document.fcontract.elements

     for(let i=0;i <inputs.length;i++){
          if(inputs[i].type !="submit"){
          	   if(inputs[i].type == "radio" && inputs[i].checked){
                   dataContracts.push(inputs[i].value)
          	   }else if(inputs[i].type != "radio"){
          	   	    dataContracts.push(inputs[i].value)
          	   }
          }  
     }
     formSaveContractTeacherRequestAjax(dataContracts)
} 





let formSaveContractTeacherRequestAjax = (dataContract)  => {
  $.ajax({
		type: "POST",
		url: "http://localhost:8080/contratos/public/contract/teacher",
		data:{dataContract:dataContract}
	})
	.done((data) => {
		console.log(data)
        if(data != "undefined"  && data != ""){
		 	loadContractLink.setAttribute('href',`http://localhost:8080/contratos/public/contract/generate/${data}`)
			loadContractLink.style.background = '#00C476'			 	
        }
	})     
	.catch((e) => {
		console.error(e)
	})
}	






formTeacher.addEventListener("submit",formSearchTeacherRequest)
formTeacherContract.addEventListener("click",formSaveContractTeacher)





