@extends('layouts.main', ['header' => 'small', 'footer' => true])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Contact Us')

@section('content')

    <!-- breadcrumb start -->
  <nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
    </ol>
  </nav>
  <!-- breadcrumb ends -->

  <!-- contact us start -->
  <section>
    <div class="contactusmapcont">
      <iframe width="100%" height="230" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
        src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=aurangabad,%20maharashtra+(Skyline%20Distributors)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
    </div>

    <div id="contactusinfocont">
      <div id="contactusinfo">
        <div class="siteheading">
          <h6>
            Contact Us
          </h6>
        </div>
        <div class="headingunderline"></div>

        <div class="contactinfoinner mt-4">
          <p><strong>Feel Free To Contact Us</strong></p>

          <div class="contactnos">


            <p class="mb-2">Customer Support</p>
            <p onclick="location.href='tel:9765499835'" class="mb-2">
              <span class="material-icons">
                call
              </span> <span class="mobnocontactus">+91 9765499835</span>
            </p>
            <p onclick="location.href='mailto:info@skylinegroup.co.in'" class="mb-4">
              <span class="material-icons">
                mail_outline
                </span> <a href="mailto:info@skylinegroup.co.in">info@skylinegroup.co.in</a>
            </p>


            <p class="mb-2">Sales and Bulk Quote</p>
            <p onclick="location.href='tel:9765499823'" class="mb-2">
              <span class="material-icons">
                call
              </span> <span class="mobnocontactus">+91 9765499823</span>
            </p>
            <p class="mb-4">
              <span class="material-icons">
                mail_outline
                </span> <a href="mailto:sales@skylinegroup.co.in">sales@skylinegroup.co.in</a>
            </p>

         
            <p class="mb-2">Any Other Query</p>
            <p onclick="location.href='tel:9765499835'" class="mb-2">
              <span class="material-icons">
                call
              </span> <span class="mobnocontactus">+91 9765499835</span>
            </p>
            <p class="mb-4">
              <span class="material-icons">
                mail_outline
                </span> <a href="mailto:Sanketskyline12@gmail.com">sanketskyline12@gmail.com</a>
            </p>
          </div>

          
          <p><strong>Visit our Office</strong></p>

          <div class="contactaddress">
            <p class="mb-1">
              <span id="locationiconaddress" class="material-icons">
                location_on
              </span>
              <span>
                Plot No. 24, Gut No 23, Sai Udyog Nagri, Near Cosmo
                Films Ltd. Midc, Waluj, Aurangabad - 431136, Maharashtra, India.
              </span>
            </p>
          </div>
        </div>
      </div>

      <div id="contactusform">
        <div class="siteheading">
          <h6>
            Send Us An Email
          </h6>
        </div>
        <div class="headingunderline"></div>

        <form action="">

          <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Your Name<span class="mandatoryfield">*</span>
            </label>
            <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="">
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput4" class="form-label">Email Id<span class="mandatoryfield">*</span>
            </label>
            <input type="email" class="form-control" id="exampleFormControlInput4" placeholder="">
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Write Us</label><span
              class="mandatoryfield">*</span>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="registerloginbtn mb-2">
            <button class="btn w-100">Submit</button>
          </div>


        </form>
      </div>
    </div>
  </section>
  <!-- contact us ends -->

@endsection