<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>Book Store {{$title}}</title>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="format-detection" content="telephone=no">
	    <meta name="apple-mobile-web-app-capable" content="yes">
	    <meta name="author" content="">
	    <meta name="keywords" content="">
	    <meta name="description" content="">

	    <link rel="stylesheet" type="text/css" href="{{asset('dist/css/normalize.css')}}">
	    <link rel="stylesheet" type="text/css" href="{{asset('dist/css/vendor.css')}}">
	    <link rel="stylesheet" type="text/css" href="{{asset('dist/css/style.css')}}">
	    <link rel="stylesheet" type="text/css" href="{{asset('plugins/icomoon/icomoon.css')}}">
	    

		<!-- script
		================================================== -->
		<script src="{{asset('dist/js/modernizr.js')}}"></script>

	</head>

<body>

<div id="header-wrap"> 

	
	<div class="top-content">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="social-links">
						<ul>
							<li>
								<a href="#"><i class="icon icon-facebook"></i></a>
							</li>
							<li>
								<a href="#"><i class="icon icon-twitter"></i></a>
							</li>
							<li>
								<a href="#"><i class="icon icon-youtube-play"></i></a>
							</li>
							<li>
								<a href="#"><i class="icon icon-behance-square"></i></a>
							</li>
						</ul>
					</div><!--social-links-->
				</div>
				<div class="col-md-6">
					<div class="right-element">
						<a href="#" class="user-account for-buy"><i class="icon icon-user"></i><span>Account</span></a>
						<a href="#" class="cart for-buy"><i class="icon icon-clipboard"></i><span>Cart:(0 $)</span></a>

						<div class="action-menu">

							<div class="search-bar">
								<a href="#" class="search-button search-toggle" data-selector="#header-wrap">
									<i class="icon icon-search"></i>
								</a>
								<form role="search" method="get" class="search-box">
									<input class="search-field text search-input" placeholder="Search" type="search">
								</form>
							</div>
						</div>

					</div><!--top-right-->
				</div>
				
			</div>
		</div>
	</div><!--top-content-->

	<header id="header">
		<div class="container">
			<div class="row">

				<div class="col-md-2">
					<div class="main-logo">
						<a href="index.html"><img src="images/main-logo.png" alt="logo"></a>
					</div>

				</div>

				<div class="col-md-10">
					
					<nav id="navbar">
						<div class="main-menu stellarnav">
							<ul class="menu-list">
								<li class="menu-item active"><a href="#home" data-effect="Home">Home</a></li>
								<li class="menu-item"><a href="#about" class="nav-link" data-effect="About">About</a></li>
								<li class="menu-item has-sub">
									<a href="#pages" class="nav-link" data-effect="Pages">Pages</a>

									<ul>
								        <li class="active"><a href="index.html">Home</a></li>
								        <li><a href="about.html">About</a></li>
								        <li><a href="styles.html">Styles</a></li>
								        <li><a href="blog.html">Blog</a></li>
								        <li><a href="single-post.html">Post Single</a></li>
								        <li><a href="shop.html">Our Store</a></li>
								        <li><a href="single-product.html">Product Single</a></li>
								        <li><a href="contact.html">Contact</a></li>
								        <li><a href="thank-you.html">Thank You</a></li>
								     </ul>

								</li>
								<li class="menu-item"><a href="#popular-books" class="nav-link" data-effect="Shop">Shop</a></li>
								<li class="menu-item"><a href="#latest-blog" class="nav-link" data-effect="Articles">Articles</a></li>
								<li class="menu-item"><a href="#contact" class="nav-link" data-effect="Contact">Contact</a></li>
							</ul>

							<div class="hamburger">
				                <span class="bar"></span>
				                <span class="bar"></span>
				                <span class="bar"></span>
				            </div>

						</div>
					</nav>

				</div>

			</div>
		</div>
	</header>
		
</div><!--header-wrap-->

<section id="billboard">

	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<button class="prev slick-arrow">
					<i class="icon icon-arrow-left"></i>
				</button>

				<div class="main-slider pattern-overlay">
					<div class="slider-item">
						<div class="banner-content">
							<h2 class="banner-title">Life of the Wild</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero ipsum enim pharetra hac. Urna commodo, lacus ut magna velit eleifend. Amet, quis urna, a eu.</p>
							<div class="btn-wrap">
								<a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More<i class="icon icon-ns-arrow-right"></i></a>
							</div>
						</div><!--banner-content--> 
						<img src="images/main-banner1.jpg" alt="banner" class="banner-image">
					</div><!--slider-item-->

					<div class="slider-item">
						<div class="banner-content">
							<h2 class="banner-title">Birds gonna be Happy</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero ipsum enim pharetra hac. Urna commodo, lacus ut magna velit eleifend. Amet, quis urna, a eu.</p>
							<div class="btn-wrap">
								<a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More<i class="icon icon-ns-arrow-right"></i></a>
							</div>
						</div><!--banner-content--> 
						<img src="images/main-banner2.jpg" alt="banner" class="banner-image">
					</div><!--slider-item-->

				</div><!--slider-->
					
				<button class="next slick-arrow">
					<i class="icon icon-arrow-right"></i>
				</button>
				
			</div>
		</div>
	</div>
	
