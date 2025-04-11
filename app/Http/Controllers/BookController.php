<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Room;
class BookController extends Controller
{
    public function book()
    {
        $all_products = Product::where('status', 0)
            ->orderBy('HotelID', 'desc')
            ->take(9)
            ->get();
        $searchResultsFound = false;
        // Trả về view với dữ liệu sản phẩm và trạng thái kết quả tìm kiếm
        return view('user.book', compact('all_products', 'searchResultsFound'));
    }
    public function detail($HotelID)
    {
        $sp = Product::where('status', 0)
            ->orderBy('HotelID', 'desc')
            ->get();

        $product = Product::where('HotelID', $HotelID)->first();

        // Sửa tên bảng trong truy vấn này từ 'rooms' thành 'room'
        $room = Room::where('HotelID', $HotelID)->get();

        return view('user.detail', compact('product','sp', 'room'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $filteredProducts = Product::where('name', 'like', "%$query%")
            ->get();

        $searchResultsFound = $filteredProducts->isNotEmpty();

        // Trả về view với dữ liệu sản phẩm được lọc và trạng thái kết quả tìm kiếm
        return view('user.book', compact('filteredProducts', 'searchResultsFound', 'query'));
    }
    public function suggestions(Request $request)
{
    $data = $request->all();

    if ($data['query']) {
        $suggestions = Product::where('name', 'like', '%' . $data['query'] . '%')
            ->get();

        $output = '<div class="suggestion-dropdown" style="position:absolute; width: 100%; max-height: 200px; overflow-y: auto;">';
        foreach ($suggestions as $key => $val) {
            $output .= '<div class="suggestion-item"style="background-color:white;color:black;"><a href="#"class="li_search_ajax">' . $val->name . '</a></div>';
        }
        $output .= '</div>';

        return response()->json(['html' => $output]);
    }
}


}
