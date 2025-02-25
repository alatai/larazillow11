<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    // 因为是资料类型的控制器
    // 所以可以通过添加构造器实现policy
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    // 还可以再构造器中定义中间件
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom',
            'priceTo',
            'beds',
            'baths',
            'areaFrom',
            'areaTo'
        ]);

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                    ->filter($filters)
                    // 对于结果进行分页，调用paginate方法，并指定每页显示数
                    // paginate返回对象，包含数据、页面信息
                    ->paginate(10)
                    ->withQueryString()
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // 可以使用auth获取当前用户
        // 然后用户使用can方法，需要再这里指定操作名称（policy中的方法名）
        // 返回true或者false
        // Auth::user()->can('view', $listing);

        // 如果想禁止用户看到内容，可以使用cannot，然后执行if语句 
        // if (Auth::user()->cannot('view', $listing)) {
        // abort(403); // HTTP状态码，用于禁止操作
        // }

        // 还可以使用路由绑定的方式
        // Laravel将通过路由参数中给定的ID获取Model
        // public function show(Listing $listing)
        return inertia(
            'Listing/Show',
            [
                // 'listing' => Listing::find($id)
                'listing' => $listing
            ]
        );
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Listing $listing)
    // {
    //     $listing->delete();

    //     return redirect()->back()
    //         ->with('success', 'Listing was deleted!');
    // }
}
