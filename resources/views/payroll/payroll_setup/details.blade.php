@foreach ($setup as $key=>$item)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $item->Head->tran_head_name }}</td>
        <td>{{ $item->amount }}</td>
    </tr>
@endforeach
