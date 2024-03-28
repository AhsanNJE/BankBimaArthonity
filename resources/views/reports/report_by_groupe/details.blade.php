<div class="row">
    <div class="col-md-6">
        <div class="mt-3">
            <h4><b>Hello,</b>
                <p>{{ $transactionMain->User->user_name }}</p>
            </h4>
        </div>
    </div><!-- end col -->
    <div class="col-md-4 offset-md-2">
        <div class="mt-3 float-end">
            <p><strong>Order Date : </strong> <span class="float-end">
                    {{ date("Y-m-d", strtotime($transactionMain->tran_date)) }}</span></p>
            <p><strong>Order Status : </strong> <span class="float-end"><span
                        class="badge bg-success">{{ $transactionMain->tran_type }}</span></span>
            </p>
            <p><strong>Invoice No. : </strong> <span class="float-end"> {{ $transactionMain->tran_id }}</span></p>
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->

<div class="row mt-3">
    <div class="col-sm-6">
        <h6>Billing Address</h6>
        <address>
            {{ $transactionMain->User->address }}
            <br>
            <span title="Phone">Phone:</span> {{ $transactionMain->User->user_phone }}<br>
            <span title="Email">Email:</span> {{ $transactionMain->User->user_email }}<br>
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
            <td>{{ $key+1 }}</td>
            <td> {{ $item->Head->tran_head_name }} </td>
            <td> {{ $item->quantity }} </td>
            <td> {{ $item->amount }} </td>
            <td> {{ $item->tot_amount }} </td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3 mt-4 float-end">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <td width>Bill amount:</td>
                        <td class="float-end">{{ number_format($transactionMain->bill_amount) }}</td>
                    </tr>
                    <tr>
                        <td>Discount:</td>
                        <td class="float-end">{{ number_format($transactionMain->discount) }}</td>
                    </tr>
                    <tr>
                        <td>Net Amount:</td>
                        <td class="float-end">{{ number_format($transactionMain->net_amount) }}</td>
                    </tr>
                    <tr>
                        <td>Advance:</td>
                        <td class="float-end">{{ number_format($transactionMain->receive != null ? $transactionMain->receive : $transactionMain->payment ) }}</td>
                    </tr>
                    <tr>
                        <td>Total Due:</td>
                        <td class="float-end">{{ number_format($transactionMain->net_amount-$transactionMain->receive- $transactionMain->payment) }}</td>
                    </tr>
                </thead>
            </table>
    </div>
</div>


<div class="center">
    <button class="btn btn-primary waves-effect waves-light print"><i class="fa-solid fa-print"></i> Print</button>
</div>