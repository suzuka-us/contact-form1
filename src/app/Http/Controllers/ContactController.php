<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        

        // index で入力された category_id をもとに、categoryテーブルを検索！
        $category = Category::find($contact['category_id']);


        // categoryテーブルの中の、今回選択されたレコードから、nameを取得
        $contact['category_name'] = $category->name;

        return view('confirm', compact('contact'));


    }

public function store(Request $request)
{
$contact = $request->only(['last_name','first_name', 'gender', 'email', 'tel', 'address', 'building','category_id','content']);
Contact::create($contact);
return view('thanks');
}




    
}
