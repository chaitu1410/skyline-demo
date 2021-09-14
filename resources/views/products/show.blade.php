@extends('layouts.main', ['header' => 'full', 'footer' => true])

@section('ogtitle', 'Finolex 1.5 SQMM')
@section('title', $product->name)

@section('content')

<!-- product info start -->
<section>

  <nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item" aria-current="page"><a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
    </ol>
  </nav>
  <div id="prodinfocontainer">

    <!-- product zoom start -->
    <div class="containerimages">

      <div class="picture" id="picture">
        <div class="rect" id="rect"></div>
        <img id="pic" src="{{ asset('images/'.$product->image) }}">
      </div>
      <div class="pictures">
          <img id="pic1" onmouseover="changeImage('{{ 'images/'.$product->image }}', 1)" src="{{ asset('images/'.$product->image) }}">
          @forelse ($images as $index => $image)
            <img id="pic{{ $index+2 }}" onmouseover="changeImage('{{ asset('images/'.$image->image) }}', {{ $index+2 }})" src="{{ asset('images/'.$image->image) }}">
          @empty
              
          @endforelse
      </div>
      <div class="zoom" id="zoom"></div>
    </div>
    <!-- product zoom end -->

    <!-- product info start -->
    <div class="prodinfocont">
      <div class="prodinfoname">
        <p>{{ $product->name }}</p>
      </div>


      @if ($product->verified)
        <div id="verifiedbadge">
          <p class="mb-0">Skyline <span id="verifiedtxt">Verified</span><span class="material-icons">
              verified_user
            </span> </p>
        </div>
      @endif

      <hr id="ratingsseparator">
      <div class="prodpricees">
        <p class="mb-1">MRP: <s><strong> ₹{{ $product->mrp }}</strong></s></p>
        <p class="mb-1">Price: <span class="text-success"><strong> ₹{{ $product->sellingPrice }}</strong></span></p>
        <p class="mb-1">You Save: <span class="text-danger">₹{{ $product->totalSaving() }} ({{ $product->discount }}%)</span></p>
        <p class="mb-1">FREE Delivery: <strong class="text-dark">July 20 - 24</strong></p>
      </div>
      <hr>

      <div class="prodmoredetails">
        @if ($varient->stock)
            <p class="mb-0 text-success">In Stock.</p>
        @else
            <p class="mb-0 text-danger">Currently not available.</p>
        @endif
        @livewire('check-availability')
        
      </div>

    </div>
    <!-- product info end -->

    <!-- add to cart, share start -->
    <div id="prodaddtocartboxcont">
      <a href="" class="shareprod">
        <span>Share</span>

        <svg id="whatsappshare" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
          class="bi bi-whatsapp" viewBox="0 0 16 16">
          <path
            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
        </svg>
        <svg id="mailshare" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
          class="bi bi-envelope" viewBox="0 0 16 16">
          <path
            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
        </svg>
        <svg id="instashare" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
          class="bi bi-instagram" viewBox="0 0 16 16">
          <path
            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
        </svg>

        <svg id="fbshare" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
          class="bi bi-facebook" viewBox="0 0 16 16">
          <path
            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
        </svg>
      </a>
      <div class="card p-2">
        <div id="bulkquotebtnincartbox" class="btn bg-orange border-light">Request Quote</div>
        <a id="manualdlink" href="{{ asset('files/'.$product->manual) }}">
          <span class="material-icons">
            file_download
          </span>
          Download Manual
        </a>
        @if ($varient->stock)
            <form method="POST" action="{{ route('products.addToCart', [ $product, $varient ]) }}">
              @csrf
              <div class="quantityincdec">
                <button type="button" onclick="(function(){
                  if(document.querySelector('#number').value > 1)
                    document.querySelector('#number').value--;
                  })();return false;">-</button>

                <input type="text" id="number" name="quantity" value="1" />

                <button type="button" onclick="(function(){ document.querySelector('#number').value++; })();return false;">+</button>
              </div>
              <div class="cartbuybtns">
                <button id="cart" class="btn" type="submit">Add To Cart</button>
              </div>
            </form>

            <div class="delivertoincart">
              <a href="">
                <span class="material-icons">
                  location_on
                </span>
                <span>Deliver to User - Aurangabad 431001</span>
              </a>
            </div>
        @endif
      </div>
    </div>
    <!-- add to cart, share end -->

  </div>
