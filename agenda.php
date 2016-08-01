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

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mi agenda "<?php
            if ($tipo == 'admin') {
                echo $_SESSION['user'] . ' (Administrador)';
            } else {
                echo $_SESSION['user'];
            }
            ?>"</title>
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

        <script type="text/javascript">

            $(document).ready(function() {

                var url = "agendaC.php";
                // prepare the data
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'idUser'},
                                {name: 'Nombre'}
                            ],
                            url: url,
                            async: false
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);

                // Create a jqxComboBox
                $("#jqxWidget").jqxComboBox({selectedIndex: 0, source: dataAdapter, displayMember: "Nombre", valueMember: "idUser", width: 200, height: 20});
                var conI = $("#jqxWidget").val();
                if (conI == '1') {
                    $("#place").val('<?php echo $dirAdmin; ?>');
                    $("#place").jqxInput({disabled: true});
                }
                $("#jqxWidget").on('select', function(event) {
                    if (event.args) {
                        var item = event.args.item;
                        if (item) {
                            if (item.value == '1') {
                                $("#place").val('<?php echo $dirAdmin; ?>');
                                $("#place").jqxInput({disabled: true});
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "agendaDir.php",
                                    data: "ID=" + item.value,
                                    success: onSuccess
                                });
                                function onSuccess(data) {
                                    if (data == 'error') {
                                        $("#place").val('');
                                    } else {
                                        $("#place").val(data);
                                        $("#resp").val("");
                                    }
                                }

                                $("#place").jqxInput({disabled: false});
                            }
                        } else {
                            alert('no validoaa');
                        }
                    }
                });

                var hoy = new Date(); //document.write(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
                var limite = new Date();
                limite.setDate(hoy.getDate() + 60);
                $("#calAd").jqxDateTimeInput({min: hoy, max: limite, width: '200px', height: '20px'});
                $("#hora").jqxNumberInput({inputMode: 'simple', rtl: true, width: '200px', height: '20px', spinButtons: true, decimalDigits: 0, symbol: ' hr', symbolPosition: 'right', min: 6, max: 18, value: 9});
                $("#place").jqxInput({height: 20, width: 425, minLength: 1});
            });
        </script>  
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
                width: 200px;
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
        </style>

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
                <!--==============================content================================-->
                <section id="content"><div class="ic"></div>
                    <div class="container_12">
                        <div class="wrapper">
                            <article class="grid_8">
                                <div class="indent-right">
                                    <h3 class="prev-indent-bot">Nueva cita</h3>
                                    <form id="contact-form" method="post" enctype="multipart/form-data">                    
                                        <fieldset>
                                            <label><span class="text-form">Cita con:</span><div id='jqxWidget'></div></label>
                                            <label><span class="text-form">Fecha:</span><div style='float: left' id='calAd'> </div> </label>                              
                                            <label><span class="text-form">Hora:</span><div id='hora'></div></label> 
                                            <label><span class="text-form">Lugar:</span><input name="place" id='place' type="text"/></label> 
                                            <div class="wrapper">
                                                <div class="text-form">Nota:</div>
                                                <div class="extra-wrap">
                                                    <textarea id="nota"></textarea><br/>                                                    
                                                    <div class="clear"></div>
                                                    <div class="buttons">
                                                        <label>
                                                            <input type="text" disabled="true" style="width: 500px ; background: #f3f3f3; border-color: #f3f3f3; color: red; " id="resp"/>
                                                        </label>
                                                        <a class="button" id="agendar">Agendar</a>
                                                    </div> 
                                                </div>
                                            </div>                            
                                        </fieldset>						
                                    </form>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            var url = "agendaCitas.php";
                                            var source =
                                                    {
                                                        dataType: "json",
                                                        dataFields: [
                                                            {name: 'idCita', type: 'string'},
                                                            {name: 'Nombre', type: 'string'},
                                                            {name: 'fecha', type: 'string'},
                                                            {name: 'horaI', type: 'string'},
                                                            {name: 'horaF', type: 'string'},
                                                            {name: 'lugar', type: 'string'},
                                                            {name: 'citaCon', type: 'string'},
                                                            {name: 'comentario', type: 'string'},
                                                            {name: 'estado', type: 'string'}
                                                        ],
                                                        id: 'idCita',
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
                                                        width: 700,
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
                                                                    url: "agendaCancelar.php",
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
                                                            {text: 'Cita con', dataField: 'Nombre', width: 100},
                                                            {text: 'Fecha', dataField: 'fecha', width: 80},
                                                            {text: 'Hora', dataField: 'horaI', width: 80},
                                                            {text: 'Lugar', dataField: 'lugar', width: 100},
                                                            {text: 'Comentario', dataField: 'comentario', width: 100},
                                                            {text: 'Estado', dataField: 'estado', width: 89}
                                                        ]
                                                    });
                                            $("#dataTable").on('rowDoubleClick', function(event) {
                                                var args = event.args;
                                                var index = args.index;
                                                var row = args.row;
                                                // update the widgets inside jqxWindow.
                                                $("#dialog").jqxWindow('setTitle', "Cancelar cita");
                                                $("#dialog").jqxWindow('open');
                                                $("#dialog").attr('data-row', row.idCita);
                                                $("#dataTable").jqxDataTable({disabled: true});
                                            });

                                            $("#agendar").click(function() {
                                                var con = $("#jqxWidget").val();
                                                var fecha = $("#calAd").val();
                                                var hora = $("#hora").val();
                                                var place = $("#place").val();
                                                var nota = $("#nota").val();
                                                if (con == '') {
                                                    $("#resp").val("Debe llenar los campos");
                                                    $("#place").jqxInput({disabled: false});
                                                    $("#place").val('');
                                                } else {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "agendaV.php",
                                                        data: "FECHA=" + fecha + "&CON=" + con + "&HORA=" + hora + "&PLACE=" + place + "&NOTE=" + nota,
                                                        success: onSuccess
                                                    });
                                                    function onSuccess(data) {
                                                        $("#resp").val(data);
                                                        source.dataType = "json";
                                                        $("#dataTable").jqxDataTable('updatebounddata', 'cells');
                                                    }
                                                }
                                            });

                                        });
                                    </script><br/>
                                    <h3 class="prev-indent-bot">Citas</h3>
                                    <form id="contact-form">
                                        <fieldset>
                                            <div class="wrapper">
                                                <div class="text-form">Citas</div>
                                                <div class="extra-wrap">
                                                    <div id="dataTable"></div>
                                                    <div class="clear"></div>

                                                </div>
                                            </div>  
                                        </fieldset>
                                    </form>
                                    <div id="dialog">
                                        <div>Edit Dialog</div>
                                        <div style="overflow: hidden;">
                                            <table style="table-layout: fixed; border-style: none;">
                                                <tr>
                                                    <td colspan="2" align="right">
                                                        <br />
                                                        <button id="save">Eliminar</button> <button style="margin-left: 5px;" id="cancel">Cancel</button></td>                    
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="grid_4">
                                <!--/*<div class="indent-left3">
                                    <h3>Datos Generales</h3>
                                    <br>
                                    <span class="color-5">Nombre:</span><br>
                                    <span class="color-5">Saturday: 7:30 am - Noon</span><br>
                                    <p class="indent-bot">Night Drop Available</p>
                                    <figure class="indent-bot">
                                        <iframe width="285" height="185" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Brooklyn,+New+York,+NY,+United+States&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=61.282355,146.513672&amp;ie=UTF8&amp;hq=&amp;hnear=Brooklyn,+Kings,+New+York&amp;ll=40.649974,-73.950005&amp;spn=0.01628,0.025663&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
                                    </figure>
                                    <dl>
                                        <dt>Demolink.org 8901 Marmora Road, Glasgow, D04 89GR.</dt>
                                        <dd><span>Telephone:</span>+1 959 552 5963;</dd>
                                        <dd><span>FAX:</span>+1 959 552 5963</dd>
                                        <dd><span>E-mail:</span><a href="#">mail@demolink.org</a></dd>
                                    </dl>

                                </div>*/-->
                            </article>
                        </div>
                    </div>
                </section>


           
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
            //var aceptar = confirm("Los Datos se Agregaron");
            window.location = 'index.php';
        </script>
        <?php
    }
    ?>
    <script type="text/javascript"> Cufon.now();</script>

</body>
</html>