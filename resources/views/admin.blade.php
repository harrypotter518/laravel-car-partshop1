@extends('layout')
 
@section('content')

     <button class="btn " style="text: left">

            <a class="btn btn-primary" href="{{route('products.index')}}">Home</a>
        </button>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
	<div class="row" style="padding-top: 10vh;">
		<div class="col-3"> 
            <img src="{{url('/1b138215bd6d6ea221a6d68ff80380ba.png')}}" alt="car2" width="100%" style="    box-shadow: 10px 30px 30px;">
        </div>
        <div class="col-6"> 
    		<div class="container text-center" >
		        <h1 class="mb-4">
		          Import and Export CSV & Excel to Database
		        </h1>

		        <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data" style="padding-top: 10vh; margin-bottom: 10vh;">
		            @csrf
			 		<input type="file" name="file" >
		           <!--  <div class=" mb-4" style="max-width: 500px; margin: 0 auto;">
		                <div class="custom-file text-left">
		                    <input type="file" name="file" class="custom-file-input" id="customFile">
		                    
		                    <label class="custom-file-label" for="customFile">Choose file</label>
		                </div>
		            </div> -->
		            <button class="btn btn-primary">Import data</button>
		            <a class="btn btn-success" href="{{ route('file-export') }}">Export data</a>
					<a class="btn btn-danger" href="/admin/clear">Delete All</a>
		        </form>

		        @if ($data ?? '')
			        <div class="alert alert-success" style="width:30vw; text-align: center; margin-top:10vh;margin: auto; ">
			            
			            	<p style=" margin: auto;">{{ $data ?? '' }}</p>
			        </div>
			    @endif
		    </div>
        </div>
        <div class="col-3"> 
            <img src="{{url('/92297bff9df5a9606f34aa3583b29e67.png')}}" alt="car2" width="100%" style="    box-shadow: 10px 30px 30px;">
        </div>
			
        
	</div>



	
@endsection