<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news', compact("news"));
    }
    public function create()
    {
        return view('create');
    }

    public function newsDataByStore($store)
    {
        $this->activeStore = $store;
        session()->put('activeStore', $store);
        $news  = News::where('storeName',$store)->get();

        return json_encode(array('data'=>$news));
    }

    public function save(Request $request)
    {
        $news = new News;
        $news->newsHead = $request->input('newsHead');
        $news->newsBody = $request->input('newsBody');
        $news->newsImage = "No Image with this News";
        error_log('my message');
        if($request->hasfile('newsImage'))
        {
            $file = $request->file('newsImage');
            $extention = $file->getClientOriginalExtension();
            $filename = 'uploads/'.time().'.'.$extention;
            $file->move('uploads/',$filename);
            $news->newsImage = $filename;
        }
        $lenHead = strlen($news->newsHead);
        $lenBody = strlen($news->newsBody);
        if( ($lenHead <10 || $lenHead >50) && ($lenBody <10 || $lenBody > 100) ) {
            return redirect()->back()->with('statusFailHead','Please add News Head and News Body text as per character limit');
        }
        elseif($lenHead <10 || $lenHead >50 ) {
            return redirect()->back()->with('statusFailHead','Please add NEWS HEAD text as per character limit');
        }
        elseif ($lenBody <10 || $lenBody > 100) {
            return redirect()->back()->with('statusFailBody','Please add NEWS BODY text as per character limit');
        }
        else {
            $news->storeName = session()->pull('activeStore');
            $news->save();
            return redirect()->back()->with('statusSuccess','News added Successfully');
        }
    }
}
