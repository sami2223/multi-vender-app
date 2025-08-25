<x-app-layout>
    <x-slot name="header">Create Product</x-slot>
    <form method="POST" action="{{ route('products.store') }}" class="space-y-4">
        @csrf
        <div><label>Name</label><input name="name" class="border" required></div>
        <div><label>Description</label><textarea name="description" class="border"></textarea></div>
        <div><label>Price</label><input type="number" step="0.01" name="price" class="border" required></div>
        <button class="px-3 py-1 bg-black text-white">Save</button>
    </form>
</x-app-layout>
