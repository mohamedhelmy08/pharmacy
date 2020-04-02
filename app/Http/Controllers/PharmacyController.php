<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pharmacy;
use Auth;
use DB;
use Hash;
class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $id = Auth::guard()->id();
        $pharmacy = DB::table('Pharmacy')->where('id',$id)->get()->first();
        $data = DB::table('Branch')->join('Region','Region.id','=','Branch.Region_Id')->join('City','City.City_ID','=','Region.City_ID')->join('Governoment','Governoment.Govern_ID','=','City.Gov_ID')->where('Branch.Ph_ID','=',$id)->get();        
        //dd($id);
        $date=date("Y-m-d");
        return view('Pharmacy.show')->with('pharmacy',$pharmacy)->with('data',$data)->with('date',$date);
    }
   
    public function myformAjax($id)
    {
        $cities = DB::table("City")
                    ->where("Gov_ID",$id)
                    ->pluck("City_Name","City_ID");
        return json_encode($cities);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function pharmacy_edit(Request $request, $pid)
      {
         $this->validate($request,[
                      "name" => 'required|min:2',
                      "phone" => 'required|min:11|numeric',
                      'Oname' => 'required|min:2',
                       'email'=>'required|string|email|max:255|unique:Pharmacy',]
                      ,
                      ['name.required' => 'Pharmacy Name is Required',
                      'phone.required' => 'Pharmacy Phone is Required',
                      'phone.numeric' => 'Pharmacy Phone is Format Must be Number',
                      'Oname.required' => 'Owner Name is Required',
                      'name.min' => 'Pharmacy Name must be 2 Characters or More',
                      'phone.min' => 'Pharmacy Phone must be 11 Characters',
                      'Oname.min' => 'Owner Name must be 2 Characters or More',
                  ]);
                 //$pharmacy = DB::table('Pharmacy')->where('Ph_ID',$pid)->get()->first();
                 
                  DB::update('update "Pharmacy" set "Ph_Name" = ?,"Ph_Owner"=?,email=?,phone=? where "id" = ? ',[$request->name,$request->Oname,$request->email,$request->phone,$pid]);
                 // $pharmacy->Ph_Name = $request->name;
                 // $pharmacy->phone = $request->phone;
                 // $pharmacy->email = $request->email;
                 // $pharmacy->Ph_Owner= $request->Oname;
                 // $pharmacy->save();
             return redirect('Pharmacy/show');
      }
      public function change_pharmacy_password(Request $request)
      {

        //dd($request);
         $this->validate($request, [
             'old' => 'required|min:6',
             "password" => 'required|min:2',
             "cpassword" => 'required|min:2|same:password'
             ,
             [
             'password.required' => 'Your Password is required',
              'old.required' => 'Old Password is Required',
             'cpassword.required' => 'Confirm Password is Required',
             'cpassword.same' => 'Confirm Password Must Be Identical to Password',
             ]
         ]);
            $id = Auth::guard()->id();
            $user = DB::table('Pharmacy')->where('id',$id)->get()->first();
        
         $hashedPassword = $user->password;
            //dd($hashedPassword);
         if (Hash::check($request->old, $hashedPassword)) {
             //Change the password
             $user->fill([
                 'password' => Hash::make($request->password)
             ])->save();

         session()->push('alert','Success');
         session()->push('alert','Password Changed Successfully');
           return back();

         }
         session()->push('alert','Danger');
         session()->push('alert','Erorr Password Does not Changed');
         return back();

      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showAddBranch()
    {   
       $countries = DB::table('Country')->get();
       //dd($countries);
       $states = DB::table('Governoment')->pluck("Govern_Name","Govern_ID");
        return view('Pharmacy.addNewBranch',compact('states'))->with('countries',$countries);
    }
    public function addNewBranch(Request $request)
    {
        $this->validate($request,[
                      "region" => 'required|min:2',
                      ]);
        $city = $request->city;
        $region = $request->region;
        $longtude=0.9828768;
        $latude=0.62833387;
        $id = DB::table('Region')->insertGetId(['City_ID'=>$city,'Region_Name'=>$region ,'Lang'=>$longtude,'Latitude'=>$latude]);
      $pid = Auth::guard()->id();
      $region_id=$id;
      DB::table('Branch')->insert(["Ph_ID"=>$pid,"Region_Id"=>$region_id]);
      session()->push('alert','Success');
      session()->push('alert','Branch Added Successfully');
      return redirect('Pharmacy/show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   public function editBranch(Request $request,$id)
    {
        $this->validate($request,[
                      "region" => 'required|min:2',
                      ]);
        $city = $request->city;
        $region = $request->region;
        $longtude=0.5467688;
        $latude=0.23435567;
       
        DB::update('update "Region" set "City_ID" = ?,"Region_Name"=?,Lang=?,Latitude=? where "id" = ? ',[$city,$region,$longtude,$latude,$id]);
      session()->push('alert','Success');
      session()->push('alert','Branch Updated Successfully');
      return redirect('Pharmacy/show');
    }
   
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function delete(Request $request,$bid,$rid)
    {
       DB::table('Branch')->where('Branch_ID',$bid)->delete();
        DB::table('Region')->where('id',$rid)->delete();
        // $branch->delete();
        // $region->delete();
       session()->push('alert','Success');
       session()->push('alert','Branch Deleted Successfully');
        return redirect('Pharmacy/show');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
   public function activate( $bid)
    { 
        $date = date("Y-m-d");
        $renewdate = date("Y-m-d",strtotime($date. "+12 month"));
        DB::update('update "Branch" set "Renewal_Flag" = ?,"Renewal_Date"=? where "Branch_ID" = ? ',[true,$renewdate,$bid]);
       session()->push('alert','Success');
       session()->push('alert','Branch Renewed Successfully');
       return redirect('Pharmacy/show');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
