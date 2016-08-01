<?php session_start(); ?>
<?php
require_once('conexion.php');
if (isset($_SESSION['user'])) {
    $sql = "SELECT * FROM usuario where user='" . $_SESSION['user'] . "' AND (tipo='user' OR tipo='admin')";
    $consulta = mysql_query($sql);
    $nom = "";
    while ($row = mysql_fetch_array($consulta)) {
        $usuario = $row['user'];
        $cumple = $row['birthDate'];
        $nom = $row['name'] . " " . $row['apP'] . " " . $row['apM'];
        $tipo = $row['tipo'];
        $dir = $row['address'];
        $tel = $row['tel'];
        $cel = $row['cel'];
        $mail = $row['email'];
        $site = $row['site'];
        $tipo = $row['tipo'];
    }
    $sql = "SELECT * FROM usuario where tipo='admin'";
    $consulta = mysql_query($sql);

    while ($row = mysql_fetch_array($consulta)) {
        $admin = $row['user'];
        $dirAdmin = $row['address'];
    }
}
?>
<?php require_once("config.inc.php"); ?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="es"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="es"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="es"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="es"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!--title>Calendario en PHP, AJAX y jQuery con eventos actualizado a 2014</title-->
	  <title>Mi agenda "<?php
            if ($tipo == 'admin') {
                echo $_SESSION['user'] . ' (Administrador)';
            } else {
                echo $_SESSION['user'];
            }
            ?>"</title>
        
	<meta http-equiv="PRAGMA" content="NO-CACHE">
	<meta http-equiv="EXPIRES" content="-1">
	
        <link type="text/css" rel="stylesheet" media="all" href="css/estilos.css">
	<link rel="icon" type="image/png" href="images/1.png" />
        <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
        <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen"> 
        <link rel="stylesheet" href="css/jqx.base.css" type="text/css"/>
        <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="js/cufon-yui.js" type="text/javascript"></script>
        <script src="js/cufon-replace.js" type="text/javascript"></script>
        <script src="js/Asap_400.font.js" type="text/javascript"></script>
        <script src="js/Asap_italic_400.font.js" type="text/javascript"></script> 
        <script src="js/FF-cash.js" type="text/javascript"></script>
        <script src="js/jquery.equalheights.js" type="text/javascript"></script> 
        <script src="js/jquery.cycle.all.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/demos.js"></script>
        <script type="text/javascript" src="js/jqxcore.js"></script>
        <script type="text/javascript" src="js/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="js/jqxcalendar.js"></script>
        <script type="text/javascript" src="js/jqxtooltip.js"></script>
        <script type="text/javascript" src="js/globalize.js"></script>
        <script type="text/javascript" src="js/jqxdata.js"></script> 
        <script type="text/javascript" src="js/jqxbuttons.js"></script>
        <script type="text/javascript" src="js/jqxscrollbar.js"></script>
        <script type="text/javascript" src="js/jqxmenu.js"></script>
        <script type="text/javascript" src="js/jqxgrid.js"></script>
        <script type="text/javascript" src="js/jqxgrid.pager.js"></script>
        <script type="text/javascript" src="js/jqxgrid.selection.js"></script> 
        <script type="text/javascript" src="js/jqxnumberinput.js"></script>
        <script type="text/javascript" src="js/jqxwindow.js"></script>
        <script type="text/javascript" src="js/jqxlistbox.js"></script>
        <script type="text/javascript" src="js/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="js/jqxgrid.sort.js"></script>
        <script type="text/javascript" src="js/jqxdatatable.js"></script>
        <script type="text/javascript" src="js/jqxinput.js"></script>
        <script type="text/javascript" src="js/jqxcombobox.js"></script>
        <script type="text/javascript" src="js/jqxtooltip.js"></script>
        

        
        
        
	</head>
