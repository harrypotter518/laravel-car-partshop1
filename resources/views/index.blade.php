@extends('layout')
 
@section('content')




    <div class="row">
        <div class="col-lg-12 margin-tb">
           
            <div class="pull-left">
                <a class="btn btn-primary" href="{{route('admin')}}"> Admin</a>
            </div>
            <div class="pull-left">
                <a class="btn btn-danger" href="{{route('carts')}}"> Cart ({{$cartcnt ?? '0'}}) </a>
            </div>
        </div>
    </div>

    <div class="container">   
        <div class="container mt-5 text-center">
            <form action="{{ route('products.index') }}" method="GET" role="search" display="float">
                     
                <center style="display: inline-flex; ">
                    <div style="width:30vw;">
                        <input type="text" class="form-control" name="term" placeholder="Search product code" id="term" value="{{ $products->term ?? ''}}" style="width:100%; padding-right:0px;">
                  </div>
                  <div >
                       <button class="btn btn-info" type="submit" title="Search projects" style=" padding-left:0px;">
                          SEARCH
                        </button>
                  </div>
              </center>  
                
            </form>
        </div>
        
        <div class="row" style="margin-top:3vh ">
            <div class="col-lg-12 margin-tb" style="text-align: center">
                    <h1>TOYOTA Spare Parts</h1>          
            </div>
        </div>
    </div>
      
    <div class="row">
        <div class="col-3"> 
            <img src="{{url('/1b138215bd6d6ea221a6d68ff80380ba.png')}}" alt="car2" width="100%" style="    box-shadow: 0px 30px 30px;">
        </div>
        <div class="col-8"> 
            <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Maker</th>
                <th>Part#</th>
                <th>Description</th>
				<th>Price(USD)</th>
				<th>Cart</th>
				
              
            </tr>
            @if(count($products)>=1)
                @foreach ($products as $product)
                <tr>
                    <td  style="vertical-align: middle">{{ ++$i}}</td>
                    <td  style="vertical-align: middle">TOYOTA</td>
                    <td  style="vertical-align: middle">  
                    <?php
                        $description= str_replace(" ","-",$product->description);
                        $product->price = round((float)$product->price*1.25 *100)/100.0;
                       
                        $part1 = substr($product->part,0,5);
                        $part2 = substr($product->part,5);
                    
                    
                    ?>
                        <a class="btn btn-info" href="{{route('products.show','TOYOTA-'.$product->part.'-'.$description.'/'.$product->qty)}}" style="width:12vw"> {{$part1}}-{{$part2}} </a>
                    </td>
                     
                    <td  style="vertical-align: middle">{{ $product->description }}</td>

					
					
					<td  style="vertical-align: middle">{{ $product->price }}</td>
					
					<td  style="width:16vw;vertical-align: middle;">

						<form action="{{route('carts.cartadd')}}" method="GET" role="search" display="float" style="margin-top:-3vh; padding-top:0vh; " >
							
								<center style="display: inline-flex; ">
									<div class="row">
										<input type="number"  name="cnt" placeholder="number" id="cnt"  value="1" style="width:6vw; padding-right:0px;">
									
										
									</div>
									<div class="row">
											<button class="btn btn-success" type="submit" title="Search projects" style=" padding-left:0px;width:6vw;">
											Add to Cart
											</button>
									</div>
								</center>  
								<input type="hidden" name="partid" value="{{$product->part}}">
    							<input type="hidden" name="qty" value="{{$product->qty}}">
    							<input type="hidden" name="price" value="{{$product->price}}">
                                <input type="hidden" name="page_info" value="index">
					
							 
						</form>
					</td>
                  
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No Products found. Try to search again !</td>
                </tr>

            @endif    
            </table>
          
        </div>
       
      

  </div>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-7">{!! $products->links() !!}</div>
        <div class="col-2"></div>
    </div>
             
   
      
@endsection