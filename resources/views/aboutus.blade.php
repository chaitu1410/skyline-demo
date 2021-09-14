@extends('layouts.main', ['header' => 'full', 'footer' => true])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'About Us')

@section('content')

    <!-- breadcrumb start -->
    <nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
    </nav>
    <!-- breadcrumb ends -->

    <!-- about us start -->
    <section>
        <div id="aboutuscont">
            <h4 class="mb-4 text-center">
                About Us
            </h4>

            <div class="aboutustext">
                <p><strong>Skyline Distributors</strong> is a well-known name in the market of Industrial suppliers in
                    the region of
                    Marathwada, Vidarbha, Maharashtra from last <strong>27 Years</strong> , widely known as trading and
                    Distribution
                    Company. Our management has many years of experience in the field of trading and distributing. The
                    basic function of the company is <strong> to fulfill the Customer requirements</strong> as per their
                    specifications
                    and needs.
                </p>

                <p>We have started our journey in <strong>1995</strong> and since we are growing rapidly in the field.
                    We introduce our self as the leading Industrial distributors of <strong>Marathwada, Vidarbha and
                        other parts of Maharashtra.</strong> We put our customers at the center of what we do. We value,
                    challenge and reward our people.</p>

                <p>We have complete range of <strong> Air Compressors and Accessories, Pneumatic Tools, DC Tool With
                        Controller, Torque Wrenches, Chain Hoist and Pneumatic Balancer, Rail System, All Types of Water
                        pumps, Electronics items, Gearbox and Motor, Hydro Pneumatic Press Machines, Air Boosters,
                        Pneumatic Fittings and Many More.</strong></p>

                <p>We are one platform that brings together the <strong>finest of Brands from across the globe under one
                        giant canopy</strong> for displaying and sourcing products & services pragmatically.</p>

            </div>
            <hr>
            <div id="visionmission">
                <div class="vision">
                    <h5>Vision</h5>
                    <p>To deliver superior value to our Customers, Vendors, Believers, Employees and Society at large.
                    </p>
                </div>
                <div class="mission">
                    <h5>Mission</h5>
                    <p>To provide world class industrial solutions to our customers through constant innovation,
                        excellence, teamwork and efforts.</p>
                </div>
            </div>
        </div>

    </section>
    <!-- about us start -->
    <div class="b-example-divider"></div>
    <!-- locations we serve starts -->
    <section>
        <div class="siteheading">
            <h6>
                Locations We serve At
            </h6>
        </div>
        <div class="headingunderline"></div>

        <div class="locationsservecont">
            <div class="locationsserveitem">
                <h5>Andhra Pradesh</h5>
                <p>Hyderabad, Visakhapatnam, Guntur, Secunderabad</p>
            </div>

            <div class="locationsserveitem">
                <h5>Maharashtra</h5>
                <p>Mumbai, Thane, Pune, Nashik, Aurangabad, Kolhapur, Nagpur, Amaravati, Ahmednagar, Chandrapur,
                    Solapur, Buldhana, Jalgaon, Ratnagiri, Sangli.</p>
            </div>

            <div class="locationsserveitem">
                <h5>Goa</h5>
                <p>Panaji, Old Goa, Canacona, Ponda, Mapusa, Vasco Da Gama, Margao.</p>
            </div>

            <div class="locationsserveitem">
                <h5>Assam</h5>
                <p>Guwahati</p>
            </div>


            <div class="locationsserveitem">
                <h5>Punjab</h5>
                <p>Chandigarh</p>
            </div>



            <div class="locationsserveitem">
                <h5>Tamil Nadu</h5>
                <p>Chennai, Coimbatore</p>
            </div>

            <div class="locationsserveitem">
                <h5>Gujarat</h5>
                <p>Ahmedabad,Bharuch, , Dwarka</p>
            </div>

            <div class="locationsserveitem">
                <h5>Delhi</h5>
                <p>Delhi, New Delhi</p>
            </div>

            <div class="locationsserveitem">
                <h5>Haryana</h5>
                <p>Chandigarh, Gurgaon.</p>
            </div>

            <div class="locationsserveitem">
                <h5>Uttar Pradesh</h5>
                <p>Kanpur</p>
            </div>

            <div class="locationsserveitem">
                <h5>Karnataka</h5>
                <p>Bangalore</p>
            </div>

            <div class="locationsserveitem">
                <h5>West Bengal</h5>
                <p>Kolkata</p>
            </div>

            <div class="locationsserveitem">
                <h5>Kerala</h5>
                <p>Kochi</p>
            </div>

            <div class="locationsserveitem">
                <h5>Rajasthan</h5>
                <p>Jaipur, Alwar, Udaipur</p>
            </div>

            <div class="locationsserveitem">
                <h5>Madhya Pradesh</h5>
                <p>Indore</p>
            </div>
        </div>
    </section>
    <!-- locations we serve ends -->

    <div class="b-example-divider"></div>
    <!--shop by brands start-->
    <section id="shopbybrandsection">
        <div class="siteheading">
            <h6>
                Our Customers
            </h6>
        </div>
        <div class="headingunderline"></div>

        <div id="shopbybrands" class="ourclientsimages">
            <div class="ourclientsimage">
                <img src="assets/images/clients/client1.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client2.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client3.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client4.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client5.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client6.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client7.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client8.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client9.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client10.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client11.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client12.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client13.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client14.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client15.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client16.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client17.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client18.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client19.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client20.jpg" alt="">
            </div>

            <div class="ourclientsimage">
                <img src="assets/images/clients/client21.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client22.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client23.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client24.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client25.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client26.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client27.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client28.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client29.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client30.jpg" alt="">
            </div>

            <div class="ourclientsimage">
                <img src="assets/images/clients/client31.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client32.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client33.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client34.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client35.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client36.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client37.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client38.jpg" alt="">
            </div>

            <div class="ourclientsimage">
                <img src="assets/images/clients/client39.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client40.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client41.jpg" alt="">
            </div>
            <div class="ourclientsimage">
                <img src="assets/images/clients/client42.jpg" alt="">
            </div>
        </div>

    </section>
    <!--shop by brands end-->


@endsection