<h1>Your Products</h1>

@if (session('status'))
  <div>{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('products.store') }}">
  @csrf
  <input type="text" name="name" placeholder="Name" required>
  <input type="number" step="0.01" name="price" placeholder="Price" required>
  <textarea name="description" placeholder="Description"></textarea>
  <button type="submit">Create</button>
</form>

<ul>
  @foreach ($products as $product)
    <li>
      {{ $product->name }} - {{ $product->price }} - {{ $product->status }}
      <form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
      </form>
    </li>
  @endforeach
  {{ $products->links() }}
</ul>
