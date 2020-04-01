<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0;">
    <meta name="author" content="TeamDesign"/>

    <!--custom css-->
    <link rel="stylesheet" type="text/css" href="/templates/static/css/main.css"/>

    <!--import materialize.css-->
    <link rel="stylesheet" type="text/css" href="/templates/static/css/materialize.min.css"/>

    <!--import normalize.css-->
    <link rel="stylesheet" type="text/css" href="/templates/static/css/normalize.css">

    <!--import hover.css-->
    <link rel="stylesheet" type="text/css" href="/templates/static/css/hover-min.css">

    <!--import google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <!--import icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--style-->

    <title>Project:HomeOffice</title>
</head>
<body>

<nav class="flex-container">
    <!--topnav-->
    <div id="topnav" class="row flex-container grey darken-2">
        <!--burger-->
        <div id="burgerIconSection" class="col s1">
            <div id="burger-icon" onclick="toggleSidebar()">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
    </div>
    <!--sidebar-->
    <div id="sidebar" class="sidebar grey darken-4">
        <div class="sidebar_content">
            <!--insert links to quiz -->
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Ayurveda</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Bekanntheitstest</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Big-Five</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Cooper</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Einbürgerung</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Grosszügigkeit</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Händigkeit</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Job</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Lateralisation</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Lerntyp</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Liegestütze</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Lineal</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Maximisierung</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Risiko</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Selbstbewusstsein</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Self-Leadership</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Sit and reach</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Social-Media-Sucht</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Storch</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Temperament</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Vertical Jump</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Wer wird Millionär?</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Work-Life</a>
            <img class="logoImage" src="/templates/static/img/logo.gif">
            <a onclick="toggleSidebar()" href="#"></a>
        </div>
    </div>
</nav>
<div class="container">
    %%content%%
</div>


</body>

<!--import jQuery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

<!--custom JS-->
<script src="/templates/static/js/script.js"></script>

<!--import materialize.js-->
<script src="/templates/static/js/materialize.js"></script>

<!--dropdown menu-->
<script>
    $('.dropdown-trigger').dropdown();
</script>
<!--scripts-->
</html>




