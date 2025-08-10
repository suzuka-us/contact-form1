<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function index()
  {
    return view('index');
  }

  public function confirm(Request $request)
   {
         // ここに処理を記述していきます。
         $contact = $request->only(['name', 'email', 'tel', 'content']);
         return view('confirm', compact('contact'));
     }
}
