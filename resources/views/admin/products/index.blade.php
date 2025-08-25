<x-app-layout>
    <x-slot name="header">Admin: Products ({{ ucfirst($status) }})</x-slot>

    <nav class="space-x-4">
        <a class="underline" href="{{ route('admin.products.index', ['status' => 'pending']) }}">Pending</a>
        <a class="underline" href="{{ route('admin.products.index', ['status' => 'approved']) }}">Approved</a>
        <a class="underline" href="{{ route('admin.products.index', ['status' => 'rejected']) }}">Rejected</a>
    </nav>

    @if (session('status')) <div class="mt-2 text-green-600">{{ session('status') }}</div> @endif

    <table class="mt-4 w-full">
        <thead><tr><th>Vendor</th><th>Code</th><th>Name</th><th>Price</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        @foreach($products as $p)
            <tr>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->code }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->price }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>
                    @if($p->status === 'pending')
                        <form method="POST" action="{{ route('admin.products.approve', $p) }}" class="inline">
                            @csrf <button class="underline text-green-700">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.products.reject', $p) }}" class="inline">
                            @csrf <button class="underline text-red-700">Reject</button>
                        </form>
                    @else
                        —
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</x-app-layout>

