<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>HomeOffice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/templates/static/css/materialize.min.css">
    <!--style-->
</head>
<body>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0;">
    <meta name="author" content="TeamDesign"/>

    <!--custom css-->
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>

    <!--import materialize.css-->
    <link rel="stylesheet" type="text/css" href="../css/materialize.min.css"/>

    <!--import normalize.css-->
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">

    <!--import hover.css-->
    <link rel="stylesheet" type="text/css" href="../css/hover-min.css">

    <!--import google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <!--import icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Project:HomeOffice - Auswertung</title>
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
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Lerntyp</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Liegestütze</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Maximisierung</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Risiko</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Self-Leadership</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Social Media süchtig?</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Wer wird Millionär?</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="#">Work-Life</a>
            <img class="logoImage" src="../img/logo.gif">
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
<script src="../js/script.js"></script>

<!--import materialize.js-->
<script src="../js/materialize.js"></script>

<!--dropdown menu-->
<script>
    $('.dropdown-trigger').dropdown();
</script>
<!--scripts-->
</html>




