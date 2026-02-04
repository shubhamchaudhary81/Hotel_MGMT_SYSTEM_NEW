@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? 'HMS') . ' | Amenities')

@section('contents')

<div x-data="{
    showEdit:false,
    showView:false,
    editData:{},
    viewData:{}
}">

<x-table
    title="Amenities"
    :columns="['SN', 'Name', 'Description', 'Created At', 'Actions']">

    {{-- ACTION BUTTON --}}
    <x-slot name="action">
        <a href="{{ route('admin.amenities.create') }}"
           class="btn-primary px-4 py-2 rounded-lg shadow text-sm">
            <i class="fa fa-plus mr-1"></i> Add Amenities
        </a>
    </x-slot>

    {{-- FILTERS --}}
    <x-slot name="filters">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search..."
                class="border px-3 py-2 rounded">
            <button class="btn-primary px-4 py-2 rounded">
                Apply
            </button>
        </form>
    </x-slot>

    {{-- TABLE ROWS --}}
    @foreach ($amenities as $index => $a)
    <tr class="hover:bg-gray-50">

        {{-- SN --}}
        <td class="px-4 py-3">
            {{ $amenities->firstItem() + $index }}
        </td>

        {{-- NAME --}}
        <td class="px-4 py-3 font-semibold">
            {{ $a->name }}
        </td>

        {{-- DESCRIPTION --}}
        <td class="px-4 py-3 text-gray-600">
            {{ Str::limit($a->description, 60) }}
        </td>

        {{-- CREATED --}}
        <td class="px-4 py-3">
            {{ $a->created_at->format('d M Y') }}
        </td>

        {{-- ACTIONS --}}
        <td class="px-4 py-3 flex items-center gap-3">

            {{-- VIEW --}}
            <button @click="
                showView = true;
                viewData = {
                    name:'{{ $a->name }}',
                    description:`{{ $a->description }}`
                };
            "
            class="text-green-600 hover:text-green-800">
                <i class="fa fa-eye"></i>
            </button>

            {{-- EDIT --}}
            <button @click="
                showEdit = true;
                editData = {
                    id:'{{ $a->id }}',
                    name:'{{ $a->name }}',
                    description:`{{ $a->description }}`
                };
            "
            class="text-blue-600 hover:text-blue-800">
                <i class="fa fa-edit"></i>
            </button>

            {{-- DELETE --}}
            <button onclick="deleteAmenity({{ $a->id }})"
                class="text-red-600 hover:text-red-800">
                <i class="fa fa-trash"></i>
            </button>

        </td>

    </tr>
    @endforeach

</x-table>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $amenities->links() }}
</div>

{{-- ========================= VIEW MODAL ========================= --}}
<div x-show="showView" x-cloak>
    <div class="modal-backdrop"></div>

    <div class="modal-box show">

        <h2 class="modal-header">Amenity Details</h2>

        <div class="modal-text mb-3"><strong>Name:</strong> <span x-text="viewData.name"></span></div>
        <div class="modal-text mb-3"><strong>Description:</strong> <span x-text="viewData.description"></span></div>

        <div class="modal-actions">
            <button @click="showView=false" class="btn-outline">Close</button>
        </div>
    </div>
</div>

{{-- ========================= EDIT MODAL ========================= --}}
<div x-show="showEdit" x-cloak>
    <div class="modal-backdrop"></div>

    <div class="modal-box show">

        <h2 class="modal-header">Edit Amenity</h2>

        <form method="POST" :action="`/admin/amenities/${editData.id}`">
            @csrf
            @method('PUT')

            <input class="modal-input" name="name" x-model="editData.name" required>

            <textarea class="modal-input" name="description" rows="4"
                      x-model="editData.description"></textarea>

            <div class="modal-actions">
                <button type="button" class="btn-outline"
                        @click="showEdit=false">Cancel</button>

                <button class="btn-primary">Update</button>
            </div>
        </form>

    </div>
</div>

{{-- DELETE --}}
<script>
function deleteAmenity(id) {
    Swal.fire({
        title: "Delete?",
        text: "This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        customClass: {
            confirmButton: "swal-confirm-btn",
            cancelButton: "swal-cancel-btn"
        }
    }).then((res)=>{
        if(res.isConfirmed){
            let f=document.createElement('form');
            f.method='POST';
            f.action=`/admin/amenities/${id}`;
            f.innerHTML=`@csrf @method('DELETE')`;
            document.body.appendChild(f);
            f.submit();
        }
    });
}
</script>

@endsection
