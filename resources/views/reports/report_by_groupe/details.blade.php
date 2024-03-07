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
            <p><strong>Order Date : </strong> <span class="float-end">
                    {{ date("Y-m-d", strtotime($transMainInvoice->tran_date)) }}</span></p>
            <p><strong>Order Status : </strong> <span class="float-end"><span
                        class="badge bg-success">{{ $transMainInvoice->tran_type }}</span></span>
            </p>
            <p><strong>Invoice No. : </strong> <span class="float-end"> {{ $transMainInvoice->tran_id }}</span></p>
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
            <span title="Phone">Phone:</span> {{ $transMainInvoice->User->user_phone }}<br>
            <span title="Email">Email:</span> {{ $transMainInvoice->User->user_email }}<br>
        </address>
    </div>
</div>



<table class="show-table">
    <thead>
        <caption class="caption">Invoice Details</caption>
        <tr>
            <th>#SL:</th>
            <th>Product:</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transDetailsInvoice as $key => $item)
        <tr>
            <td>{{ $key++ }}</td>
            <td> {{ $item->Head->tran_head_name }} </td>
            <td> {{ $item->quantity }} </td>
            <td> {{ $item->amount }} </td>
            <td> {{ $item->tot_amount }} </td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6 mt-4">
        <div class="float-end">
            <p><b>Total Due:</b> <span class="float-end text-danger text-bold">{{ $transMainInvoice->due }}</span>
            </p>
            <p><b>Sub-total:</b> <span class="float-end">{{ $transSum }}</span></p>
            <p><b>Discount (10%):</b> <span class="float-end">
                    &nbsp;&nbsp;&nbsp;{{ ($transSum * 10)/100 }}</span>
            </p>
            <p><b>Total:</b><span class="float-end">
                    &nbsp;&nbsp;&nbsp;{{ $transSum-(($transSum * 10)/100) }}</span></p>
        </div>
    </div>
</div>


<div class="center">
    <button class="btn btn-primary waves-effect waves-light print"><i class="fa-solid fa-print"></i> Print</button>
</div>