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
        
        // 電話番号を3分割する
    if (!empty($contact['tel'])) {
        // 例: "09012345678"
        $tel = $contact['tel'];


         // 分割 (3-4-4形式で分ける場合)
        $contact['tel_1'] = substr($tel, 0, 3);
        $contact['tel_2'] = substr($tel, 3, 4);
        $contact['tel_3'] = substr($tel, 7);

        return view('confirm', compact('contact'));
    }



        

        // index で入力された category_id をもとに、categoryテーブルを検索！
        $category = Category::find($contact['category_id']);


        // categoryテーブルの中の、今回選択されたレコードから、nameを取得
        $contact['category_name'] = $category->name;

        return view('confirm', compact('contact'));


    }

public function store(Request $request)
    {
     \Log::info('store メソッドに入りました'); // ←追加

        
        // buildingは消去　下記に追加
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'category_id', 'content']);
        
        // 建物名が入力されていない場合は空文字を代入
        $contact['building'] = $request->building ?? '';
        
        // 3つの番号を集約して　tel に代入
        $contact ['tel'] = $request->tel_1. $request->tel_2 . $request->tel_3;

        \Log::info('Contact作成前', $contact->toArray() ?? $contact); // ←追加

         Contact::create($contact);
       
         return redirect()->route('thanks');
    }




    
}
