@extends('frontend.layouts.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')

<!-- FAQ Page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">FAQs</h2>
                    <h2 class="ec-title">Frequently Asked Questions</h2>
                    <p class="sub-title mb-3">Find answers to common queries</p>
                </div>
            </div>
            <div class="ec-common-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="accordion" id="faqAccordion">

                            @foreach($faqs as $key => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $key }}">
                                    <button class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $key }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $key }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </div> <!-- End of Accordion -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
