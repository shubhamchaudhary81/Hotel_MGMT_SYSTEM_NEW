@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? 'HMS') . ' | Room Services')

@section('contents')

<div x-data="{
    showView:false,
    showEdit:false,
    view:{},
    edit:{}
}">

    <x-table 
        title="Room Services"
        :columns="['S.N', 'Service Name', 'Price', 'Availability', 'Description', 'Actions']">

        {{-- ACTION BUTTON --}}
        <x-slot name="action">
            <a href="{{ route('admin.room-services.create') }}"
               class="btn-primary px-4 py-2 rounded-lg shadow text-sm flex items-center gap-2">
                <i class="fa fa-plus"></i> Add Service
            </a>
        </x-slot>

        {{-- FILTER --}}
        <x-slot name="filters">
            <form method="GET" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="border px-3 py-2 rounded w-48" placeholder="Search...">

                <button class="btn-primary px-4 py-2 rounded shadow">Apply</button>
            </form>
        </x-slot>

        {{-- TABLE ROWS --}}
        @foreach($roomServices as $index => $s)
            <tr class="hover:bg-gray-50">

                {{-- SN --}}
                <td class="px-4 py-3">{{ $roomServices->firstItem() + $index }}</td>

                <td class="px-4 py-3 font-semibold">{{ $s->name }}</td>

                <td class="px-4 py-3 font-semibold">Rs. {{ number_format($s->price, 2) }}</td>

                <td class="px-4 py-3">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $s->availability_status == 'available'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($s->availability_status) }}
                    </span>
                </td>

                <td class="px-4 py-3 text-gray-600">{{ Str::limit($s->description, 60) }}</td>

                <td class="px-4 py-3 flex items-center gap-3">

                    {{-- VIEW --}}
                    <button @click="
                        showView = true;
                        view = {
                            name: '{{ $s->name }}',
                            description: `{{ $s->description }}`,
                            price: '{{ number_format($s->price,2) }}',
                            status: '{{ ucfirst($s->availability_status) }}'
                        };
                    " class="text-green-600 hover:text-green-800 text-mg">
                        <i class="fa fa-eye"></i>
                    </button>

                    {{-- EDIT --}}
                    <button @click="
                        showEdit = true;
                        edit = {
                            id: '{{ $s->id }}',
                            name: '{{ $s->name }}',
                            description: `{{ $s->description }}`,
                            price: '{{ $s->price }}',
                            status: '{{ $s->availability_status }}'
                        };
                    " class="text-blue-600 hover:text-blue-800 text-mg">
                        <i class="fa fa-edit"></i>
                    </button>

                    {{-- DELETE --}}
                    <button onclick="deleteRoomService({{ $s->id }})"
                        class="text-red-600 hover:text-red-800 text-mg">
                        <i class="fa fa-trash"></i>
                    </button>

                </td>

            </tr>
        @endforeach

    </x-table>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $roomServices->links() }}
    </div>


    {{-- ======================= VIEW MODAL ======================= --}}
    <div x-show="showView" x-cloak 
         class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center"
         x-transition.opacity>

        <div x-transition.scale 
             class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-lg relative">

            <button @click="showView = false"
                class="absolute top-3 right-4 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

            <h2 class="text-xl font-bold mb-4">Service Details</h2>

            <div class="space-y-3 text-gray-700">
                <p><strong>Name:</strong> <span x-text="view.name"></span></p>
                <p><strong>Price:</strong> Rs. <span x-text="view.price"></span></p>
                <p><strong>Status:</strong> <span x-text="view.status"></span></p>
                <p><strong>Description:</strong> <span x-text="view.description"></span></p>
            </div>

            <div class="flex justify-end mt-6">
                <button @click="showView=false" 
                    class="btn-secondary px-4 py-2 rounded">Close</button>
            </div>
        </div>
    </div>



   <!-- ======================= EDIT MODAL ======================= -->
<div x-show="showEdit" x-cloak
     class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center"
     x-transition.opacity>

    <div x-transition.scale
         class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-lg relative">

        {{-- CLOSE BUTTON --}}
        <button @click="showEdit=false"
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">
            <i class="fa fa-times"></i>
        </button>

        {{-- TITLE --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Edit Room Service
        </h2>

        <form method="POST" :action="`/admin/room-services/${edit.id}`">
            @csrf
            @method('PUT')

            {{-- SERVICE NAME --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Service Name</label>
                <input type="text"
                       name="name"
                       x-model="edit.name"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2
                              focus:ring-[var(--primary-color)]
                              focus:border-[var(--primary-color)] transition">
            </div>

            {{-- PRICE --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Price (Rs.)</label>
                <input type="text"
                       name="price"
                       x-model="edit.price"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            {{-- STATUS --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Availability Status</label>
                <select name="availability_status"
                        x-model="edit.status"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>

            {{-- DESCRIPTION --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea name="description"
                          rows="4"
                          x-model="edit.description"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end gap-4 mt-6">
                <button type="button"
                        @click="showEdit=false"
                        class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                    Cancel
                </button>

                <button class="px-6 py-2 rounded-lg text-white font-semibold shadow
                               bg-[var(--primary-color)]
                               hover:bg-[var(--primary-hover)] transition">
                    Update
                </button>
            </div>

        </form>
    </div>

</div>


</div>

{{-- ================== DELETE SCRIPT ================== --}}
<script>
function deleteRoomService(id) {
    Swal.fire({
        title: "Delete this service?",
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
            let f = document.createElement('form');
            f.method = 'POST';
            f.action = `/admin/room-services/${id}`;
            f.innerHTML = `@csrf @method('DELETE')`;
            document.body.appendChild(f);
            f.submit();
        }
    });
}
</script>

@endsection
