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

var formAdd = document.getElementById("formAdd");
var formAddCat = document.getElementById("formAddCat");
var formAddAutor = document.getElementById("formAddAutor");
var formAddEdi = document.getElementById("formAddEdi");
var formAddGen = document.getElementById("formAddGen");
var formAddLibro = document.getElementById("formAddLibro");
var formAddGenLibro = document.getElementById("formAddGenLibro");
var formAddAutorLibro = document.getElementById("formAddAutorLibro");

var libroAutor = document.getElementById("libroAutor");

if(formAdd){
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
          },
          theme: 'snow'
        
    });
    const inputFile = document.querySelector("#fotografia");
    formAdd.addEventListener('submit',(e) => {
        if(inputFile.files.length > 0){
            e.preventDefault();
            document.getElementById("cuerpo").value = quill.container.firstChild.innerHTML;
    
            let noticia = new FormData(formAdd);
            noticia.append("archivo", inputFile.files[0]);
            
            fetch('../agregar/datosRecibidos.php',{
                method: 'POST',
                body: noticia
            }).then( (res) => res.text()).then( (data) => {
                console.log(data);
            });
            alert("Noticia Agregada"); 
            window.location='../main.php'; 
        }else{
            alert("Selecciona un archivo");
        }
    });
}else if(formAddCat){
    formAddCat.addEventListener('submit',(e) => {
        e.preventDefault();
        let categoria = new FormData(formAddCat);

        fetch("../agregar/datosRecibidos.php",{
            method: 'POST',
            body: categoria
        }).then( (res) => res.text()).then( (data) => {
            console.log(data);
        });
        alert("Categoria Agregada"); 
        window.location='../main.php?id=2'; 
    });
}else if(formAddAutor){
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
          },
          theme: 'snow'
        
    });
    const inputFile = document.querySelector("#fotografia");
    formAddAutor.addEventListener('submit', (e) => {
        if(inputFile.files.length > 0){
            e.preventDefault();
            document.getElementById("biografia").value = quill.container.firstChild.innerHTML;
    
            let autor = new FormData(formAddAutor);
            autor.append("archivo", inputFile.files[0]);
            
            fetch('../agregar/datosRecibidos.php',{
                method: 'POST',
                body: autor
            }).then( (res) => res.text()).then( (data) => {
                console.log(data);
            });
            alert("Autor Agregado"); 
            window.location='../main.php?id=6'; 
        }else{
            alert("Selecciona un archivo");
        }
    });
}else if(formAddEdi){
    formAddEdi.addEventListener('submit', (e) =>{
        e.preventDefault();
        let editorial = new FormData(formAddEdi);

        fetch("../agregar/datosRecibidos.php",{
            method: 'POST',
            body: editorial
        }).then( (res) => res.text()).then((data) => {
            console.log(data);
        });
        alert("Editorial Agregada"); 
        window.location='../main.php?id=4'; 
    });
}else if(formAddGen){
    formAddGen.addEventListener('submit', (e) =>{
        e.preventDefault();
        let genero = new FormData(formAddGen);

        fetch("../agregar/datosRecibidos.php",{
            method: 'POST',
            body: genero
        }).then( (res) => res.text()).then( (data) => {
            console.log(data);
        });
        alert("Genero Agregado"); 
        window.location='../main.php?id=4'; 
    });
}else if(formAddLibro){
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
          },
          theme: 'snow'
        
    });
    const inputFile = document.querySelector("#portada");
    formAddLibro.addEventListener('submit', (e) => {
        if(inputFile.files.length > 0){
            e.preventDefault();
            document.getElementById("prologo").value = quill.container.firstChild.innerHTML;
    
            let autor = new FormData(formAddLibro);
            autor.append("archivo", inputFile.files[0]);
            var ISBN = autor.get("ISBN");
            fetch('../agregar/datosRecibidos.php',{
                method: 'POST',
                body: autor
            }).then( (res) => res.text()).then( (data) => {
                // console.log(data);
                window.location='addLibroGenero.php?ISBN='+ISBN; 
            });

        }else{
            alert("Selecciona un archivo");
        }
    });
}else if(formAddGenLibro){
    formAddGenLibro.addEventListener('submit', (e) =>{
        e.preventDefault();

        let genLibro = new FormData(formAddGenLibro);
        var ISBN = genLibro.get("ISBN");
        fetch('../agregar/datosRecibidos.php',{
            method: 'POST',
            body: genLibro
        }).then( (res) => res.text()).then( (data) => {
            // console.log(data);
            var add = confirm("Agregar otro genero?");
            if(add){
                window.location='addLibroGenero.php?ISBN='+ISBN; 
            }else{
                window.location='addLibroAutor.php?ISBN='+ISBN;
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
            // console.log(data);
            var add = confirm("Agregar otro Autor?");
            if(add){
                window.location='addLibroAutor.php?ISBN='+ISBN; 
            }else{
                window.location='../main.php?id=3';
            }
        });
    });
}

function deleteAutBook(ISBN,titulo){
    var autor = prompt("Eliminar un autor del libro '" + titulo + "'. Escriba el nombre del autor para eliminar","");
    if(autor == ""){
        alert("No especifico ningun autor");
    }else if(autor == undefined){

    }else{
        let name = new FormData(libroAutor);
        const table = "autBook"
        name.append("tabla", table);
        name.append("ISBN", ISBN);
        name.append("autor", autor);

        fetch("../admin/eliminar/datoRecibido.php",{
            method: 'POST',
            body: name
        }).then( (res) => res.text()).then( (data) =>{
            // console.log(data);
            alert("Eliminar el autor: " + autor);
            location.href="main.php?id=5";
        });
    }
}  
function deleteGenBook(ISBN,titulo){
    var genero = prompt("Eliminar un genero del libro '" + titulo + "'. Escriba el el genero para eliminar","");
    if(genero == ""){
        alert("No especifico ningun autor");
    }else if(genero == undefined){

    }else{
        let name = new FormData(libroAutor);
        const table = "getBook"
        name.append("tablaGen", table);
        name.append("ISBN", ISBN);
        name.append("genero", genero);

        fetch("../admin/eliminar/datoRecibido.php",{
            method: 'POST',
            body: name
        }).then( (res) => res.text()).then( (data) =>{
            // console.log(data);
            alert("Eliminar el genero: " + genero);
            location.href="main.php?id=8";
        });
    }
}  




