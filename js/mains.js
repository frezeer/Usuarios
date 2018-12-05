var btn_cargar = document.getElementById('btn_cargar_usuarios');
	error_box = document.getElementById('error_box');
	tabla = document.getElementById('tabla');
	loader = document.getElementById('loader');

	var usuario_nombre,
	    usuario_edad,
	    usuario_pais,
		usuario_correo; 
		
	  function cargarUsuarios()
	 {
	    		tabla.innerhtml = '<tr><th>ID</th><th>Nombre</th><th>Edad</th><th>Pais</th><th>Correo</th></tr>';
	    		var peticion = new XMLHttpRequest();
	    		peticion.open('GET', 'php/leer-datos.php');
	    		loader.classList.add('active');
	    		peticion.onload = function()
	    		{
	    			//console.log(peticion.responseText);
	    			var basedatos = JSON.parse(peticion.responseText);
	    			//var datos = JSON.parse(peticion.responseText);
	    			//console.log(basedatos);
	    			if(basedatos.error){
	    					error_box.classList.add('active');
	    				}
	    				else
	    				{
	    				for(i=0; i < basedatos.length; i++){

	    					var elemento = document.createElement('tr');
							elemento.innerHTML += ("<td>"+ basedatos[i].id +"</td>");
							elemento.innerHTML += ("<td>"+ basedatos[i].nombre + "</td>");
							elemento.innerHTML += ("<td>"+ basedatos[i].edad + "</td>");
							elemento.innerHTML += ("<td>"+ basedatos[i].pais+ "</td>");
							elemento.innerHTML += ("<td>"+ basedatos[i].correo + "</td>");
							document.getElementById('tabla').appendChild(elemento);
							
	    				}	
	    			}
	    		}
	    		peticion.onreadystatechange = function(){
	    			if(peticion.readyState == 4 && peticion.status == 200){
	    				loader.classList.remove('active');
	    			}
	    		}
	    	peticion.send();	
	    }
	
	  function agregarUsuarios(e)
	 {
			e.preventDefault();
			var peticion = new XMLHttpRequest();
			peticion.open('POST','php/guardar-datos.php');
		    
		    usuario_nombre = formulario.nombre.value.trim();
		    usuario_edad =   parseInt(formulario.edad.value.trim());
		    usuario_pais =   formulario.pais.value.trim();
		    usuario_correo = formulario.correo.value.trim();

		    if(formulario_valido()){
		    	console.log('ok');
		   		 error_box.classList.remove('active');
		   		 //var parametros = 'nombre=Carlos&edad=23&pais=Meexico&correo=sist@century21tamayo.com';
				 //var parametros = 'nombre='+ usuario_nombre +'&edad='+ usuario_edad +'&pais='+ usuario_pais +'&correo='+ usuario_correo;
		   		 var parametros = 'nombre='+ usuario_nombre +'&edad='+ usuario_edad + '&pais=' + usuario_pais + '&correo=' + usuario_correo;
		   		 console.log(parametros);

		   		 peticion.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded");

		   		 loader.classList.add('active');

		   		 peticion.onload = function(){
		   		 		cargarUsuarios();
		   		 		formulario.nombre.value='';
		   		 		formulario.edad.value='';
		   		 		formulario.pais.value='';
		   		 		formulario.correo.value='';
		   		 }

		   		 peticion.onreadystatechange = function(){
		   		 	if(peticion.readyState == 4 && peticion.status == 200){
		   		 		loader.classList.remove('active');
		   		 	}
		   		 }

		   		 peticion.send(parametros);

		    }else{
		    	error_box.classList.add('active');
		    	error_box.innerhtml = "Completa el formulario correctamente";
		    }

	 }
	
	  btn_cargar.addEventListener('click' , function(){
	  	cargarUsuarios();
	  });
	  
	  
	  formulario.addEventListener('submit', function(e){
		agregarUsuarios(e);
	  });

	 function formulario_valido(){

			if(usuario_nombre == ""){
				return false;
			}else if(usuario_edad == "")
			{
				return false;
			}else if(usuario_pais == "")
			{
				return false;
			}else if(usuario_correo == "")
			{
				return false;	
			}
			return true;
	  }

