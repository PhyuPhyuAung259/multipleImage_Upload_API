<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::with('images')->get();

        return response()->json(['products' => $products,'message' => 'Successfully uploaded','status'=>true],200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $product=new Product();
        $product->title=$request->title;
        $product->description=$request->description;
        $product->save();
        if($request->has('image')){
            $image=$request->image;
            foreach($image as $key=>$value){
                $name=time().$key.'.'.$value->getClientOriginalExtension();
                $path=public_path('upload');
                $value->move($path,$name);

                $image=new Image();
                $image->name=$name;
                $image->path=$path;
                $image->product_id=$product->id;
                $image->save();

            }
        }
        return response()->json(['data'=>'', 'message' => 'Successfully uploaded','status'=>true],200);
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
