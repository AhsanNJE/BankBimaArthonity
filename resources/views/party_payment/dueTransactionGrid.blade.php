@foreach ($transaction as $key => $item)
    <tr>
        <td>{{ $transaction->firstItem() + $key }}</td>
        <td>{{ $item->tran_id }}</td>
        <td>{{ $item->bill_amount }}</td>
        <td>{{ $item->due }}</td>
        <td style="display: flex;gap:5px;">
            <button class="btn btn-primary btn-sm" data-id="{{ $item->id }}" id="edit"><i
                    class="fas fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                    class="fas fa-trash"></i></button>
        </td>
    </tr>
@endforeach
