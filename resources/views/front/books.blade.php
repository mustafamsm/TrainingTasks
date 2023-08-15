<x-front title="home">
    <div class="container">
		<div class="row">
			<div class="col-md-12">

			<div class="section-header align-center">
				<div class="title">
					<span>Some quality items</span>
				</div>
				<h2 class="section-title">All Books</h2>
			</div>

			<div class="product-list" data-aos="fade-up">
				<div class="row">
					@foreach ($books as $book)
						
					<div class="col-md-3">
						<figure class="product-style">
							<img src="{{asset('storage//book-images/'.$book->image)}}" alt="Books" class="product-item">
								<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							<figcaption>
								<h3>{{$book->name}}</h3>
								<p>{{$book->author}}</p>
								<div class="item-price">${{number_format($book->price,2)}}</div>
							</figcaption>
						</figure>
					</div>
					@endforeach
				
 
			    </div><!--ft-books-slider-->				
			</div><!--grid-->


			</div><!--inner-content-->
		</div>
		
		 
	</div>
	
</x-front>


