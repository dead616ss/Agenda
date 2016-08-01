<?php
session_start();
require_once('conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Agenda electronica</title>
        <meta charset="utf-8"/>
        <link rel="icon" type="image/png" href="images/1.png" />
        <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen"/>  
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
        <script type="text/javascript" src="js/jqxcore.js"></script>
        <script type="text/javascript" src="js/jqxcheckbox.js"></script>
        <script type="text/javascript" src="js/jqxbuttons.js"></script>
        <script type="text/javascript" src="js/jqxvalidator.js"></script>
        <script type="text/javascript" src="js/demos.js"></script>

        <style type="text/css">
            .demo-iframe {
                border: none;
                width: 100px;
                height: 200px;
                clear: both;
                display: none;
            }
            .form #password, .form #username {
                height: 24px;
                margin-top: 5px;
                width: 150px;
            }
            .form #rememberme {
                margin-top: 5px;
                margin-bottom: 8px;
            }
            .prompt {
                margin-top: 10px; font-size: 10px;
            } 
        </style>
        <script type="text/javascript">
            $(document).ready(function() {

                $("#username, #password").addClass('jqx-input');

                // add validation rules.
                $('#contact-form').jqxValidator({
                    rules: [
                        {input: '#username', message: 'Debe ingresar el usuario', action: 'keyup, blur', rule: 'required'},
                        {input: '#username', message: 'EL usuario debe iniciar con una letra', action: 'keyup, blur', rule: 'startWithLetter'},
                        {input: '#username', message: 'EL usuario debe tener entre 4 y 20 caractreres', action: 'keyup, blur', rule: 'length=4,20'},
                        {input: '#password', message: 'Contraseña requerida', action: 'keyup, blur', rule: 'required'},
                        {input: '#password', message: 'La contraseña debe tener entre 4 y 12 caracteres', action: 'keyup, blur', rule: 'length=4,12'}
                    ]
                });
                // validate form.
                $("#loginButton").click(function() {
                    $('#contact-form').jqxValidator('validate');
                });

                $("#contact-form").on('validationSuccess', function() {
                    var nomb = $("#username").val();
                    var cont = $("#password").val();                    
                    $.ajax({
                        type: "POST",
                        url: "login.php",
                        data: "username=" + nomb + "&password=" + cont,
                        success: onSuccess
                    }).done(function(msg) {
                        if (msg == 1) {

                        } else {
                            //navigator.notification.alert("Hubo un error en el registro",null,"Error","Aceptar");
                        }
                    });
                    function onSuccess(data) {
                        if(data){
                            window.location='index.php';
                        }else{
			    $("#resp1").val('Usuario o contraseña incorrecta');
                        }
                        
                    }                    
                });
            });

        </script>
    </head>
    <body id="page1">
        <?php
        if (isset($_SESSION['user'])) {
            ?>
            <script language="javascript">
                window.location = 'agenda.php';
            </script>
        <?php } else {
            ?>
            <div class="main">
                <!--==============================header=================================-->
                <header>
                    <div class="container_12">
                        <div class="wrapper p3">
                            <div class="grid_12">
                                <div class="wrapper border-bot"><br/>
                                    <h1><a href="agenda.php"><img src="images/logo1.png" width="270" height="120"/></a></h1>                        
                                </div> 
                            </div>
                        </div>                

                    </div>
                </header>
                <!--==============================content================================-->
                <section id="content"><div class="ic"></div>
                    <div class="container_12">
                        <div class="wrapper">                            
                            <article class="grid_6">
                                <div class="indent-right">
                                    <h3>Iniciar sesion</h3>                                     
                                    <form id="contact-form" >
                                        <fieldset>
                                            <label><span class="text-form">Usuario:</span><input name="username" id='username' type="text"/></label>
                                            <label><span class="text-form">Contraseña:</span><input name="password" id='password' type="password"/></label>
                                            <input type="text" disabled="true" style="width: 200px ; background: #f3f3f3; border-color: #f3f3f3; color: red; " id="resp1"/>
                                            <div class="clear"></div>                                                      
                                        </fieldset>  
                                        <div>
                                            <a class="button" id="loginButton">Iniciar sesion</a>
                                        </div>
                                    </form>
                                    <!--<div class="prompt">¿Olvidaste la contraseña?<a>Recuperar</a></div>-->
                                    <div class="prompt">Obtener una cuenta<a href="registro.php"> registarse</a></div>

                                </div>
                            </article>
                            <article class="grid_6">
                                <div class="indent-left">
                                    <h3>Beneficios</h3>
                                    <div class="wrapper border-bot2 prev-indent-bot">
                                        <strong class="numb">1.</strong>
                                        <div class="extra-wrap">
                                            <span class="color-5">Agendar citas.</span> Las citas son agendadas con el ---, ofreciendo la garantia de que sera atendido en la fecha establecida.
                                        </div>
                                    </div>
                                    <div class="wrapper border-bot2 prev-indent-bot">
                                        <strong class="numb">2.</strong>
                                        <div class="extra-wrap">
                                            <span class="color-5">Directorio telefonico.</span> Acceso a la principal informacion de tus contactos a tarves del directorio .
                                        </div>
                                    </div>
                                    <div class="wrapper p2">
                                        <strong class="numb">3.</strong>
                                        <div class="extra-wrap">
                                            <span class="color-5">Notificaciones.</span> Recibira las principales notificaciones de las citas y contactos.
                                        </div>
                                    </div>                                    
                                </div>
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
        <?php }
        ?>        
    </body>
</html>