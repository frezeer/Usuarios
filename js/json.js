var nombre = "sergio";
var edad = 20;
var pais = "cuba";

var nombre2 = "carlos";
var edad2 = 30;
var pais2 = "Mexico";

console.log(nombre);


/*Ejemplo de objetos*/

var carlos = {
	"nombre": "Carlos",
	"Edad":  20,
	"pais": "Mexico"
}

console.log(carlos.nombre);

var alejandro = {
	"nombre": "alejandro",
	"Edad":  20, 
	"pais": "Cuba"
}

console.log(alejandro.nombre);
console.log(alejandro.pais);


/*Ejemplo de arreglos*/

var nombreamigos = ["pedro","carlos","juan","sergio","david","ivan"];

console.log(nombreamigos[0]);
console.log(nombreamigos[1]);
console.log(nombreamigos[2]);
console.log(nombreamigos[3]);



/*Ejemplo de json*/
var amigos = [ {
	"nombre": "alejandro",
	"edad":   23,
	"pais":   "Colombia"
},
{
	"nombre": "paco",
	"edad":   25,
	"pais":   "Ecuador"
} ]



console.log(amigos[0]);

console.log(amigos[0].pais);
console.log(amigos[0].nombre);
console.log(amigos[0].edad);


console.log(amigos[1]);

console.log();