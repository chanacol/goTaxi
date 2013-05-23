<?php
$html = array();
$html[0] = '<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>GoTaxi</title>
    <meta name="description" content="">
    <meta name="author" content="Grethel Bello Cagnant">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="cleartype" content="on">

    <!-- iPhone -->
    <link href="http://cdn.tapquo.com/lungo/icon-57.png" sizes="57x57" rel="apple-touch-icon">
    <link href="http://cdn.tapquo.com/lungo/startup-image-320x460.png" media="(device-width: 320px) and (device-height: 480px)
             and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">

    <!-- iPhone (Retina) -->
    <link href="http://cdn.tapquo.com/lungo/icon-114.png" sizes="114x114" rel="apple-touch-icon">
    <link href="http://cdn.tapquo.com/lungo/startup-image-640x920.png" media="(device-width: 320px) and (device-height: 480px)
             and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

    <!-- iPhone 5 -->
    <link href="http://cdn.tapquo.com/lungo/startup-image-640x1096.png" media="(device-width: 320px) and (device-height: 568px)
             and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

    <!-- iPad -->
    <link href="http://cdn.tapquo.com/lungo/icon-72.png" sizes="72x72" rel="apple-touch-icon">
    <link href="http://cdn.tapquo.com/lungo/startup-image-768x1004.png" media="(device-width: 768px) and (device-height: 1024px)
             and (orientation: portrait)
             and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">
    <link href="http://cdn.tapquo.com/lungo/startup-image-748x1024.png" media="(device-width: 768px) and (device-height: 1024px)
             and (orientation: landscape)
             and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">

    <!-- iPad (Retina) -->
    <link href="http://cdn.tapquo.com/lungo/icon-144.png" sizes="144x144" rel="apple-touch-icon">
    <link href="http://cdn.tapquo.com/lungo/startup-image-1536x2008.png" media="(device-width: 768px) and (device-height: 1024px)
             and (orientation: portrait)
             and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
    <link href="http://cdn.tapquo.com/lungo/startup-image-1496x2048.png" media="(device-width: 768px) and (device-height: 1024px)
             and (orientation: landscape)
             and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="components/lungo.css">
    <link rel="stylesheet" href="components/lungo.icon.css">
    <link rel="stylesheet" href="components/lungo.icon.brand.css">
    <link rel="stylesheet" href="components/lungo.css">
    <link rel="stylesheet" href="components/theme.lungo.css">
    <link rel="stylesheet" href="components/myStyle.css">
	<!--[if lte IE 8]>
     <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.ie.css" />
 <![endif]-->
</head>
<body class="app">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=147762038580096";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, "script", "facebook-jssdk"));</script>
	<!--div class="header"></div-->
	<script>
	  (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,"script","//www.google-analytics.com/analytics.js","ga");
	
	  ga("create", "UA-41140215-1", "comeze.com");
	  ga("send", "pageview");

	</script>';
$html[1] = '<!-- Lungo - Dependencies -->
    <script src="components/quo.js"></script>
    <script src="components/lungo.js"></script>
	<!-- Lungo - Sandbox App -->
    <script>
        Lungo.init({
            name: "GoTaxi",
		});
    </script>
</body>
</html>';
$mensajes = array();
$mensajes['datos'] = array();
$mensajes['error'] = array();
$mensajes['page'] = './login.php';
include('./BD.php');
?>