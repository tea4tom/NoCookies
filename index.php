<?php
$includeheader = true;
include "assets/php/nocookies.php";
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>noCookies Test Page</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-gem"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>NoCookies</h1>
								<p>A less intrusive implentation of the 'super-cookie' model, using the anonymous device 
								statistical information to recognise a returning visitor. The NoCookies system is designed 
								to be restricted to a single site and replace the reliance on a session type cookie, saved 
								on a users device.</p>
								<span id="sessionprofile" style="display: none;"></span>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="#info">Session Info</a></li>
								<li><a href="#identify">Identify</a></li>
								<li><a href="#about">About</a></li>
								<li><a href="#contact">Contact</a></li>
								<!--<li><a href="#elements">Elements</a></li>-->
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- nonCookie Info provided -->
							<article id="info">
								<h2 class="major">NoCookies_Session:</h2>
								<p>Below is the data structure compiled using this browser / session.</p>
								<span id="debug_object_string">Loading...</span>
							</article>

						<!-- identify and create a non cookie on server -->
							<article id="identify">
								<h2 class="major">Identity</h2>
								<p>Enter an identity tag below and submit it. The server will create a session record online and try to remember you 
								when you return to this page.</p>
								<p>
								<form action="javascript:void()">
									<input type="text" id="profileidstr" value="" /> <button id="updateprofileid">Save</button>
								</form>
								<span id="profile_id_confirmation" style="color: green;"></span>
								</p>
							</article>

						<!-- About -->
							<article id="about">
								<h2 class="major">About</h2>
								<span class="image main"><img src="images/pic03.jpg" alt="" /></span>
								<p>Lorem ipsum dolor sit amet, consectetur et adipiscing elit. Praesent eleifend dignissim arcu, at eleifend sapien imperdiet ac. Aliquam erat volutpat. Praesent urna nisi, fringila lorem et vehicula lacinia quam. Integer sollicitudin mauris nec lorem luctus ultrices. Aliquam libero et malesuada fames ac ante ipsum primis in faucibus. Cras viverra ligula sit amet ex mollis mattis lorem ipsum dolor sit amet.</p>
							</article>

						<!-- Contact -->
							<article id="contact">
								<h2 class="major">Contact</h2>
								<h3 style="color: #c0c0c0">Form Disabled</h3>
								<ul class="icons">
									<li><a href="https://x.com/TheRealTomPoole/" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="https://github.com/tea4tom" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
								</ul>
							</article>

					</div>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; Untitled. Design: <a href="https://html5up.net">HTML5 UP</a>. <canvas id="nclogo" width="200" height="50" style=""></canvas></p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

			<canvas id="glcanvas" width="100" height="100" style="position: absolute; left: -150px; top: 0px;"></canvas>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/md5.js"></script> <!-- NC -->
			<script src="assets/js/main.js"></script>
			<script src="assets/js/webgl/gl-matrix-min.js"></script>
    		<script src="assets/js/webgl/webgl.js"></script>
			<script src="assets/js/fonts-detector.js"></script> <!-- NC -->
			<script src="assets/js/nocookies.js"></script> <!-- NC -->

	</body>
</html>
