@foreach ($transaction as $key => $item)
    <tr>
        <td>{{ $transaction->firstItem() + $key }}</td>
        <td>{{ $item->Head->tran_head_name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ $item->amount }}</td>
        <td>{{ $item->tot_amount }}</td>
        <td style="display: flex;gap:5px;">
            <button class="editDetail" data-id="{{ $item->id }}" id="edit"><i
                    class="fas fa-edit"></i></button>
            <button class="deleteDetail" data-id="{{ $item->id }}" id="delete"><i
                    class="fas fa-trash"></i></button>
        </td>
    </tr>
@endforeach
