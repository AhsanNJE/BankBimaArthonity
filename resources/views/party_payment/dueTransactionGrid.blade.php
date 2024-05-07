@foreach ($transaction as $key => $item)
    <tr>
        <td>{{ $transaction->firstItem() + $key }}</td>
        <td>{{ $item->tran_id }}</td>
        <td style="text-align: right">{{ number_format($item->bill_amount, 0, '.', ',') }} Tk.</td>
        <td style="text-align: right">{{ number_format($item->due, 0, '.', ',') }} Tk.</td>
    </tr>
@endforeach
