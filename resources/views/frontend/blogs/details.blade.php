@extends('frontend.layouts.master')

@section('content')
<style>
    .ec-blog-main-img {
    overflow: hidden;

}
.ec-blog-date {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex
;
    padding: 5px 0 0px 0;
}
.ec-blog-date .date {
    margin-top: 15px;
    margin-bottom: 15px;
}
.ec-blog-detail .ec-blog-title {
    font-family: "Montserrat";
    font-weight: 600;
    font-size: 30px;
    letter-spacing: 0;
    color: #413636;
    margin-bottom:40px;
}
.ec-blog-detail .ec-blog-desc {
    font-family: "Montserrat";
    font-weight: 600;
    font-size: 20px;
    letter-spacing: 0;
    color: #666060;
    margin-bottom:40px;
}
.ec-blog-arrows {
    margin-bottom: 30px;
    padding: 15px 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex
;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    border-top: 1px solid #d9d9d9;
    border-bottom: 1px solid #d9d9d9;
}

</style>
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-blogs-rightside col-lg-12 col-md-12">

                <!-- Blog content Start -->
                <div class="ec-blogs-content">
                    <div class="ec-blogs-inner">

                        <!-- Main Blog Image -->
                        <div class="ec-blog-main-img">
                            <img class="blog-image" src="{{ url('blogs/' . $blog->image) }}" alt="{{ $blog->title }}"width="1100px">
                        </div>

                        <!-- Blog Date -->
                        <div class="ec-blog-date">
                            <p class="date">{{ $blog->created_at->format('d F, Y') }} </p>
                        </div>

                        <!-- Blog Title and Description -->
                        <div class="ec-blog-detail">
                            <h2 class="ec-blog-title">{{ $blog->title }}</h2>
                            <p class="ec-blog-desc">{!! $blog->description !!}</p> <!-- Displaying description with HTML formatting (e.g., paragraphs, line breaks, etc.) -->
                        </div>

                        <!-- Blog Navigation Arrows -->
                        <div class="ec-blog-arrows">
                            <!-- Previous Blog -->
                            @if ($previousBlog)
                                <a href="{{ route('blogs.detail', ['id' => $previousBlog->id, 'slug' => $previousBlog->slugs]) }}">
                                    <i class="ecicon eci-angle-left"></i> Prev Post
                                </a>
                            @endif

                            <!-- Next Blog -->
                            @if ($nextBlog)
                                <a href="{{ route('blogs.detail', ['id' => $nextBlog->id, 'slug' => $nextBlog->slugs]) }}">
                                    Next Post <i class="ecicon eci-angle-right"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
                <!-- Blog content End -->
            </div>
        </div>
    </div>
</section>
@endsection
