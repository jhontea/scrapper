<!DOCTYPE HTML>
<!--
	Promo Scrapper
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Promo Scrapper</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		@include('promo.elements.style')
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header">

						<!-- Logo -->
							<h1><a href="{{ asset('/crawler/promo') }}">Promo Scrapper</a></h1>

						<!-- Nav -->
							@include('promo.elements.navbar')
						<!-- Banner -->
                            @include('promo.elements.banner')

						<!-- Intro -->
							@yield('intro')

					</div>
				</div>

			<!-- Main -->
				@yield('main')

			<!-- Footer -->
				@include('promo.elements.footer')

		</div>

		<!-- Scripts -->
			@include('promo.elements.script')
	</body>
</html>