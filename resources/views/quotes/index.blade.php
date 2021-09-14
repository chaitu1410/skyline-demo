@extends('layouts.main', ['header' => 'small', 'footer' => false])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Bulk Quotes')

@section('content')
    <!-- breadcrumb start -->
    <nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">All Bulk Quote Requests</li>
        </ol>
    </nav>
    <!-- breadcrumb ends -->


    <style>
        .allyourquotescont {
        padding: 1.2rem;

        }

        .downloadskylinepdf {
        display: flex;
        justify-content: start;
        align-items: center;
        }

        .downloadskylinepdf span {
        font-size: 13px;
        color: var(--blue);
        }

        .downloadskylinepdf .material-icons {
        font-size: 22px;
        margin-right: 2px;
        }

        #downloadquottext:hover {
        text-decoration: underline var(--blue);
        }

        .allyourquotedate {
        font-style: italic;
        color: grey;
        font-size: 14px;
        font-weight: 550;
        }
    </style>


    <!-- bulk quotes starts -->
    <section>
        <div class="allyourquotescont">
            <p class="mb-2 fw-bold">Total Quotes : @if($quotes) {{ count($quotes) }} @else 0 @endif</p>
        </div>

        @forelse ($quotes as $quote)
            <div class="allyourquotescont">
                <div class="allyourquoteitem card p-2 mt-3 mb-3">
                    <div class="allyourquotedate">
                    <p class="">{{ date('d M, Y', strtotime($quote->created_at)) }}</p>
                    </div>

                    <div class="mb-3">
                    <label class="form-label small">Your Quote Request :</label>
                    <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="5" disabled>{{ $quote->requirement }}</textarea>
                    </div>

                    @if ($quote->clientQuotationFile) 
                        <a href="{{ asset('files/'.$quote->clientQuotationFile ) }}">
                        <div class="downloadskylinepdf">
                            <span class="material-icons">
                            file_download
                            </span>
                            <span id="downloadquottext">
                            Download Your Quotation
                            </span>
                        </div>
                        </a>
                    @endif


                    <div class="mb-3 mt-4">
                    <label class="form-label small">Skyline's Reply :</label>
                    <p> {!! $quote->reply !!} </p>
                    </div>

                    @if ($quote->adminQuotationFile) 
                        <a href="{{ asset('files/'.$quote->adminQuotationFile ) }}">
                        <div class="downloadskylinepdf">
                            <span class="material-icons">
                            file_download
                            </span>
                            <span id="downloadquottext">
                            Download Skyline's Quotation
                            </span>
                        </div>
                        </a>
                    @endif

                </div>
            </div>
            <div class="b-example-divider"></div>
        @empty
            
        @endforelse
    </section>
@endsection