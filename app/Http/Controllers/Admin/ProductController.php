<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $service) {}

    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');
        $products = Product::with('user')->where('status', $status)->latest()->paginate(15);
        return view('admin.products.index', compact('products', 'status'));
    }

    public function approve(Product $product)
    {
        $this->service->setApproval(auth()->user(), $product, true);
        return back()->with('status', 'Product approved.');
    }

    public function reject(Product $product)
    {
        $this->service->setApproval(auth()->user(), $product, false);
        return back()->with('status', 'Product rejected.');
    }
}
