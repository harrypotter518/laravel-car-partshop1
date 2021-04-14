@extends('layout')

@section('content')
    <style>
        body{
            background-color:#778899;
        }
    </style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
           
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Home</a>
            </div>
     
        </div>
    </div>

    <div class="row" style="padding-top: 10vh; text-align: center;">
        <div class="col-lg-12 margin-tb">
            <h1>My Cart</h1>
            <!-- <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div> -->
        </div>
    </div>
   
    <div class="row">
        <div class="col-2 col-md-2 col-sm-2"> 
            <img src="{{url('/1b138215bd6d6ea221a6d68ff80380ba.png')}}" alt="car1" width="100%" style="box-shadow: 10px 30px 30px;">
        </div>
        <div class="col-md-8 col-sm-8"> 
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Maker</th>
                    <th>Part#</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Action</th>
                
                </tr>
                @if(count($carts)>=1)
                    @foreach ($carts as $cart)
                    <tr>
                        <td>{{ ++$i}}</td>
                        <td>TOYOTA</td>
                        <td >  
                             {{ $cart->partid}} 
                        </td>
                        <td>{{$cart->description}}</td>
                        <td>
                            <?php  
                            $cart->price = round((float)$cart->price *1.25 *100)/100.0;
                            $tprice = $cart->price * $cart->cnt;
                            ?>
                            <form action="{{route('carts.cartupdate')}}" method="get">
                                <input type="number"  name="cnt" placeholder="number" id="cnt"  value="{{ $cart->cnt }}" style="text-align:center;width:4vw; padding-right:0px;">
                                <input type="hidden"  name="partid"  value="{{ $cart->partid }}" >
                                <input type="hidden"  name="price"  value="{{ $cart->price }}" >                                    
                            </form>
                            
                        </td>
                        
                        <td>{{ $cart->price }}</td>
                        <td>{{$tprice}}</td>
                        <td>
                            <form action="{{route('carts.cartdel')}}" method="GET">        
                                <input type="hidden" name="del_id" value="{{ $cart->partid}}">
                                <button type="submit" class="btn btn-danger" style="width:4vw;">Del</button>
                            </form>
                        </td>
                    
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">No Products.</td>
                    </tr>

                @endif    
                </table>

                <div class="pull-right">
                    <h2>Total Price:  {{ $totalprice ?? '0' }}</h2>
                </div>
            
        </div>
        <div class="col-2 col-md-2"> 
          
            
        </div>
        
    </div>
    
    <div class="row">
        <div class="col-3"></div>
        <div class="col-7">{!! $carts->links() !!}</div>
        <div class="col-2"></div>
    </div>


    <script>
    $(document).ready(function(){
       
        $('form input').change(function() {
            $(this).closest('form').submit();
        });
    });
    </script>


@endsection

