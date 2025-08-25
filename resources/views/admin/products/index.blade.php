<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin: Products ({{ ucfirst($status) }})
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <nav class="mb-6 flex gap-4">
                        <a class="px-3 py-2 rounded bg-yellow-100 text-yellow-800 font-semibold hover:bg-yellow-200 transition" href="{{ route('admin.products.index', ['status' => 'pending']) }}">Pending</a>
                        <a class="px-3 py-2 rounded bg-green-100 text-green-800 font-semibold hover:bg-green-200 transition" href="{{ route('admin.products.index', ['status' => 'approved']) }}">Approved</a>
                        <a class="px-3 py-2 rounded bg-red-100 text-red-800 font-semibold hover:bg-red-200 transition" href="{{ route('admin.products.index', ['status' => 'rejected']) }}">Rejected</a>
                    </nav>

                    @if (session('status'))
                        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vendor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($products as $p)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $p->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $p->code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $p->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($p->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $p->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($p->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($p->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($p->status === 'pending')
                                            <form method="POST" action="{{ route('admin.products.approve', $p) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-700 hover:text-green-900 mr-2">Approve</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.products.reject', $p) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-700 hover:text-red-900">Reject</button>
                                            </form>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

