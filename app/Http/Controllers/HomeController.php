<?php

namespace App\Http\Controllers;
use App\Models\PropertySale;
use App\Models\PropertyRent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rents = PropertyRent::with('location','detail','feature')->latest()->take(10)->get();
        $sales = PropertySale::with('location','detail','feature')->latest()->take(10)->get();
        // dd($propertyRent,$propertySale);
        return view('welcome',compact('rents','sales'));
    }
    public function rent()
    {
        $rents = PropertyRent::with('location','detail','feature')->latest()->take(10)->get();
       
        return view('rent',compact('rents'));
    }
    public function sale()
    {
        
        $sales = PropertySale::with('location','detail','feature')->latest()->take(10)->get();
        // dd($propertyRent,$propertySale);
        return view('sale',compact('sales'));
    }


// sow rent
    public function show_rent(propertyrent $propertyrent)
    {
        $rents = PropertyRent::with('location','detail','feature')->latest()->take(4)->get();
        $rent = PropertyRent::with('location','detail','feature')->where('id',$propertyrent->id)->get();
        return view('singleProperty', compact('rent','rents'));
    }
// show sales

public function show_sale(propertysale $propertysale)
{
    $sales = PropertySale::with('location','detail','feature')->latest()->take(4)->get();
    $sale = PropertySale::with('location','detail','feature')->where('id',$propertysale->id)->get();
    return view('singleSale', compact('sale','sales'));
}
    public function search(Request $request)
    {
        $rents = PropertyRent::where(
            
            function($query) use($request){
                if($term = $request->term){
                    $query->orWhere('title','like', '%'.$term .'%')
                    ->orWhere('description','like', '%'.$term .'%')
                    ->orWhere('currency','like', '%'.$term .'%')
                    ->orWhere('property_status','like', '%'.$term .'%')
                    ->orWhere('property_type','like', '%'.$term .'%')
                    ->orWhere('property_label','like', '%'.$term .'%')
                    ->orWhere('monthly_rate','like', '%'.$term .'%')->get();
                  
                }
               
            }
        )  ->with(['location' => function ($query) use($request) {
            if($term = $request->term){
            $query->orWhere('address','like', '%'.$term .'%')
            ->orWhere('city','like', '%'.$term .'%')
            ->orWhere('region','like', '%'.$term .'%')
            ->orWhere('country','like', '%'.$term .'%')
           ->get();
          
        }}],'detail','feature')->latest()->take(10)->get();
        $sales = PropertySale::where(
            
            function($query) use($request){
                if($term = $request->term){
                    $query->orWhere('title','like', '%'.$term .'%')
                    ->orWhere('description','like', '%'.$term .'%')
                    ->orWhere('currency','like', '%'.$term .'%')
                    ->orWhere('property_status','like', '%'.$term .'%')
                    ->orWhere('property_type','like', '%'.$term .'%')
                    ->orWhere('property_label','like', '%'.$term .'%')
                    ->orWhere('sale_price','like', '%'.$term .'%')->get();
                  
                }
               
            }
        )  ->with('location','detail','feature')->latest()->take(10)->get();
        // dd($propertyRent,$propertySale);
        return view('searchResult',compact('rents','sales'));
    }
}
