var libroAutor = document.getElementById("libroAutor");

function eliminarUser(id,nombre,rol){
    var eliminar = confirm("¿Quiere eliminar a : "+ nombre +" [ " + rol + " ]" + " de NotiBooks?");
    if(eliminar){
        var eliminarUser = document.getElementById("eliminarUser");
        let user = new FormData(eliminarUser);
        user.append("tabla","acceso");
        user.append("id",id);

        fetch("../admin/eliminar/datoRecibido.php", {
            method: 'POST',
            body: user
        }).then( (res) => res.text()).then( (data) =>{
            window.location.href='../admin/main.php?id=7';
        });
    }
};
function eliminarAutor(id,nombre){
    var eliminar = confirm("¿Quiere eliminar al autor : "+ nombre + " ?");
    if(eliminar){
        var eliminarAutor = document.getElementById("eliminarAutor");
        let autor = new FormData(eliminarAutor);
        autor.append("tabla","autor");
        autor.append("id",id);
    
        fetch("../admin/eliminar/datoRecibido.php", {
            method: 'POST',
            body: autor
        }).then( (res) => res.text()).then( (data) =>{
            window.location.href='../admin/main.php?id=6';
        });
    }
}
function eliminarEditorial(id,nombre){
    var eliminar = confirm("¿Quiere eliminar la editorial : "+ nombre + " ?");
    if(eliminar){
        var eliminarEditGen = document.getElementById("eliminarEditGen");
        let editorial = new FormData(eliminarEditGen);
        editorial.append("tabla","editorial");
        editorial.append("id",id);
    
        fetch("../admin/eliminar/datoRecibido.php", {
            method: 'POST',
            body: editorial
        }).then( (res) => res.text()).then( (data) =>{
            window.location.href='../admin/main.php?id=4';
        });
    }
}
function eliminarGenero(id,nombre){
    var eliminar = confirm("¿Quiere eliminar el genero : "+ nombre + " ?");
    if(eliminar){
        var eliminarEditGen = document.getElementById("eliminarEditGen");
        let genero = new FormData(eliminarEditGen);
        genero.append("tabla","genero");
        genero.append("id",id);
    
        fetch("../admin/eliminar/datoRecibido.php", {
            method: 'POST',
            body: genero
        }).then( (res) => res.text()).then( (data) =>{
            window.location.href='../admin/main.php?id=4';
        });
    }
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
            console.log(data);
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
        name.append("tabla", table);
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
function deleteNoticia(id,titulo){
    var eliminar = confirm("¿Quiere eliminar la noticia : "+ titulo + " ?");
    // if(eliminar){
    //     var eliminarNoticia = document.getElementById("eliminarNoticia");
    //     let noticia = new FormData(eliminarNoticia);
    //     noticia.append("tabla","noticia");
    //     noticia.append("id",id);
    //     alert(id);
    
    //     // fetch("../admin/eliminar/datoRecibido.php", {
    //     //     method: 'POST',
    //     //     body: noticia
    //     // }).then( (res) => res.text()).then( (data) =>{
    //     //     window.location.href='../admin/main.php?id=4';
    //     // });
    // }
}  