@extends('layout')

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
           
            <div class="pull-left">
                <a class="btn btn-primary" href="{{route('products.index') }}"> Home</a>
            </div>
            <div class="pull-left">
                <a class="btn btn-danger" href="{{route('carts')}}"> Cart ({{$cartcnt ?? '0'}}) </a>
            </div>
        </div>
    </div>
    <?php
        $part1 = substr($product->part,0,5);
        $part2 = substr($product->part,5);
    ?>
    <div class="row" style="padding-top: 10vh; text-align: center;">
        <div class="col-lg-12 margin-tb">
            <h2>Genuine {{$product->part}}({{$part1}}-{{$part2}}),TOYOTA {{$product->description}}</h2>
            <!-- <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div> -->
        </div>
    </div>
   
    <div class="row">
        <div class="col-3"> 
            <img src="{{url('/1b138215bd6d6ea221a6d68ff80380ba.png')}}" alt="car1" width="100%" style="    box-shadow: 10px 30px 30px;">
        </div>
        <div class="col-6"> 
            <table class="table table-bordered" style="color:white">
            <?php
                 $product->price = round((float)$product->price*1.25 *100)/100.0;
                $product->vweight = round((float)$product->vweight *10000)/10000.0;
                $product->weight = round((float)$product->weight *1000)/1000.0;
                $product->height = round((float)$product->height *1000)/1000.0;
                $product->length = round((float)$product->length *1000)/1000.0;
                $product->width = round((float)$product->width *1000)/1000.0;               

            ?>
       
                <tr>
                    <td> Manufacturer</td>
                    <td >TOYOTA</td>        
                </tr>
              
                 <tr>
                    <td> Part#</td>
                    <td >{{$part1}}-{{$part2}}</td>        
                </tr>
                <tr>
                    <td>Description</td>
                    <td >{{ $product->description }}</td>        
                </tr>
                 <tr>
                    <td>Price</td>
                    <td >{{ $product->price }}</td>        
                </tr>
                 <tr>
                    <td>Qty</td>
                    <td >{{ $product->qty }}</td>        
                </tr>
              
                <tr>
                    <td>Origin</td>
                    <td >{{ $product->origin }}</td>        
                </tr>
                <tr>
                    <td> Weight</td>
                    <td >{{ $product->weight }}  kg</td>        
                </tr>
                <tr>
                    <td> V.Weight</td>
                    <td >{{ $product->vweight }}  Kg</td>        
                </tr>
                 <tr>
                    <td>Lenght</td>
                    <td >{{ $product->length }}  m</td>        
                </tr>
                 <tr>
                    <td>Width</td>
                    <td >{{ $product->width }}  m</td>        
                </tr>
                <tr>
                    <td> Height</td>
                    <td >{{ $product->height }}  m</td>        
                </tr>
             
            </table>
        </div>
        <div class="col-3"> 
            <div class="row">
                <img src="{{url('/92297bff9df5a9606f34aa3583b29e67.png')}}" alt="car2" width="100%" >
            </div>
            
           
        </div>
        
    </div>

     <div class="row">
        <div class="col-5"></div>
        <div class="col-7">
             <form action="{{route('carts.cartadd')}}" method="GET" role="search" display="float" style="padding-top:0vh;">
                                
                        <center style="display: inline-flex; ">
                            <div class="row">
                                <input type="number"  name="cnt" placeholder="number" id="cnt"  value="1" style="width:7vw; padding-right:0px;">
                            
                                
                            </div>
                            <div class="row">
                                    <button class="btn btn-success" type="submit" title="Search projects" style=" padding-left:0px;">
                                    Add to Cart
                                    </button>
                            </div>
                            <input type="hidden" name="partid" value="{{$product->part}}">
                            <input type="hidden" name="qty" value="{{$product->qty}}">
                            <input type="hidden" name="price" value="{{$product->price}}">
                            <input type="hidden" name="page_info" value="show">
                        
                        </center>  
                     
                </form>
            
        </div>
               
</div>
    


@endsection

