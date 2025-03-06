@extends('frontend.layouts.master')

@section('content')
    <style>
        .ec-breadcrumb-title {
            text-decoration: none;
            color: #444444;
            display: block;
            font-size: 15px;
            font-family: "Montserrat";
            line-height: 22px;
            font-weight: 700;
            margin: 0 auto;
            text-transform: capitalize;
        }

        .ec-blog-inner .ec-blog-title a:hover {
            color: #3474d4;
        }

        .ec-blog-inner .ec-blog-title a {
            color: #555;
            font-size: 16px;
            margin: 0 auto;
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            font-family: "Montserrat";
            font-weight: 600;
            line-height: 1.5;
            letter-spacing: 0;
            text-transform: capitalize;
        }

        .ec-blog-inner .ec-blog-date {
            font-size: 14px;
            color: #12254e;
            line-height: 1.4;
            letter-spacing: 0;
            margin-bottom: 10px;
        }

        .ec-blog-date {
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            padding: 5px 0 0px 0;
        }

        .ec-blog-inner .ec-blog-desc {
            margin-bottom: 13px;
            color: #3b3a3a;
            font-size: 14px;
            letter-spacing: 0;
            word-break: break-all;
            line-height: 24px;
            font-family: "Montserrat";
        }
        .ec-blog-inner .ec-blog-image {
    margin-bottom: 15px;
    overflow: hidden;
}
    </style>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Blog Page</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="{{ route('all_products') }}">Home</a></li>
                            <li class="ec-breadcrumb-item active">Blog Page</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-blogs-rightside col-lg-12 col-md-12">

                    <!-- Blog content Start -->
                    <div class="ec-blogs-content">
                        <div class="ec-blogs-inner">
                            <div class="row">
                                @foreach ($blogs as $blog)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-6 ec-blog-block">
                                        <div class="ec-blog-inner">
                                            <div class="ec-blog-image">
                                                <a href="{{ route('blogs.detail', ['id' => $blog->id, 'slug' => $blog->slugs]) }}">
                                                    <img class="blog-image" src="{{ url('blogs/' . $blog->image) }}"
                                                        alt="{{ $blog->title }}" width="360px" height="206px">
                                                </a>
                                            </div>
                                            <div class="ec-blog-content">
                                                <h5 class="ec-blog-title">
                                                    <a href="{{ route('blogs.detail', ['id' => $blog->id, 'slug' => $blog->slugs]) }}">{{ $blog->title }}</a>
                                                </h5>
                                                <div class="ec-blog-date">By <span> Admin</span> /
                                                    {{ $blog->created_at->format('F d, Y') }}</div>
                                                <div class="ec-blog-desc">
                                                    {{ Str::limit(strip_tags($blog->description), 100) }}
                                                </div>
                                                <div class="ec-blog-btn">
                                                    <a href="{{ route('blogs.detail', ['id' => $blog->id, 'slug' => $blog->slugs]) }}" class="btn btn-primary">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Ec Pagination Start -->
                        <div class="ec-pro-pagination">
                            <span>Showing {{ $blogs->firstItem() }}-{{ $blogs->lastItem() }} of {{ $blogs->total() }}
                                item(s)</span>
                            <ul class="ec-pro-pagination-inner">
                                {{ $blogs->links('pagination::bootstrap-4') }} <!-- Use Bootstrap 4 pagination -->
                            </ul>
                        </div>
                        <!-- Ec Pagination End -->
                    </div>
                    <!--Blog content End -->
                </div>
            </div>
        </div>
    </section>
@endsection
