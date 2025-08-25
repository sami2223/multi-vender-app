<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductApprovalController extends Controller
{
  public function __construct(private ProductService $service) {}

  public function index(): View
  {
    $products = $this->service->listPending();
    return view('admin.products.index', compact('products'));
  }

  public function approve(Product $product): RedirectResponse
  {
    $this->service->approve($product);
    return back()->with('status', 'Product approved.');
  }

  public function reject(Product $product): RedirectResponse
  {
    $this->service->reject($product);
    return back()->with('status', 'Product rejected.');
  }
}
