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
        $tipo= $row['tipo'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mi agenda "<?php  if($tipo=='admin'){ echo $_SESSION['user'].' (Administrador)';} else { echo $_SESSION['user'];} ?>"</title>
        <meta charset="utf-8">
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
        <script type="text/javascript" src="js/jqxvalidator.js"></script>
        <script type="text/javascript" src="js/jqxmaskedinput.js"></script>          

        <style type="text/css">
            .demo-iframe {
                border: none;
                width: 600px;
                height: 400px;
                clear: both;
                display: none;
            }
            .text-input
            {
                height: 25px;
                width: 100px;
                background: white;
            }
            .register-table
            {
                margin-top: 0px;
                margin-bottom: 10px;
            }
            .register-table td, 
            .register-table tr
            {
                border-spacing: 0px;
                border-collapse: collapse;
                font-family: Verdana;
                font-size: 15px;
            }
            h3 
            {
                display: inline-block;
                margin: 0px;
            }
            .prompt {
                margin-top: 10px; font-size: 10px;
            }
            #combobox{
                font-family: Verdana;
                font-size: 15px;
            }
            .required
            {
                vertical-align: baseline;
                color: red;
                font-size: 10px;
            }

        </style>

        <script type="text/javascript">
            $(document).ready(function() {
                var url = "directorioC.php";
                var source =
                        {
                            dataType: "json",
                            dataFields: [
                                {name: 'idUser', type: 'string'},
                                {name: 'Nombre', type: 'string'},
                                {name: 'birthDate', type: 'string'},
                                {name: 'address', type: 'string'},
                                {name: 'Web', type: 'string'},
                                {name: 'Telefono', type: 'string'},
                                {name: 'oficio', type: 'string'}
                            ],
                            id: 'idUser',
                            url: url,
                            addRow: function(rowID, rowData, position, commit) {
                                commit(true);
                            },
                            updateRow: function(rowID, rowData, commit) {
                                commit(true);
                            },
                            deleteRow: function(rowID, commit) {
                                commit(true);
                            }
                        };

                var dataAdapter = new $.jqx.dataAdapter(source, {
                    loadComplete: function() {
                        // data is loaded.
                    }
                });

                $("#dataTable").jqxDataTable(
                        {
                            width: 600,
                            pageable: true,
                            source: dataAdapter,
                            columnsResize: true,
                            sortable: true,
                            altrows: true,
                            ready: function() {
                                // called when the DataTable is loaded.  
                                // init jqxWindow widgets.

                                $("#save").jqxButton({height: 30, width: 80});
                                $("#cancel").jqxButton({height: 30, width: 80});
                                $("#cancel").mousedown(function() {
                                    // close jqxWindow.
                                    $("#dialog").jqxWindow('close');
                                });
                                $("#save").mousedown(function() {
                                    // close jqxWindow.
                                    $("#dialog").jqxWindow('close');
                                    // update edited row.
                                    var editRow = parseInt($("#dialog").attr('data-row'));
                                    $.ajax({
                                        type: "POST",
                                        url: "directorioE.php",
                                        data: "ID=" + editRow,
                                        success: onSuccess
                                    });
                                    function onSuccess(data) {
                                        source.dataType = "json";
                                        $("#dataTable").jqxDataTable('updatebounddata', 'cells');

                                    }
                                });
                                $("#dialog").on('close', function() {
                                    // enable jqxDataTable.
                                    $("#dataTable").jqxDataTable({disabled: false});
                                });

                                $("#dialog").jqxWindow({
                                    resizable: false,
                                    position: {left: $("#dataTable").offset().left + 75, top: $("#dataTable").offset().top + 35},
                                    width: 180, height: 100,
                                    autoOpen: false
                                });
                                $("#dialog").css('visibility', 'visible');
                            },
                            pagerButtonsCount: 8,
                            columns: [
                                {text: 'Nombre', dataField: 'Nombre', width: 150},
                                {text: 'Fecha', dataField: 'birthDate', width: 80},
                                {text: 'Direccion', dataField: 'address', width: 150},
                                {text: 'Correo/Pagina', dataField: 'Web', width: 150},
                                {text: 'Telefono/Celular', dataField: 'Telefono', width: 100},
                                {text: 'Oficio', dataField: 'oficio', width: 100}
                            ]
                        });
                $("#dataTable").on('rowDoubleClick', function(event) {
                    var args = event.args;
                    var row = args.row;
                    // update the widgets inside jqxWindow.
                    $("#dialog").jqxWindow('setTitle', "Que desea hacer");
                    $("#dialog").jqxWindow('open');
                    $("#dialog").attr('data-row', row.idUser);
                    $("#dataTable").jqxDataTable({disabled: true});

                });

                var date = new Date();
                date.setFullYear(1990, 0, 1);
                $('#birthInput').jqxDateTimeInput({min: new Date(1900, 0, 1), max: new Date(1996, 11, 31), width: 200, height: 20, value: $.jqx._jqxDateTimeInput.getDateTime(date)});

                $('.text-input').addClass('jqx-input');
                /*$('.text-input').addClass('jqx-rc-all');
                if (theme.length > 0) {
                    $('.text-input').addClass('jqx-input-' + theme);
                    $('.text-input').addClass('jqx-widget-content-' + theme);
                    $('.text-input').addClass('jqx-rc-all-' + theme);
                }*/
                $("#phoneInput").jqxMaskedInput({mask: '(###)###-####', width: 200, height: 20});
                $("#celphoneInput").jqxMaskedInput({mask: '(###)###-####', width: 200, height: 20});

                $("#contact-form").jqxValidator({
                    rules: [
                        {input: '#name', message: 'Debe ingresar el nombre', action: 'keyup, blur', rule: 'required'},
                        {input: '#name', message: 'El nombre debe tener entre 3 y 20 caracteres', action: 'keyup, blur', rule: 'length=3,20'},
                        {input: '#app', message: 'Debe ingresar el apellido paterno', action: 'keyup, blur', rule: 'required'},
                        {input: '#app', message: 'El apellido debe tener entre 3 y 20 caracteres', action: 'keyup, blur', rule: 'length=3,20'},
                        {input: '#apm', message: 'Debe ingresar el apellido materno', action: 'keyup, blur', rule: 'required'},
                        {input: '#apm', message: 'El apellido debe tener entre 3 y 20 caracteres', action: 'keyup, blur', rule: 'length=3,20'},
                        {input: '#dir', message: 'Ingrese una direccion', action: 'keyup, blur', rule: 'required'},
                        {input: '#dir', message: 'La direccion debe tener mas de 6 caracteres y menos de 50 caracteres', action: 'keyup, blur', rule: 'length=6,50'},
                        {input: '#emailInput', message: 'Ingrese el e-mail', action: 'keyup, blur', rule: 'required'},
                        {input: '#emailInput', message: 'e-mail invalido', action: 'keyup', rule: 'email'},
                        {input: '#phoneInput', message: 'Telefono invalido', action: 'valuechanged, blur', rule: 'phone'},
                        {input: '#celphoneInput', message: 'Celular invalido', action: 'valuechanged, blur', rule: 'phone'}]
                });

                // validate form.
                $("#sendButton").click(function() {
                    var validationResult = function(isValid) {
                        if (isValid) {
                            //$("#contact-form").submit();
                        }
                    };
                    $("#contact-form").jqxValidator('validate', validationResult);
                });

                $("#contact-form").on('validationSuccess', function() {
                    var name = $("#name").val();
                    var app = $("#app").val();
                    var apm = $("#apm").val();
                    var date = $('#birthInput').val();
                    var dir = $("#dir").val();
                    var username = '<?php echo $usuario; ?>';
                    var password = '';
                    var email = $("#emailInput").val();
                    var site = $("#site").val();
                    var phone = $("#phoneInput").val();
                    var celphone = $("#celphoneInput").val();
                    var oficio = $("#oficio").val();
                    var preg = '';
                    var res = '';

                    $.ajax({
                        type: "POST",
                        url: "directorioN.php",
                        data: "name=" + name + "&app=" + app + "&apm=" + apm + "&birthdate=" + date
                                + "&dir=" + dir + "&username=" + username + "&passwordInput=" + password +
                                "&emailInput=" + email + "&site=" + site + "&phone=" + phone +
                                "&celphone=" + celphone + "&oficio=" + oficio + "&combobox=" + preg + "&res=" + res + "&client=" + 'client',
                        success: onSuccess
                    }).done(function(msg) {
                        if (msg == 1) {

                        } else {
                            //navigator.notification.alert("Hubo un error en el registro",null,"Error","Aceptar");
                        }
                    });
                    function onSuccess(data) {
                        window.location = 'directorio.php';
                    }

                });
                $("#editar").click(function() {
                    muestra_oculta("contenido");
                });
            });
            function muestra_oculta(id) {
                if (document.getElementById) { //se obtiene el id
                    var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
                    el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
                }
            }
            function soloLetras(e) {
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toLowerCase();
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                especiales = "8-37-39-46";

                tecla_especial = false
                for (var i in especiales) {
                    if (key == especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }

                if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                    return false;
                }
            }

        </script>

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
                                            <li><a href="agenda.php">Citas</a></li>
                                            <li><a class="active" href="directorio.php">Directorio</a></li>   
                                            <?php if ($tipo == 'admin') { ?>
                                                <li><a href="configurar.php">Configurar</a></li>
                                            <?php }
                                            ?>
                                                <li><a href="calendario.php">Calendario</a></li>
                                            <li><a href="cerrar.php">Salir</a></li>
                                            
                                        </ul>
                                    </nav><br/>
                                </div>

                            </div>
                        </div>
                    </div>
                </header>
                <!--==============================content================================-->
                <div id="contenido">
                    <section id="content"><div class="ic"></div>
                        <div class="container_12">
                            <div class="wrapper">
                                <article class="grid_4">
                                    <div class="indent-left3">
                                        <h3>Mis datos</h3><br>
                                        Datos personales<br>
                                        <span class="color-5"><?php echo $nom; ?></span><br>
                                        Cumpleaños<br>
                                        <span class="color-5"><?php echo $cumple; ?></span>                                        
                                        <dl>
                                            <dt><?php echo $dir; ?></dt>
                                            <dd><span>Telefono:</span><?php echo $tel; ?></dd>
                                            <dd><span>Celular:</span><?php echo $cel; ?></dd>                                        
                                            <dd><span>E-mail:</span><?php echo $mail; ?></dd>
                                            <dd><span>Sitio:</span><a href="<?php echo $site; ?>"><?php echo $site; ?></a></dd><br/>
                                            <!--<dd><a class="button" id="editar">Editar información</a></dd>-->
                                        </dl>
                                    </div>
                                </article>
                                <article class="grid_8">                                
                                    <div class="indent-right">                                    
                                        <h3 class="prev-indent-bot">Nuevo contacto</h3>
                                        <form id="contact-form">
                                            <td><label><span class="text-form">Nombre:<span class="required">*</span></span><input name="name" id='name' type="text" onkeypress="return soloLetras(event)"/></label></td>
                                            <label><span class="text-form">Apellido  paterno:<span class="required">*</span></span></span><input name="app" id='app' type="text" onkeypress="return soloLetras(event)"/></label>                                        
                                            <label> <span class="text-form">Apellido  materno:<span class="required">*</span></span></span><input name="apm" id='apm' type="text" onkeypress="return soloLetras(event)"/></label>
                                            <label> <span class="text-form">Fecha de nacimiento:<span class="required">*</span></span></span><div name="birthdate" id="birthInput"></div></label>
                                            <label><span class="text-form">Direccion:<span class="required">*</span></span><input name="dir" id='dir' type="text"/></label>
                                            <label><span class="text-form">Email:<span class="required">*</span></span></span><input name="emailInput" id='emailInput' type="text"/></label>
                                            <label><span class="text-form">Pagina web:</span><input name="site" id='site' type="text"/></label>
                                            <label><span class="text-form">Telefono:<span class="required">*</span></span><div name="phone" id="phoneInput"></div></label>
                                            <label><span class="text-form">Celular:<span class="required">*</span></span><div name="celphone" id="celphoneInput"></div></label>
                                            <label><span class="text-form">Oficio:</span><input name="oficio" id='oficio' type="text" onkeypress="return soloLetras(event)"/></label>
                                            <label>
                                                <a class="button" id="sendButton">Agregar</a>
                                            </label>
                                        </form>
                                        <br/>
                                        <h3 class="prev-indent-bot">Contactos</h3>
                                        <br/> 
                                        <h2>Directorio</h2>
                                        Si desea eliminar un contacto debera dar doble clic sobre el ususario
                                        <div id="dataTable"></div> 
                                        <div id="dialog">
                                            <div>Edit Dialog</div>
                                            <div style="overflow: hidden;">
                                                <table style="table-layout: fixed; border-style: none;">

                                                    <tr>
                                                        <td colspan="2" align="right">
                                                            <br />
                                                            <button id="save">Eliminar</button> 
                                                            <button style="margin-left: 5px;" id="cancel">Cancelar</button>
                                                        </td>                    
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                    </section> 
                </div>
                <!--==============================footer=================================-->
                <footer>
                    <div class="inner">
                        <div class="footer-bg">
                            lafama.com &copy; 2014
                            <span><a class="link" target="_blank" href="http://www.lafama.com/" rel="nofollow">Agenda personal</a> por lafama.com</span><span>M&aacute;s <a href="#" title="MPG - plantillas web y plantillas Flash" target="_blank">Informacion</a> en ITSL.</span>
                        </div>
                    </div>
                </footer>
            </div>
            <?php
        } else {
            ?>
            <script language="javascript">
                window.location = 'index.php';
            </script>
            <?php
        }
        ?>

    </body>
</html>