</section>
<!-- product info end -->




<!-- more product details start -->
<div class="moreproductdetails">



  <div class="prodmodels">
    <div class="mt-1 prodmodelsvariants">
      @foreach ($varients as $var)
        <div class="prodvariantitem @if($var->id == $varient->id) prodvariantitemactive @endif" onclick="location.href='{{ route('products.show', ['product' => $product, 'varient' => $var->id]) }}'">
          <div class="prodvarianthead">
            <p class="mb-0">{{ Str::limit($var->name, 15, $end='...') }}</p>
          </div>
          <div class="prodvarianttext">
            <p class="mb-1 fw-bold">₹{{ $var->sellingPrice }}</p>
            @if ($var->stock)
              <p class="mb-0 text-success fw-bold prodvariantstock">In Stock</p>
            @else
              <p class="mb-0 text-danger fw-bold prodvariantstock">Out of Stock</p>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>


  <div class="proddetailstable">
    <table class="table table-borderless">
      @forelse ($varient->properties as $property)
        <tr>
          <th scope="row">{{ $property->property }}</th>
          <td>{{ $property->value }}</td>
        </tr>
      @empty
          
      @endforelse

      <tr>
        <th scope="row">Country Of Origin</th>
        <td>{{ $product->countryOfOrigin }}</td>
      </tr>

      <tr>
        <th scope="row">Brand</th>
        <td>{{ $product->brand->name }}</td>
      </tr>

    </table>
  </div>
  <hr>
  <div class="prodinfodesc">
    <p><strong>Product Description</strong></p>
    {!! $product->description !!}
  </div>
</div>
<!-- more product details ends -->

<div class="b-example-divider d-md-none d-lg-none mt-md-3 mt-lg-3"></div>

<!-- terms and conditions, delivery, return starts -->
<section>
  <div class="returntermscont">

    <a data-bs-toggle="modal" data-bs-target="#termsandconditions">
      <div class="returntermsitem">
        <img src="{{ asset('assets/images/term.png') }}" alt="">
        <p class="mb-0">Terms & Conditions</p>
      </div>
    </a>


    <a data-bs-toggle="modal" data-bs-target="#returnpolicymodal">
      <div class="returntermsitem">
        <img src="{{ asset('assets/images/return-box.png') }}" alt="">
        <p class="mb-0">Return Policy</p>
      </div>
    </a>

    <a>
      <div class="returntermsitem">
        <img src="{{ asset('assets/images/delivery.png') }}" alt="">
        <p class="mb-0">Skyline Delivered</p>
      </div>
    </a>


  </div>
</section>
<!-- terms and conditions, delivery, return starts -->

<div class="b-example-divider"></div>
<!-- have any questions start -->
<section>
  <div class="haveanyqcont mt-3">
    <p><strong>Have Any Question ?</strong></p>
    <form action="{{ route('questions.store', $product) }}" method="POST">
      @csrf
      <div class="haveanyqinput d-flex">
        <span class="material-icons">
          search
        </span>
        <input type="text" class="form-control" placeholder="Type Your Question" name="question">
        <button id="postqbtn" class="btn bluebg" type="submit">Post</button>
      </div>
    </form>
  </div>
</section>
<!-- have any questions end -->

