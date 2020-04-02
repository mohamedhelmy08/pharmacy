@extends('master')
@section('nav')
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li ><a href="/home">Home</a></li>
                <li class="active"><a href="/Pharmacy/show">Pharmacy</a></li>
                <li><a href="/Medicine/show">Medicine</a></li>
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
            <strong class="text-black">Add New  Branch</strong>
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
                <h2 class="h3 mb-3 text-black">Branch Info</h2>
            <div class="p-3 p-lg-5 border">
            <form action="{{ url('Pharmacy/addNewBranch') }}" method="post" id="edit-form" enctype="multipart/form-data">
                      {{csrf_field()}}
                <div class="form-group row">
                  <div class="col-md-4">
                    <label for="name" class="text-black">Country <span class="text-danger">*</span></label>
                    <select name="country"  class="form-control"  required="">
                    @foreach ($countries as $value)
                        <option value="{{$value->Country_ID}}">{{ $value->Country }}</option>
                    @endforeach
                     </select>
                  </div>
                  <div class="col-md-4">
                      
                    <label for="Oname" class="text-black">State <span class="text-danger">*</span></label>
                    <select name="state" onchange="myFunction()" class="form-control" id="state" required="">
                      <option value="0"> ----- Select State ---------</option>
                    @foreach ($states as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                          </select>
                  </div>
                  <div class="col-md-4">
                      
                    <label for="Oname" class="text-black">City <span class="text-danger">*</span></label>
                    <select name="city" class="form-control" id="city" required="">
                          </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="region" class="text-black">Region Name <span class="text-danger">*</span></label>
                    <input type="text"  id="region" name="region" class="form-control" required="">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                  <label for="phone" class="text-black">Location <span class="text-danger">* Pin your Location on the Map</span></label>
                  
                </div>
                </div>
               <div class="form-group row">
                  <div class="col-lg-4">
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
