<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ url('/') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ public_path('assets/css/style.css') }}">
    <title>Invoice</title>
</head>

<body>

    <style>
        .invoicecontainer {
            width: 60%;
            margin: 3% 20%;
            box-shadow: 3px 3px 10px lightgrey;
            padding: 2rem;
        }

        .invheadpart img {
            height: 3rem;
        }

        .invoicehead {
            display: flex;
            justify-content: space-between;
        }

        .invheadpart {
            text-align: right;
        }

        .invoicecontent {
            display: flex;
            justify-content: space-between;
        }

        .invoicecontentpart {
            width: 48%;
        }

        .invoicecontentpart1 {
            text-align: right;
        }

        .invoicetable table {
            border: 1px solid rgb(88, 88, 88);
            width: 100%;
        }

        .invoicesignaturediv {

            text-align: right;
        }

        .signaturediv {
            height: 3rem;
            width: 170px;
            margin-top: 0.7rem;
            margin-bottom: 0.7rem;
            margin-left: auto;
            background-color: lightgrey;
            text-align: center;
        }

        .signaturediv img {
            margin-top: 0.1rem;
            height: 2.8rem;
        }
        .invoiceverysmalltext{
            font-size: 9px;
            text-align: center;
        }
    </style>
    <section>
        <div class="invoicecontainer">
            <div class="invoicehead">
                <div class="invheadpart">
                    <strong>
                        <p class="mb-0">Tax Invoice/Bill of Supply/Cash Memo</p>
                    </strong>
                    <p>(Original for Recipient)</p>
                </div>
            </div>

            <div class="invoicecontent mt-5">
                <div class="invoicecontentpart">
                    <strong>
                        <small>
                            <p class="mb-0">Sold By :</p>
                        </small>
                    </strong>
                    <small>
                        <p class="mb-0">Skyline Distributors</p>
                    </small>
                    <small>
                        {{ $sellerDetails->OfficeAddress }}
                    </small>
                </div>

                <div class="invoicecontentpart invoicecontentpart1">
                    <strong>
                        <small>
                            <p>Billing Address :</p>
                        </small>
                    </strong>
                    <small>
                        <p>{{ $details->customerName }}</p>
                    </small>
                    <small>
                        <p>
                            {{ $details->houseNumber }}, {{ $details->landmark }}, {{ $details->area }}
                        </p>
                    </small>
                    <small>
                        <p>{{ $details->town }}, {{ $pincode->state }}, {{ $details->pincode }}</p>
                    </small>
                    <small>
                        <p>INDIA</p>
                    </small>

                </div>
            </div>

            <div class="invoicecontent">
                <div class="invoicecontentpart">

                    <p><small><strong>PAN No :</strong> AAQCS4259Q</small></p>
                    <p><small><strong>GST Registration No :</strong> 27AAQCS4259Q1ZA</small></p>
                </div>

                <div class="invoicecontentpart invoicecontentpart1">
                    <strong>
                        <small>
                            <p class="mb-0">Shipping Address :</p>
                        </small>
                    </strong>
                    <small>
                        <p class="mb-0">{{ $details->customerName }}</p>
                    </small>
                    <small>
                        <p class="mb-0">
                            {{ $details->houseNumber }}, {{ $details->landmark }}, {{ $details->area }}
                        </p>
                    </small>
                    <small>
                        <p class="mb-0">{{ $details->town }}, {{ $pincode->state }}, {{ $details->pincode }}</p>
                    </small>
                    <small>
                        <p class="mb-0">INDIA</p>
                    </small>
                    <p class="mb-0"><small><strong>Place of delivery :</strong> {{ $pincode->state }}</small></p>
                </div>
            </div>

            <div class="invoicecontent mt-5">
                <div class="invoicecontentpart">

                    <p class="mb-0"><small><strong>Order Number :</strong> {{ $order->id }}</small></p>
                    <p class="mb-0"><small><strong>Order Date :</strong> {{ date('d M, Y', strtotime($order->created_at)) }}</small></p>
                </div>

                <div class="invoicecontentpart invoicecontentpart1">


                    <p class="mb-0"><small><strong>Invoice Number :</strong> {{ $order->id }} </small></p>
                    <p class="mb-0"><small><strong>Invoice Details :</strong> {{ $order->id }}</small></p>
                    <p class="mb-0"><small><strong>Invoice Date :</strong> {{ date('d M, Y', strtotime($order->created_at)) }}</small></p>

                </div>
            </div>

            <div class="invoicetable mt-5">
                <table class="table table-bordered small">
                    <thead>
                        <tr>
                            <th scope="col">Sr. No.</th>
                            <th scope="col">Description</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Net Amount</th>
                            <th scope="col">Tax Rate</th>
                            <th scope="col">Tax Type</th>
                            <th scope="col">Tax Amount</th>
                            <th scope="col">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index => $product)    
                            <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>
                                    {{ $product->product->name }}<br>Varient: {{ $product->varient->name }}
                                </td>
                                <td>₹{{ $product->varient->mrp }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>₹{{ $product->varient->mrp * $product->quantity }}</td>
                                <td>{{ $product->varient->gst }}%</td>
                                <td>IGST</td>
                                <td>₹{{ $product->varient->gstAmount() }}</td>
                                <td>₹{{ $product->varient->sellingPrice }}</td>
                            </tr>
                        @empty
                            
                        @endforelse

                        <tr>
                            <th scope="row" colspan="7">Total :</th>
                            <td>₹{{ $details->totalGst }}</td>
                            <td>₹{{ $details->payableAmount + $details->totalDiscount - $details->deliveryCharge }}</td>
                        </tr>

                        <tr>
                            <th scope="row" colspan="8">Total Discount :</th>
                            <td>₹{{ $details->totalDiscount }}</td>
                        </tr>

                        <tr>
                            <th scope="row" colspan="8">Delivery Charge :</th>
                            <td>₹{{ $details->deliveryCharge }}</td>
                        </tr>

                        <tr>
                            <th scope="row" colspan="8">Total Payable Amount :</th>
                            <td>₹{{ $details->payableAmount }}</td>
                        </tr>

                        <tr>
                            <th scope="row" colspan="9">
                                <p class="mb-0">Amount in Words:
                                </p>
                                <p class="mb-0"> {{ numberTowords($details->payableAmount) }}</p>
                            </th>
                        </tr>

                        <tr>
                            <th scope="row" colspan="9">
                                <div class="invoicesignaturediv">
                                    <p class="mb-0">For Skyline Distributors :
                                    </p>
                                    <div class="signaturediv">
                                        <img src="{{ asset("assets/images/sign.jpg") }}" alt="">
                                    </div>
                                    <p class="mb-0">Authorized Signatory
                                    </p>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

</body>

</html>