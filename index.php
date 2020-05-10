
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Stephan Stofer">

    <title>WEBTEC – HSLU FS19</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="files/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="files/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="files/favicon/favicon-16x16.png">
    <link rel="manifest" href="files/favicon/site.webmanifest">
    <link rel="mask-icon" href="files/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="files/favicon/favicon.ico?v=JykPRebEKe">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato%7CRoboto" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Stylesheets -->

    <link href="files/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body onload="checkCookie()">
<div class="container">
    <!-- Header -->
    <header>
        <div class="site-header">
                <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <div class="row">
                        <div class="col-8">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarList" aria-controls="navbarList" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarList">
                                    <ul class="listmenu">
                                        <li class="nav-item active" data-toggle="collapse" data-target=".navbar-collapse.show">
                                            <a href="#welcome" class="nav-item">Willkommen</a>
                                        </li>
                                        <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
                                            <a href="#canvas" class="nav-item">Canvas</a>
                                        </li>
                                        <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
                                            <a href="#gallery" class="nav-item">Galerie</a>
                                        </li>
                                        <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
                                            <a href="#contact" class="nav-item">Kontakt</a>
                                        </li>
                                        <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
                                           <a href="#imprint" class="nav-item">Impressum</a>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                        <div class="col-4">
                            <div class="float-right switch-control" >
                                <label class="switch">
                                    <input id="styleSwitch" checked type="checkbox" name="styleSwitch" onclick="styleSwitch()">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
                <!-- Navigation END -->
        </div>
    </header>

    <!-- Header END -->

    <!-- Main -->
    <main>
        <div class="block">
            <a class="menuTarget" id="welcome"></a>
            <h1>Willkommen</h1>
            <h3>Diese Seite ist im Rahmen Moduls WEBTEC entstanden.</h3>
            <p>Viel Vergnügen beim betrachten dieser Webseite.</p>
        </div>
            <hr>
        <div class="block">
            <a class="menuTarget" id="canvas"></a>
            <h1>Canvas</h1>
            <p>Dieser Block enthält ein Canvas Objekt. Es werden zufällig Kreise mit unterschiedlichen Grössen und Farben gezeichnet.</p>
            <canvas id="myCanvas">

            </canvas>
        </div>
            <hr>
        <div class="block">
            <a id="gallery"></a>
            <h1>Galerie</h1>
            <p>Schau dir diese schönen Snowboardbilder an!</p>
            <div class="carousel-container">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators" id="indicators">
                    </ol>
                    <div class="carousel-inner" id="galleryItems">
                    </div>
                    <div class="carousel-controls">
                        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="carousel-control right" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="block">
            <?php
            // define variables and set to empty values
            $nameErr = $emailErr = $commentErr= "";
            $name = $email = $comment = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["name"])) {
                    $nameErr = "Bitte gib deinen Namen ein, ich kenne schon viele «Anonymous».";
                } else {
                    $name = test_input($_POST["name"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                        $nameErr = "Es sind nur Buchstaben und Leerzeichen erlaubt";
                    }
                }

                if (empty($_POST["email"])) {
                    $emailErr = "Wir benötigen dein E-Mail Adresse, um dich kontaktieren zu können.";
                } else {
                    $email = test_input($_POST["email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Da hast du dich wohl vertippt, kontrolliere ob du deine Adresse vollständig eingegeben hast.";
                    }
                }

                if (empty($_POST["comment"])) {
                    $commentErr = "Ergänze ein paar Keywords, die dein Anliegen schildern.";
                } else {
                    $comment = test_input($_POST["comment"]);
                }
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
            <a id="contact"></a>
            <h1>Kontaktformular</h1>
            <?php
                if(isset($_POST['contactForm'])&& empty($nameErr . $emailErr . $commentErr)){
                    echo "<p>Herzlichen Dank für deine Nachricht <span class='name'>" . $name . "</span>. Dir wurde soeben deine Nachricht als Kopie zugestellt.</p>";
                    $to = $email;
                    $subject = "Kopie deiner Nachricht";
                    $txt = $comment;
                    $headers = "From: post@multi-abo.ch" . "\r\n" .
                        "Reply-To: stephan.stofer@stud.hslu.ch". "\r\n" .
                        "BCC: stephan.stofer@stud.hslu.ch";

                    mail($to,$subject,$txt,$headers);
                    $name = $comment = $email = "";
                }
                else{
                    echo "<p>Fragen, Anliegen oder einfach Lust zu schreiben? Sende mir eine Nachricht via Formular zu.</p>";
                    echo "<span class='error'>$nameErr</span>";if (!empty($nameErr)) echo "<br/>";
                    echo "<span class='error'>$commentErr</span>";if (!empty($commentErr)) echo "<br/>";
                    echo "<span class='error'>$emailErr</span>";
                }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#contact" class="contactform" id="usrform" method="post">
                <input type="text" name="name" placeholder="Vorname Nachname" value="<?php echo $name;?>">
                <input type="text" name="email" placeholder="E-Mail Adresse"  value="<?php echo $email;?>">
                <textarea name="comment" placeholder="Ihre Nachricht..." form="usrform"><?php echo $comment;?></textarea>
                <input class="submit" type="submit" name="contactForm" value="Absenden" >
            </form>
        </div>
        <hr>

        <div class="block">
            <a id="imprint"></a>
            <h1>Impressum</h1>
            <p>Stephan Stofer<br>
            Chriesiweg 20<br>
            6020 Emmenbrücke</p>
        </div>

    </main>
    <!-- Main END-->

    <!-- Footer -->
    <footer class="site-footer">
        <p class="footertext">© Stofer Stephan, HSLU FS19 – Modul Webtec</p>
    </footer>
    <!-- Footer END -->


</div>

<!-- Cookie Scripting -->

<script>
    function setCookie(cname) {
        var d = new Date();
        d.setTime(d.getTime() + (7*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        if (getCookie("WebTecTheme") === "true") {
            document.cookie = (cname + "=" + "false" + ";path=/");
        }else{
            document.cookie = (cname + "=" + "true;" + expires + ";path=/");
        }
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";

    }

    function checkCookie() {
        if (getCookie("WebTecTheme") === "true") {
            $(".nav-item").toggleClass("style-switch");
            $(".site-header").toggleClass("style-switch-gradient");
            $(".error").toggleClass("styleSwitch");
            $(".name").toggleClass("styleSwitch");
            $("#styleSwitch").prop('checked', false);
        }
    }


    function styleSwitch() {
        $(".nav-item").toggleClass("style-switch");
        $(".site-header").toggleClass("style-switch-gradient");
        $(".error").toggleClass("styleSwitch");
        $(".name").toggleClass("styleSwitch");

        setCookie("WebTecTheme");

    }


</script>


<!-- Canvas Scripting -->
<script>
    // set up initial variables
    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");

    ctx.beginPath();
    ctx.moveTo(Math.fround(Math.random() * 300),Math.floor(Math.random() * 500));
    ctx.lineTo(Math.fround(Math.random() * 300),Math.floor(Math.random() * 600));


    function drawCircle(){
        ctx.beginPath();
        ctx.arc(Math.fround(Math.random() * 600),Math.fround(Math.random() * 300),Math.fround(Math.random() * 50),0,2*Math.PI);
        //ctx.arc(Math.floor(Math.random() * 600),Math.floor(Math.random() * 300),Math.floor(Math.random() * 50),0,2*Math.PI);
        ctx.fillStyle=getRandomColor();
        ctx.fill();
    }
    var x = 0;
    setInterval(function(){
        drawCircle();
        x++;
    }, Math.fround(Math.random() * 120));


    function getRandomColor() {
        var digits = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += digits[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>

<!-- Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Load Gallery Images -->
<script src="files/js/script.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="files/js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>