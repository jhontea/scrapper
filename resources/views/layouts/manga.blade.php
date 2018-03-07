<!DOCTYPE HTML>
<!--
	Manga Scrapper
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Manga Scrapper</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		@include('manga.elements.style')
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header">

						<!-- Logo -->
							<h1><a href="{{ asset('/crawler/manga') }}">Manga Scrapper</a></h1>

						<!-- Nav -->
							@include('manga.elements.navbar')
						<!-- Banner -->
                            @include('manga.elements.banner')

						<!-- Intro -->
							@yield('intro')

					</div>
				</div>

			<!-- Main -->
				@yield('main')

			<!-- Footer -->
				@include('manga.elements.footer')

		</div>

		<!-- Scripts -->
			@include('manga.elements.script')
	</body>
</html>