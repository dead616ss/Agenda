<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Registro</title>
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
        <script type="text/javascript" src="js/globalize.js"></script> 
        <script type="text/javascript" src="js/jqxcalendar.js"></script> 
        <script type="text/javascript" src="js/jqxdatetimeinput.js"></script> 
        <script type="text/javascript" src="js/jqxmaskedinput.js"></script>         
        <script type="text/javascript" src="js/jqxdata.js"></script>    
        <script type="text/javascript" src="js/jqxscrollbar.js"></script>
        <script type="text/javascript" src="js/jqxlistbox.js"></script>
        <script type="text/javascript" src="js/jqxradiobutton.js"></script>
        <script type="text/javascript" src="js/jqxcombobox.js"></script>
        <script type="text/javascript" src="js/jqxdropdownlist.js"></script>
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

                var date = new Date();
                date.setFullYear(1950, 0, 1);
                $('#birthInput').jqxDateTimeInput({min: new Date(1900, 0, 1), max: new Date(1996, 11, 31), width: 200, height: 20, value: $.jqx._jqxDateTimeInput.getDateTime(date)});

                var source = [
                    "Pelicula favorita",
                    "Nombre de tu primera mascota",
                    "Equipo de futbol",
                    "Personaje de una caricatura"
                ];
                $("#combobox").jqxDropDownList({source: source, selectedIndex: 0, width: '200', height: '20'});

                $('.text-input').addClass('jqx-input');
                $('.text-input').addClass('jqx-rc-all');
                if (theme.length > 0) {
                    $('.text-input').addClass('jqx-input-' + theme);
                    $('.text-input').addClass('jqx-widget-content-' + theme);
                    $('.text-input').addClass('jqx-rc-all-' + theme);
                }
                $("#phoneInput").jqxMaskedInput({mask: '(###)###-####', width: 200, height: 20});
                $("#celphoneInput").jqxMaskedInput({mask: '(###)###-####', width: 200, height: 20});

                $('#contact-form').jqxValidator({
                    rules: [
                        {input: '#name', message: 'Debe ingresar el nombre', action: 'keyup, blur', rule: 'required'},
                        {input: '#name', message: 'El nombre debe tener entre 3 y 20 caracteres', action: 'keyup, blur', rule: 'length=3,20'},
                        {input: '#app', message: 'Debe ingresar el apellido paterno', action: 'keyup, blur', rule: 'required'},
                        {input: '#app', message: 'El apellido debe tener entre 3 y 20 caracteres', action: 'keyup, blur', rule: 'length=3,20'},
                        {input: '#apm', message: 'Debe ingresar el apellido materno', action: 'keyup, blur', rule: 'required'},
                        {input: '#apm', message: 'El apellido debe tener entre 3 y 20 caracteres', action: 'keyup, blur', rule: 'length=3,20'},
                        {input: '#dir', message: 'Ingrese una direccion', action: 'keyup, blur', rule: 'required'},
                        {input: '#dir', message: 'La direccion debe tener mas de 10 caracteres y menos de 50 caracteres', action: 'keyup, blur', rule: 'length=10,50'},
                        {input: '#username', message: 'Debe ingresar el nombre de usuario', action: 'keyup, blur', rule: 'required'},
                        {input: '#username', message: 'El nombre de usuario debe tener entre 3 y 12 caracteres', action: 'keyup, blur', rule: 'length=3,12'},
                        {input: '#passwordInput', message: 'Ingrese contraseña', action: 'keyup, blur', rule: 'required'},
                        {input: '#passwordInput', message: 'Tu contraseña debe tener entr 4 y 12 caracteres', action: 'keyup, blur', rule: 'length=4,12'},
                        {input: '#passwordConfirmInput', message: 'Ingrese contraseña', action: 'keyup, blur', rule: 'required'},
                        {input: '#passwordConfirmInput', message: 'Las contraseñas no coinciden', action: 'keyup, focus', rule: function(input, commit) {
                                if (input.val() === $('#passwordInput').val()) {
                                    return true;
                                }
                                return false;
                            }
                        },
                        {input: '#emailInput', message: 'Ingrese el e-mail', action: 'keyup, blur', rule: 'required'},
                        {input: '#emailInput', message: 'e-mail invalido', action: 'keyup', rule: 'email'},
                        {input: '#phoneInput', message: 'Telefono invalido', action: 'valuechanged, blur', rule: 'phone'},
                        {input: '#celphoneInput', message: 'Celular invalido', action: 'valuechanged, blur', rule: 'phone'},
                        {input: '#res', message: 'Debe ingresar una respuesta', action: 'keyup, blur', rule: 'required'},
                        {input: '#res', message: 'La respuesta debe tener entre 3 y 12 caracteres', action: 'keyup, blur', rule: 'length=3,12'}]
                });

                // validate form.
                $("#sendButton").click(function() {
                    var validationResult = function(isValid) {
                        if (isValid) {
                            //$("#contact-form").submit();
                        }
                    }
                    $('#contact-form').jqxValidator('validate', validationResult);
                });

                $("#contact-form").on('validationSuccess', function() {
                    llenar();
                    //alert(date);
                });

            });
            
            function llenar(){
                var name=$("#name").val();
                    var app=$("#app").val();
                    var apm=$("#apm").val();
                    var date = $('#birthInput').val();
                    var dir=$("#dir").val();
                    var username=$("#username").val();
                    var password=$("#passwordInput").val();
                    var email=$("#emailInput").val();
                    var site=$("#site").val();
                    var phone=$("#phoneInput").val();
                    var celphone=$("#celphoneInput").val();
                    var oficio=$("#oficio").val();
                    var preg=$("#combobox").val();
                    var res=$("#res").val();
                    $.ajax({
                        type: "POST",
                        url: "registroN.php",
                        data: "name=" + name + "&app=" + app +"&apm=" + apm +"&birthdate=" + date
                                +"&dir=" + dir +"&username=" + username +"&passwordInput=" + password +
                                "&emailInput=" + email +"&site=" + site +"&phone=" + phone +
                                "&celphone=" + celphone +"&oficio=" + oficio +"&combobox=" + preg+ "&res=" + res+"&client="+"user",
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
                            $("#resp").val("El usuario ya existe");
                        }                       
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
            <script language="javascript">
                //var aceptar = confirm("Los Datos se Agregaron");
                window.location = 'index.php';
            </script>
            <?php
        } else {
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
                            <article class="grid_8">                                
                                <div class="indent-right">                                    
                                    <h3 class="prev-indent-bot">Registro</h3>
                                    <form id="contact-form">
                                        <td><label><span class="text-form">Nombre:<span class="required">*</span></span><input name="name" id='name' type="text" onkeypress="return soloLetras(event)"/></label></td>
                                        <label><span class="text-form">Apellido  paterno:<span class="required">*</span></span></span><input name="app" id='app' type="text" onkeypress="return soloLetras(event)"/></label>                                        
                                        <label> <span class="text-form">Apellido  materno:<span class="required">*</span></span></span><input name="apm" id='apm' type="text" onkeypress="return soloLetras(event)"/></label>
                                        <label> <span class="text-form">Fecha de nacimiento:<span class="required">*</span></span></span><div name="birthdate" id="birthInput"></div></label>
                                        <label><span class="text-form">Direccion:<span class="required">*</span></span><input name="dir" id='dir' type="text"/></label>
                                        <label><span class="text-form">Usuario:<span class="required">*</span></span></span><input name="username" id='username' type="text"/></label>
                                        <label><span class="text-form">Contraseña:<span class="required">*</span></span></span><input name="passwordInput" id='passwordInput' type="password"/></label>
                                        <label><span class="text-form">Repetir contraseña:<span class="required">*</span></span></span><input name="passwordConfirmInput" id='passwordConfirmInput' type="password"/></label>
                                        <label><span class="text-form">Email:<span class="required">*</span></span></span><input name="emailInput" id='emailInput' type="text"/></label>
                                        <label><span class="text-form">Pagina web:</span><input name="site" id='site' type="text"/></label>
                                        <label><span class="text-form">Telefono:<span class="required">*</span></span><div name="phone" id="phoneInput"></div></label>
                                        <label><span class="text-form">Celular:<span class="required">*</span></span><div name="celphone" id="celphoneInput"></div></label>
                                        <label><span class="text-form">Oficio:</span><input name="oficio" id='oficio' type="text" onkeypress="return soloLetras(event)"/></label>
                                        <label><span class="text-form">Pregunta:<span class="required">*</span></span>
                                            <div id='combobox' name="combobox"></div>
                                        </label>
                                        <label><span class="text-form">Respuesta:<span class="required">*</span></span></span><input name="res" id='res' type="text"/></label>  
                                        <label>
                                            <input type="text" disabled="true" style="width: 200px ; background: #f3f3f3; border-color: #f3f3f3; color: red; " id="resp"/>
                                        </label>
                                        <label>
                                            <a class="button" id="sendButton">Registrarse</a>
                                        </label>
                                    </form>
                                    <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe>
                                </div>
                            </article>
                        </div>
                        <div id="ress"></div>
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
        }
        ?>        

        <script type="text/javascript"> Cufon.now();</script>
    </body>
</html>
