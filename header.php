<!DOCTYPE HTML>

<html lang="fr">

<head>
  <title>Open de bloc 2015</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="Open de bloc de Grenoble 2015" />
  <meta name="keywords" content="escalade, compétition, bloc, grenoble, caf fontaine" />
  <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
  <script src="js/jquery.min.js"></script>
  <script src="js/compressed/index.js"></script>
  <script src="js/skel.min.js"></script>
  <script src="js/skel-layers.min.js"></script>
  <script src="js/init.js"></script>
  <noscript>
    <link rel="stylesheet" href="css/skel.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style-xlarge.css" />
  </noscript>
  <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
  <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="images/icons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="images/icons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="images/icons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="images/icons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="images/icons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="images/icons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="images/icons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="images/icons/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="images/icons/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="images/icons/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/icons/favicon-16x16.png">
  <link rel="manifest" href="images/icons/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="images/icons/ms-icon-144x144.png">


  <!-- Open graph -->
  <meta property="og:title" content="Open de bloc Grenoble 2015" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="http://www.openblocgrenoble.fr" />
  <meta property="og:image" content="http://www.openblocgrenoble.fr/images/open-bloc-2015.jpg" />

  <!-- Add fancyBox main JS and CSS files -->
  <script type="text/javascript" src="js/compressed/fancybox.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />

  <script type="text/javascript">
  $(document).ready(function() {

    // Set custom style, close if clicked, change title type and overlay color
    $(".fancybox-effects-c").fancybox({
      closeClick : true,

      openEffect : 'none',

      helpers : {
        title : {
          type : 'inside'
        },
        overlay : {
          css : {
            'background' : 'rgba(238,238,238,0.85)'
          }
        }
      }
    });
  });
  </script>

</head>
<body class="landing">
  <?php include_once("analyticstracking.php") ?>

  <!-- Header -->
  <header id="header" class="alt skel-layers-fixed">
    <h1>
      <a href="index.php">Open de bloc Grenoble 2015</a>
      <span>&nbsp;&nbsp;par le&nbsp;&nbsp;</span>
      <a href="http://fontaine-en-montagne.ffcam.fr" target="_blank">CAF Fontaine
        <span>
          <img src="images/logos/caf-fontaine.png" alt="CAF Fontaine" height="40" />
        </span>
      </a>
    </h1>
    <nav id="nav">
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="program.php">Déroulement</a></li>
        <li><a href="registration.php">Inscription</a></li>
        <li><a href="benevoles.php">Bénévoles</a></li>
        <li><a href="media.php">Media</a></li>
        <li><a href="results.php">Résultats</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
  </header>
