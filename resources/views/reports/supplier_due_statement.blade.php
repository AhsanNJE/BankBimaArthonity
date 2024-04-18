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

                        </ol>
                    </div>
                    <h4 class="page-title">Supplier Due Statement</h4>
                    <hr>
                    <form action="/supplier/filter" method="POST">
                        @csrf
                        <div class="row pb-3">
                            <div class="col-md-3">
                                <label for="">Start Date:</label>
                                <input type="date" name="start_date" value="{{ date('Y-m-d') }}" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="">End Date:</label>
                                <input type="date" name="end_date" value="{{ date('Y-m-d') }}" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-1 pt-4">
                                <button type="submit" class="btn btn-primary">View</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="overflow-x:auto;">


                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>User Type</th>
                                    <th>Invoice</th>
                                    <th>Order Date</th>
                                    <th>Total</th>
                                    <th>Receive</th>
                                    <th>Payment</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($supplierDueTransaction as $key=> $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item['User']['user_name'] }}</td>
                                    <td>{{ $item['User']['user_type'] }}</td>
                                    <td>{{ $item->invoice }}</td>
                                    <td>{{ $item->tran_date }}</td>
                                    <td> <span class="btn btn-success btn-sm waves-effect waves-light">
                                            {{ round($item->net_amount) }}</span> </td>
                                    <td> <span class="btn btn-info btn-sm waves-effect waves-light">
                                            {{ round($item->receive) }}</span> </td>
                                    <td> <span class="btn btn-warning btn-sm waves-effect waves-light">
                                            {{ round($item->payment) }}</span> </td>
                                    <td> <span class="btn btn-danger btn-sm waves-effect waves-light">
                                            {{ round($item->due) }}</span> </td>
                                    <td>
                                        <!-- <a href="#" class="btn btn-secondary rounded-pill waves-effect waves-light"> Details </a>  -->
                                        <a href="#" class="btn btn-dark btn-sm rounded-pill waves-effect waves-light">
                                            Pay Due </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->




    </div> <!-- container -->

</div> <!-- content -->


@endsection