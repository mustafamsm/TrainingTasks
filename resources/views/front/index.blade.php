<x-front title="home">

    <section id="client-holder" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="logo-wrap">
                        <div class="grid">
                            <a href="#"><img src="{{ asset('dist/images/client-image1.png') }}"alt="client"></a>
                            <a href="#"><img src="{{ asset('dist/images/client-image2.png') }}"
                                    alt="client"></a>
                            <a href="#"><img src="{{ asset('dist/images/client-image3.png') }}"
                                    alt="client"></a>
                            <a href="#"><img src="{{ asset('dist/images/client-image4.png') }}"
                                    alt="client"></a>
                            <a href="#"><img src="{{ asset('dist/images/client-image5.png') }}"
                                    alt="client"></a>
                        </div>
                    </div><!--image-holder-->
                </div>
            </div>
        </div>
    </section>

    <section id="featured-books">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header align-center">
                        <div class="title">
                            <span>Some quality items</span>
                        </div>
                        <h2 class="section-title">Featured Books</h2>
                    </div>

                    <div class="product-list" data-aos="fade-up">
                        <div class="row">
                            @foreach ($books as $book)
                                <div class="col-md-3">
                                    <figure class="product-style">
                                        <img src="{{ asset('storage//book-images/' . $book->image) }}" alt="Books"
                                            class="product-item">
                                        <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add
                                            to Cart</button>
                                        <figcaption>
                                            <h3>{{ $book->name }}</h3>
                                            <p>{{ $book->author }}</p>
                                            <div class="item-price">${{ number_format($book->price, 2) }}</div>
                                        </figcaption>
                                    </figure>
                                </div>
                            @endforeach


                        </div><!--ft-books-slider-->
                    </div><!--grid-->


                </div><!--inner-content-->
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="btn-wrap align-right">
                        <a href="{{ route('books') }}" class="btn-accent-arrow">View all products <i
                                class="icon icon-ns-arrow-right"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="popular-books" class="bookshelf">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header align-center">
                        <div class="title">
                            <span>Some quality items</span>
                        </div>
                        <h2 class="section-title">Popular Books</h2>
                    </div>

                    <ul class="tabs">

                        @foreach ($categorys as $category)
                            <li data-tab-target="#{{Str::slug($category->name)}}" class="tab">{{ $category->name }}</li>
                        @endforeach

                    </ul>

                    <div class="tab-content">
						@foreach ($categorys as $category)
                        <div id="{{Str::slug($category->name)}}" data-tab-content class="{{ $loop->first ? 'active' : '' }}">
                            <div class="row">
								 
								@foreach ($category->books as $book )								
                                <div class="col-md-3">
                                    <figure class="product-style">
                                        <img src="{{asset('storage/book-images/'.$book->image)}}" alt="Books" class="product-item">
                                        <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add
                                            to Cart</button>
                                        <figcaption>
                                            <h3>{{$book->name}}</h3>
                                            <p>{{$book->author}}</p>
                                            <div class="item-price">$ {{number_format($book->price,2)}}</div>
                                        </figcaption>
                                    </figure>
                                </div>

								@endforeach

                              

                            </div>
                        </div>
						@endforeach


                    </div>

                </div><!--inner-tabs-->

            </div>
        </div>
    </section>
    {{-- <section id="best-selling" class="leaf-pattern-overlay">
	<div class="corner-pattern-overlay"></div>
	<div class="container">
		<div class="row">

			<div class="col-md-8 col-md-offset-2">

				<div class="row">

					<div class="col-md-6">
						<figure class="products-thumb">
							<img src="images/single-image.jpg" alt="book" class="single-image">
						</figure>	
					</div>

					<div class="col-md-6">
						<div class="product-entry">
							<h2 class="section-title divider">Best Selling Book</h2>

							<div class="products-content">
								<div class="author-name">By Timbur Hood</div>
								<h3 class="item-title">Birds gonna be happy</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero ipsum enim pharetra hac.</p>
								<div class="item-price">$ 45.00</div>
								<div class="btn-wrap">
									<a href="#" class="btn-accent-arrow">shop it now <i class="icon icon-ns-arrow-right"></i></a>
								</div>
							</div>

						</div>
					</div>

				</div>
				<!-- / row -->

			</div>

		</div>
	</div>
</section>



<section id="quotation" class="align-center">
	<div class="inner-content">
		<h2 class="section-title divider">Quote of the day</h2>
		<blockquote data-aos="fade-up">
			<q>“The more that you read, the more things you will know. The more that you learn, the more places you’ll go.”</q>
			<div class="author-name">Dr. Seuss</div>			
		</blockquote>
	</div>		
</section>

<section id="special-offer" class="bookshelf">

	<div class="section-header align-center">
		<div class="title">
			<span>Grab your opportunity</span>
		</div>
		<h2 class="section-title">Books with offer</h2>
	</div>

	<div class="container">
		<div class="row">
			<div class="inner-content">	
				<div class="product-list" data-aos="fade-up">
					<div class="grid product-grid">				
						<figure class="product-style">
							<img src="images/product-item5.jpg" alt="Books" class="product-item">
							<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							<figcaption>
								<h3>Simple way of piece life</h3>
								<p>Armor Ramsey</p>
								<div class="item-price">
								<span class="prev-price">$ 50.00</span>$ 40.00</div>
							</figcaption>
						</figure>
					
						<figure class="product-style">
							<img src="images/product-item6.jpg" alt="Books" class="product-item">
							<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							<figcaption>
								<h3>Great travel at desert</h3>
								<p>Sanchit Howdy</p>
								<div class="item-price">
								<span class="prev-price">$ 30.00</span>$ 38.00</div>
							</figcaption>
						</figure>
					
						<figure class="product-style">
							<img src="images/product-item7.jpg" alt="Books" class="product-item">
							<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							<figcaption>
								<h3>The lady beauty Scarlett</h3>
								<p>Arthur Doyle</p>
								<div class="item-price">
								<span class="prev-price">$ 35.00</span>$ 45.00</div>
							</figcaption>
						</figure>
					
						<figure class="product-style">
							<img src="images/product-item8.jpg" alt="Books" class="product-item">
							<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							<figcaption>
								<h3>Once upon a time</h3>
								<p>Klien Marry</p>
								<div class="item-price">
								<span class="prev-price">$ 25.00</span>$ 35.00</div>
							</figcaption>
						</figure>

						<figure class="product-style">
							<img src="images/product-item2.jpg" alt="Books" class="product-item">
							<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							<figcaption>
								<h3>Simple way of piece life</h3>
								<p>Armor Ramsey</p>
								<div class="item-price">$ 40.00</div>
							</figcaption>
						</figure>					
					</div><!--grid-->
				</div>
			</div><!--inner-content-->
		</div>
	</div>
</section>

<section id="subscribe">
	<div class="container">
		<div class="row">

			<div class="col-md-8 col-md-offset-2">
				<div class="row">

					<div class="col-md-6">

						<div class="title-element">
							<h2 class="section-title divider">Subscribe to our newsletter</h2>
						</div>

					</div>
					<div class="col-md-6">

						<div class="subscribe-content" data-aos="fade-up">
							<p>Sed eu feugiat amet, libero ipsum enim pharetra hac dolor sit amet, consectetur. Elit adipiscing enim pharetra hac.</p>
							<form id="form">
								<input type="text" name="email" placeholder="Enter your email addresss here">
								<button class="btn-subscribe">
									<span>send</span> 
									<i class="icon icon-send"></i>
								</button>
							</form>
						</div>

					</div>
					
				</div>
			</div>
			
		</div>
	</div>
</section>

<section id="latest-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="section-header align-center">
					<div class="title">
						<span>Read our articles</span>
					</div>
					<h2 class="section-title">Latest Articles</h2>
				</div>

				<div class="row">

					<div class="col-md-4">

						<article class="column" data-aos="fade-up">

							<figure>
								<a href="#" class="image-hvr-effect">
									<img src="images/post-img1.jpg" alt="post" class="post-image">			
								</a>
							</figure>

							<div class="post-item">	
								<div class="meta-date">Mar 30, 2021</div>			
							    <h3><a href="#">Reading books always makes the moments happy</a></h3>

							    <div class="links-element">
								    <div class="categories">inspiration</div>
								    <div class="social-links">
										<ul>
											<li>
												<a href="#"><i class="icon icon-facebook"></i></a>
											</li>
											<li>
												<a href="#"><i class="icon icon-twitter"></i></a>
											</li>
											<li>
												<a href="#"><i class="icon icon-behance-square"></i></a>
											</li>
										</ul>
									</div>
								</div><!--links-element-->

							</div>
						</article>
						
					</div>
					<div class="col-md-4">

						<article class="column" data-aos="fade-down">
							<figure>
								<a href="#" class="image-hvr-effect">
									<img src="images/post-img2.jpg" alt="post" class="post-image">
								</a>
							</figure>
							<div class="post-item">	
								<div class="meta-date">Mar 29, 2021</div>			
							    <h3><a href="#">Reading books always makes the moments happy</a></h3>

							    <div class="links-element">
								    <div class="categories">inspiration</div>
								    <div class="social-links">
										<ul>
											<li>
												<a href="#"><i class="icon icon-facebook"></i></a>
											</li>
											<li>
												<a href="#"><i class="icon icon-twitter"></i></a>
											</li>
											<li>
												<a href="#"><i class="icon icon-behance-square"></i></a>
											</li>
										</ul>
									</div>
								</div><!--links-element-->

							</div>
						</article>
						
					</div>
					<div class="col-md-4">

						<article class="column" data-aos="fade-up">
							<figure>
								<a href="#" class="image-hvr-effect">
									<img src="images/post-img3.jpg" alt="post" class="post-image">
								</a>
							</figure>
							<div class="post-item">		
								<div class="meta-date">Feb 27, 2021</div>			
							    <h3><a href="#">Reading books always makes the moments happy</a></h3>

							    <div class="links-element">
								    <div class="categories">inspiration</div>
								    <div class="social-links">
										<ul>
											<li>
												<a href="#"><i class="icon icon-facebook"></i></a>
											</li>
											<li>
												<a href="#"><i class="icon icon-twitter"></i></a>
											</li>
											<li>
												<a href="#"><i class="icon icon-behance-square"></i></a>
											</li>
										</ul>
									</div>
								</div><!--links-element-->

							</div>
						</article>
						
					</div>

				</div>

				<div class="row">

					<div class="btn-wrap align-center">
						<a href="#" class="btn btn-outline-accent btn-accent-arrow" tabindex="0">Read All Articles<i class="icon icon-ns-arrow-right"></i></a>
					</div>
				</div>

			</div>	
		</div>
	</div>
</section>  --}}

</x-front>
