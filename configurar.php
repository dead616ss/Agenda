<?php session_start(); ?>
<?php
require_once('conexion.php');
if (isset($_SESSION['user'])) {
    $sql = "SELECT * FROM usuario where user='" . $_SESSION['user'] . "' AND (tipo='user' OR tipo='admin')";
    $consulta = mysql_query($sql);
    $nom = "";
    while ($row = mysql_fetch_array($consulta)) {
        $usuario = $row['user'];
        $nom = $row['name'] . " " . $row['apP'] . " " . $row['apM'];
        $tipo = $row['tipo'];
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
        <script type="text/javascript" src="js/demos.js"></script>
        <script type="text/javascript" src="js/jqxdatatable.js"></script>
        <script type="text/javascript" src="js/jqxinput.js"></script>
        <script type="text/javascript" src="js/jqxcombobox.js"></script>
        <script type="text/javascript" src="js/jqxtooltip.js"></script>

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
                                            <li><a href="agenda.php">Citas</a></li>
                                            <li><a href="directorio.php">Directorio</a></li>   
                                            <?php if ($tipo == 'admin') { ?>
                                                <li><a class="active" href="configurar.php">Configurar</a></li>
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
                <?php if ($tipo == 'admin') { ?>
                    <section id="content"><div class="ic"></div>
                        <div class="container_12">
                            <div class="wrapper">                               
                                <article class="grid_8">
                                    <div class="indent-right">
                                        <h3 class="prev-indent-bot">Configurar horarios</h3>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                llenarFechas();
                                                $("#inicioP1").jqxNumberInput({inputMode: 'simple', rtl: true, width: '150px', height: '20px', spinButtons: true, decimalDigits: 0, symbol: ' hr', symbolPosition: 'right', min: 6, max: 18, value: 9});
                                                $("#finP1").jqxNumberInput({inputMode: 'simple', rtl: true, width: '150px', height: '20px', spinButtons: true, decimalDigits: 0, symbol: ' hr', symbolPosition: 'right', min: 6, max: 18, value: 16});
                                                $("#libre1").jqxNumberInput({inputMode: 'simple', rtl: true, width: '150px', height: '20px', spinButtons: true, decimalDigits: 0, symbol: ' hr', symbolPosition: 'right', min: 6, max: 18, value: 11});

                                                $("#per").click(function() {
                                                    var hI = parseInt($("#inicioP1").val());
                                                    var hF = parseInt($("#finP1").val());
                                                    var hL = $("#libre1").val();
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "configurarP.php",
                                                        data: "HI=" + hI + "&HF=" + hF + "&HL=" + hL,
                                                        success: onSuccess
                                                    });
                                                    function onSuccess(data) {
                                                        if (data) {
                                                            window.location = "configurar.php";
                                                        }
                                                    }
                                                });

                                            });
                                            function llenarFechas() {

                                                $("#horaI").val("<?php
            $sql = "SELECT inicioH FROM fechasAd where tipo=1";
            $consulta = mysql_query($sql, $con);

            while ($row = mysql_fetch_array($consulta)) {
                $inicio = $row['inicioH'];
            }
            echo $inicio;
            ?>");
                                                $("#horaF").val("<?php
            $sql = "SELECT fin FROM fechasAd where tipo=1";
            $consulta = mysql_query($sql, $con);

            while ($row = mysql_fetch_array($consulta)) {
                $fin = $row['fin'];
            }
            echo $fin;
            ?>");
                                                $("#libre").val("<?php
            $sql = "SELECT libre FROM fechasAd where tipo=1";
            $consulta = mysql_query($sql, $con);

            while ($row = mysql_fetch_array($consulta)) {
                $fin = $row['libre'];
            }
            echo $fin;
            ?>");
                                            }
                                        </script>
                                        <br/> 
                                        <h2>Horarios permanentes</h2>
                                        <form id="contact-form">                    
                                            <fieldset>
                                                <label><span class="text-form">Horarios</span><span class="text-form">Anterior</span><span class="text-form">Nueva</span></label> 
                                                <label>
                                                    <span class="text-form">Hora inicial:</span>
                                                    <span class="text-form">
                                                        <input type="text" id="horaI" disabled="true" style="background: #f6f6f6; width: 100px; border-color: #f6f6f6;"/>
                                                    </span>
                                                    <div id='inicioP1'></div>
                                                </label>
                                                <label>
                                                    <span class="text-form">Hora final:</span>
                                                    <span class="text-form">
                                                        <input type="text" id="horaF" disabled="true" style="background: #f6f6f6; width: 100px; border-color: #f6f6f6;"/>
                                                    </span>
                                                    <div id='finP1'></div>
                                                </label>
                                                <label>
                                                    <span class="text-form">Libre:</span>
                                                    <span class="text-form">
                                                        <input type="text" id="libre" disabled="true" style="background: #f6f6f6; width: 100px; border-color: #f6f6f6;"/>
                                                    </span>
                                                    <div id='libre1'></div>
                                                </label>
                                                <div class="wrapper">
                                                    <div class="extra-wrap">                                                    
                                                        <div class="clear"></div>
                                                        <a class="button" id="per">Guardar cambios</a>
                                                    </div>
                                                </div>                    
                                            </fieldset>						
                                        </form>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                var url = "configurarU.php";
                                                var source =
                                                        {
                                                            dataType: "json",
                                                            dataFields: [
                                                                {name: 'idUser', type: 'string'},
                                                                {name: 'Nombre', type: 'string'},
                                                                {name: 'birthDate', type: 'string'},
                                                                {name: 'user', type:'string'},
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
                                                                        url: "configurarEU.php",
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
                                                    $("#dialog").jqxWindow('setTitle', "Que desea hacer ");
                                                    $("#dialog").jqxWindow('open');
                                                    $("#dialog").attr('data-row', row.idUser);
                                                    $("#dataTable").jqxDataTable({disabled: true});

                                                });
                                            });
                                        </script>
                                       

                                        <br/>
                                        <h3 class="prev-indent-bot">Usuarios registrados</h3>
                                        <br/> 
                                        <h2>Horarios permanentes</h2>
                                        Si desea eliminar un usuario debera dar doble clic sobre el ususario
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
                    <?php
                }
                ?>
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
        <script type="text/javascript"> Cufon.now();</script>
    </body>
</html>