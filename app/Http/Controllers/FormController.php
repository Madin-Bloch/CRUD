<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Form;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FormController extends Controller
{

    function home(){
  
        $alldata = Form::all();
        return view('home',['alldata' => $alldata]);
    }

    function index(){
        $alldata = Form::all();
        return view('welcome',['alldata' => $alldata]);
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:forms,email,' . $request->id,
            'phone' => [
                'required',
                'digits:10',
                Rule::unique('forms')->ignore($request->id),
            ],
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'gender' => 'required|in:male,female',
        ]);

        $user = Form::updateOrCreate(
            ['id' => $request->id], // If ID exists → update, else insert
            [
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'gender' => $request->gender,
            ]
        );
       // Delete old & upload new Aadhaar image
    if ($request->hasFile('aadhaar_card')) {
        if ($user->aadhaar_card && file_exists(public_path('uploads/' . $user->aadhaar_card))) {
            unlink(public_path('uploads/' . $user->aadhaar_card));
        }
        $user->aadhaar_card = $user->upload($request->file('aadhaar_card'), 'aadhar');
    }

    // Delete old & upload new PAN image
    if ($request->hasFile('pan_card')) {
        if ($user->pan_card && file_exists(public_path('uploads/' . $user->pan_card))) {
            unlink(public_path('uploads/' . $user->pan_card));
        }
        $user->pan_card = $user->upload($request->file('pan_card'), 'pan');
    }

    // Delete old & upload new Profile image
    if ($request->hasFile('profile_photo')) {
        if ($user->profile_photo && file_exists(public_path('uploads/' . $user->profile_photo))) {
            unlink(public_path('uploads/' . $user->profile_photo));
        }
        $user->profile_photo = $user->upload($request->file('profile_photo'), 'profile');
    }
        // $user->image = $user->upload($request->file('image'));
        $user->save();

        return redirect()->back()->with('success', $request->id ? 'Form updated!' : 'Form submitted!');
    }


    public function destory($id){
        $record = Form::find($id);
        $record->delete();
        return redirect()->back()->with('success','record deleted');
    } 

    public function edit($id){
        $user = Form::findOrFail($id);
        $alldata = Form::all();
        return view('create', compact('user', 'alldata'));
    }

    public function showtable(){
        $alldata = Form::all();
        return view('showtable',['alldata' => $alldata]);
    }
    

    public function showform(){
        $alldata = Form::all();
        return view('create',['alldata' => $alldata]);
    }

    public function countryList(){
        $data['alldata'] = Form::all();
        $data['countries'] = Country::get(["name", "id"]);
        return view('countries-list',$data);
    }   

    public function fetchState(Request $request){
        $data['states'] = State::where("country_id", $request->country_id)
                                ->get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchCity(Request $request) {
        $data['cities'] = City::where("state_id", $request->state_id)
                                    ->get(["name", "id"]);                                  
        return response()->json($data);
    }
}
