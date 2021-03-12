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

var formModificar = document.getElementById("formModificar");
var formModCat = document.getElementById("formModCat");
var formModAcceso = document.getElementById("formModAcceso");
var formModAutor = document.getElementById("formModAutor");
var formModEdi = document.getElementById("formModEdi");
var formModGen = document.getElementById("formModGen");
var formModLibro = document.getElementById("formModLibro");

if(formModificar){
    var quill = new Quill('#editor', {
        modules:{
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    
    const inputFile = document.querySelector('#fotografia');
    formModificar.addEventListener('submit',(e) => {
            e.preventDefault();
            document.getElementById("cuerpo").value = quill.container.firstChild.innerHTML;
    
            let noticia = new FormData(formModificar);
            noticia.append("archivo", inputFile.files[0]);
    
            fetch("../modificar/datosRecibidos.php",{
                method : "POST",
                body : noticia
            }).then( (res) => res.text()).then( (res) => {
                console.log(res);
            });
            alert("Noticia Modificada");
            window.location.href="../main.php?id=1";
    
    });
}else if(formModCat){
    formModCat.addEventListener('submit', (e) => {
        e.preventDefault();
        let categoria = new FormData(formModCat);

        fetch("../modificar/datosRecibidos.php",{
            method: 'POST',
            body: categoria
        }).then( (res) => res.text()).then( (data) => {
            console.log(data);
        });
        alert("Categoria Modificada");
        window.location.href="../main.php?id=2";
    });
}else if(formModAcceso){
    formModAcceso.addEventListener('submit', (e) =>{
        e.preventDefault();
        let acceso = new FormData(formModAcceso);

        fetch("../modificar/datosRecibidos.php", {
            method: 'POST',
            body: acceso
        }).then( (res) => res.text()).then( (data) => {
            console.log(data);
        });
        alert("Acceso Modificado");
        window.location.href="../main.php?id=7";
    });
}else if(formModAutor){
    var quill = new Quill('#editor', {
        modules:{
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    
    const inputFile = document.querySelector('#fotografia');
    formModAutor.addEventListener('submit',(e) => {
        e.preventDefault();
        document.getElementById("biografia").value = quill.container.firstChild.innerHTML;
    
        let autor = new FormData(formModAutor);
        autor.append("archivo", inputFile.files[0]);
    
        fetch("../modificar/datosRecibidos.php",{
            method : "POST",
            body : autor
        }).then( (res) => res.text()).then( (res) => {
            console.log(res);
        });
        alert("Autor Modificado");
        window.location.href="../main.php?id=6";
    });
}
else if(formModEdi){
    formModEdi.addEventListener('submit', (e) =>{
        e.preventDefault();
        let editorial = new FormData(formModEdi);

        fetch("../modificar/datosRecibidos.php", {
            method: 'POST',
            body: editorial
        }).then( (res) => res.text()).then( (data) => {
            console.log(data);
        });
        alert("Editorial Modificado");
        window.location.href="../main.php?id=4";
    });
}else if(formModGen){
    formModGen.addEventListener('submit', (e) =>{
        e.preventDefault();
        let genero = new FormData(formModGen);

        fetch("../modificar/datosRecibidos.php", {
            method: 'POST',
            body: genero
        }).then( (res) => res.text()).then( (data) => {
            console.log(data);
        });
        alert("Genero Modificado");
        window.location.href="../main.php?id=4";
    });
}else if(formModLibro){
    var quill = new Quill('#editor', {
        modules:{
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    
    const inputFile = document.querySelector('#portada');
    formModLibro.addEventListener('submit',(e) => {
            e.preventDefault();
            document.getElementById("prologo").value = quill.container.firstChild.innerHTML;
    
            let noticia = new FormData(formModLibro);
            noticia.append("archivo", inputFile.files[0]);
    
            fetch("../modificar/datosRecibidos.php",{
                method : "POST",
                body : noticia
            }).then( (res) => res.text()).then( (res) => {
                console.log(res);
            });
            alert("Libro Modificado");
            window.location.href="../main.php?id=3";
    
    });
}