<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AgentController extends Controller
{
    use MediaUploadingTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->roles =="agent"){
            return view('agent_dashboard.index');
        }else{
            return redirect()->route('agent.create');
        }
       
    }


    public function create()
    {
        return view('agent_dashboard.create');
    }


    public function store(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $phone_number = $request->input('phone_number');
        $gps_address = $request->input('gps_address');
        $address = $request->input('address');
        $city = $request->input('city');
        $region = $request->input('region');
        $country = $request->input('country');
        
        $agent =  Agent::create([
            'user_id'=> Auth::id(),
            'roles'=>'agent',
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'phone_number'=>$phone_number,
            'gps_address'=>$gps_address,
            'address'=>$address,
            'city'=>$city,
            'region'=>$region,
            'country'=>$country,
           
           
        ]
            
        );
        if($agent){
          $user = User::where('id', Auth::id())->update(['roles' => 'agent']);
        }

        
        if ($request->input('id_card', false)) {
            $media =   $agent->addMedia(public_path('uploads/' . $request->input('id_card')))->toMediaCollection('id_card');
       }

      

       return redirect()->route('agent.index');
       
    }
}
