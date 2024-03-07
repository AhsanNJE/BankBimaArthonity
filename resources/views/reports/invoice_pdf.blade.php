<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }

    table {
        font-size: x-small;
    }

    tfoot tr td {
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }

    .font {
        font-size: 15px;
    }

    .authority {
        /*text-align: center;*/
        float: right
    }

    .authority h5 {
        margin-top: -10px;
        color: green;
        /*text-align: center;*/
        margin-left: 35px;
    }

    .thanks p {
        color: green;
        ;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: green; font-size: 26px;"><strong>BankBimaArthonity</strong></h2>
            </td>
            <td align="left">
                <pre class="font">
               Head Office:
               Bank Bima Arthonity<br>
               Email:bankbima1@gmail.com
               Mobile:01715076590,01842012151<br>
               Editorial & Commercial Office:
               PHP Tower, 107/2, Kakrail, Dhaka-1000<br>

            </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;"></table>

    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Name: {{ $transMainPdfInvoice->User->user_name }}</strong> <br>
                    <strong>Email: {{ $transMainPdfInvoice->User->user_email }}</strong> <br>
                    <strong>Phone: {{ $transMainPdfInvoice->User->user_phone }}</strong> <br>

                    <strong>Address: {{ $transMainPdfInvoice->User->address }}</strong>
                    <!-- <strong>Shop Name:</strong> -->

                </p>
            </td>
            <td>
                <p class="font">
                <h3><span style="color: green;">Invoice:</span> {{ $transMainPdfInvoice->tran_id }}</h3>
                Order Date: {{ $transMainPdfInvoice->tran_date }}<br>
                Order Status: {{ $transMainPdfInvoice->tran_type }}<br>
                <!-- Payment Status: <br> -->
                Total Amount: {{ $transMainPdfInvoice->net_amount }}<br>
                Total Due: {{ $transMainPdfInvoice->due }}</span>
                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Products</h3>


    <table width="100%">
        <thead style="background-color: green; color:#FFFFFF;">
            <tr class="font">
                <th>SL:</th>
                <th>User Name:</th>
                <th>User Type:</th>
                <th>Quantity:</th>
                <th>Amount:</th>
                <th>Total Amount:</th>
            </tr>
        </thead>
        <tbody>

            @foreach($transDetailsPdfInvoice as $key => $item)
            <tr class="font">
                <td align="center">{{ $key+1 }}</td>
                <td align="center"> {{ $item->User->user_name }} </td>
                <td align="center"> {{ $item->User->user_type }} </td>
                <td align="center">{{ $item->quantity }} </td>
                <td align="center"> {{ $item->amount }} </td>
                <td align="center"> {{ $item->tot_amount }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: green;">Subtotal:</span> {{ $transPdfSum }}</h2>
                <h2><span style="color: green;">Discount(10%):</span> {{ ($transPdfSum * 10)/100 }}</h2>
                <h2><span style="color: green;">Total:</span> {{ $transPdfSum-(($transPdfSum * 10)/100) }} TAKA</h2>
                {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
        <p>Thanks For You..!!</p>
    </div>
    <div class="authority float-right mt-5">
        <p>BankBimaArthonity</p>
        <p>-----------------------------------</p>
        <h5>Authority Signature:</h5>
    </div>
</body>

</html>