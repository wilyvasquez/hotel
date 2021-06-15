$(function () {
	var btn = document.getElementById('btn_siguiente');
	btn.addEventListener('click', function(e) {
		e.preventDefault();
		$.ajax({
	      url: baseurl+"CtrPagina/generarPago",
	      type: "post",
	      dataType: "html",
	      data: null,
	    }).done(function(response){
	    	$("#vistaPago").html(response);
	    });
	},false);
});

