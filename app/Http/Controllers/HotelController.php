<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Product;
use App\Models\Room;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HotelController extends Controller
{
    public function saveHotels(Request $request){
        $data = array();
        $data['name'] = $request->hotelName;
        $data['address'] = $request->hotelAddress;
        $get_image = $request->file('ImageHotel');

        if ($get_image && $get_image->isValid()) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = $get_image->getClientOriginalExtension();
        
            if (!in_array(strtolower($extension), $allowedExtensions)) {
                return redirect()->back()->with('error', 'Invalid image format. Allowed formats: JPG, JPEG, PNG, GIF');
            }
        
            $name_image = pathinfo($get_image->getClientOriginalName(), PATHINFO_FILENAME);
            $new_image_name = $name_image . '_' . time() . '.' . $extension;
            $destinationPath = public_path('assets/images/cart'); // Thay đổi đường dẫn tới thư mục lưu trữ của bạn
            $get_image->move($destinationPath, $new_image_name);
            
            $data['ImageHotel'] = 'assets/images/cart/' . $new_image_name; // Lưu đường dẫn đầy đủ của ảnh
        } else {
            $data['ImageHotel'] = ''; // Nếu không có ảnh được tải lên, có thể cung cấp giá trị mặc định hoặc rỗng
        }
        
        // Sau đó, thêm dữ liệu vào cơ sở dữ liệu
        DB::table('products')->insert($data);
        Session::flash('success', 'add successed');
        return redirect()->to('/add-hotel');
        
    }
    

    public function getAllHotels() {
        $allHotels = DB::table('products')->get();
        return view('hotels.allhotel', compact('allHotels'));
    }
    public function updateHotels($HotelID){
        $editHotels = DB::table('products')->where('HotelID', $HotelID)->get();

        return view('hotels.edithotel', compact('editHotels'));
    }
    public function updatedHotels(Request $request){
        $HotelID = $request->input('HotelID');
        $data = array();
        $data['name'] = $request->hotelName;
        $data['address'] = $request->hotelAddress;
        $data['ImageHotel'] = $request->hotelImage;

        DB::table('products')->where('HotelID', $HotelID)->update($data);
        Session::flash('success', 'updated successed');
        return Redirect::to('/all-hotel');
    }
    public function deleteHotels(Request $request){    
    try {
        // Lấy ID của khách sạn được gửi từ form
        $hotelId = $request->HotelID;

        // Xóa dữ liệu khách sạn từ bảng Hotel dựa trên ID
        $deleted = Product::destroy($hotelId);

        if ($deleted) {
            // Nếu xóa thành công
            Session::flash('success', 'Xóa thành công');
        } else {
            // Nếu không xóa được
            Session::flash('error', 'Không thể xóa khách sạn. Vui lòng thử lại sau.');
        }

        return redirect()->back();
    } catch(\Exception $e) {
        // Xử lý nếu có lỗi xảy ra trong quá trình xóa
        Session::flash('error', 'Xóa thất bại: ' . $e->getMessage());
        return redirect()->back();
    }
}

public function updateNumberOfRooms(Request $request)
{
    $hotelID = $request->input('hotelID');

    $numberOfRooms = Room::where('HotelID', $hotelID)->count();

    Product::where('HotelID', $hotelID)->update(['NumberOfRoom' => $numberOfRooms]);

    return response()->json(['numberOfRooms' => $numberOfRooms]);
}
}
