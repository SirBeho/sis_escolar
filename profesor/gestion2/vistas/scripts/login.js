$("#frmAcceso").on('submit',function(e)
{
    e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();
 
  
    $.post("ajax/usuario.php?op=verificar",
        {"logina":logina,"clavea":clavea},
        function(datos)
        {
            console.log(datos)
            datos = JSON.parse(datos)
         
            if (datos=="null" || datos==null || datos=="")
            {
              console.log("eoot");
                document.getElementById("msjerror").innerHTML = 
                `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Contraseña incorrecta
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`;
            
                  
                  
            }
            else
            {
               
               $(location).attr("href","./vistas/escritorio.php");
            }
        }
    );
    
})