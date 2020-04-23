<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0;">
    <meta name="author" content="TeamDesign"/>

    <!--import normalize.css-->
    <link rel="stylesheet" type="text/css" href="/templates/static/css/normalize.css">

    <!--import materialize.css-->
    <link rel="stylesheet" type="text/css" href="/templates/static/css/materialize.min.css"/>

    <!--custom css-->
    <link rel="stylesheet" type="text/css" href="/templates/static/css/main.css"/>

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

<nav class="flex-containery">
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
        <div class="col logoutbtn">
            <a href="/logout" class="waves-effect waves-light btn">Abmelden</a>
        </div>
    </div>
    <!--sidebar-->
    <div id="sidebar" class="sidebar grey darken-4">
        <div class="sidebar_content">
            <!--insert links to quiz -->
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/ayurveda">Ayurveda</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/bekanntheit">Bekanntheitstest</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/thebigfive">Big-Five</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/cooper">Cooper</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/einbuergerung">Einbürgerung</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/lerntyp">Lerntyp</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/liegestuetze">Liegestütze</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/maximisierung">Maximierung</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/risiko">Risiko</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/selfleadership">Self-Leadership</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/socialmedia">Social-Media-Sucht</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/werwirdmillionaer">Wer wird Millionär?</a>
            <a class="hvr-underline-from-left menu-item" onclick="toggleSidebar()" href="/quiz/worklife">Work-Life</a>
            <img class="logoImage" src="/templates/static/img/logo.gif">
            <a onclick="toggleSidebar()" href="#"></a>
        </div>
    </div>
</nav>
<div class="container">
    %%content%%
</div>




<!--import jQuery-->
<script src="/templates/static/js/jquery.min.js"></script>

<!--custom JS-->
<script src="/templates/static/js/script.js"></script>

<!--import materialize.js-->
<script src="/templates/static/js/materialize.js"></script>

<!--dropdown menu-->
<script>
    $('.dropdown-trigger').dropdown();
</script>
<!--scripts-->
</body>
</html>
