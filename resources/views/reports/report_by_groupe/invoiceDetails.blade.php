@section('style')
<style>
    .modal-subject {
        width: 80%;
    }

    #search {
        width: 100%;
        margin: 0;
    }
    .caption{
        background: #00807a;
    }
</style>
@endsection

<div id="invoiceDetails" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            {{-- <h3 class="center">Edit Client</h3> --}}
            <span class="close-modal" data-modal-id="invoiceDetails">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Invoice Details</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="print-part">
                        <div class="card" >
                            <div class="card-body">
                                <!-- Logo & title -->
                                <div class="clearfix">
                                    <div class="float-start">
                                        <div class="auth-logo">
                                            <div class="logo logo-dark">
                                                <span class="logo-lg">
                                                    <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}"
                                                        height="22">
                                                </span>
                                            </div>

                                            <div class="logo logo-light">
                                                <span class="logo-lg">
                                                    <img src="{{ asset('assets/dist/img/credit/visa.png') }}"
                                                        height="22">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="float-end">
                                        <h4 class="m-0 d-print-none">Invoice</h4>
                                    </div>
                                </div>

                                <div class="details">

                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div><!-- end row -->
            </div>
        </div>
    </div>
</div>