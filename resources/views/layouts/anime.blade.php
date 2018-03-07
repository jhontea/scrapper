<!DOCTYPE HTML>
<!--
	Anime Scrapper
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Anime Scrapper</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		@include('anime.elements.style')
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header">

						<!-- Logo -->
							<h1><a href="{{ asset('/crawler/anime') }}">Anime Scrapper</a></h1>

						<!-- Nav -->
							@include('anime.elements.navbar')
						<!-- Banner -->
                            @include('anime.elements.banner')

						<!-- Intro -->
							@yield('intro')

					</div>
				</div>

			<!-- Main -->
				@yield('main')

			<!-- Footer -->
				@include('anime.elements.footer')

		</div>

		<!-- Scripts -->
			@include('manga.elements.script')
	</body>
</html>