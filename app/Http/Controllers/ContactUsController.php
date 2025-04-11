<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
class ContactUsController extends Controller
{
    // Create Contact Form
    public function contact()
    {
        return view('user.contact-us');
    }
    public function postContact(Request $request)
    {
        try {
        Contact::create($request->all());
        session()->flash('success', 'We have received your message and would like to thank you for writing to us.');
        }catch (\Throwable $th) {
      session()->flash('danger', 'Please fill out this form!');
        }
      return redirect()->route('contact-us');

    }

    public function blog()
    {
        $all_name = Product::all();
        $blog=Blog::all();
        return view('user.blog-review',compact('all_name','blog'));
    }
    public function postBlog(Request $request)
    {
        try {
        Blog::create($request->all());
        session()->flash('success', 'We have received your message and would like to thank you for writing to us.');
        }catch (\Throwable $th) {
      session()->flash('danger', 'Please fill out this form!');
        }
      return redirect()->route('blog-review');

    }

}
