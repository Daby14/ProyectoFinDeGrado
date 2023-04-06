console.log("hola mundo");

let id = document.getElementById("enviar");

if(id !== null){
    
    id.addEventListener("click", function(){
        console.log("Has pulsado el botón!!!!");
    })

}