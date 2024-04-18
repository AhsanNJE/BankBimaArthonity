@foreach ($transaction as $key => $item)
    <tr>
        <td>{{ $transaction->firstItem() + $key }}</td>
        <td>{{ $item->tran_id }}</td>
        <td>{{ $item->bill_amount }}</td>
        <td>{{ $item->due }}</td>
    </tr>
@endforeach
