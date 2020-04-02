<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = DB::table('Category')->paginate(6);
        $data = DB::table('Product')->join('PH_PROD','PH_PROD.Product_ID','=','Product.id')->join('Category','Category.Cat_ID','=','Product.Cat_ID')->join('Branch','PH_PROD.Branch_ID','=','Branch.Branch_ID')->join('Region','Branch.Region_Id','=','Region.id')->select('Product.id','Product.Product_Name','Product.Cat_ID','PH_PROD.Branch_ID','PH_PROD.QTY','PH_PROD.Price','Region.Region_Name','Category.Category_Name')->get();
        //dd($data);
        return view('Medicine.show')->with('categories',$categories)->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addNewCategory(Request $request)
    {
      $cat_name = $request->input('cname');
       // $cat = new Category;
      DB::table('Category')->insert(['Category_Name'=>$cat_name ]);
         session()->push('alert','Success'); 
        session()->push('alert','Category Added Successfully');
        return redirect('Medicine/category');
    }
    public function showCategory()
    {   
        $categories = DB::table('Category')->get();
        return view('Medicine.category')->with('categories',$categories);
    }
    public function delete($id)
    {  
       $check =DB::table('Category')->where('Sub_Cat_ID',$id)->get();
       //dd(empty($check[0]));
       if (empty($check[0]))  {
           DB::table('Category')->where('Cat_ID',$id)->delete();
            session()->push('alert','Success');
            session()->push('alert','Category Deleted Successfully');
        return redirect('Medicine/category');
        }else{
          session()->push('alert','Danger');
          session()->push('alert','Can not Delete Main Category Before Delete his Subs');
        return redirect('Medicine/category');
      }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAddMedicine()
    {
      
       $categories = DB::table('Category')->get();
      $id = Auth::guard()->id();
      $branchs = DB::table('Branch')->join('Region','Region.id','=','Branch.Region_Id')->where('Branch.Ph_ID','=',$id)->get();
        return view('Medicine.addMedicine')->with('branchs',$branchs)->with('categories',$categories);
    }
    public function addNewMedicine(Request $request)
    {
        $this->validate($request,['mname'=>'required:Product,Product_Name',
            'uprice'=>'required',
            'qty'=>'required']);
        $id = DB::table('Product')->insertGetId(['Product_Name'=>$request->mname ,'Cat_ID'=>$request->category]);
      $pid = Auth::guard()->id();
      DB::table('PH_PROD')->insert(["Ph_ID"=>$pid,"Product_ID"=>$id,"Branch_ID"=>$request->branch,"QTY"=>$request->qty,"Price"=>$request->uprice]);
      session()->push('alert','Success');
      session()->push('alert','Medicine Added Successfully');
       return redirect('Medicine/show');
    }
    public function showEditMedicine($id)
    {   
      $categories = DB::table('Category')->get();
      $pid = Auth::guard()->id();
      $branchs = DB::table('Branch')->join('Region','Region.id','=','Branch.Region_Id')->where('Branch.Ph_ID','=',$pid)->get();
      $medicine = DB::table('Product')->join('PH_PROD','PH_PROD.Product_ID','=','Product.id')->where('Product.id',$id)->get()->first();
        return view('Medicine.editMedicine')->with('medicine',$medicine)->with('branchs',$branchs)->with('categories',$categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editMedicine(Request $request,$id)
    {
      $this->validate($request,['mname'=>'required:Product,Product_Name',
            'uprice'=>'required',
            'qty'=>'required']);
        //dd($id);
        DB::update('update "Product" set "Product_Name" = ?,"Cat_ID"=? where "id" = ? ',[$request->mname,$request->category,$id]);
        DB::update('update "PH_PROD" set "Branch_ID" = ?,"QTY"=?,"Price"=? where "Product_ID" = ? ',[$request->branch,$request->qty,$request->uprice,$id]);

        session()->push('alert','Success');
        session()->push('alert',' Medicine Updated Successfully');
        return redirect('Medicine/show');
    }
   public function deleteMedicine($id)
    {      
           DB::table('PH_PROD')->where('Product_ID',$id)->delete();
           DB::table('Product')->where('id',$id)->delete();
            session()->push('alert','Success');
            session()->push('alert','Medicine Deleted Successfully');
        return redirect('Medicine/show');
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
