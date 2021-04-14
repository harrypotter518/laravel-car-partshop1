<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
use App\Models\Product;
use App\Models\Cart;
use DB;

class ProductController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
      
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct()
    {
        ini_set('max_execution_time', 1200);
        // ini_set('post_max_size', '100M');
        // ini_set('upload_max_filesize', '500M');
        ini_set('memory_limit', '1024M');
        // ini_set('max_input_time', 5000);
    }

    public function fileImport(Request $request) 
    {
        if ($request->file('file'))
        {
            
             Excel::import(new ProductsImport, $request->file('file')->store('temp'));
                $success = "Products are updated successfully";
                //return back();
                return view('admin',['data'=>$success]);
        }
        else
        {
           $input_error = 'Select Excel file';
            return view('admin',['data'=>$input_error]);
                       
            // return echo '<script type="text/javascript">toastr.success('asda')</script>';
        }
       
    }

    public function clear() 
    {
        Product::truncate();
                $success = "All products are deleted successfully";
               
                return view('admin',['data'=>$success]);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport() 
    {
        return Excel::download(new ProductsExport, 'products-collection.xlsx');
    }    




     public function index(Request $request)
    {
        //$products = Product::latest()->paginate(5); 
        $request->term = str_replace("-","",$request->term);
         $products = Product::where([
            ['part', '!=',Null],
            [function($query) use ($request){
                if(($term = $request->term)){
                     $query->orWhere('part', 'like', '%'.$term.'%')->get();
                }

            }]
           
        ])
        ->orderBy('id', 'asc')
        ->paginate(10);

        $products->term = $request->term;
        $cartcnt =  DB::table('carts')->count();
        return view('index',compact('products'))
            ->with('i',  (request()->input('page', 1) - 1) * 10)->with('cartcnt', $cartcnt);
    }
   

  

    public function cartupdate(Request $request)
    {         
            $tprice= (float)$request->price * (int)$request->cnt;

            DB::table('carts')
            ->where('partid', $request->partid)
            ->update([
                'cnt' =>$request->cnt,
                'tprice' => $tprice
            ]);

            $carts = DB::table('carts')
            ->join('products', 'partid', '=', 'products.part')
            ->paginate(10);

            // $carts = DB::table('carts')
            // ->orderBy('id', 'desc')
            // ->paginate(10);

            $totalprice =  DB::table('carts')
            ->sum('tprice');

            return view('cartshow')->with('carts', $carts)->with('i',  (request()->input('page', 1) - 1) * 10)->with('totalprice',  $totalprice);
        
    }

      public function cartadd(Request $request)
    {
        $similarity=  DB::table('carts')
        ->where('partid', $request->partid)->count();

        if ($similarity ==0)
        {
            $tprice= (float)$request->price * (int)$request->cnt;
            DB::table('carts')->insert([
                'partid' => $request->partid,
                'qty' => $request->qty,
                'cnt' => $request->cnt,
                'price' => $request->price,
                'tprice' => $tprice,
    
            ]);
        }
        else{
            $original_cnt =  DB::table('carts')
            ->select('cnt')
            ->where('partid', $request->partid)->pluck('cnt')[0];

            $request->cnt +=  $original_cnt; 
            $tprice= (float)$request->price * (int)$request->cnt;

            DB::table('carts')
            ->where('partid', $request->partid)
            ->update([
                'cnt' =>$request->cnt,
                'tprice' => $tprice
            ]);

        }  

        $product = DB::table('products')
        ->where('part', $request->partid)
        ->get();

        $cartcnt =  DB::table('carts')->count();

        if ($request->page_info == "show")
            return view('show')->with('product', $product[0])->with('cartcnt', $cartcnt);

        if ($request->page_info == "index")
        {         
            return redirect('/products');
        }
        return 0;
        
    }
  
    public function carts(Request $reuqest)
    {
       
        $carts = DB::table('carts')
            ->join('products', 'partid', '=', 'products.part')
            ->paginate(10);
         $totalprice =  DB::table('carts')
                            ->sum('tprice');

        return view('cartshow')->with('carts', $carts)->with('i',  (request()->input('page', 1) - 1) * 10)->with('totalprice',  $totalprice);


    }

    public function show(Request $request)
    {
       $str = explode("-",$request->p_code);
       $key = $str[1];
       
       
        $product = DB::table('products')
                        ->where('part', $key)
                        ->get();
        $cartcnt =  DB::table('carts')->count();
        return view('show')->with('product', $product[0])->with('cartcnt', $cartcnt);;
    }

    public function cartdel(Request $request)
    {
        $product = DB::table('carts')
        ->where('partid', $request->del_id)
        ->delete();
  
         $carts = DB::table('carts')
            ->join('products', 'partid', '=', 'products.part')
            ->paginate(10);
         $totalprice =  DB::table('carts')
                            ->sum('tprice');

        return view('cartshow')->with('carts', $carts)->with('i',  (request()->input('page', 1) - 1) * 10)->with('totalprice',  $totalprice);
       
    }    
   
 
}