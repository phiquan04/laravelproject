@extends('layouts.master')
@section('menu')
@extends('sidebar.allusers')
@endsection
@section('content')
    {{-- message --}}
    
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">All Users</h4> <a href="{{route('Add-Users')}}" class="btn btn-primary float-right veiwbutton">Add User</a> </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body booking_card">
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped table table-hover table-center mb-0 text-center">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Role</th>
                                                <th>Created at</th>
                                                <th>Updated at</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td hidden class="id">{{$user->id}}</td>
                                   
                                            <td class="text-center">{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td class="text-center">{{$user->email}}</td>
                                            <td>{{$user->password}}</td>
                                            <td class="text-center">
                                               <?php 
                                               if($user->role==1)
                                               {
                                               ?>
                                                <div class="actions text-center" style="color: red"> Admin </div>
                                                <?php 
                                               }else{
                                                ?>
                                                <div class="actions" style="color: green">User </div>
                                                <?php 
                                               }
                                                ?>
                                            </td>
                                            <td>{{$user->created_at}}</td>
                                            <td>{{$user->updated_at}}</td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{URL::to('/edit-users/'.$user->id)}}">
                                                            <i class="fas fa-pencil-alt m-r-5"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item delete_asset" href="#" data-toggle="modal" data-target="#delete_asset">
                                                            <i class="fas fa-trash-alt m-r-5"></i> Delete
                                                        </a> 
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                     @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- delete model --}}
            <div id="" class="modal fade delete-modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <form action="" method="POST">
                                @csrf
                                <img src="{{ URL::to('assets/img/sent.png') }}" alt="" width="50" height="46">
                                <h3 class="delete_class">Are you sure want to delete this Asset?</h3>
                                <div class="m-t-20">
                                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <input class="form-control" type="hidden" id="e_id" name="id" value="">
                                    <input class="form-control" type="hidden" id="e_fileupload" name="fileupload" value="">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end delete model --}}
        </div>
        @section('script')
    <script>
        $(document).on('click', '.delete_asset', function(e) {
            e.preventDefault();
            var userId = $(this).closest('tr').find('.id').text();

            if (confirm("Are you sure want to delete this user?")) {
                var _this = $(this).parents('tr');
                $('#e_id').val(_this.find('.id').text());
                $('#e_fileupload').val(_this.find('.fileupload').text());

                $.ajax({
                    type: "DELETE",
                    url: '/delete-user/' + userId,
                    data: {
                        "_token": "{{ csrf_token() }}" 
                    },
                    success: function(response) {
                        
                        $(`tr:has(td:contains('${userId}'))`).remove();
                        alert(response.message);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        });

    </script>
@endsection

@endsection