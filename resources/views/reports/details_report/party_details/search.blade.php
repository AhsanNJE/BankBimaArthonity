<table>
    <thead>
        <caption class="caption">Party Details Report</caption>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @php
            $groupedTransactions = [];
            foreach ($transactions as $transaction) {
                $tranId = $transaction['tran_id'];
                if (!isset($groupedTransactions[$tranId])) {
                    $groupedTransactions[$tranId] = [];
                }
                $groupedTransactions[$tranId][] = $transaction;
            }
            $totalDue = 0;
        @endphp
        @foreach ($groupedTransactions as $key => $transaction)
        <tr>
            <td>
                <table>
                    <thead>
                        <caption class="caption">Party Details Report for Transaction id {{$key}}</caption>
                        <tr>
                            <th>Transaction Id</th>
                            <th>Tran User</th>
                            <th>Bill Amount</th>
                            <th>Discount</th>
                            <th>Net Amount</th>
                            <th>Receive</th>
                            <th>Payment</th>
                            <th>Balance / Due</th>
                            <th>Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction as $keys =>$tran)
                        <tr>
                            
                            <td>{{$tran->tran_id}}</td>
                            <td>{{$tran->User->user_name}}</td>
                            @if ($loop->first)
                                <td>{{$tran->bill_amount}}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$tran->discount}}</td>
                            <td>{{$tran->net_amount}}</td>
                            <td>{{$tran->receive}}</td>
                            <td>{{$tran->payment}}</td>
                            <td>
                                @php
                                    $due = $tran->net_amount - $tran->receive - $tran->payment
                                @endphp
                                {{$due}}
                            </td>
                            <td>{{date('Y-m-d', strtotime($tran->tran_date))}}</td>
                            @if ($loop->last)
                                @php
                                    $totalDue += $tran->due
                                @endphp                               
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    @endforeach
    </tbody>
    {{-- <tfoot>
        <tr>
            <td>{{ $totalDue }}</td>
        </tr>
    </tfoot> --}}
</table>


{{-- <div class="center paginate" id="paginate">
    {!! $transactions->links() !!}
</div> --}}