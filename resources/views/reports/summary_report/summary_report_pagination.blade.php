<table class="show-table">
    <thead>
        <caption class="caption">Summary Report</caption>
        <tr>
            <th>SL:</th>
            <th>Transaction Groupe</th>
            <th>Transaction Head</th>
            <th>Receive</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($groupes as $key => $groupe)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$groupe->tran_groupe_name}}</td>
            <td>
                <table class="show-table" style="">
                    @foreach ($head_groupe[$key] as $heads)
                    <tr>
                        <td>
                            {{$heads->tran_head_name}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td>
                <table class="show-table" style="">
                    @foreach ($head_groupe[$key] as $heads)
                    <tr>
                        <td>
                            {{$heads->tran_head_name}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


{{-- <div class="center paginate" id="paginate">
    {!! $client->links() !!}
</div> --}}