<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Product;
use App\Models\Book;
use App\Models\Room;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class RoomController extends Controller
{
    public function allRooms(){
      return view('room.allroom');
    }
    public function addRooms(){
      $data = DB::table('products')->get();
      return view('room.addroom',compact('data'));
      }
      public function getHotelInfo($hotelID) {
        $hotel = Product::find($hotelID);
    
        if ($hotel) {
            $data = [
                'hotelName' => $hotel->name,
                'numberOfRooms' => $hotel->NumberOfRoom,
            ];
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Không tìm thấy thông tin khách sạn'], 404);
        }
    }
    
    
    
      public function saveRooms(Request $request)
      {
   
        $data = [
          'HotelID' => $request->hotelID,
          'room_type' => $request->room_type,
          'room_Image' => $request->room_Image,
          'room_no' => $request->room_number,
          'room_price' => $request->room_price,
      ];
  
          DB::table('room')->insert($data);
          Session::flash('success', 'add successed');
          return Redirect::to('/all-room');
      
      }
      public function getAllRooms() { 
            $rooms = Room::with('hotel')->get();
            return view('room.allroom', compact('rooms'));
    }     
    public function updateRooms($room_id){
        $editRoom = Room::with('hotel')->where('room_id', $room_id)->get();
        return view('room.editroom', compact('editRoom'));
    }
    public function updatedRooms(Request $request){
        $roomID = $request->input('room_id');
        $data = [
            'HotelID' => $request->hotelID,
            'room_type' => $request->room_type,
            'room_Image' => $request->room_Image,
            'room_no' => $request->room_number,
            'room_price' => $request->room_price,
        ];

        DB::table('room')->where('room_id', $roomID)->update($data);
        Session::flash('success', 'updated successed');
        return Redirect::to('/all-room');
    }
    public function deleteRooms(Request $request){    
      try {
        
          $roomId = $request->room_id;
  
          $deleted = Room::destroy($roomId);
  
          if ($deleted) {
              // Nếu xóa thành công
              Session::flash('success', 'Xóa thành công');
          } else {
              // Nếu không xóa được
              Session::flash('error', 'Không thể xóa phòng. Vui lòng thử lại sau.');
          }
  
          return redirect()->back();
      } catch(\Exception $e) {
          // Xử lý nếu có lỗi xảy ra trong quá trình xóa
          Session::flash('error', 'Xóa thất bại: ' . $e->getMessage());
          return redirect()->back();
      }
  }
  public function room_status_active($roomID){
   DB::table('room')->where('room_id',$roomID)->update(['room_status'=>0]);
   Session::flash('success', 'Inactive');
   return Redirect::to('/all-room');
}
public function room_status_inactive($roomID){
    DB::table('room')->where('room_id',$roomID)->update(['room_status'=>1]);
   Session::flash('success', 'Active');
   return Redirect::to('/all-room');
}
  
}