<!-- customer questions and reviews start -->
<section>
  <div class="customersection">
    <div class="askedqcustomer">
      <table class="table table-borderless">
        @forelse ($product->questions as $question)
            @if ($question->answer !== NULL)
              <tr>
                <th scope="row">Question :</th>
                <td class="qcus">{{ $question->question }}</td>
              </tr>
              <tr>
                <th scope="row">Answer :</th>
                <td>
                  <p id="qans" class="mb-0">{{ $question->answer }}</p>
                  <p id="qdate">By Skyline Admin, on {{ date('d M, y', strtotime($question->updated_at)) }}</p>
                </td>
              </tr>
            @endif
          @empty
            <div class="haveanyqcont mt-3">
              <p><strong>No questions posted yet.</strong></p>
            </div>
          @endforelse
      </table>
    </div>
  </div>

</section>
<!-- customer questions and reviews end -->

<div class="b-example-divider"></div>

<!-- products scroller top picks start -->
<section>
  <div class="siteheading">
    <h6>
      Related Products
    </h6>
  </div>
  <div class="headingunderline"></div>

  <div class="productscont">

    @forelse ($relatedProducts as $prod)
      <div class="procard card">
        <h1 class="discount">{{ $prod->discount }}%</h1>
        <div class="prod-img">
          <img src="{{ asset('images/'.$prod->image) }}" class="" alt="{{ $prod->name }}" onclick="location.href='{{ route('products.show', $product) }}'">
        </div>

        <div class="productdetails" onclick="location.href='{{ route('products.show', $product) }}'">
          <a href="{{ route('products.show', $product) }}">
            <p class="prodname">{{ $prod->name }}</p>
          </a>
          <img src="{{ asset('images/'.$prod->brand->image) }}" alt="{{ $prod->brand->name }}">
          <p class="mb-0 text-success prodprice"><span class="cutprice text-danger">₹{{ $prod->mrp }} </span> ₹{{ $prod->sellingPrice }}</p>
        </div>
      </div>
    @empty
        
    @endforelse

  </div>
</section>
<!-- products scroller top picks end -->

<div class="b-example-divider"></div>


<!-- terms and conditions modal starts -->
<section>
  <div class="modal fade" id="termsandconditions" tabindex="-1" aria-labelledby="termsandconditionsLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="privacypolicytext" class="modal-body">
          <p class="fw-bold">Ordering Information: Place an order</p>
          <p>All our orders are online. If you wish to place an order over phone, our representative will assist you
            in creating an online account and placing an order. After you place your order, we will send you an e-mail
            acknowledgement. Our phone, fax and email addresses are available in the contact us section of website. We
            will start processing your order only after we have received payment. By placing an order on e-skyline.in,
            you agree that you are buying for your business needs.</p>


          <p class="fw-bold">Our business hours</p>
          <p>Our hours are 9:30 AM to 6:30 PM Monday to Saturday at 0240-255645.</p>

          <p class="fw-bold">Order delivery times</p>

          <p>If material is in stock or readily available, we shall dispatch in 02 business days and material should
            reach you on 96 Business hours. For special order or out of stock items delivery times are 01 to 03 weeks.
            If we are not able to fulfill your order then we will refund your entire amount within 15 business days.
            If order times exceed what we have committed to, we will contact you to determine if you want to execute
            the order with the new delivery time. If you do not wish to execute the order at that time, we will refund
            your entire amount.</p>

          <p class="fw-bold">GST Tax</p>


          <p>We invoice all transactions and charge all taxes as per regulation. We charge GST as per the product
            category determined by Government of India.</p>


          <p class="fw-bold">Excise Duty and MODVAT</p>

          <p>We charge excise duty if applicable. Excise is either included in price or separately displayed at time
            of checkout, whichever is applicable. We provide excise duty/MODVAT documents upon request – Contact us at
            info@skylinegroup.co.in. We offer tax invoice along with retail invoice where required.
          </p>


          <p class="fw-bold">Payment Methods</p>

          <p>We accept payments via Netbanking, NEFT/RTGS, debit cards, credit cards, cheque. Please mail us your
            cheque at Skyline Distributors, Plot No. 24, Gut No. 23, Beside Cosmo Films, Sai Ugyognagri, MIDC Area,
            Waluj, Aurangabad, Maharashtra - 431001 by speedpost or registered post or courier. We cannot claim
            responsibility for cheques sent through normal mail. Please enclose invoice copy along with your cheque.
          </p>



          <p class="fw-bold">Cancellation</p>

          <p>We reserve the right to cancel any order for any reason. Possible reasons for cancellation include, but
            are not limited to the following:
          </p>
          <p>
          <p>1. Potentially fraudulent order. Before shipping orders, we run a check to make
            sure they are legitimate. If the check fails, we may cancel your order.</p>

          <p>2. Incorrect pricing. Due to the sometimes volatile market for collectible
            products, sometimes there are major fluctuations in price. Therefore, we reserve the right to remove any
            item from any order and provide a full refund to the customer for that item.</p>
          <p>3. Non-Payment of Non COD orders. If payment is not received within a reasonable
            amount of time after the order has been placed, we may cancel an order without notice.</p>
          <p>4. If the order is not serviceable by us due to non-availability of the product
            among any of our vendors.</p>
          <p>5. If your pin code is not serviced by any of our courier partners.</p>
          <p>6. If the procurement is taking longer than 7 working days and you are not
            willing to wait further.</p>
          </p>

          <p class="fw-bold">Returns and exchanges</p>

          <p>We offer returns and exchanges only against manufacturing defects. Please contact our office to discuss
            any return requests.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- terms and conditions modal ends -->


