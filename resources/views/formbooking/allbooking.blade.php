@extends('layouts.master')
@section('menu')
@extends('sidebar.allbooking')
@endsection
@section('content')
    {{-- message --}}

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Appointments</h4>
                            <a href="" class="btn btn-primary float-right veiwbutton ">Add Booking</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">
                                <table class="datatable table table-stripped table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>Client Information</th>
                                            <th>Hotel Name</th>
                                            <th>Room Information</th>
                                            <th>Booking Information</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoices as $bookingdetails)
                                        <tr>
                                            <td hidden class="id">{{$bookingdetails->book_details_id}}</td>
                                   
                                            <td class="text-center">{{$bookingdetails->bookingDetail->book_details_id}}</td>
                                            <td>
                                            <b>Book Code:</b> {{$bookingdetails->bookingDetail->book_code}} <br>
                                            <b>Name:</b> {{$bookingdetails->bookingDetail->booking->reservation->reservate_name}} <br>
                                            <b>Phone number:</b> {{$bookingdetails->bookingDetail->booking->reservation->reservate_phone}}   
                                            </td>
                                            <td>{{$bookingdetails->bookingDetail->room->hotel->name}}</td>
                                            <td>
                                                <b>Room type:</b>  {{$bookingdetails->bookingDetail->room_type}} <br>
                                                  <b>Price:</b> {{$bookingdetails->bookingDetail->room->room_price}} đ
                                               
                                            </td>
                                            <td>
                                                 <b>Checkin day:</b> {{$bookingdetails->bookingDetail->created_at}} <br>
                                                 <b>Checkout day:</b> {{$bookingdetails->checkout_date}} <br>
                                                 <b>Total:</b> {{$bookingdetails->total}}
                                            </td>                                             
                                            <td>
                                                <a target="_blank" href="{{URL::to('/print-order/'.$bookingdetails->invoice_id)}}" class="btn btn-sm bg-success-light mr-2"><i class="fa-solid fa-print" style="font-size: 25px;"></i></a>
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
        {{-- Model delete --}}
        <div id="delete_asset" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="" method="POST">
                        @csrf
                        <div class="modal-body text-center"> <img src="{{ URL::to('assets/img/sent.png') }}" alt="" width="50" height="46">
                            <h3 class="delete_class">Are you sure want to delete this Asset?</h3>
                            <div class="m-t-20">
                                <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                <input class="form-control" type="hidden" id="e_id" name="id" value="">
                                <input class="form-control" type="hidden" id="e_fileupload" name="fileupload" value="">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Model delete --}}
    </div>
    @section('script')
    {{-- delete model --}}
    <script>
        $(document).on('click','.bookingDelete',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_fileupload').val(_this.find('.fileupload').text());
        });
    </script>
    @endsection
@endsection