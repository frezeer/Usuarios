var btn = document.getElementById('btn_cargar_usuarios');
var loader = document.getElementById('loader');

btn.addEventListener('click',function()
{
	var peticion = new XMLHttpRequest();

	peticion.open('GET','php/leer-datos.php');
	//peticion.open('GET', 'http://www.json-generator.com/api/json/get/cuauxHEEQy?indent=2');

			loader.classList.add('active'); //cnos muestra  la bolita para saber que esta descargando los datos
	
	peticion.onload = function(){
		//console.log(peticion.responseText);
		//console.log(JSON.parse(peticion.responseText));
		//console.log(JSON.parse(peticion.responseText)[0]);
		//console.log(JSON.parse(peticion.responseText)[0].nombre);
		var datos = JSON.parse(peticion.responseText);

		//for(var i=0; i < 5; i++)
			for(var i=0; i < datos.length; i++)
		{ 
			var elemento = document.createElement('tr');
				elemento.innerHTML += ("<td>"+ datos[i].id +"</td>");
				elemento.innerHTML += ("<td>"+ datos[i].nombre + "</td>");
				elemento.innerHTML += ("<td>"+ datos[i].edad + "</td>");
				elemento.innerHTML += ("<td>"+ datos[i].pais+ "</td>");
				elemento.innerHTML += ("<td>"+ datos[i].correo + "</td>");
				document.getElementById('tabla').appendChild(elemento);
		}		

	// datos.forEach(personas =>
	// 	{
	// 			var elemento = document.createElement('tr');
	// 			elemento.innerHTML += ("<td>"+ personas.id + "</td>");
	// 			elemento.innerHTML += ("<td>"+ personas.nombre + "</td>");
	// 			elemento.innerHTML += ("<td>"+ personas.edad + "</td>");
	// 			elemento.innerHTML += ("<td>"+ personas.pais + "</td>");
	// 			elemento.innerHTML += ("<td>"+ personas.email + "</td>");
	// 			document.getElementById('tabla').appendChild(elemento);
	// 	});



	}		
	peticion.onreadystatechange = function(){	
		if(peticion.readyState == 4 && peticion.status == 200){
			console.log(peticion.readyState);
			console.log(peticion.status);
			//alert("Evento Cargado");
				loader.classList.remove('active'); //remueve la bolita
		}
	}
			peticion.send(); //Envia la peticion;
	});