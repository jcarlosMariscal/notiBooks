var toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],
  
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    [{ 'direction': 'rtl' }],                         // text direction
  
    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    [ 'link', 'image', 'formula' ],          // add's image support
  
    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    [{ 'font': [] }],
    [{ 'align': [] }],
  
    ['clean']                                         // remove formatting button
  ];

const one = document.getElementById("formAddOne");
const more = document.getElementById("formAdd");
const inputFile = document.querySelector("#imagen");
if(one){
    var formularioOne = document.getElementById('formAddOne');
    var inputs = document.querySelectorAll('#formAddOne input');
}else if(more){
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
          },
          theme: 'snow'
        
    });

    var formulario = document.getElementById("formAdd");
    var inputs = document.querySelectorAll('#formAdd input');

    var id = document.querySelector("#editor");
}

const expresiones = {
	frase: /^[a-zA-ZÀ-ÿ\s\-]{5,}$/, // Letras, numeros, guion y guion_bajo
	titulo: /^[a-zA-ZÀ-ÿ0-9\s\-\:\,\.\?\¿\¡\!\"\'\(\)]{5,}$/, // 
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,50}$/, // Letras y espacios, pueden llevar acentos.
	// password: /^.{4,12}$/, // 4 a 12 digitos.
	// correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	// telefono: /^\d{7,14}$/, // 7 a 14 numeros.
    // archivo : /(.jpg|.jpeg|.png|.gif)$/i,
    ISBN: /^[a-zA-Z0-9\-]{11,13}$/,
    contenido : /^<([a-z]+)([^<]+)*(?:>([^{}\\]*)<\/\1>|\s+\/>)$/,
    fecha: /^(\d{4}\-\d{2}\-\d{2})|(\d{4}\/\d{2}\/\d{2})$/,        
    url: /^https?:\/\/[\w\-]+(\.[\w\-]+)+[\#?]?.*$/        
}
const campos = {
    categoria : false,
    titulo: false,
    entrada: false,
    imagen: false,
    fecha: false,
    url:false,
    nombre: false,
    profesion: false,
    fecha_nac : false,
    fecha_fal : false,
    obras: false,
    editorial: false,
    genero: false
}
const validarForm = (e) => {
    switch (e.target.name){
        case "categoria":
            validarCampo(expresiones.frase, e.target, 'categoria');
        break;
        case "titulo":
            validarCampo(expresiones.titulo, e.target, 'titulo');
        break;
        case "entrada":
            validarCampo(expresiones.titulo, e.target, 'entrada');
        break;
        case "imagen":
            var filename = inputFile.files[0].name;
            var exten = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename)[0] : undefined;
            if(exten == "png" || exten == "PNG" || exten == "jpeg" || exten == "jpg" || exten == "gif"){
                document.getElementById(`grupo-imagen`).classList.remove("formOne-incorrecto");
                document.querySelector(`#grupo-imagen .formInputError`).classList.remove("formInputError-active");
                document.getElementById(`grupo-imagen`).classList.add("formOne-correcto");
                document.getElementById('inputFile').innerHTML = null;
                document.querySelector(`#grupo-imagen .formInputStatic`).classList.add("formInputStatic");
                document.getElementById('inputFile').innerHTML = "Se ha seleccionado nueva imagen";
                campos['imagen'] = true;
            }else{
                document.getElementById(`grupo-imagen`).classList.remove("formOne-correcto");

                document.getElementById(`grupo-imagen`).classList.add("formOne-incorrecto");
                document.querySelector(`#grupo-imagen .formInputError`).classList.add("formInputError-active");
                document.getElementById('inputFile').innerHTML = "La extension " + exten + " no está permitido. Seleccione una imagen.";
                campos['imagen'] = false;
            }
        break;
        case "ISBN":
            validarCampo(expresiones.ISBN, e.target, 'ISBN');
        break;
        case "fecha":
            validarCampo(expresiones.fecha, e.target, 'fecha');
        break;
        case "url":
            validarCampo(expresiones.url, e.target, 'url');
        break;
        case "nombre":
            validarCampo(expresiones.nombre, e.target, 'nombre');
        break;
        case "profesion":
            validarCampo(expresiones.nombre, e.target, 'profesion');
        break;
        case "fecha_nac":
            validarCampo(expresiones.fecha, e.target, 'fecha_nac');
        break;
        case "fecha_fal":
            validarCampo(expresiones.fecha, e.target, 'fecha_fal');
        break;
        case "obras":
            validarCampo(expresiones.titulo, e.target, 'obras');
        break;
        case "editorial":
            validarCampo(expresiones.frase, e.target, 'editorial');
        break;
        case "genero":
            validarCampo(expresiones.frase, e.target, 'genero');
        break;
    }
}

const validarCampo = (expresion, input, campo) => {
    if(expresion.test(input.value)){
        document.getElementById(`grupo-${campo}`).classList.remove("formOne-incorrecto");
        document.getElementById(`grupo-${campo}`).classList.add("formOne-correcto");
        document.querySelector(`#grupo-${campo} .formInputError`).classList.remove("formInputError-active");
        campos[campo] = true;
    }else{
        document.getElementById(`grupo-${campo}`).classList.add("formOne-incorrecto");
        document.querySelector(`#grupo-${campo} .formInputError`).classList.add("formInputError-active");
        campos[campo] = false;
    }
}
inputs.forEach((input) => {
    input.addEventListener('keyup', validarForm);
    input.addEventListener('blur', validarForm);
});

