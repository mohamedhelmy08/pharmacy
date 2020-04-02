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
            <strong class="text-black">Add New Medicine</strong>
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
<div class="container">
    <div class="row">
     <div class="col-md-12 mb-0">
           <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">New Medicine</h2>              
                <div class="p-3 p-lg-5 border">
                <form method="POST" action="{{ url('/Medicine/addNewMedicine') }}">
                        @csrf
                    <div class="form-group row">
                      <div class="col-md-12">
                        <label for="branch" class="text-black">Branch<span class="text-danger">*</span></label>
                      <select name="branch"  class="form-control"  required="">
                        @foreach ($branchs as $value)
                            <option value="{{$value->Branch_ID}}">{{ $value->Region_Name }} Branch</option>
                        @endforeach
                       </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="mname" class="text-black">Medicine Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="" id="mname" name="mname">
                      </div>
                      <div class="col-md-6">
                        <label for="category" class="text-black">Category<span class="text-danger">*</span></label>
                    <select name="category"  class="form-control"  required="">
                      @foreach ($categories as $value)
                          <option value="{{$value->Cat_ID}}">{{ $value->Category_Name }}</option>
                      @endforeach
                     </select>
                      </div>

                    </div>
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="uprice" class="text-black">Unit Price <span class="text-danger">*</span></label>
                        <input id="uprice" type="Number" class="form-control" name="uprice" required >
                      </div>
                      <div class="col-md-6">
                        <label for="qty" class="text-black">Quantity <span class="text-danger">*</span></label>
                        <input id="qty" type="Number" class="form-control" name="qty" required >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Add">
                      </div>
                    </div>
               </form>
                </div>
              </div>
            </div>
     </div>
    </div> 
</div> 
@endsection