<!-- return policy modal starts -->
<section>
  <div class="modal fade" id="returnpolicymodal" tabindex="-1" aria-labelledby="returnpolicymodalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Return Policy</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="privacypolicytext" class="modal-body">
          <p class="fw-bold">OUR RETURN POLICY: IT’S REALLY SIMPLE!</p>
          <p>The Customer should verify the Product upon its receipt.</p>
          <p>We assure you of free replacement or repairs in case of any manufacturing defect in the performance of
            the standard products purchased from us within 15 days of receipt of material at your end.</p>
          <p>Kindly email our Customer Care team at info@skylinegroup.co.in or call us at 0240-2556133, if case of any
            questions or queries for timely resolution.</p>

          <table class="table table-bordered mt-3">

            <tr>
              <td class="fw-bold small">REASON OF RETURN</td>
              <td class="fw-bold small">RESOLUTION</td>
            </tr>

            <tr>
              <td>Was delivered in a physically damaged condition</td>
              <td>Free Replacement</td>
            </tr>

            <tr>
              <td>Has missing parts or accessories</td>
              <td>Delivery of Missing parts/ Free Replacement</td>
            </tr>

            <tr>
              <td>Is different from what was ordered</td>
              <td>Delivery of material originally ordered</td>
            </tr>

            <tr>
              <td>Is no longer needed (subject to acceptance by us)</td>
              <td>Refund subject to valid reason of return</td>
            </tr>

          </table>

          <p class="fw-bold">Resolution in various cases is given below:</p>
          <p>If the fault is on us (mixed up, faulty on arrival), we’ll of course pay for return shipping.</p>
          <p>As soon as the return or exchange has cleared it’s inspection, you will be notified of your exchange or
            credit immediately.</p>

          <p class="fw-bold">How to Return? Kindly raise a return & service request within 15 days of material
            delivery. Next Steps:</p>

          <p>
          <ul>
            <li>INFORM US</li>
            <li>PREPARE PACKAGE</li>
            <li>SEND THE PACKAGE</li>
            <li>WE RECEIVE THE PACKAGE</li>
            <li>REPLACEMENT OR REPAIR WITHIN 7 DAYS</li>
            <li>INFORM US</li>
          </ul>
          </p>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- return policy modal ends -->

@endsection