@extends('frontend.layouts.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')

 <!-- Ec About Us page -->
 <section class="ec-page-content section-space-p">
     <div class="container">
         <div class="row">
             <div class="col-md-12 text-center">
                 <div class="section-title">
                     <h2 class="ec-bg-title">About Us</h2>
                     <h2 class="ec-title">About Us</h2>
                     <p class="sub-title mb-3">Revolutionizing Home Theater Furniture</p>
                 </div>
             </div>
             <div class="ec-common-wrapper">
                 <div class="row">
                     {{-- <div class="col-md-6 ec-cms-block ec-abcms-block text-center">
                         <div class="ec-cms-block-inner">
                             <img class="a-img" src="{{ url('/') }}/frontend/assets/images/offer-image/one.webp"
                                 alt="about">
                         </div>
                     </div> --}}
                     <div class="col-md-12 ec-cms-block ec-abcms-block text-center">
                         <div class="ec-cms-block-inner">

                             <p class="ec-cms-block-title mt-3 mb-5">At KAVITHA LLC/[M & M Designs]/USTProjectorCabinets.com/ustcabinets.com, our journey began with a simple yet common challenge faced by home theater enthusiasts: finding the perfect cabinet to accommodate both a UST (Ultra Short Throw) projector and a center channel speaker. We quickly realized that this was a widespread issue, as these two essential components often compete for the same prime real estate in entertainment setups. </p>
                                 <h3 class="ec-cms-block-title mt-4" style="color:blueviolet"> Our Mission </h3>
                             <p style="color:black;font-size:16px" ><b>Driven by our passion for optimal home theater experiences, we set out to solve this dilemma. Our mission became clear: to create innovative, functional, and affordable furniture solutions that seamlessly integrate all components of a modern home theater system.</b></p>
                             <h3 class="ec-cms-block-title mt-4" style="color:blueviolet">  The Innovation Process </h3>
                             <p style="color:black;font-size:16px;margin-bottom:10px"><b>Our team spent countless hours researching, designing, and prototyping various solutions. We explored multiple approaches, considering factors such as: </b>
                                </p>
                             <p style="color:black;font-weight:600;font-size:15px">- Optimal viewing angles for UST projectors</p>
                             <p style="color:black;font-weight:600;font-size:15px">-  Ideal positioning for center channel acoustics </p>
                             <p style="color:black;font-weight:600;font-size:15px">-  Ventilation requirements for electronic components </p>
                             <p style="color:black;font-weight:600;font-size:15px">-  Aesthetic appeal and integration with various home decor styles  </p>
                             <p style="color:black;font-size:16px;margin-top:10px"><b>We've managed to significantly reduce costs without compromising on quality or functionality. </b>
                             </p>
                             <h3 class="ec-cms-block-title mt-4" style="color:blueviolet"> Our Commitment </h3>
                             <p style="color:black;font-size:16px;margin-bottom:10px"><b>Today, Our company stands at the forefront of home theater furniture innovation. We remain committed to:  </b>
                                </p>
                             <p style="color:black;font-weight:600;font-size:15px">- Continuously improving our designs </p>
                             <p style="color:black;font-weight:600;font-size:15px">-   Listening to customer feedback and adapting to evolving needs  </p>
                             <p style="color:black;font-weight:600;font-size:15px">-   Maintaining affordability without sacrificing quality  </p>
                             <p style="color:black;font-weight:600;font-size:15px">-  Providing exceptional customer service and support  </p>
                             <p style="color:black;font-size:16px;margin-top:10px"><b>Join us in transforming your home theater experience with furniture that's as innovative as the technology it houses.  </b>
                             </p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>


@endsection
