<?php

namespace App\Http\Controllers;
use App\Models\PropertyRent;
use App\Models\BookApointment;
use App\Models\PropertySale;

use Illuminate\Http\Request;

class AdminController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function index()
    {
      return view('admin.index');
       
    }
    public function profile()
    {
      return view('admin.profile');
       
    }
    public function sale(Request $request)
    {
        if ($request->ajax()) {
            $data = PropertySale::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      return view('admin.sale');
       
    }

    public function rent(Request $request)
    {
        if ($request->ajax()) {
            $data = PropertyRent::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      return view('admin.rent');
       
    }

    public function apointment(Request $request)
    {
        if ($request->ajax()) {
            $data = BookApointment::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      return view('admin.apointment');
       
    }


}
