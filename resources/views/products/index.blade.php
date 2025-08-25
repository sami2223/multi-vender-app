<x-app-layout>
    <x-slot name="header">My Products</x-slot>

    <a href="{{ route('products.create') }}" class="underline">Add Product</a>

    @if (session('status')) <div class="mt-2 text-green-600">{{ session('status') }}</div> @endif

    <table class="mt-4 w-full">
        <thead><tr><th>Code</th><th>Name</th><th>Price</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @foreach($products as $p)
            <tr>
                <td>{{ $p->code }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->price }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>
                    <a href="{{ route('products.edit', $p) }}" class="underline">Edit</a>
                    <form action="{{ route('products.destroy', $p) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="underline text-red-600" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</x-app-layout>
