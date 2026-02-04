@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? 'HMS') . ' | Room Types')

@section('contents')

    <div x-data="{
            showEdit:false,
            showView:false,
            editData:{},
            viewData:{}
        }" class="relative">

        <x-table title="Room Types" :columns="['S.N', 'Name', 'Description', 'Actions']">

            {{-- ACTION BUTTON --}}
            <x-slot name="action">
                <a href="{{ route('admin.room-types.create') }}" class="px-4 py-2 rounded-lg text-white shadow 
                      bg-[var(--primary-color)] hover:bg-[var(--primary-hover)] transition">
                    <i class="fa fa-plus mr-1"></i> Add Room Type
                </a>
            </x-slot>

            {{-- FILTERS --}}
            <x-slot name="filters">
                <form method="GET" class="flex gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                        class="border px-3 py-2 rounded w-48">

                    <button class="px-4 py-2 rounded text-white 
                               bg-[var(--primary-color)] hover:bg-[var(--primary-hover)] transition">
                        Apply
                    </button>
                </form>
            </x-slot>

            {{-- TABLE ROWS --}}
            @foreach ($roomTypes as $type)
                <tr class="hover:bg-gray-50">

                    {{-- SN NUMBER --}}
                    <td class="px-4 py-3">
                        {{ ($roomTypes->currentPage() - 1) * $roomTypes->perPage() + $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 font-semibold">{{ $type->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ Str::limit($type->description, 60) }}</td>
                    <!-- <td class="px-4 py-3">{{ $type->created_at->format('d M Y') }}</td> -->

                    <td class="px-4 py-3 flex items-center gap-3">

                        {{-- VIEW --}}
                        <button @click="
                    showView = true;
                    viewData = {
                        id:'{{ $type->id }}',
                        name:'{{ $type->name }}',
                        description:`{{ $type->description }}`,
                    };
                " class="text-green-600 hover:text-green-800">
                            <i class="fa fa-eye"></i>
                        </button>

                        {{-- EDIT --}}
                        <button @click="
                    showEdit = true;
                    editData = {
                        id:'{{ $type->id }}',
                        name:'{{ $type->name }}',
                        description:`{{ $type->description }}`
                    };
                " class="text-blue-600 hover:text-blue-800">
                            <i class="fa fa-edit"></i>
                        </button>

                        {{-- DELETE --}}
                        <button onclick="deleteRoomType({{ $type->id }})" class="text-red-600 hover:text-red-800">
                            <i class="fa fa-trash"></i>
                        </button>

                    </td>

                </tr>
            @endforeach


        </x-table>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $roomTypes->links() }}
        </div>

        {{-- ================================================= --}}
        {{-- =============== VIEW MODAL ======================= --}}
        {{-- ================================================= --}}
        <div x-show="showView" x-cloak x-transition.opacity
            class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">

            <div x-transition.scale class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-lg relative">
                {{-- Close Button --}}
                <button @click="showView=false" class="absolute top-3 right-4 text-gray-500 hover:text-gray-700 text-xl">
                    &times;
                </button>

                <h2 class="text-xl font-bold mb-4">Room Type Details</h2>

                <div class="space-y-3">
                    <p><strong>Name:</strong> <span x-text="viewData.name"></span></p>
                    <p><strong>Description:</strong> <span x-text="viewData.description"></span></p>
                    <!-- <p><strong>Created At:</strong> <span x-text="viewData.created_at"></span></p> -->
                </div>

                <div class="flex justify-end mt-6">
                    <button @click="showView=false" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700
                           hover:bg-gray-100 transition font-medium">
                        Close
                    </button>
                </div>
            </div>

        </div>

        {{-- ================================================= --}}
        {{-- =============== EDIT MODAL ======================= --}}
        {{-- ================================================= --}}
        <div x-show="showEdit" x-cloak x-transition.opacity
            class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">

            <div x-transition.scale class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-lg relative">
                {{-- Close Button --}}
                <button @click="showEdit=false" class="absolute top-3 right-4 text-gray-500 hover:text-gray-700 text-xl">
                    &times;
                </button>

                <h2 class="text-xl font-bold mb-4">Edit Room Type</h2>

                <form method="POST" :action="`/admin/room-types/${editData.id}`">
                    @csrf
                    @method('PUT')

                    <input class="w-full border rounded-lg px-3 py-2 mb-4" name="name" x-model="editData.name">

                    <textarea class="w-full border rounded-lg px-3 py-2 mb-4" name="description" rows="4"
                        x-model="editData.description"></textarea>

                    <div class="flex justify-end gap-3">
                        <button type="button" @click="showEdit=false" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700
                               hover:bg-gray-100 transition font-medium">
                            Cancel
                        </button>

                        <button class="px-4 py-2 rounded-lg text-white font-medium shadow-sm
                               bg-[var(--primary-color)] hover:bg-[var(--primary-hover)] transition">
                            Update
                        </button>
                    </div>

                </form>
            </div>

        </div>


        {{-- DELETE SCRIPT --}}
        <script>
            function deleteRoomType(id) {
                Swal.fire({
                    title: "Delete Room Type?",
                    text: "This action cannot be undone.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    customClass: {
                        confirmButton: "swal-confirm-btn",
                        cancelButton: "swal-cancel-btn"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        let f = document.createElement('form');
                        f.method = 'POST';
                        f.action = `/admin/room-types/${id}`;
                        f.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                        document.body.appendChild(f);
                        f.submit();
                    }
                });
            }
        </script>

@endsection