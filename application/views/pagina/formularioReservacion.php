<form action="#" id="datosReservacion">
	<aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title">Datos tarjeta</h4>
        
            <div class="form-group">
               <div class="form-group">
                  <input type="text" class="form-control" name="titular" placeholder="Nombre del titular" required>
               </div>
            </div>
            <div class="form-group">
               <input type="text" class="form-control" name="apellidos" placeholder="Apellidos del titular" required>
            </div>
            <div class="form-group">
               <input type="text" class="form-control" name="telefono" placeholder="Numero de telefono" required>
            </div>
            <div class="form-group">
               <input type="email" class="form-control" name="correo" placeholder="Correo" required>
            </div>
        
    </aside>
    <div class="comment-form" style="padding-top: 10px;padding-bottom:10px;margin-top: 10px;">
       <button type="submit" class="primary-btn button_hover" id="btn_siguiente">Siguiente</button>
    </div>
</form>

<script type="text/javascript">
	$(function () {
		$("#datosReservacion").on("submit", function(e){
		    e.preventDefault();
		    var formData = new FormData(document.getElementById("datosReservacion"));
		    $.ajax({
		      url: baseurl+"CtrPagina/pago",
		      type: "post",
		      dataType: "html",
		      data: formData,
		      cache: false,
		      contentType: false,
		      processData: false
		    }).done(function(response){
		    	window.location.replace(response);
		    });
		});
	});
</script>