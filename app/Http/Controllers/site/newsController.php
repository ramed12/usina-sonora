<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\News;

class newsController extends Controller
{
    public function detail($id, $slug)
    {

        $news = News::find($id);
        $news->view += 1;
        $news->save();

        $data = news::where('id', $id)->first();

        return view('site.news.detail', ['data' => $data]);
    }

    public function list()
    {
        $data = news::where('status', 1)->orderBy('created_at', 'DESC')->paginate(15);
        return view('site.news.list', ['data' => $data]);
    }
}
