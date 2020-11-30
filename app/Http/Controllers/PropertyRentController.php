<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Http\Request;
use App\Models\PropertyRent;
use App\Models\PropertyDetail;
use App\Models\Feature;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DataTables;
class PropertyRentController extends Controller
{
    use MediaUploadingTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)

    {

        if ($request->ajax()) {
            $data = PropertyRent::where('user_id',Auth::id())->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('agent_dashboard/create_listing/rent/index');


    }
    public function create()
    {
        return view('agent_dashboard/create_listing/rent/create');
    }


    public function store(Request $request)
    {
        
        
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'property_type' => 'required',
        //     'property_status' => 'required',
        //     'property_label' => 'required',
        //     'monthly_rate' => 'required',
        //     'yearly_rate' => 'required',
        //     'rent_duration' => 'required',
        //     'currency'
        // ]);
       
        $title = $request->input('title');
        $description = $request->input('description');
        $property_type = $request->input('property_type');
        $property_status = $request->input('property_status');
        $property_label = $request->input('property_label');
        $monthly_rate = $request->input('monthly_rate');
        $yearly_rate = $request->input('yearly_rate');
        $rent_duration = $request->input('rent_duration');
        $currency = $request->input('currency');
        $area = $request->input('area');
        $nature_of_building = $request->input('nature_of_building');
        $bedrooms = $request->input('bedrooms');
        $bathrooms = $request->input('bathrooms');
        $year_build = $request->input('year_build');
        $car_packing = $request->input('car_packing');
        $landlord_residential_status = $request->input('landlord_residential_status');
        $security = $request->input('security');
        $electricity = $request->input('electricity');
        $waste_disposal = $request->input('waste_disposal');
        $toilet = $request->input('toilet');
        $kitchen = $request->input('kitchen');
        $compound_cleaning = $request->input('compound_cleaning');
        $water = $request->input('water');
        $kitchen_type = $request->input('kitchen_type');
        $bathroom_type = $request->input('bathroom_type');
        $spcial_condition = $request->input('spcial_condition');
        $reason = $request->input('reason');
        $address = $request->input('address');
        $city = $request->input('city');
        $region = $request->input('region');
        $country = $request->input('country');
        $longitute = $request->input('longitute');
        $latitute = $request->input('latitude');
      

       
      $location =  Location::create([
            'address'=>$address,
            'city'=>$city,
            'region'=>$region,
            'country'=>$country,
            'longitute'=>$longitute,
            'latitute'=>$latitute,
           
        ]
            
        );
      
if($location){
  $propertyRent =  PropertyRent::create([
        'user_id'=>  Auth::id(),
        'location_id'=>$location->id,
        'title'=>$title,
        'description'=>$description,
        'property_type'=>$property_type,
        'property_status'=>$property_status,
        'property_label'=>$property_label,
        'property'=>$property_label,
        'monthly_rate'=>$monthly_rate,
        'yearly_rate'=>$yearly_rate,
        'rent_duration'=>$rent_duration,
        'currency'=>$currency,
    ]
        
    );

    if($propertyRent){
       $details= PropertyDetail::create([
            'property_rent_id'=>$propertyRent->id,
            'nature_of_building'=>$nature_of_building,
            'bedrooms'=>$bedrooms,
            'bathrooms'=>$bathrooms,
            'year_build'=>$year_build,
            'Area'=>$area,
            'car_packin'=>$car_packing,
            'landlord_residential_status'=>$landlord_residential_status,
            'security'=>$security,
            'electricity'=>$electricity,
            'compound_cleaning'=>$compound_cleaning,
            'waste_disposal'=>$waste_disposal,
            'toilet'=>$toilet,
            'kitchen'=>$kitchen,
            'water'=>$water,
            'kitchen_type'=>$kitchen_type,
            'bathroom_type'=>$bathroom_type,
            'special_condition'=>$spcial_condition,
            'reason'=>$reason,
           
        ]
            
        );
        if($details){
          
            foreach ($request->input('check') as $checked) {
                $rent_id =$details->property_rent_id;
                $feature = Feature::create([
                    'property_rent_id'=>$rent_id,
                       'features'=>$checked
                   ]);

            }
           
          
            if ($request->input('main_photo', false)) {
             $media =   $propertyRent->addMedia(public_path('uploads/' . $request->input('main_photo')))->toMediaCollection('main_photo');
        }

        foreach ($request->input('gallery', []) as $file) {
            $media =   $propertyRent->addMedia(public_path('uploads/' . $file))->toMediaCollection('gallery');
        }
           
           if( $feature){
            return redirect()->route('rent.index')
            ->with('success', 'Project created successfully.');
        }
           
        }
    }

}
       
       
       

    }





    public function edit(Property_rent $property_rent)
    {
        return view('property_rent.edit', compact('project'));
    }


    public function update(Request $request, Property_rent $property_rent)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'property_type' => 'required',
            'property_status' => 'required',
            'property_label' => 'required',
            'monthly_rate' => 'required',
            'yearly_rate' => 'required',
            'rent_duration' => 'required',
            'currency'
        ]);
        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }

    public function destroy( Property_rent $property_rent)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
}
