<ul>
    {{-- General Info Part Starts --}}
    <li data-id="1">General Information</li>
    <div class="general">
        <div class="details-head"> 
            <div class="highlight">
                <span class="name"> {{$category->category_name}} </span><br>
            </div>   
        </div>
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-2 bold">Name</div>
                <div class="col-md-4">{{$category->category_name}}</div>
            </div>
        </div>
    </div>


   


    <!-- {{-- Transaction info part starts --}}
    <li data-id="4">Transaction Information</li>
    <div class="transaction">
        <div class="transaction" style="overflow-x:auto;">
            <table class="show-table">
                <thead>
                    <caption class="caption">Transaction Details</caption>
                    <tr>
                        <th>SL:</th>
                        <th>Id</th>
                        <th>Type</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Balance</th>
                        <th>Advance</th>
                        <th>Due</th>
                        <th>Due Collect</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->tran_id }}</td>
                            <td>{{ $item->tran_type }}</td>
                            <td>{{ $item->bill_amount }}</td>
                            <td>{{ $item->discount }}</td>
                            <td>{{ $item->net_amount }}</td>
                            <td>{{ $item->receive }} {{ $item->payment }}</td>
                            <td>{{ $item->due }}</td>
                            <td>{{ $item->due_col !== null ? $item->due_col : '0' }}</td>
                            <td>{{ date('Y-m-d', strtotime($item->tran_date)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- Other info part starts --}}
    <li data-id="5">Others Information</li>
    <div class="others">
            
    </div> -->
</ul>