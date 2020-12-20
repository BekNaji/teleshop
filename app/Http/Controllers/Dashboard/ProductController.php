<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Company;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status','=',1)->where('company_id','=',Auth::user()->company->id)->orderBy('id','DESC')->get();


        return view('dashboard.product.index',compact('products'));
    }

    public function create()
    {
        return view('dashboard.product.create');
    }

    public function edit(Request $request)
    {
        $product = Product::find($request->id);

        $images = Image::where('product_id','=',$request->id)->get();

        return view('dashboard.product.edit',compact('product','images'));
    }

    public function store(Request $request)
    {
        //dd($request->file('images'));
        $company  = Company::find(Auth::user()->company_id);
        $company->product_row = $company->product_row + 1;
        $company->save();

        $product                = new Product();
        $product->number        = sprintf("%05s",$company->product_row);
        $product->name          = $request->name;
        $product->company_id    = Auth::user()->company->id;
        $product->user_id       = Auth::user()->id;
        $product->link          = $request->link;
        $product->fee_buy       = $request->fee_buy;
        $product->fee_buy_dollr = $request->fee_buy_dollr;
        $product->fee_sell      = $request->fee_sell;
        $product->profit        = $request->fee_sell - $request->fee_buy_dollr;
        $product->interest      = $request->interest;
        $product->save();

        if($images = $request->images)
        {
            foreach($images as $image)
            {
                $names[] = $this->uploadImage($image);
            }
            foreach($names as $link)
            {
                $image = new Image();
                $image->link = $link;
                $image->product_id = $product->id;
                $image->save();
            }

        }

        return redirect()->route('product.index')->with(['message'=>'Stored!']);

    }

    public function update(Request $request)
    {
        //dd($request->file('images'));
        $product                = Product::find($request->id);
        $product->name          = $request->name;
        $product->link          = $request->link;
        $product->fee_buy       = $request->fee_buy;
        $product->fee_buy_dollr = $request->fee_buy_dollr;
        $product->fee_sell      = $request->fee_sell;
        $product->profit        = $request->fee_sell - $request->fee_buy_dollr;
        $product->interest      = $request->interest;
        $product->save();

        if($images = $request->images)
        {
            foreach($images as $image)
            {
                $names[] = $this->uploadImage($image);
            }
            foreach($names as $link)
            {
                $image = new Image();
                $image->link = $link;
                $image->product_id = $product->id;
                $image->save();
            }

        }

        return back()->with(['message'=>'Updated!']);

    }

    public function remove(Request $request)
    {
        $product = Product::find($request->id);
        $images = Image::where('product_id','=',$product->id)->get();
        foreach($images as $image)
        {
            if(file_exists(public_path($image->link)))
            {
                unlink(public_path($image->link));
            }

        }

        $product->delete();
        return back()->with(['message'=>'Deleted!']);
    }

    public function removeImage(Request $request)
    {
        $image = Image::find($request->id);

        if(file_exists(public_path($image->link)))
        {
            unlink(public_path($image->link));
        }
        $image->delete();

        return back()->with(['message'=>'Image Deleted!']);
    }

    public function uploadImage($query)
    {
        $img_name = rand(1111,9999);
        $ext     = strtolower($query->getClientOriginalExtension());
        $img_full_name = $img_name.'.'.$ext; // like  123213.jpg
        $upload_path = 'images/product/';
        $image_url = $upload_path.$img_full_name;
        $success = $query->move($upload_path,$img_full_name);

        return $image_url;

    }
}
