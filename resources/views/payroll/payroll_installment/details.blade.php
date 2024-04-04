@foreach ($payrolls as $key=>$item)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $item->Head->tran_head_name }}</td>
        <td>{{ $item->amount }}</td>
        @if ($item->date != null)
            <td>{{ date('m', strtotime($item->date)) }}</td>
            <td>{{ date('Y', strtotime($item->date)) }}</td>
        @else
            <td></td>
            <td></td>
        @endif
    </tr>
@endforeach
