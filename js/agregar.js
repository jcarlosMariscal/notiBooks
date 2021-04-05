var formAddGenLibro = document.getElementById("formAddGenLibro");
var formAddAutorLibro = document.getElementById("formAddAutorLibro");
var formAdd = document.getElementById("formAdd");
var formMod = document.getElementById("formMod");
if(formAdd){
    var inputs = document.querySelectorAll('#formAdd input');
}else if(formMod){
    var inputs = document.querySelectorAll('#formMod input');
}


const expresiones = {
	frase: /^[a-zA-ZÀ-ÿ\s\-]{5,}$/, // Letras, numeros, guion y guion_bajo
	titulo: /^[a-zA-ZÀ-ÿ0-9\s\-\:\,\.\?\¿\¡\!\"\'\(\)]{5,}$/, // 
	nombre: /^[a-zA-ZÀ-ÿ\s]{5,50}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{6,16}$/, // 4 a 12 digitos.  
}
const campos = {
    nombre: false,
    password : false
}

const validarForm = (e) => {
    switch (e.target.name){
        case "nombre":
            validarCampo(expresiones.nombre, e.target, 'nombre');
        break;
        case "password":
            validarCampo(expresiones.password, e.target, 'password');
        break;
    }
}

const validarCampo = (expresion, input, campo) => {
    if(expresion.test(input.value)){
        document.querySelector(`#grupo-${campo} .formInputError-login`).classList.remove("formInputError-login-active");
        campos[campo] = true;
    }else{
        document.querySelector(`#grupo-${campo} .formInputError-login`).classList.add("formInputError-login-active");
        campos[campo] = false;
    }
}
inputs.forEach((input) => {
    input.addEventListener('keyup', validarForm);
    input.addEventListener('blur', validarForm);
});

if(formAddGenLibro){
    formAddGenLibro.addEventListener('submit', (e) =>{
        e.preventDefault();

        let genLibro = new FormData(formAddGenLibro);
        var ISBN = genLibro.get("ISBN");
        fetch('../agregar/datosRecibidos.php',{
            method: 'POST',
            body: genLibro
        }).then( (res) => res.text()).then( (data) => {
            console.log(data);
            if(data == "repetido"){
                alert("El genero que ha seleccionado ya se encuentra definido en el libro. Intente con otro")
            }else if(data == "insertar"){
                alert("Genero Agregado"); 
                window.location='addLibroGenero.php?ISBN='+ISBN; 
            }
        });
    });
}else if(formAddAutorLibro){
    formAddAutorLibro.addEventListener('submit', (e) =>{
        e.preventDefault();
        let autorLibro = new FormData(formAddAutorLibro);
        var ISBN = autorLibro.get("ISBN");
        fetch('../agregar/datosRecibidos.php',{
            method: 'POST',
            body: autorLibro
        }).then( (res) => res.text()).then( (data) => {
            console.log(data);
            if(data == "repetido"){
                alert("El autor que ha seleccionado ya se encuentra definido en el libro. Intente con otro")
            }else if(data == "insertar"){
                alert("Autor agregado")
                window.location='addLibroAutor.php?ISBN='+ISBN; 
            }
        });
    });
}else if(formAdd){
    formAdd.addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData(formAdd);
        if(campos.nombre && campos.password){
            fetch('../admin/agregar/datosRecibidos.php',{
                method: 'POST',
                body: data
            }).then( (res) => res.text()).then( (data) => {
                console.log(data);
                if(data == "repetido"){
                    alert("Ya existe un usuario con el mismo nombre");
                    window.location="main.php?id=7"
                }else if(data == "insertar"){
                    alert("Autor agregado");
                    window.location="main.php?id=7"
                }else if(data == "nuevo"){
                    // alert("nuevo");
                    window.location="../admin.php"
                }
            });
        }else{
            document.getElementById('formulario-mensaje').classList.add('formMensajeLogin-active');
        }
    });
}else if(formMod){
    formMod.addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData(formMod);
        if(campos.nombre){
            fetch('../../admin/modificar/datosRecibidos.php',{
                method: 'POST',
                body: data
            }).then( (res) => res.text()).then( (data) => {
                console.log(data);
                if(data == "repetido"){
                    alert("Ya existe un usuario con el mismo nombre");
                    window.location="../main.php?id=7"
                }else if(data == "noCambio"){
                    // alert("Autor agregado");
                    window.location="../main.php?id=7" 
                }else if(data == "insertar"){
                    console.log("Usuario modificado");
                    window.location="../main.php?id=7" 
                }
            });
        }else{
            document.getElementById('formulario-mensaje').classList.add('formMensajeLogin-active');
        }
    });
}





