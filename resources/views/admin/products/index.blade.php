<h1>Pending Products</h1>

@if (session('status'))
  <div>{{ session('status') }}</div>
@endif

<ul>
  @foreach ($products as $product)
    <li>
      {{ $product->name }} - {{ $product->code }} - {{ $product->vendor->name }}
      <form method="POST" action="{{ route('admin.products.approve', $product) }}" style="display:inline">
        @csrf
        <button type="submit">Approve</button>
      </form>
      <form method="POST" action="{{ route('admin.products.reject', $product) }}" style="display:inline">
        @csrf
        <button type="submit">Reject</button>
      </form>
    </li>
  @endforeach
  {{ $products->links() }}
</ul>
