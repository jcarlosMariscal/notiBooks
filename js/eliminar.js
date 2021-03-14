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