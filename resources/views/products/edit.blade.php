<x-app-layout>
    <x-slot name="header">Edit Product</x-slot>
    <form method="POST" action="{{ route('products.update', $product) }}" class="space-y-4">
        @csrf @method('PUT')
        <div><label>Name</label><input name="name" value="{{ $product->name }}" class="border"></div>
        <div><label>Description</label><textarea name="description" class="border">{{ $product->description }}</textarea></div>
        <div><label>Price</label><input type="number" step="0.01" name="price" value="{{ $product->price }}" class="border"></div>
        <button class="px-3 py-1 bg-black text-white">Update</button>
    </form>
</x-app-layout>
