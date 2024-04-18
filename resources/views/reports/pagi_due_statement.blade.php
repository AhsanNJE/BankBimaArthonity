<table id="basic-datatable" class="table dt-responsive nowrap w-100">
    <thead>
        <tr>
            <th>Sl</th>
            <th>Name</th>
            <th>Tran Id</th>
            <th>Tran Date</th>
            <th>Total</th>
            <th>Discount</th>
            <th>Net Total</th>
            <th>Advance(R)</th>
            <th>Advance(P)</th>
            <th>Due Discount</th>
            <th>Due Collect</th>
            <th>Due</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        @foreach($alldue as $key=> $item)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $item['User']['user_name'] }}</td>
            <td>{{ $item['tran_id'] }}</td>
            <td>{{ $item->tran_date }}</td>
            <td>{{ $item->bill_amount }}</td>
            <td> <span class="btn btn-success btn-sm waves-effect waves-light">
                    {{ round($item->discount) }}</span> </td>
            <td> <span class="btn btn-info btn-sm waves-effect waves-light">
                    {{ round($item->net_amount) }}</span> </td>
            <td> <span class="btn btn-warning btn-sm waves-effect waves-light">
                    {{ round($item->receive) }}</span> </td>
            <td> <span class="btn btn-warning btn-sm waves-effect waves-light">
                    {{ round($item->payment) }}</span> </td>
            <td> <span class="btn btn-danger btn-sm waves-effect waves-light">
                    {{ round($item->due_disc) }}</span> </td>
            <td> <span class="btn btn-info btn-sm waves-effect waves-light">
                    {{ round($item->due_col) }}</span> </td>
            <td> <span class="btn btn-info btn-sm waves-effect waves-light">
                    {{ round($item->due) }}</span> </td>
            <td>


                <a href="{{ route('trans.details',$item->id) }}"
                    class="btn btn-secondary btn-sm rounded-pill waves-effect waves-light">
                    Details </a>

                <button type="button" class="btn btn-success btn-sm rounded-pill waves-effect waves-light"
                    data-bs-toggle="modal" data-bs-target="#signup-modal" id="{{ $item->id }}"
                    onclick="transactionDue(this.id)">Pay Due
                </button>

                <a href="{{ route('trans.invoice',$item->tran_id) }}"
                    class="btn btn-primary btn-sm rounded-pill waves-effect waves-light">
                    Invoice</a>
            </td>
        </tr>
        @endforeach

    </tbody>

</table>
{{ $alldue->links() }}