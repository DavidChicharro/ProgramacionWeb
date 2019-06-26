var nombre = false;
var apellidos = false;
var email = false;
var pass = false;
var fecha = false;
var isbn = false;
var titulo = false;
var autor = false;
var anio = false;
var editorial = false;
var edicion = false;
var descripcion = false;
var opinion = false;
var nota = false;

let check = function() {
	let password = document.getElementById('password');
	let confirm = document.getElementById('passRepetir');

	if (password.value == confirm.value){
		password.style.borderColor = 'lightgreen';
		confirm.style.borderColor = 'lightgreen';

		return true;
	} else {
		password.style.borderColor = 'red';
		confirm.style.borderColor = 'red';

		return false;
	}
}


let checkPass = function() {
	let passAct = document.getElementById("passActual");

	let passNueva = document.getElementById("password");
	let passRepet = document.getElementById("passRepet");

	let cmp = -1;
	if (passNueva.value.length != 0 && passRepet.value.length != 0)
		cmp = (passNueva.value).localeCompare(passRepet.value);

	let distintas = (passAct.value).localeCompare(passNueva.value);

	if(cmp==0 && passAct.value.length != 0 && distintas!=0){
		return true;
	}
	else{
		return false;
	}
}

function createAlertMessage(el,msg){
	if(!document.getElementById("alert-"+el)){
		let div = document.getElementById(el);
		let p = document.createElement('p');
		let node = document.createTextNode(msg);
		p.appendChild(node);
	  	p.style.color = "red";
	  	p.style.margin = "0 0 0 3%";
	  	p.setAttribute("id", "alert-"+el+"");
	    div.parentNode.insertBefore( p, div.nextSibling );
	}
}

function deleteAlert(el){
	let element = document.getElementById("alert-"+el);
	if(element)
		element.remove();
}

function createAlertIcon(el){
	let div = document.getElementById(el);
	let img = document.createElement('img');
	img.setAttribute("src", "imagenes/alert.png");
  	img.setAttribute("width", "25");
  	img.setAttribute("height", "25");
  	img.setAttribute("alt", "!");
  	img.setAttribute("class", "alert-icon");
    div.parentNode.insertBefore( img, div.nextSibling );
}

function formElemValidation(elem){
	let el = document.forms["formAltaUsuario"][elem].value;
	if (el == ""){
		let msg = 'El campo '+elem+' no puede estar vacío';
		createAlertMessage(elem,msg);
		return false;
	}
	else
		deleteAlert(elem);
	return true;
}

function emailValidation(form){
	let reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	let email = document.forms[form]["email"].value;

	if (!reg.test(String(email).toLowerCase())){
		let msg = 'El campo email debe contener una expresión válida';
		createAlertMessage('email',msg);
		return false;
	}
	else
		deleteAlert('email');

	return true;
}

function passValidation(form){
	let reg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;
	let pass = document.forms[form]["password"].value;

	if (!reg.test(String(pass))){
		let msg = 'La contraseña debe tener entre 8 y 20 caracteres y, al menos, una mayúscula, una minúscula, un número y un caracter especial.';
		createAlertMessage('password',msg);							
		return false;
	}
	else
		deleteAlert('password');

	return true;
}

function fechValidation(){
	let reg = /^(19[0-99]|[2][0][0-1])\d{1}[\/\-]([1-2]\d|[0|9]\d)[\/\-](0?[1-9]|[12][0-9]|3[01])$/;
	let fech = document.forms["formAltaUsuario"]["fecha_nac"].value;

	if (!reg.test(String(fech))){
		let msg = 'La fecha debe estar comprendida entre 1903 y 2019';
		createAlertMessage('fNacimiento',msg);							
		return false;
	}
	else
		deleteAlert('fNacimiento');

	return true;
}

function formValidation(form){
	nombre = formElemValidation('nombre');
	apellidos = formElemValidation('apellidos');
	email = emailValidation(form.name);
	pass = check() && passValidation(form.name);
	fecha = fechValidation();

	if(nombre && apellidos && email && pass && fecha){
		document.getElementById("btnCrearCuenta").disabled = false;
		document.getElementById("btnCrearCuenta").classList.remove('btn-disabled');
	}
	else{
		document.getElementById("btnCrearCuenta").disabled = true;
		document.getElementById("btnCrearCuenta").classList.add('btn-disabled');
	}
}


function formLoginValidation(form){
	email = emailValidation(form.name);
	pass = passValidation(form.name);

	if(email && pass){
		document.getElementById("botonEnviar").disabled = false;
		document.getElementById("botonEnviar").classList.remove('btn-disabled');
	}
	else{
		document.getElementById("botonEnviar").disabled = true;
		document.getElementById("botonEnviar").classList.add('btn-disabled');
	}
}

function isbnValidation(form){
	let reg = /^(\d{13})$/;
	let isbn = document.forms[form]["isbn"].value;

	if (!reg.test(isbn)){
		let msg = 'El ISBN debe ser una cadena de 13 dígitos';
		createAlertMessage('isbn',msg);
		return false;
	}
	else
		deleteAlert('isbn');

	return true;
}

