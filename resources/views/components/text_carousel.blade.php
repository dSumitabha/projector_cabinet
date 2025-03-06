  <div id="carouselExampleSlidesOnly" class="carousel slide " data-bs-ride="carousel" data-bs-interval="2500">
   <div class="carousel-inner">
        @foreach (App\Models\HeaderNavigation::all() as $headerText)
            <div class="carousel-item @if($loop->first) active @endif">
                <!-- Display each title from the HeaderNavigation model -->
                <p>{{ $headerText->title }}</p>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
