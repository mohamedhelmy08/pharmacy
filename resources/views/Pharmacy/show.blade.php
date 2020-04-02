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
            <strong class="text-black">Show Pharmacy</strong>
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
                <h2 class="h3 mb-3 text-black">Pharmacy Info</h2>
            <div class="p-3 p-lg-5 border">
              <div class="col-md-12"><label for="name" class="text-black">Pharmacy Name : {{$pharmacy->Ph_Name}}</label></div>
              <div class="col-md-12"> <label for="Oname" class="text-black">Pharmacy Owner : {{$pharmacy->Ph_Owner}}</label></div>
              <div class="col-md-12"><label for="email" class="text-black">Pharmacy Email : {{$pharmacy->email}}</label></div>
              <div class="col-md-12"><label for="phone" class="text-black">Pharmacy Phone : {{$pharmacy->phone}}</label></div> 
              <div style="float: right;"><button  class="btn btn-primary" data-toggle="modal" data-target="#exampleModaledit">Edit</button>
              <button  class="btn btn-primary" data-toggle="modal" data-target="#exampleModalpass">Change Password</button> 
            </div>
          </div>
          </div>
          </div>
           <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Branchs</h2>
                <a href="addNewBranch" style="float: right; margin-top:10px;margin-right:30px; " class="btn btn-primary">New Branch</a> 
               
                <div class="p-3 p-lg-5 border">
                <div class="row mb-5" style="margin-top: 10px;">
                  <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th class="product-thumbnail">Branch</th>
                            <th class="product-quantity">Renewable Date</th>
                            <th class="product-name">State</th>
                            <th class="product-total">City</th>
                            <th class="product-total">Pay</th>
                            <th class="product-remove">Remove</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $data)
                          <tr>

                            <td>
                              {{$data->Region_Name}}  Branch
                            </td>
                            <td >
                             {{$data->Renewal_Date}}
                            </td>
                            <td >
                              {{$data->Govern_Name}}
                            </td>
                            <td>{{$data->City_Name}}</td>
                            <td>
                              @if($data->Renewal_Date == $date || $data->Renewal_Date == null)
                              <a  href="{{ action('PharmacyController@activate',$data->Branch_ID) }}" class="btn btn-success" style="padding: 0;">Pay</a>
                               @else
                                <a  class="btn btn-success disabled" style="padding: 0;">Pay</a> 
                               @endif
                             </td>
                            <td><a  href="/Pharmacy/delete/{{$data->Branch_ID}}/{{$data->id}}" class="btn btn-danger" style="padding: 0;">X</a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </form>
                </div>
                 
                </div>
              </div>
            </div>
     </div>
    </div> 
   </div> 
 <div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 40px;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #51eaea;">
              <h5 class="modal-title" id="exampleModalLabel">Edit Form</h5>
            </div>
            <div class="modal-body">
             <form action="{{ url('pharmacy_edit/'.$pharmacy->id) }}" method="post" id="edit-form" enctype="multipart/form-data">
                      {{csrf_field()}}
                              <div class="form-group row">
                  <div class="col-md-6">
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    <label for="name" class="text-black">Pharmacy Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$pharmacy->Ph_Name}}" id="name" name="name">
                  </div>
                  <div class="col-md-6">
                      @error('Oname')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    <label for="Oname" class="text-black">Owner Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('Oname') is-invalid @enderror" value="{{$pharmacy->Ph_Owner}}" id="Oname" name="Oname">
                  </div>

                </div>
                <div class="form-group row">
                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                   @enderror
                  <div class="col-md-12">
                    <label for="email" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="email"  id="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email" autofocus value="{{$pharmacy->email}}">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      @error('phone')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  <label for="phone" class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{$pharmacy->phone}}" id="phone" name="phone" placeholder="Phone Number">
                </div>
                </div>
             </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-standard" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-standard" href="{{ url('pharmacy_edit/'.$pharmacy->id) }}"
             onclick="event.preventDefault();
                           document.getElementById('edit-form').submit();">
              {{ __('Update') }}
                </a>
            </div>
          </div>
        </div>
  </div>
  <div class="modal fade" id="exampleModalpass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 40px;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #51eaea;">
              <h5 class="modal-title" id="exampleModalLabel">Change Password Form</h5>
            </div>
            <div class="modal-body">
             <form action="{{ url('/update_pharmacy_password') }}" method="post" id="changpass-form" enctype="multipart/form-data">
                      {{csrf_field()}}
                <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                              <label for="password" class="control-label">Old Password</label>

                              <div>
                                  <input id="password" type="password" class="form-control" name="old" required="Please fill this">

                                  @if ($errors->has('old'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('old') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                  <label for="password" class=" control-label">New Password</label>

                                  <div>
                                      <input id="password" type="password" class="form-control" name="password" required="Please fill this">

                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                      @endif
                                  </div>
                              </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                  <label for="password-confirm" class="control-label">Confirm Password</label>

                                  <div>
                                      <input id="password-confirm" type="password" class="form-control" name="cpassword" required="Please fill this">

                                      @if ($errors->has('password_confirmation'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                                      </span>
                                      @endif
                                  </div>
                    </div>
             </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-standard" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-standard" href="{{ url('/update_pharmacy_password') }}"
             onclick="event.preventDefault();
                           document.getElementById('changpass-form').submit();">
              {{ __('Change Password') }}
                </a>
            </div>
          </div>
        </div>
  </div>
@endsection
