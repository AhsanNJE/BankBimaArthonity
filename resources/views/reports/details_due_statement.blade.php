@extends('admin.layouts.layout')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-10 mt-2">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Trans Due Statement Details </a></li> -->

                        </ol>
                    </div>
                    <h4 class="page-title">Transaction Due Statement Details:</h4>
                </div>
            </div>
            <div class="col-2 mt-2">
            <a href="{{ route('pending.all.due') }}" class="btn btn-info mb-2 text-left"><<-Back</a>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">


            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">





                        <!-- end timeline content-->

                        <div class="tab-pane" id="settings">
                            <form method="post" action="#" enctype="multipart/form-data">
                                @csrf

                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>All Details:
                                </h5>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Name:</label>
                                            <p class="text-danger"> {{ $transDetails->User->user_name }} </p>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">User Type:</label>
                                            <p class="text-danger"> {{ $transDetails->User->user_type }} </p>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Transaction Invoice:</label>
                                            <p class="text-danger"> {{ $transDetails->invoice }} </p>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Total Amount:</label>
                                            <p class="text-danger"> {{ $transDetails->net_amount }} </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Total Discount:</label>
                                            <p class="text-danger"> {{ $transDetails->discount }} </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Transacton Receive</label>
                                            <p class="text-danger"> {{ $transDetails->receive }} </p>
                                        </div>
                                    </div>




                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Transaction Payment:</label>
                                            <p class="text-danger"> {{ $transDetails->payment }} </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Transaction Due:</label>
                                            <p class="text-danger"> {{ $transDetails->due }} </p>
                                        </div>
                                    </div>


                                </div> <!-- end row -->


                                <div class="text-end">
                                    <!-- <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i></button> -->
                                </div>
                            </form>
                        </div>
                        <!-- end settings content-->


                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->




@endsection