@extends('layouts.master')
@section('menu')
@extends('sidebar.editroom')
@endsection
@section('content')
    {{-- message --}}
    
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Add Users</h3>
                    </div>
                </div>
            </div>
            <form action="{{URL::to('save-users')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class=" formtype">
                            <div class="hotel-row col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control @error('rent') is-invalid @enderror" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="hotel-row col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('rent') is-invalid @enderror" id="useremail" name="useremail" required>
                                </div>
                            </div>
                            <div class="hotel-row col-md-4">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('rent') is-invalid @enderror" id="userpassword" name="userpassword" required>
                                </div>
                            </div>
                            <div class="hotel-row col-md-4">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="select2 form-control @error('name') is-invalid @enderror" id="userrole" name="userrole">
                                        <option selected disabled> --Select Role-- </option>
                                        <option value="0">User</option>    
                                        <option value="1">Admin</option>                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit ml-2">Save</button>
                <button type="button" class="btn btn-primary buttonedit">Cancel</button>
            </form>
        </div>
    </div>
@endsection