</section>
{{$slot}}

<section id="download-app" class="leaf-pattern-overlay">
	<div class="corner-pattern-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="row">

						<div class="col-md-5">
							<figure>
								<img src="images/device.png" alt="phone" class="single-image">
							</figure>
						</div>

						<div class="col-md-7">
							<div class="app-info">
								<h2 class="section-title divider">Download our app now !</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus liberolectus nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna. Adipiscing fames semper erat ac in suspendisse iaculis.</p>
								<div class="google-app">
									<img src="images/google-play.jpg" alt="google play">
									<img src="images/app-store.jpg" alt="app store">
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
</section>

<footer id="footer">
	<div class="container">
		<div class="row">

			<div class="col-md-4">
				
				<div class="footer-item">
					<div class="company-brand">
						<img src="images/main-logo.png" alt="logo" class="footer-logo">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus liberolectus nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna. Adipiscing fames semper erat ac in suspendisse iaculis.</p>
					</div>
				</div>
				
			</div>

			<div class="col-md-2">

				<div class="footer-menu">
					<h5>About Us</h5>
					<ul class="menu-list">
						<li class="menu-item">
							<a href="#">vision</a>
						</li>
						<li class="menu-item">
							<a href="#">articles </a>
						</li>
						<li class="menu-item">
							<a href="#">careers</a>
						</li>
						<li class="menu-item">
							<a href="#">service terms</a>
						</li>
						<li class="menu-item">
							<a href="#">donate</a>
						</li>
					</ul>
				</div>

			</div>
			<div class="col-md-2">

				<div class="footer-menu">
					<h5>Discover</h5>
					<ul class="menu-list">
						<li class="menu-item">
							<a href="#">Home</a>
						</li>
						<li class="menu-item">
							<a href="#">Books</a>
						</li>
						<li class="menu-item">
							<a href="#">Authors</a>
						</li>
						<li class="menu-item">
							<a href="#">Subjects</a>
						</li>
						<li class="menu-item">
							<a href="#">Advanced Search</a>
						</li>
					</ul>
				</div>

			</div>
			<div class="col-md-2">

				<div class="footer-menu">
					<h5>My account</h5>
					<ul class="menu-list">
						<li class="menu-item">
							<a href="#">Sign In</a>
						</li>
						<li class="menu-item">
							<a href="#">View Cart</a>
						</li>
						<li class="menu-item">
							<a href="#">My Wishtlist</a>
						</li>
						<li class="menu-item">
							<a href="#">Track My Order</a>
						</li>
					</ul>
				</div>

			</div>
			<div class="col-md-2">

				<div class="footer-menu">
					<h5>Help</h5>
					<ul class="menu-list">
						<li class="menu-item">
							<a href="#">Help center</a>
						</li>
						<li class="menu-item">
							<a href="#">Report a problem</a>
						</li>
						<li class="menu-item">
							<a href="#">Suggesting edits</a>
						</li>
						<li class="menu-item">
							<a href="#">Contact us</a>
						</li>
					</ul>
				</div>

			</div>

		</div>
		<!-- / row -->

	</div>
</footer>

<div id="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="copyright">
					<div class="row">

						<div class="col-md-6">
							<p>© 2022 All rights reserved. Free HTML Template by <a href="https://www.templatesjungle.com/" target="_blank">TemplatesJungle</a></p>
						</div>

						<div class="col-md-6">
							<div class="social-links align-right">
								<ul>
									<li>
										<a href="#"><i class="icon icon-facebook"></i></a>
									</li>
									<li>
										<a href="#"><i class="icon icon-twitter"></i></a>
									</li>
									<li>
										<a href="#"><i class="icon icon-youtube-play"></i></a>
									</li>
									<li>
										<a href="#"><i class="icon icon-behance-square"></i></a>
									</li>
								</ul>
							</div>
						</div>

					</div>
				</div><!--grid-->

			</div><!--footer-bottom-content-->
		</div>
	</div>
</div>

<script src="{{asset('dist/js/jquery-1.11.0.min.js')}}"></script>
<script src="{{asset('dist/js/plugins.js')}}"></script>
<script src="{{asset('dist/js/script.js')}}"></script>
 

</body>
</html>	