<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\Category;
use Intervention\Image\Facades\Image;
class BookController extends Controller
{
    public function index(){
        $lists = Book::all();
        return view('book.index', ["lists"=>$lists]);
    }
    public function create(){
        $categories = Category::all();
        return view('book.create', ["categories"=>$categories]);
    }
    public function store(Request $request){
        $book = new Book();
        $book->title = $request->title;
   
        $book->author = $request->author;
        $book->content = $request->content;
        $book->category = $request->category;
        $book->rate = $request->rate;

        // formから送信されたimgファイルを読み込む
        $file = $request->file('image');
        // 画像の拡張子を取得
        $extension = $request->file('image')->getClientOriginalExtension();
        // 画像の名前を取得
        $filename = $request->file('image')->getClientOriginalName();
        // 画像をリサイズ
        $resize_img = Image::make($file)->resize(300, 300)->encode($extension);
        // s3のuploadsファイルに追加
        $path = Storage::disk('s3')->put(''.$filename,(string)$resize_img, 'public');
        // 画像のURLを参照
        $url = Storage::disk('s3')->url($filename);

        $book->picture = $url;
        $book->save();
        return redirect('/');
    }
    public function detail ($id){
        $book = Book::find($id);
        $categories = Category::all();
        return view("book.detail",["book"=>$book, "categories"=>$categories]);
    }
    public function update (Request $request){
        $id = $request->input('id');
        $content = $request->input('content');
        $category = $request->input('category');
        $res = DB::update('update books set content = ?, category = ? where id = ?', [$content, $category, $id]);
        echo $res;
    }
    // public function slideshow(){
    //     $lists = Book::all();
    //     return view('book.slide', ["lists"=>$lists]);
    // }
    public function rate(){
        $lists = DB::select('select * from books order by rate desc');
        return view('book.index', ["lists"=>$lists]);
    }
    public function regist(){
        $lists = DB::select('select * from books order by created_at desc');
        return view('book.index', ["lists"=>$lists]);
    }
    public function category ($id){
        $lists = DB::select('select * from books where category = ?', [$id]);
        return view('book.index', ["lists"=>$lists]);
    }
    public function slide (){
        $lists = Book::all();
        return view('book.slide', ["lists"=>$lists]);
    }
}