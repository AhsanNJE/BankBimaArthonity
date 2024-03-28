<table class="show-table">
    <thead>
        <caption class="caption">Report By Groupes</caption>
        <tr>
            <th>SL:</th>
            <th>Transaction Id</th>
            <th>User Name</th>
            <th>Bill Amount</th>
            <th>Discount</th>
            <th>Net amount</th>
            <th>Receive</th>
            <th>Payment</th>
            <th>Due</th>
            <th>Transaction Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $key=>$item)
            <tr>
                <td>{{ $transactions->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ $item->User->user_name }}</td>
                <td>{{ $item->bill_amount }}</td>
                <td>{{ $item->discount }}</td>
                <td>{{ $item->net_amount }}</td>
                <td>{{ $item->receive }}</td>
                <td>{{ $item->payment }}</td>
                <td>{{ $item->net_amount - $item->receive- $item->payment }}</td>
                <td>{{ date('Y-m-d', strtotime($item->tran_date)) }}</td>
                <td>
                    <button class="btn btn-info btn-sm open-modal invoiceDetails" data-modal-id="invoiceDetails"
                    data-id="{{ $item->tran_id }}"><i class="fas fa-edit"></i>Invoice</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>