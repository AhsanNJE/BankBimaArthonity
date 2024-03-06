@extends('admin.layouts.layout')
@section('admin')


<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Transaction Invoice</a></li> -->
                        </ol>
                    </div>
                    <h4 class="page-title">Transaction Invoice</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo & title -->
                        <div class="clearfix">
                            <div class="float-start">
                                <div class="auth-logo">
                                    <div class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt=""
                                                height="22">
                                        </span>
                                    </div>

                                    <div class="logo logo-light">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/dist/img/credit/visa.png') }}" alt=""
                                                height="22">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="float-end">
                                <h4 class="m-0 d-print-none">Invoice</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <h4><b>Hello,</b>
                                        <p>{{ $transMainInvoice->User->user_name }}</p>
                                    </h4>

                                </div>


                            </div><!-- end col -->
                            <div class="col-md-4 offset-md-2">
                                <div class="mt-3 float-end">
                                    <p><strong>Order Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $transMainInvoice->tran_date }}</span></p>
                                    <p><strong>Order Status : </strong> <span class="float-end"><span
                                                class="badge bg-success">{{ $transMainInvoice->tran_type }}</span></span>
                                    </p>
                                    <p><strong>Invoice No. : </strong> <span
                                            class="float-end">{{ $transMainInvoice->tran_id }}</span></p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <h6>Billing Address</h6>
                                <address>
                                    {{ $transMainInvoice->User->address }}
                                    <br>
                                    <abbr title="Phone">Phone:</abbr> {{ $transMainInvoice->User->user_phone }}<br>
                                    <abbr title="Email">Email:</abbr> {{ $transMainInvoice->User->user_email }}<br>
                                </address>
                            </div> <!-- end col -->


                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-centered">
                                        <thead>
                                            <tr>
                                                <th>#SL:</th>
                                                <th>Name:</th>
                                                <th style="width: 10%">User Type</th>
                                                <th style="width: 10%">Quantity</th>
                                                <th style="width: 10%">Amount</th>
                                                <th style="width: 10%">Total Amount</th>
                                                <!-- <th style="width: 10%" class="text-end">Total</th> -->
                                            </tr>
                                        </thead>
                                        @php
                                        $sl = 1;
                                        @endphp
                                        <tbody>
                                            @foreach($transDetailsInvoice as $key => $item)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td> {{ $item->User->user_name }} </td>
                                                <td> {{ $item->User->user_type }} </td>
                                                <td> {{ $item->quantity }} </td>
                                                <td> {{ $item->amount }} </td>
                                                <td> {{ $item->tot_amount }} </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="clearfix pt-5">
                                    <h6 class="text-muted">Notes:</h6>


                                </div>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="float-end">
                                    <p><b>Total Due:</b> <span
                                            class="float-end text-danger text-bold">{{ $transMainInvoice->due }}</span>
                                    </p>
                                    <p><b>Sub-total:</b> <span class="float-end">{{ $transSum }}</span></p>
                                    <p><b>Discount (10%):</b> <span class="float-end">
                                            &nbsp;&nbsp;&nbsp;{{ ($transSum * 10)/100 }}</span>
                                    </p>
                                    <p><b>Total:</b><span class="float-end">
                                            &nbsp;&nbsp;&nbsp;{{ $transSum-(($transSum * 10)/100) }}</span></p>
                                </div>
                                <div class="clearfix"></div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4 mb-1">
                            <div class="text-end d-print-none">
                                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                        class="mdi mdi-printer me-1"></i> Print</a>

                                <a href="{{ url('trans/invoice-download/'.$item->tran_id) }}"
                                    class="btn btn-info waves-effect waves-light"> PDF Invoice </a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->





@endsection