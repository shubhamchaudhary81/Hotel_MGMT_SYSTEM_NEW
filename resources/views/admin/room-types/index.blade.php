@extends('layouts.admin.app')
@section('title', 'HDC Hotel | Room Types')

@section('contents')

<x-table
    title="Room Types"
    :columns="['ID', 'Name', 'Description', 'Created At', 'Actions']">

    {{-- ACTION BUTTON --}}
    <x-slot name="action">
        <a href="{{ route('admin.room-types.create') }}"
           class="bg-[#6B4C2B] text-white px-4 py-2 rounded-lg shadow hover:bg-[#5a3f20]">
            + Add Room Type
        </a>
    </x-slot>

    {{-- FILTERS --}}
    <x-slot name="filters">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search..."
                   class="border px-3 py-2 rounded">
            <button class="bg-[#6B4C2B] text-white px-4 py-2 rounded">
                Apply
            </button>
        </form>
    </x-slot>

    {{-- TABLE ROWS --}}
    @forelse ($roomTypes as $type)
        <tr class="hover:bg-gray-50">

            <td class="px-4 py-3">{{ $type->id }}</td>
            <td class="px-4 py-3 font-semibold">{{ $type->name }}</td>
            <td class="px-4 py-3 text-gray-600">{{ Str::limit($type->description, 60) }}</td>
            <td class="px-4 py-3">{{ $type->created_at->format('d M Y') }}</td>

            <td class="px-4 py-3 flex gap-3">

                <a href="{{ route('admin.room-types.edit', $type->id) }}"
                   class="text-blue-600 hover:text-blue-800">
                    Edit
                </a>

                <form action="{{ route('admin.room-types.destroy', $type->id) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:text-red-800">
                        Delete
                    </button>
                </form>

            </td>

        </tr>

    @empty
        <tr>
            <td colspan="5" class="text-center py-5 text-gray-500">
                No room types found.
            </td>
        </tr>
    @endforelse

</x-table>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $roomTypes->links() }}
</div>


@endsection
