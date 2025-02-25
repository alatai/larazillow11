<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    // 和ListingController使用同样的Policy
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        // dd($request->boolean('deleted'));

        $filters = [
            // 'deleted' => $request->boolean('deleted')
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return inertia(
            'Realtor/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    // ->mostRecent()
                    ->filter($filters)
                    // ->get()
                    ->paginate(5)
                    ->withQueryString()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit',
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

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was updated!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 如果没有指定模型，则意味着实际上没有调用任何policy
        // if (Auth::user()->cannot('create', Listing::class)) {
        // abort(403);
        // }

        return inertia('Realtor/Create');
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
        // Listing::create(

        // 获取当前登录用户信息
        // 方法一：
        // Auth::user();
        // 方法二：
        $request->user()->listings()->create(
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
        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was created!');
    }

    public function destroy(Listing $listing)
    {
        // deleteOrFail：针对模型已经被删除却有人意外为同一模型再次调用
        $listing->deleteOrFail();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
