<x-layout title="List of Ideas" addRoute="ideas.create" addText="+ Add Idea">
    @if (Session::has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="max-w-7xl mx-auto p-4">
        <p class="mb-4">
            Here are some of our best ideas.
        </p>
        <table class="mt-3 min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Idea</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created
                        At
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($ideas as $idea)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $idea->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $idea->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $idea->created_at->format('Y-m-d') }}</td>
                        <td px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="{{ route('ideas.edit', $idea->id) }}"
                                class="text-blue-600 hover:text-blue-900 bg-gray-100 px-2 py-1 rounded">Edit</a>
                            <a href="{{ route('ideas.showDelete', $idea->id) }}"
                                class="text-red-600 hover:text-red-900 bg-gray-100 px-2 py-1 rounded">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
