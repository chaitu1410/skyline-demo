@extends('layouts.main', ['header' => 'auth', 'footer' => false])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Sign Up')

@section('content')

    <!-- breadcrumb start -->
    <nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sign Up</li>

        </ol>
    </nav>
    <!-- breadcrumb ends -->

    <!-- register form start -->
    <div class="registeruserform mt-0 mb-4">
        <h4 class="mb-4 text-center">
            Sign Up
        </h4>

        @livewire('register-user')
    </div>
    <!-- register form ends -->


    <!-- privacy policy starts -->
    <section>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Privacy Policy</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="privacypolicytext" class="modal-body">
                        <p>Revised on March 03rd, 2020</p>
                        <p>Your privacy is very important to us. This Privacy Policy (this “Policy”) describes how our
                            Services handle and secure information they collect. This Privacy Policy is part of, and
                            incorporated into, the User Agreement for our Services. If you have entered into a user
                            agreement for one of our Services (your “User Agreement”), it will supplement and amend the
                            Privacy Policy. This document may narrow or modify the scope of our use of information under
                            this Policy, please review them carefully.</p>

                        <p class="fw-bold">Collection of Information</p>

                        <p>We collect personally identifiable information, like names, postal addresses, email
                            addresses, etc., when voluntarily submitted by our visitors. The information you provide is
                            used to fulfill you specific request. This information is only used to fulfill your specific
                            request, unless you give us permission to use it in another manner, for example to add you
                            to one of our mailing lists.</p>

                        <p class="fw-bold">Cookie/Tracking Technology</p>


                        <p>The Site uses cookies and tracking technology depending on the features offered. Cookies and
                            tracking technology are useful for gathering information such as browser type and operating
                            system, tracking the number of visitors to the Site, and understanding how visitors use the
                            Site. Cookies can also help customize the Site for visitors. Personal information cannot be
                            collected via cookies and other tracking technology, however, if you previously provided
                            personally identifiable information, cookies may be tied to such information. Aggregate
                            cookie and tracking information may be shared with third parties.</p>


                        <p class="fw-bold">Distribution of Information</p>

                        <p>We may disclose to third party services certain personally identifiable information listed
                            below:
                            Information you provide us such as name, email, mobile phone number Information we collect
                            as you access and use our service, including device information, location and network
                            carrier. This information is shared with third party service providers so that we can:
                            Personalize the app for you Perform behavioral Analytics Commitment to Data Security Your
                            personally identifiable information is kept secure. Only authorized employees, agents and
                            contractors (who have agreed to keep information secure and confidential) have access to
                            this information.
                        </p>


                        <p class="fw-bold">Online Advertising We Use</p>

                        <p>We use Google Analytics Advertising Features for remarketing to advertise across the
                            Internet. Remarketing will display relevant ads tailored to you based on what parts of the
                            Skylinegroup.com website you have viewed by placing a cookie on your machine. THIS COOKIE
                            DOES NOT IN ANYWAY IDENTIFY YOU OR GIVE ACCESS TO YOUR COMPUTER. The cookie is used to say
                            “This person visited this page, so show them ads relating to that page.” Google Analytics
                            remarketing allows us to tailor our marketing to better suit your needs and only display ads
                            that are relevant to you. If you do not wish to participate in our remarketing, you can opt
                            out by using the Google Analytics Opt-out Browser Add-on. We reserve the right to make
                            changes to this policy. Any changes to this policy will be posted.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- privacy policy ends -->


@endsection