<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tax Invoice</title>
    <style>
        @page {
            margin: 0mm;
            margin-header: 0mm;
            margin-footer: 0mm;
        }
        * {
            margin:0;
            padding:0;
            font-family:Arial;
            font-size: 8pt;
            color:#000;
        }
        body {
            width: 100%;
            font-family: Arial;
            font-size: 8pt;
            margin:0;
            padding:0;
        }
        p {
            margin:0;
            padding:0;
        }
        #wrapper {
            /* width:180mm; */
            margin:0 15mm;
        }
        .page {
            height:297mm;
            width:210mm;
            page-break-after:always;
        }
        table {
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;    
            border-spacing:0;
            border-collapse: collapse;
        }
        table td  {
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 2mm;
        }    
        h1.heading {
            font-size:22pt;
            color:#000;
            font-weight:normal;
        }
        h2.heading {
            font-size:10pt;
            color:#000;
            font-weight:normal;
        }
        hr {
            color:#ccc;
            background:#ccc;
        }
        .client {
            color:#000;
            font-weight:normal;
        }
        #invoice_body {
            height: auto;
        }
        #invoice_body , #invoice_total {   
            width:100%;
        }
        #invoice_body table , #invoice_total table {
            width:100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
            border-spacing:0;
            border-collapse: collapse; 
            margin-top:5mm;
        }
        #invoice_body table td , #invoice_total table td {
            text-align:center;
            font-size:9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding:2mm 0;
        }
        #invoice_body table td.mono  , #invoice_total table td.mono {
            font-family:monospace;
            text-align:right;
            padding-right:3mm;
            font-size:10pt;
        }
        #footer {   
            width:180mm;
            margin:0 15mm;
            padding-bottom:3mm;
        }
        #footer table {
            width:100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
            background:#eee;
            border-spacing:0;
            border-collapse: collapse; 
        }
        #footer table td {
            width:25%;
            text-align:center;
            font-size:9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <p style="text-align:center; font-weight:bold; padding-top:5mm;">TAX INVOICE</p>
        <table class="heading" style="width:100%;">
            <tr>
                <td style="width:58%;">
                    <h2 class="heading" ><span style="font-size:15px;">INVOICE No.</span> #{{ $invoice->financial_year }}{{ $invoice->invoice_no }}</h2><br/>
                    <h1 class="heading" style="font-size:14px;"><b>{{ $user->company_name }}</b></h1>
                    <h1 class="heading" style="font-size:12px;"><i>Formerly known as: SHRI SAI NATH BROADBAND PVT. LTD. </i></h1>
                    <span style="font-size: 9pt;" class="client">{{ $user->address }}</span><br />
                    <span style="font-size: 9pt;">Udaipur, Rajasthan 313001<br />
                        Contact&nbsp;&nbsp;: {{ $user->company_mobile }}<br/>
                        Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $user->email_invoice }}<br />
                        GSTIN&nbsp;&nbsp;&nbsp;: {{ $user->gst_number }}<br />
                        Pan No&nbsp;&nbsp;: {{ $user->pan_no }}<br />
                        Website&nbsp;: {{ $user->website }}<br /><br /> 
                    </span>
                    <h1 class="heading" ><u><span style="font-size:11pt;">BILL TO :</span></u></h1>
                    <span style="font-size: 9pt;">Client ID : {{ $invoice->customer->customer_email }}</span><br />
                    <span style="font-size: 9pt;"><b>{{ $invoice->customer->name_title . ' ' . $invoice->customer->customer_name }}</b>
                        <br />
                        {{ $invoice->customer->customer_address }}<br />
                        @if (!empty($invoice->customer->gstin_no))
                        GSTIN No :&nbsp;{{ $invoice->customer->gstin_no }}<br/>';
                        @endif
                        @if (!empty($invoice->customer->panno))
                        Pan No&nbsp;: {{ $invoice->customer->panno }}<br/>
                        @endif
                        Mob&nbsp;  : {{ $invoice->customer->customer_contact_number }}<br />
                        @if (!empty($invoice->customer->static_ip))
                        Static IP&nbsp;  : <b>{{ $invoice->customer->static_ip }}</b><br />
                        @endif
                    </span>
                </td>
                <td valign="top" style="text-align: right;">
                    <h2 style="text-align: right;"><span style="font-size:9pt; display: block; text-align: right">Invoice Date: {{ $invoice->invoice_date }}</span></h2>
                    <h2 style="text-align: right;"><span style="font-size:9pt; display: block; text-align:right" >Start Date : {{ $invoice->start_date }}</span></h2>
                    <h2 style="text-align: right;"><span style="font-size:9pt; display: block; text-align: right">End Date : {{ $invoice->end_date }}</span></h2>
                    <img style="margin-right: 34px;" src="{{ public_path('assets/backend/img/logo.png') }}" height="auto" width="30%">
                </td>
            </tr>
        </table>
        <div id="content">
            <div id="invoice_body">
                <table style="width:100%">
                    <tr>
                        <td style="width:50%;"><b>Product/Service Details </b></td>
                        <td rowspan="" style="width:25%;"><b>Currency</b></td>
                        <td rowspan="" style="width:25%;"><b>Amount</b></td>
                    </tr>
                    @foreach ($invoice->items as $invoice_item)
                    <tr>
                        <td scope="col"style="font-size: 10pt;">{{ $invoice_item->item->product_name }}
                            [{{ $invoice_item->item->description }}]
                        </td>
                        <td scope="col">INR</td>
                        <td scope="col">{{ number_format($invoice_item->goods_amount, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td  scope="col"><b>SUBTOTAL :</b></td>
                        <td  scope="col">INR</td>
                        <td scope="col">{{ number_format($invoice->total_amount, 2) }}</td>
                    </tr>
                    @if ($invoice->discount > 0)
                    <tr>
                        <td  scope="col"><b>DISCOUNT({{ $invoice->discount_in }}) :</b></td>
                        <td  scope="col">INR</td>
                        <td scope="col">{{ number_format($invoice->discount, 2) }}</td>
                    </tr>
                    <tr>
                        <td  scope="col"><b>AFTER DISCOUNT TOTAL</b></td>
                        <td  scope="col">INR</td>
                        <td scope="col">{{ number_format($amount_after_discount, 2) }}</td>
                    </tr>
                    @endif
                    @php
                    $cgst_tax = $amount_after_discount * $invoice->CGST / 100;
                    $sgst_tax = $amount_after_discount * $invoice->SGST / 100;
                    @endphp
                    <tr>    
                        <td  scope="col"><b>CGST({{ $invoice->CGST }}%)</b></td>
                        <td  scope="col">INR</td>
                        <td scope="col">{{ number_format($cgst_tax, 2) }}</td>
                    </tr>
                    <tr>    
                        <td  scope="col"><b>SGST({{ $invoice->SGST }}%)</b></td>
                        <td  scope="col">INR</td>
                        <td scope="col">{{ number_format($sgst_tax, 2) }}</td>
                    </tr>
                    <tr>
                        <td  scope="col"><b>TOTAL :</b></td>
                        <td  scope="col">INR</td>
                        <td scope="col">{{ number_format($invoice->grand_total, 2) }}</td>
                    </tr>
                </table>
            </div>
            <div id="invoice_total" style="margin-top:3px;">
                <table>
                    <tr>
                        <td style="text-align:left; padding-left:10px;width:50%;font-size:9pt;">In Words : {{ $in_words }} Rupees Only</td>
                        <td style="width:25%;">In figures</td>
                        <td style="width:25%;"><b>{{ number_format($invoice->grand_total, 2) }}</b></td>
                    </tr>
                </table>
            </div>
            <hr />
            <table style="width:100%; height:50mm;">
                <tr>
                    <td valign="top">TERMS & CONDITION :</td> 
                    <td valign="top">BANK ACCOUNT DETAILS :</td>
                </tr>
                <tr>
                    <td valign="top" style="width:50%;">
                        <ul>
                            @foreach ($terms as $term)
                            <li>{!! $term->terms_condition !!}</li>
                            @endforeach                                            
                        </ul>
                    </td>
                    <td style="width:50%;">
                        <ul>
                            <li>Beneficiary Name : {{ $bank_details->beneficiary_name }}</li>
                            <li>Bank Name : {{ $bank_details->bank_name }}</li>
                            <li>Account No : {{ $bank_details->account_no }}</li>
                            <li>Branch : {{ $bank_details->branch }}</li>
                            <li>IFSC Code : {{ $bank_details->ifsc_code }}</li>
                        </ul>
                    </td>
                </tr>
            </table>
            <br/>
            <table style="width:100%; height:20mm;text-align:center;">
                <tr><td style="font-size:6.5pt;"><b>- SUBJECT TO UDAIPUR JURISDICTION -</b></td></tr>
                <tr><td style="font-size:9pt;"><b>"WE MAKE THE WEB A BETTER PLACE"</b></td></tr>
            </table>
            <br/>
            <table style="width:100%; ">
                <tr>
                    <td valign="bottom" style="width:50%;">
                        <input type="checkbox"> Orginal<br/>
                        <input type="checkbox"> Duplicate-1<br/>
                        <input type="checkbox"> Duplicate-2
                    </td>
                    <td valign="top" style="text-align:right;">{{ $user->signature }}<br/><br/> <br/> <br/> Authorised Signatory </td>
                </tr><br/>
                <tr >
                    <td colspan="2"  style="text-align:center;">This is computer generated invoice</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>