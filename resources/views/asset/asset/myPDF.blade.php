<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Assets Details</title>
        <style>
            body{
                font-family: Arial;
            }
            .invoice_table .table .tbody .tr.odd {
                background-color: #4C8BF5;
                color: #fff;
            }


            .invoice_table .table {
                display: table;
                width: 100%;
            }

            .invoice_table .table .thead {
                display: table-header-group;
            }

            .invoice_table .table .tr {
                display: table-row;
            }

            .invoice_table .table .thead .tr .th {
                display: table-cell;
            }

            .invoice_table .table .thead .th {
                padding: 13px 0 12px;
            }

            .invoice_table .table .tbody {
                display: table-row-group;
            }

            /* CODE TO MAKE THE ROWS A DIFFERENT COLOUR */
            .invoice_table .table .tbody .tr:nth-child(odd){
                background-color: #4C8BF5;
                color: #fff;
            }

            .invoice_table .table .tr .td {
                display: table-cell;
                
            }

            .invoice_table .table .tbody .td {
                padding: 20px 0;
                /* background-color: #474a4e;
                color: #fff; */
            }
        </style>
       

    </head>

                  <body >
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="mb-4"   >
                                            <img src="{{public_path('master/assets/images/logo.png')}}" alt="" class="img-fluid" style="width: 20%" align="right">
                                            <img src="{{public_path('master/assets/images/ttcl.png')}}" alt="" class="img-fluid" style="width: 20%" align="left">
                                        </div>
                                        <h1 class="card-title" align="center">Assets List </h1>
                                    </div>
                                    <div class="invoice_table" style="width: 700px; margin: 30px auto;">
                                        <div class="table" style="border: 1px solid #000;">
                                            <div class="thead" style="border: #000;">
                                                <div class="tr" style="border: 1px solid #000;">
                                                    <div class="th"></div>
                                                    <div class="th" style=" text-align: center; border: 1px solid #000; color:#4C8BF5">Name</div>
                                                    <div class="th" style="text-align: center; border: 1px solid #000;color:#4C8BF5">Code</div>
                                                    <div class="th" style="text-align: center; border: 1px solid #000; color:#4C8BF5">Purchase Date</div>
                                                    <div class="th" style="text-align: center; border: 1px solid #000; color:#4C8BF5">Manufactured Year</div>
                                                    <div class="th" style="text-align: center; border: 1px solid #000; color:#4C8BF5">Price</div>
                                                    <div class="th" style="text-align: center; border: 1px solid #000; color:#4C8BF5">Status</div>
                                                </div>
                                            </div>
                            
                                            <div class="tbody">
                                                @foreach($data as $item)
                                                    <div class="tr">
                                                        <div class="td"></div>
                                                        <div class="td" style="text-align: center; border: 1px solid #000;">
                                                            {{ $item['name'] }}
                                                        </div>
                                                        <div class="td" style="text-align: center; border: 1px solid #000;">
                                                            {{ $item['asset_code'] }}
                                                        </div>
                                                        <div class="td" style="text-align: center; border: 1px solid #000;">
                                                         {{ date('d/M/y', strtotime($item->purchase_date))}}
                                                    </div>
                                                    <div class="td" style="text-align: center; border: 1px solid #000;">
                                                        {{ $item['manufactured_year'] }}
                                                    </div>
                                                    <div class="td" style="text-align: center; border: 1px solid #000;">
                                                        {{ $item['p_price'] }}
                                                    </div>
                                                    <div class="td" style="text-align: center; border: 1px solid #000;">
                                                         {{ $item['status'] }}
                                                    </div>
                                                    </div>
                                                @endforeach
                            
                                                {{-- <div class="tr">
                                                    <div class="td" rowspan="3" colspan="3" style="padding: 50px 0 5px 0; border: 1px solid #000;"></div>
                                                    <div class="td" style="text-align: right; padding: 50px 0 5px 0; border: 1px solid #000;">
                                                        SUBTOTAL:
                                                    </div>
                                                    <div class="td" style="text-align: center; padding: 50px 0 5px 0; border: 1px solid #000;">
                                                        R {{ $order_item->totalPrice }}
                                                    </div>
                                                </div> --}}
                            
                                                {{-- @if(!empty($order->delivery_fee))
                                                    <div class="tr">
                                                        <div class="td" style="text-align: right; padding: 0 0 5px 0; border: 1px solid #000;">
                                                            DELIVERY FEE:
                                                        </div>
                                                        <div class="td" style="text-align: center; padding: 0 0 5px 0; border: 1px solid #000;">
                                                            R {{ $order->delivery_fee }}
                                                        </div>
                                                    </div>
                                                @endif
                             --}}
                                                {{-- <div class="tr">
                                                    <div class="td" style="text-align: right; padding: 0; border: 1px solid #000;">
                                                        TOTAL:
                                                    </div>
                                                    <div class="td" style="text-align: center; padding: 0; border: 1px solid #000;">
                                                        R {{ $order->order_price }}
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>  
                                    {{-- <div class="card-body">
        
                                        <table id="datatable" width="100%" border="2">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th> Code</th>
                                                <th>Status</th>
                                                <th>Manufactured Year</th>
                                                <th>Price</th>
                                                <th>Purchase Date</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                    
                                                <tr>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->asset_code}}</td>
                                                    <td>{{$item->status}}</td>
                                                    <td>{{$item->manufactured_year}}</td>
                                                    <td>{{$item->p_price}}</td>
                                                    <td>{{date('d/M/y', strtotime($item->purchase_date))}}</td>
                                                   
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
        
                                    </div> --}}
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                       
                    </div> 
                </div>
            </div>
        </div>
       
        <div class="rightbar-overlay"></div>

        

    </body>
</html>
