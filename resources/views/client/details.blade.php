
<ul>
    {{-- General Info Part Starts --}}
    <li data-id="1">General Information</li>
    <div class="general">
        <div class="details-head">
            <div class="image-round">
                <img src="/storage/profiles/{{$client->image !== null ? $client->image : ($client->gender == 'female' ? 'female.png' : 'male.png') }}" alt="" height="100px" width="100px">
            </div> 
            <div class="highlight">
                <span class="name"> {{$client->user_name}} </span><br>
                {{-- <span class="designation"> {{$client->designation->designation}} </span> --}}
            </div>   
        </div>
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-2 bold">Name</div>
                <div class="col-md-4">{{$client->user_name}}</div>
                <div class="col-md-2 bold">Client Location</div>
                <div class="col-md-4">{{$client->location->upazila}}, {{$client->location->district}}, {{$client->location->division}} </div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Gender</div>
                <div class="col-md-4">{{$client->gender}}</div>
                <div class="col-md-2 bold">Client Type</div>
                <div class="col-md-4">{{$client->Withs->tran_with_name}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">NID</div>
                <div class="col-md-4">{{$client->nid}}</div>
            </div>
        </div>
    </div>


    {{-- contact info part starts --}}
    <li data-id="2">Contact Information</li>
    <div class="contact">
        <div class="details-table" style="">
            <div class="row each-row">
                <div class="col-md-2 bold">Email</div>
                <div class="col-md-4">{{$client->user_email}}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Contact No</div>
                <div class="col-md-4">{{$client->user_phone}}</div>
            </div>
        </div>
    </div>


    {{-- Address info part starts --}}
    <li data-id="3">Address Information</li>
    <div class="address">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-3 bold">Permanent Address</div>
                <div class="col-md-9">{{$client->address}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-3 bold">Present Address</div>
                {{-- <div class="col-md-9">{{$employee->user_phone}}</div> --}}
            </div>
        </div>
    </div>


    {{-- Transaction info part starts --}}
    <li data-id="4">Transaction Information</li>
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


    {{-- Other info part starts --}}
    <li data-id="5">Others Information</li>
    <div class="others">
            
    </div>
</ul>