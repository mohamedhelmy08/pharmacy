@extends('master')
@section('nav')
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li ><a href="/home">Home</a></li>
                <li ><a href="/Pharmacy/show">Pharmacy</a></li>
                <li class="active"><a href="/Medicine/show">Medicine</a></li>
                <li><a href="#">Orders</a></li>
              </ul>
            </nav>
          </div>
@endsection
@section('content')
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Show Medicine</strong>
          </div>
        </div>
      </div>
    </div>
              <div class="container content" style="padding-top:60px;">
                   @if(count($errors)>0)
                       <div class="alert alert-danger">
                           <ul>
                           @foreach($errors->all() as $error)
                               <li>{{ $error }}</li>
                           @endforeach
                           </ul>
                       </div>
                   @endif

                 @if(Session::has('alert'))
                       <center>
                           <div>
                               <?php $a = [];  $a = session()->pull('alert')  ?>
                               @if($a[0]=="Danger")
                                   <div class="alert alert-danger">
                                       <label>{{$a[1]}}</label>
                                   </div>
                               @else
                                   <div class="alert alert-success">
                                      <label>{{$a[1]}}</label>
                                   </div>
                               @endif
                           </div>
                       </center>
                  @endif
                </div> 
  <div class="container">
    <div class="row">
     <div class="col-md-12 mb-0">
      <div class="row mb-5">
        <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Medicine Categories</h2>
            <div class="p-3 p-lg-5 border">
            <div class="row">
              @foreach($categories as $category)
              <div class="col-md-6"><ul><li><label for="name" class="text-black">{{$category->Category_Name}} </label></li></ul></div>
              @endforeach
              <div class="col-md-12">
              <a href="/Medicine/category" class="btn btn-primary" style="float: right;padding: 8px;">View All Categories</a>
              </div>
             </div> 
            </div>
        </div>
      </div>
    </div>
   </div>
  </div>
<div class="container">
    <div class="row">
     <div class="col-md-12 mb-0">
           <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Medicines</h2>
                <a href="/Medicine/addNewMedicine" style="float: right; margin-right:30px; " class="btn btn-primary">New Medicine</a>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Branch</th>
                          <th>Category</th>
                          <th>Medicine</th>
                          <th>Quantity</th>
                          <th>Unit Price</th>
                          <th>Edit</th>
                          <th>Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $data)
                            <tr>
                              <td>{{$data->Region_Name}} Branch</td>
                              <td>{{$data->Category_Name}}</td>
                              <td>{{$data->Product_Name}}</td>
                              <td>{{$data->QTY}}</td>
                              <td>{{$data->Price}}</td>
                              <td><a  href="/Medicine/editMedicine/{{$data->id}}" class="btn btn-primary">Edit</a></td>
                             
                              <td><a  href="/Medicine/delete/{{$data->id}}" class="btn btn-danger">X</a></td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
              </div>
           </div>
    </div>
  </div>
</div>
@endsection