<body id="page1">
    
    <?php
        if (isset($_SESSION['user'])) {
            ?>
            <div class="main">
                <!--==============================header=================================-->
                <header>
                    <div class="container_12">
                        <div class="wrapper p3">
                            <div class="grid_12">
                                <div class="wrapper border-bot">
                                    <h1><a href="agenda.php"><img src="images/logo1.png" width="270" height="120"/></a></h1>
                                    <nav>
                                        <ul class="menu">
                                            <li><a class="active" href="agenda.php">Citas</a></li>
                                            <li><a href="directorio.php">Directorio</a></li>   
                                            <?php if ($tipo == 'admin') { ?>
                                                <li><a href="configurar.php">Configurar</a></li>
                                            <?php }
                                            ?>
                                               <li><a href="calendario.php">Calendario</a></li> 
                                            <li><a href="cerrar.php">Salir</a></li>
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>

                    </div>
                </header>
    
    
    
	<div class="calendario_ajax">
		<div class="cal"></div>
                <div id="mask"></div>
	</div>
	
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/localization/messages_es.js "></script>
		
	<script>
            
	function generar_calendario(mes,anio)
	{
		var agenda=$(".cal");
		agenda.html("<img src='images/loading.gif'>");
		$.ajax({
			type: "GET",
			url: "ajax_calendario.php",
			cache: false,
			data: { mes:mes,anio:anio,accion:"generar_calendario" }
		}).done(function( respuesta ) 
		{
			agenda.html(respuesta);
		});
	}
		
	function formatDate (input) {
		var datePart = input.match(/\d+/g),
		year = datePart[0].substring(2),
		month = datePart[1], day = datePart[2];
		return day+'-'+month+'-'+year;
	}
		
		$(document).ready(function()
		{
			/* GENERAMOS CALENDARIO CON FECHA DE HOY */
			generar_calendario("<?php if (isset($_GET["mes"])) echo $_GET["mes"]; ?>","<?php if (isset($_GET["anio"])) echo $_GET["anio"]; ?>");
			
			
			/* AGREGAR UN EVENTO */
			$(document).on("click",'a.add',function(e) 
			{
				e.preventDefault();
				var id = $(this).data('evento');
				var fecha = $(this).attr('rel');
				
				$('#mask').fadeIn(1000).html("<div id='nuevo_evento' class='window' rel='"+fecha+"'>Agregar un evento el "+formatDate(fecha)+"</h2><a href='#' class='close' rel='"+fecha+"'>&nbsp;</a><div id='respuesta_form'></div><form class='formeventos'><input type='text' name='evento_titulo' id='evento_titulo' class='required'><input type='button' name='Enviar' value='Guardar' class='enviar'><input type='hidden' name='evento_fecha' id='evento_fecha' value='"+fecha+"'></form></div>");
			});
			
			/* LISTAR EVENTOS DEL DIA */
			$(document).on("click",'a.modal',function(e) 
			{
				e.preventDefault();
				var fecha = $(this).attr('rel');
				
				$('#mask').fadeIn(1000).html("<div id='nuevo_evento' class='window' rel='"+fecha+"'>Eventos del "+formatDate(fecha)+"</h2><a href='#' class='close' rel='"+fecha+"'>&nbsp;</a><div id='respuesta'></div><div id='respuesta_form'></div></div>");
				$.ajax({
					type: "GET",
					url: "ajax_calendario.php",
					cache: false,
					data: { fecha:fecha,accion:"listar_evento" }
				}).done(function( respuesta ) 
				{
					$("#respuesta_form").html(respuesta);
				});
			
			});
		
			$(document).on("click",'.close',function (e) 
			{
				e.preventDefault();
				$('#mask').fadeOut();
				setTimeout(function() 
				{ 
					var fecha=$(".window").attr("rel");
					var fechacal=fecha.split("-");
					generar_calendario(fechacal[1],fechacal[0]);
				}, 500);
			});
		
			//guardar evento
			$(document).on("click",'.enviar',function (e) 
			{
				e.preventDefault();
				if ($("#evento_titulo").valid()==true)
				{
					$("#respuesta_form").html("<img src='images/loading.gif'>");
					var evento=$("#evento_titulo").val();
					var fecha=$("#evento_fecha").val();
					$.ajax({
						type: "GET",
						url: "ajax_calendario.php",
						cache: false,
						data: { evento:evento,fecha:fecha,accion:"guardar_evento" }
					}).done(function( respuesta2 ) 
					{
						$("#respuesta_form").html(respuesta2);
						$(".formeventos,.close").hide();
						setTimeout(function() 
						{ 
							$('#mask').fadeOut('fast');
							var fechacal=fecha.split("-");
							generar_calendario(fechacal[1],fechacal[0]);
						}, 3000);
					});
				}
			});
				
			//eliminar evento
			$(document).on("click",'.eliminar_evento',function (e) 
			{
				e.preventDefault();
				var current_p=$(this);
				$("#respuesta").html("<img src='images/loading.gif'>");
				var id=$(this).attr("rel");
				$.ajax({
					type: "GET",
					url: "ajax_calendario.php",
					cache: false,
					data: { id:id,accion:"borrar_evento" }
				}).done(function( respuesta2 ) 
				{
					$("#respuesta").html(respuesta2);
					current_p.parent("p").fadeOut();
				});
			});
				
			$(document).on("click",".anterior,.siguiente",function(e)
			{
				e.preventDefault();
				var datos=$(this).attr("rel");
				var nueva_fecha=datos.split("-");
				generar_calendario(nueva_fecha[1],nueva_fecha[0]);
			});

		});
		</script>
	</div>
         <?php
    } else {
        ?>
        <script language="javascript">
            //var aceptar = confirm("Los Datos se Agregaron");
            window.location = 'index.php';
        </script>
        <?php
    }
    ?>
	
	     <footer>
                <div class="inner">
                    <div class="footer-bg">
                        lafama.com &copy; 2014
                        <span><a class="link" target="_blank" href="http://www.lafama.com/" rel="nofollow">Agenda personal</a> por lafama.com</span><span>M&aacute;s <a href="#" title="MPG - plantillas web y plantillas Flash" target="_blank">Informacion</a> en ITSL.</span>
                    </div>
                </div>
            </footer>
	
	<!-- ESTO NO TE HACE FALTA! -->
	<!--script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	try {
	var pageTracker = _gat._getTracker("UA-266167-20");
	pageTracker._setDomainName(".martiniglesias.eu");
	pageTracker._trackPageview();
	} catch(err) {}</script-->
</body>
</html>