if(one){
    formularioOne.addEventListener('submit', (e) => {
        e.preventDefault();

        let formOne = new FormData(formularioOne);
        if(formOne.get("tabla") == "categoria"){
            var data = campos.categoria;
        }else if(formOne.get("tabla") == "editorial"){
            var data = campos.editorial;
        }else if(formOne.get("tabla") == "genero"){
            var data = campos.genero;
        }
        if(data){
            document.getElementById('formulario-mensaje').classList.remove('formOneMensaje-active');
            fetch("../modificar/datosRecibidos.php",{
                method: 'POST',
                body: formOne
            }).then( (res) => res.text()).then( (data) => {
                console.log(data);

                if(data == "repetido"){
                    alert("Hay un registro con el mismo nombre/titulo en la base de datos. Por favor modifiquelo.");

                }else if(data == "insertarCategoria"){
                    alert("Categoria Modificada"); 
                    window.location='../main.php?id=2'; 
                }else if(data == "noCambioCategoria"){
                    window.location.href="../main.php?id=2";

                }else if(data == "insertarEditorial"){
                    alert("Editorial Modificada"); 
                    window.location='../main.php?id=4'; 
                }else if(data == "noCambioEditorial"){
                    window.location="../main.php?id=4";

                }else if(data == "insertarGenero"){
                    alert("Genero Modificado"); 
                    window.location='../main.php?id=4'; 
                }else if(data == "noCambioGenero"){
                    window.location='../main.php?id=4'; 
                }
            });
        }else{
            document.getElementById('formulario-mensaje').classList.add('formOneMensaje-active');
        }
    });
}else if(more){
    formulario.addEventListener('submit',(e) => {
        e.preventDefault();
        let form = new FormData(formulario);
        document.getElementById("cuerpo").value = quill.container.firstChild.innerHTML;
        var textCuerpo = document.getElementById("cuerpo").value;
        form.append("archivo", inputFile.files[0]);

        form.append("cuerpo", textCuerpo);
        if(textCuerpo === "<p><br></p>" || textCuerpo == "<p><br></p><p><br></p>" || textCuerpo == "<p><br></p><p><br></p><p><br></p>"){
            document.getElementById(`grupo-editor`).classList.add("formOne-incorrecto");
            document.querySelector(`#grupo-editor .formInputError`).classList.add("formInputError-active");
            var cuerpo = false;
        }else{
            var cuerpo = true;
        }
        if(form.get("tabla") == "noticia"){
            var dato1 = campos.titulo;
            var dato2 = campos.entrada;
            if(form.get("archivo") === "undefined"){
                var dato3 = true;
            }else{
                var dato3 = campos.imagen;
            }
            var dato4 = true;
            var dato5 = true;
            var dato6 = true;
        }else if(form.get("tabla") == "libro"){
            var dato1 = true;
            var dato2 = campos.titulo;
            if(form.get("archivo") === "undefined"){
                var dato3 = true;
            }else{
                var dato3 = campos.imagen;
            }
            var dato4 = campos.fecha;
            var dato5 = campos.url;
            var dato6 = true;
            var ISBN = form.get("ISBN");
        }else if(form.get("tabla") == "autor"){
            var dato1 = campos.nombre;
            var dato2 = campos.profesion;
            var dato3 = campos.fecha_nac;
            var dato4 = campos.fecha_fal;
            var dato5 = campos.obras;
            if(form.get("archivo") === "undefined"){
                var dato6 = true;
            }else{
                var dato6 = campos.imagen;
            }
        }
        console.log("Archivo es: ");
        console.log(form.get("archivo"));
        if(dato1 && dato2 && dato3 && dato4 && dato5 && dato6 && cuerpo){
            fetch('../modificar/datosRecibidos.php',{
                method: 'POST',
                body: form
            }).then( (res) => res.text()).then( (data) => {
                console.log(data);
                if(data == "repetido"){
                    alert("Se encontró un registro con el mismo titulo/ISBN/nombre en la base de datos, por favor modifiquelo");
                    console.log("repetido");

                }else if(data == "insertarNoticia"){
                    alert("Noticia Modificada"); 
                    window.location='../main.php'; 
                }else if(data == "noCambioNoticia"){
                    window.location="../main.php";

                }else if(data == "insertarLibro"){
                    alert("El libro ha sido modificado");
                    window.location="../main.php?id=3";
                }else if(data == "noCambioLibro"){
                    window.location="../main.php?id=3";

                }else if(data == "insertarAutor"){
                    alert("Autor Modificado"); 
                    window.location='../main.php?id=6'; 
                }else if(data == "noCambioAutor"){
                    window.location='../main.php?id=6'; 
                }
            });
        }else{
            document.getElementById('formulario-mensaje').classList.add('formOneMensaje-active');
        }
    });
}