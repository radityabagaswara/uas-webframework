<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brands::all();
        $categories = Categories::all();
        $products = $this->getForYouProducts();

        return view('index', compact("brands", "categories", "products"));
    }

    public function adminIndex()
    {
        return view('admin.index');
    }

    public function brandName($name)
    {

        $brand = Brands::all()->where('name', $name)->first();
        $products_raw = Products::all()->where('brands_id', $brand->id);

        $products = [];

        foreach ($products_raw as $product) {
            if ($product->discount > 0)
                $product['total'] = $product->price - $product->price * ($product->discount / 100);
            else $product['total'] = $product->price;

            $product['format_total'] = number_format($product->total);

            $explode_total = explode(",", $product->format_total);

            $format_x = "";

            $format_x .= $explode_total[0];

            for ($i = 1; $i < count($explode_total); $i++) {
                $format_x .= "," . "xxx";
            }
            $product["formated_total"] = $format_x;

            $products[] = $product;
        }

        return view('brands', compact("brand", "products"));
    }


    public function categoryName($name)
    {

        $category = Categories::all()->where('name', $name)->first();
        $products_raw = Products::all()->where('categories_id', $category->id);

        $products = [];

        foreach ($products_raw as $product) {
            if ($product->discount > 0)
                $product['total'] = $product->price - $product->price * ($product->discount / 100);
            else $product['total'] = $product->price;

            $product['format_total'] = number_format($product->total);

            $explode_total = explode(",", $product->format_total);

            $format_x = "";

            $format_x .= $explode_total[0];

            for ($i = 1; $i < count($explode_total); $i++) {
                $format_x .= "," . "xxx";
            }
            $product["formated_total"] = $format_x;

            $products[] = $product;
        }

        return view('categories', compact("category", "products"));
    }



    public function getForYouProducts()
    {
        $products_raw  = Products::all()->shuffle()->take(5);

        $products = [];

        foreach ($products_raw as $product) {
            if ($product->discount > 0)
                $product['total'] = $product->price - $product->price * ($product->discount / 100);
            else $product['total'] = $product->price;

            $product['format_total'] = number_format($product->total); //Format angka agar bisa di split
            // 12,000,000

            $explode_total = explode(",", $product->format_total); //Split angka bedasarkan ,
            // [12, 000, 000]
            //  0    1    2

            $format_x = "";
            //

            $format_x .= $explode_total[0]; //Ambil index 0 (Diasumsikan selalu ditampilkan)
            //12

            for ($i = 1; $i < count($explode_total); $i++) { //Loop index 1 sampai terakhir (Diasumsikan dibelakang koma pasti 3 digit)
                $format_x .= "," . "xxx";
                //12,xxx
                //12,xxx,xxx
            }
            //12,xxx,xxx

            $product["formated_total"] = $format_x;

            $products[] = $product;
        }

        return $products;
    }
}
