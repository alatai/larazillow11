<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia(
            'Listing/Index',
            [
                'listings' => Listing::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd,表示在屏幕输出内容
        // dd($request->all());

        // $listing = new Listing();
        // $listing->beds = $request->beds;
        // ...
        // $listing->save();

        Listing::create(
            // ... 允许将两个数组合并到一起
            // 如果第二个数组有与第一个数组相同的键，那么原始值将被替换
            //...$request->all(),

            // 在Laravel中使用验证时，首先指定被接受的数据字段,然后提供验证约束
            // 如果在Laravel中遇到任何验证错误，它会产生一个错误
            // 并且会在会话中存储所有的验证错误
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        // 重定向
        // flash消息，只是一个临时数据，存储在用户分配的session中
        // 并且在每次后续请求时都会被销毁
        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)

    // 还可以使用路由绑定的方式
    // Laravel将通过路由参数中给定的ID获取Model
    // public function show(Listing $listing)
    {
        return inertia(
            'Listing/Show',
            [
                'listing' => Listing::find($id)
                // 'listing' => $listing
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        // Model有 update 方法
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        return redirect()->route('listing.index')
            ->with('success', 'Listing was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }
}