function formAltaValidation(form, elem, tam){
	let el = document.forms[form][elem].value;
	if (el == ""){
		let msg = 'El campo '+elem+' no puede estar vacío';
		createAlertMessage(elem,msg);
		return false;
	}else if(el.length > tam){
		let msg = 'El campo '+elem+' no tener más de '+tam+' caracteres';
		createAlertMessage(elem,msg);
		return false;
	}
	else
		deleteAlert(elem);
	return true;
}

function formListValidation(form, elem, forbid){
	let el = document.forms[form][elem].value;
	if (el == ""){
		let msg = 'El campo '+elem+' no puede estar vacío';
		createAlertMessage(elem,msg);
		return false;
	}else if(el == forbid){
		let msg = 'El campo '+elem+' no puede ser '+forbid;
		createAlertMessage(elem,msg);
		return false;
	}
	else
		deleteAlert(elem);
	return true;
}

function numValidation(form, elem, min, max){
	let el = document.forms[form][elem].value;
	if(el < min || el > max){
		let msg = 'El campo '+elem+' debe comprender entre '+min+' y '+max;
		createAlertMessage(elem,msg);
		return false;
	}
	else
		deleteAlert(elem);
	return true;
}

function radioValidation(form){
	nota=true;
	formName = form.parentNode.parentNode.parentNode;
	formAltaLibroValidation(formName);
}

function formAltaLibroValidation(form){
	isbn = isbnValidation(form.name);
	titulo = formAltaValidation(form.name,'titulo',80);
	autor = formAltaValidation(form.name,'autor',80);
	editorial = formListValidation(form.name,'editorial','Editorial');
	anio = numValidation(form.name,'anio',1000,2019);
	edicion = numValidation(form.name,'edicion',1,250);
	descripcion = formAltaValidation(form.name,'descripcion',800);
	opinion = formAltaValidation(form.name,'opinion',500);

	if(isbn && titulo && autor && anio && editorial && edicion && descripcion && opinion && nota){
		document.getElementById("enviar").disabled = false;
		document.getElementById("enviar").classList.remove('btn-disabled');
	}
	else{
		document.getElementById("enviar").disabled = true;
		document.getElementById("enviar").classList.add('btn-disabled');
	}
}


function radioLeidoValidation(form){
	nota=true;
	formName = form.parentNode.parentNode.parentNode;
	formModifOpinValidation(formName);
}

function formModifOpinValidation(form){
	let opin = formAltaValidation(form.name,'opinion',500);
	opinion = opin;

	if(opinion || nota){
		document.getElementById("btnEnviar").disabled = false;
		document.getElementById("btnEnviar").classList.remove('btn-disabled');
	}
	else{
		document.getElementById("btnEnviar").disabled = true;
		document.getElementById("btnEnviar").classList.add('btn-disabled');
	}
}

function radioValorarValidation(form){
	nota=true;
	formName = form.parentNode.parentNode.parentNode;
	formValorarValidation(formName);
}

function formValorarValidation(form){
	let opin = formAltaValidation(form.name,'opinion',500);
	opinion = opin;

	if(opinion && nota){
		document.getElementById("btnEnviar").disabled = false;
		document.getElementById("btnEnviar").classList.remove('btn-disabled');
	}
	else{
		document.getElementById("btnEnviar").disabled = true;
		document.getElementById("btnEnviar").classList.add('btn-disabled');
	}
}

function formDataValidation(form, elem){
	let el = document.forms[form][elem].value;
	if (el == ""){
		let msg = 'El campo '+elem+' no puede estar vacío';
		createAlertMessage(elem,msg);
		return false;
	}
	else
		deleteAlert(elem);
	return true;
}

function fechaValidation(form,elem){
	let reg = /^(19[0-99]|[2][0][0-1])\d{1}[\/\-]([1-2]\d|[0|9]\d)[\/\-](0?[1-9]|[12][0-9]|3[01])$/;
	let fech = document.forms[form][elem].value;

	if (!reg.test(String(fech))){
		let msg = 'La fecha debe estar comprendida entre 1903 y 2019';
		createAlertMessage('fNacimiento',msg);							
		return false;
	}
	else
		deleteAlert('fNacimiento');

	return true;
}

function formDatosPersonalesValidation(form){
	nombre = formDataValidation(form.name,'nombre');
	apellidos = formDataValidation(form.name,'apellidos');
	email = emailValidation(form.name);
	fecha = fechaValidation(form.name,'fecha_nac');

	if(nombre || apellidos || email || fecha){
		document.getElementById("btnGuardarCambios").disabled = false;
		document.getElementById("btnGuardarCambios").classList.remove('btn-disabled');
	}
	else{
		document.getElementById("btnGuardarCambios").disabled = true;
		document.getElementById("btnGuardarCambios").classList.add('btn-disabled');
	}
}

function formPassValidation(form){
	pass = checkPass() && passValidation(form.name);

	if(pass){
		document.getElementById("btnCambiarPass").disabled = false;
		document.getElementById("btnCambiarPass").classList.remove('btn-disabled');
	}
	else{
		document.getElementById("btnCambiarPass").disabled = true;
		document.getElementById("btnCambiarPass").classList.add('btn-disabled');
	}
}