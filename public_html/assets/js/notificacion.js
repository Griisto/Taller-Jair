function Notificacion(){
    let Notificacion = document.getElementById('notificacion');

    if(Notificacion){
        Notificacion.classList.add('show');

        setTimeout(function(){
            Notificacion.classList.remove('show')
        },10000);
    }
}
window.onload = Notificacion();