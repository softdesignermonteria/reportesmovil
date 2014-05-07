/*Funciones JS donde se asocian los eventos*/
$(document).ready(function(e) {
	
$.mobile.ajaxEnabled = true;
$.datepicker.regional['es'] = 
  {
  closeText: 'Cerrar', 
  prevText: 'Previo', 
  nextText: 'Próximo',
  
  monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
  'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
  monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
  'Jul','Ago','Sep','Oct','Nov','Dic'],
  monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
  dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
  dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
  dateFormat: 'yy-mm-dd', firstDay: 0, 
  initStatus: 'Selecciona la fecha', isRTL: false};
$.datepicker.setDefaults($.datepicker.regional['es']);
 
//$.mobile.page.prototype.options.domCache = true;
url_master = "http://107.170.28.129/ReportesMovil/";
//url_master = "";
 
/*$("#errorMsg").hide();*/
$("#btnLogin").click(function(){
var usu = $("#txtuser").val();
var pass = $("#txtpassword").val();

$.post(url_master+"server/login.php",{ usu : usu, pass : pass},function(respuesta){
	
	if (respuesta == true) {
		
		$.mobile.changePage("#Menu");
	}
	else{
		$.mobile.changePage('#pageError', 'pop', true, true);
		/*$("#errorMsg").fadeIn(300);
		$("#errorMsg").css("display", "block");*/
	}
	});
});


/*Page 5*/


$("#search_button").click(function(e) {
	e.preventDefault();
	// getting the value that user typed
			
	var fecha    = $("#fecha").val();
	var limite    = $("#limite").val();
	// forming the queryString
	var data            = 'fecha='+ fecha+'&limite='+limite;
	 
	// if searchString is not empty
	if((fecha)&&(limite)) {
		// ajax call
		$.ajax({
			type: "POST",
			url: url_master+"server/top_cliente.php",
			data: data,
			beforeSend: function(html) { // this happens before actual call
				$("#results").html('');
				$("#searchresults").show();
				//$(".word").html(searchString);
		   },
		   success: function(html){ // this happens after we get results
				$("#results").show();
				$("#results").html(html);
		  }
		});   
	}
	return false;
});
    

		
/*Page 6*/		
$("#search_button2").click(function(e) {
	e.preventDefault();
	// getting the value that user typed
	var fecha_i    = $("#fecha_i").val();
	var fecha_f    = $("#fecha_f").val();
		// forming the queryString
	var data            = 'fecha_i='+ fecha_i+'&fecha_f='+fecha_f;
	 
	// if searchString is not empty
	if((fecha_i)&&(fecha_f)) {
		// ajax call
		$.ajax({
			type: "POST",
			url: url_master+"server/articulo_rota.php",
			data: data,
			beforeSend: function(html) { // this happens before actual call
				$("#results2").html('');
				$("#searchresults").show();
				//$(".word").html(searchString);
		   },
		   success: function(html){ // this happens after we get results
				$("#results2").show();
				$("#results2").html(html);
		  }
		});   
	}
	return false;
});
	
	
data = "";
$.ajax({
	type: "POST",
	url: url_master+"server/inventario.php",
	data: data,
	beforeSend: function(html) { // this happens before actual call
	   // $("#div_page2").hide();
		$("#div_page2").html('');
		
		
   },
   success: function(html){ // this happens after we get results
		$("#div_page2").html(html);
		//$("#div_page2").show();
	   
  }
});


data = "";
$.ajax({
	type: "POST",
	url: url_master+"server/clientes.php",
	data: data,
	beforeSend: function(html) { // this happens before actual call
	   // $("#div_page2").hide();
		$("#div_page3").html('');
		
		
   },
   success: function(html){ // this happens after we get results
		$("#div_page3").html(html);
		//$("#div_page2").show();
	   
  }
}); 

data = "";
$.ajax({
	type: "POST",
	url: url_master+"server/proveedores.php",
	data: data,
	beforeSend: function(html) { // this happens before actual call
	   // $("#div_page2").hide();
		$("#div_page4").html('');
		
		
   },
   success: function(html){ // this happens after we get results
		$("#div_page4").html(html);
		//$("#div_page2").show();
	   
  }
});  


/*Page 7*/

$("#search_button1").click(function(e) {
	e.preventDefault();
	// getting the value that user typed
	var fecha1   = $("#fecha1").val();
	// forming the queryString
	var data            = 'fecha1='+ fecha1;
	 
	// if searchString is not empty
	if((fecha)) {
		// ajax call
		$.ajax({
			type: "POST",
			url: url_master+"server/ingresos_diarios.php",
			data: data,
			beforeSend: function(html) { // this happens before actual call
				$("#results1").html('');
				$("#searchresults1").show();
				//$(".word").html(searchString);
		   },
		   success: function(html){ // this happens after we get results
				$("#results1").show();
				$("#results1").html(html);
		  }
		});   
	}
	return false;
});

});



