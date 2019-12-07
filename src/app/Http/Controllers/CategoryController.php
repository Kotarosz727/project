<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{
    public function index(){
        $categorys = Category::all();
    }
}