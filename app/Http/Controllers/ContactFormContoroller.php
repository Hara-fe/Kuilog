<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactFormContoroller extends Controller
{
    public function index(Request $request)
    {
        return view('ContactForm.index', compact('request'));
    }
    public function confirm(Request $request)
    {
        // dd($request->all());

    $request->validate([
        'name' => ['required', 'min:2', 'max:10']
    ]);
// 入力画面に戻る処理
        if ($request->has('back')){
            // withInput()は、リダイレクト時に、現在の入力内容を付ける命令
            return redirect('/form')->withInput();
        }

        // (追加)確認画面で送信ボタンが押されたときの処理
        if ($request->has('send')) {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->save(); // DBに保存
            // 完了画面を表示
            return redirect('/form/complete');
        }

        // 送信されたデータを渡しつつ確認画面のビューを表示
        return view('ContactForm.confirm', compact('request'));

        
    }
      public function list() {
        // お問い合わせのレコードをすべて取得
        $contacts = Contact::all();
        return view('ContactForm.list', compact('contacts'));
    }

    public function delete($id)
    {
        $contact_to_delete = Contact::find($id);
        $contact_to_delete->delete();

        return redirect('/list');
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('ContactForm.edit' , compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:10'],
        ]);

        $contact = Contact::find($id);
        $contact->name = $request->name;
        $contact->save();

        return redirect('/list');
    }

}
