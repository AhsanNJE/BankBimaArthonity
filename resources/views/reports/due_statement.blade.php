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
                    <h4 class="page-title">Due Statement</h4>
                    <hr>
                    <form action="/filter" method="POST">
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
                                <button type="submit" class="btn btn-primary btn-sm">View</button>
                            </div>

                            <div class="col-md-1 pt-4">
                                <a href="{{ route('client.due.transaction') }}" class="btn btn-secondary"> Client </a>
                            </div>
                            <div class="col-md-1 pt-4">
                                <a href="{{ route('supplier.due.transaction') }}" class="btn btn-secondary">Supplier</a>
                            </div>
                            <div class="col-md-1 pt-4">
                                <a href="#" class="btn btn-secondary">Employee</a>
                            </div>
                            <!-- <div class="col-md-5">
                                                <label for="">Search:</label>
                                                <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="Search Here....">
                                            </div> -->
                        </div>
                    </form>
                    <div class="col-md-5">
                        <label for="">Search:</label>
                        <input type="text" name="search" id="search" class="mb-3 form-control"
                            placeholder="Search Here....">
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-data">


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
                                @foreach($alldue as $key=> $item)
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
                                        <a href="{{ route('trans.details',$item->id) }}"
                                            class="btn btn-secondary btn-sm rounded-pill waves-effect waves-light">
                                            Details </a>

                                        <button type="button"
                                            class="btn btn-success btn-sm rounded-pill waves-effect waves-light"
                                            data-bs-toggle="modal" data-bs-target="#signup-modal" id="{{ $item->id }}"
                                            onclick="transactionDue(this.id)">Pay Due </button>

                                        <a href="{{ route('trans.invoice',$item->tran_id) }}"
                                        class="btn btn-primary btn-sm rounded-pill waves-effect waves-light">
                                        Invoice</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            
                        </table>
                        
                        {{ $alldue->links() }}
                    </div> <!-- end card body-->
                    
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                              
                            </thead>


                            <tbody>
                               

                            </tbody>

                            <tfoot>
                                @php

                                $total_amount = App\Models\Transaction_Main::sum('net_amount');
                                $total_receive = App\Models\Transaction_Main::sum('receive');
                                $total_payment = App\Models\Transaction_Main::sum('payment');
                                $total_due = App\Models\Transaction_Main::sum('due');

                                @endphp
                                <tr>
                                    <th>
                                        <h4 class="text-right text-bold">Total : </h4>
                                    </th>
                                    <th>
                                        <h4 class="text-end text-bold">{{ $total_amount }}</h4>
                                    </th>
                                    <th>
                                        <h4 class="text-right text-bold">Receive : </h4>
                                    </th>
                                    <th>
                                        <h4 class="text-end text-bold">{{ $total_receive }}</h4>
                                    </th>
                                    <th>
                                        <h4 class="text-right text-bold">Payment : </h4>
                                    </th>
                                    <th>
                                        <h4 class="text-end text-bold">{{ $total_payment }}</h4>
                                    </th>
                                    <th>
                                        <h4 class="text-right text-bold">Due : </h4>
                                    </th>
                                    <th>
                                        <h4 class="text-end text-bold">{{ $total_due }}</h4>
                                    </th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->




    </div> <!-- container -->

</div> <!-- content -->

<!-- PAY Due Modal -->
<!-- Signup modal content -->
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="text-center mt-2 mb-4 ">
                    <div class="auth-logo">

                        <h3> Pay Due Amount </h3>
                    </div>
                </div>


                <form class="px-3" method="post" action="{{ route('trans.update.due') }}">
                    @csrf

                    <input type="hidden" name="id" id="trans_due_id">
                    <input type="hidden" name="pay" id="pay">

                    <div class="mb-3">
                        <label for="username" class="form-label">Payable Due</label>
                        <input class="form-control" type="text" id="due">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Pay Now</label>
                        <input class="form-control" type="text" name="due">
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Update Due</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
function transactionDue(id) {
    $.ajax({
        type: 'GET',
        url: '/pending/all/due/' + id,
        dataType: 'json',
        success: function(data) {
            // console.log(data)
            $('#due').val(data.due);
            $('#pay').val(data.payment);
            $('#trans_due_id').val(data.id);
        }
    })
}
</script>


@endsection

@section('ajax')

<script>
$(document).ready(function() {

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1]
        pagination(page);


    });

    function pagination(page) {
        $.ajax({
            url: "/pagination/pagination-data?page=" + page,
            success: function(res) {
                $('.table-data').html(res);
            }
        });
    }

    //Searching due statement
    $(document).on('keyup', function(e) {
        e.preventDefault();
        let search_string = $('#search').val();
        $.ajax({
            url: "{{ route('search.due.statement') }}",
            method: 'GET',
            data: {
                search_string: search_string
            },
            success: function(res) {
                $('.table-data').html(res);
                if (res.status == 'nothing_found') {
                    $('.table-data').html('<span class="text-danger">' + 'Nothing Found' +
                        '</span>');
                }
            }
        })
    })
});
</script>

@endsection