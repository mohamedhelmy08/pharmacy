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
            <strong class="text-black">Show Category</strong>
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
                <h2 class="h3 mb-3 text-black">Medicine Categories</h2>
                <a href="addNewCategory" style="float: right; margin-top:10px;margin-right:30px; " class="btn btn-primary" data-toggle="modal" data-target="#exampleModaladd">New Category</a> 
               
                <div class="p-3 p-lg-5 border">
                <div class="row mb-5" style="margin-top: 10px;">
                  <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Category</th>
                            <th>Remove</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($categories as $cat)
                          <tr>

                            <td>
                              {{$cat->Category_Name}} 
                            </td>
                            <td><a  href="/Medicine/category/delete/{{$cat->Cat_ID}}" class="btn btn-danger" style="padding-top: 6px;padding-bottom: 6px; padding-right: 30px; padding-left: 30px; display: initial;">X</a></td>
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
 <div class="modal fade" id="exampleModaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 40px;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #51eaea;">
              <h5 class="modal-title" id="exampleModalLabel">Add Form</h5>
            </div>
            <div class="modal-body">
             <form action="{{ url('/Medicine/category/addCategory') }}" method="post" id="add-form" enctype="multipart/form-data">
                      {{csrf_field()}}
                <div class="form-group row">
                  <div class="col-md-12">
                      @error('cname')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    <label for="cname" class="text-black">Category Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('cname') is-invalid @enderror" value="" id="cname" name="cname">
                  </div>

                </div>
             </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-standard" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-standard" href="{{ url('/Medicine/category/addCategory') }}"
             onclick="event.preventDefault();
                           document.getElementById('add-form').submit();">
              {{ __('Add') }}
              </a>
            </div>
          </div>
        </div>
  </div>
@endsection
