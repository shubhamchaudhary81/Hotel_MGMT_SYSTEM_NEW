@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? 'HMS') . ' | Rooms')

@section('contents')

<div x-data="{
        showView:false,
        showEdit:false,
        view:{},
        edit:{}
    }">

    <x-table 
        title="Rooms"
        :columns="['S.N', 'Room Number', 'Type', 'Price', 'Capacity', 'Floor', 'Status', 'Actions']">

        {{-- ACTION BUTTON --}}
        <x-slot name="action">
            <a href="{{ route('admin.rooms.create') }}"
               class="btn-primary px-4 py-2 rounded-lg shadow text-sm flex items-center gap-2">
                <i class="fa fa-plus"></i> Add Rooms
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

        {{-- TABLE BODY --}}
        @foreach($rooms as $index => $r)
        <tr class="hover:bg-gray-50">

            {{-- SN --}}
            <td class="px-4 py-3">{{ $rooms->firstItem() + $index }}</td>

            {{-- ROOM NUMBER --}}
            <td class="px-4 py-3 font-semibold">{{ $r->room_number }}</td>

            {{-- ROOM TYPE --}}
            <td class="px-4 py-3">
                <span class="px-2 py-1 bg-gray-100 rounded text-xs font-semibold">
                    {{ $r->roomType->name }}
                </span>
            </td>

            {{-- BASE PRICE --}}
            <td class="px-4 py-3 font-semibold">Rs. {{ number_format($r->base_price, 2) }}</td>

            {{-- CAPACITY --}}
            <td class="px-4 py-3">{{ $r->capacity }}</td>

            {{-- FLOOR --}}
            <td class="px-4 py-3">{{ $r->floor_number }}</td>

            {{-- STATUS (Inline Update) --}}
            <td class="px-4 py-3">
                <form method="POST" 
                      action="{{ route('admin.rooms.update-status', $r->id) }}"
                      x-data
                      @change="$event.target.form.submit()">

                    @csrf
                    @method('PUT')

                    <select name="status"
                        class="text-xs font-semibold rounded px-2 py-1 border cursor-pointer
                        {{ $r->status=='available' ? 'bg-green-100 text-green-700 border-green-200'
                        : ($r->status=='occupied' ? 'bg-blue-100 text-blue-700 border-blue-200'
                        : 'bg-red-100 text-red-700 border-red-200') }}">

                        <option value="available" {{ $r->status=='available' ? 'selected' : '' }}>
                            Available
                        </option>

                        <option value="occupied" {{ $r->status=='occupied' ? 'selected' : '' }}>
                            Occupied
                        </option>

                        <option value="out_of_order" {{ $r->status=='out_of_order' ? 'selected' : '' }}>
                            Out of Order
                        </option>

                    </select>
                </form>
            </td>

            {{-- ACTIONS --}}
            <td class="px-4 py-3 flex items-center gap-3">

                {{-- VIEW --}}
                <button @click="
                    showView = true;
                    view = {
                        number: '{{ $r->room_number }}',
                        type: '{{ $r->roomType->name }}',
                        base_price: '{{ number_format($r->base_price,2) }}',
                        weekend_price: '{{ $r->weekend_price }}',
                        seasonal_price: '{{ $r->seasonal_price }}',
                        capacity: '{{ $r->capacity }}',
                        floor: '{{ $r->floor_number }}',
                        status: '{{ ucfirst(str_replace('_',' ',$r->status)) }}',
                        description:`{{ $r->description }}`,
                        image: '{{ $r->image ? asset($r->image) : '' }}'
                    };
                " class="text-green-600 hover:text-green-800">
                    <i class="fa fa-eye"></i>
                </button>

                {{-- EDIT --}}
                <button @click="
                    showEdit = true;
                    edit = {
                        id: '{{ $r->id }}',
                        number: '{{ $r->room_number }}',
                        type_id: '{{ $r->room_type_id }}',
                        base_price: '{{ $r->base_price }}',
                        weekend_price: '{{ $r->weekend_price }}',
                        seasonal_price: '{{ $r->seasonal_price }}',
                        capacity: '{{ $r->capacity }}',
                        floor: '{{ $r->floor_number }}',
                        status: '{{ $r->status }}',
                        description:`{{ $r->description }}`,
                        image: '{{ $r->image ? asset($r->image) : '' }}',
                        preview: null
                    };
                " class="text-blue-600 hover:text-blue-800">
                    <i class="fa fa-edit"></i>
                </button>

                {{-- DELETE --}}
                <button onclick="deleteRoom({{ $r->id }})"
                    class="text-red-600 hover:text-red-800">
                    <i class="fa fa-trash"></i>
                </button>

            </td>

        </tr>
        @endforeach

    </x-table>

    <div class="mt-4">
        {{ $rooms->links() }}
    </div>


    {{-- =================== VIEW MODAL =================== --}}
    <div x-show="showView" x-cloak
         class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center"
         x-transition.opacity>

        <div x-transition.scale class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-xl relative">

            <button @click="showView=false"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

            <h2 class="text-xl font-bold mb-4">Room Details</h2>

            <template x-if="view.image">
                <img :src="view.image" class="w-40 h-40 rounded object-cover border mx-auto mb-4">
            </template>

            <div class="space-y-2 text-gray-700">
                <p><strong>Room Number:</strong> <span x-text="view.number"></span></p>
                <p><strong>Type:</strong> <span x-text="view.type"></span></p>
                <p><strong>Base Price:</strong> Rs. <span x-text="view.base_price"></span></p>
                <p><strong>Capacity:</strong> <span x-text="view.capacity"></span></p>
                <p><strong>Floor:</strong> <span x-text="view.floor"></span></p>
                <p><strong>Status:</strong> <span x-text="view.status"></span></p>
                <p><strong>Description:</strong> <span x-text="view.description"></span></p>
            </div>

            <div class="flex justify-end mt-6">
                <button @click="showView=false"
                    class="btn-secondary px-4 py-2 rounded">Close</button>
            </div>
        </div>
    </div>


    {{-- =================== EDIT MODAL =================== --}}
    <div x-show="showEdit" x-cloak
         class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center"
         x-transition.opacity>

        <div x-transition.scale 
             class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-xl relative">

            <button @click="showEdit=false"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">
                <i class="fa fa-times"></i>
            </button>

            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Room</h2>

            <form method="POST" :action="`/admin/rooms/${edit.id}`" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ROOM NUMBER --}}
                <label class="block font-semibold text-gray-700">Room Number</label>
                <input type="text" name="room_number" x-model="edit.number"
                       class="input-field mb-4">

                {{-- ROOM TYPE --}}
                <label class="block font-semibold text-gray-700">Room Type</label>
                <select name="room_type_id" x-model="edit.type_id"
                        class="input-field mb-4">
                    @foreach($roomTypes as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>

                {{-- PRICE --}}
                <label class="block font-semibold text-gray-700">Base Price (Rs.)</label>
                <input type="number" step="0.01" name="base_price" x-model="edit.base_price"
                       class="input-field mb-4">

                {{-- CAPACITY --}}
                <label class="block font-semibold text-gray-700">Capacity</label>
                <input type="number" name="capacity" x-model="edit.capacity"
                       class="input-field mb-4">

                {{-- FLOOR --}}
                <label class="block font-semibold text-gray-700">Floor Number</label>
                <input type="number" name="floor_number" x-model="edit.floor"
                       class="input-field mb-4">

                {{-- STATUS --}}
                <label class="block font-semibold text-gray-700">Status</label>
                <select name="status" x-model="edit.status" class="input-field mb-4">
                    <option value="available">Available</option>
                    <option value="occupied">Occupied</option>
                    <option value="out_of_order">Out of Order</option>
                </select>

                {{-- DESCRIPTION --}}
                <label class="block font-semibold text-gray-700">Description</label>
                <textarea name="description" rows="4" x-model="edit.description"
                          class="input-field mb-4"></textarea>

                {{-- IMAGE --}}
                <label class="block font-semibold text-gray-700">Room Image</label>
                <div class="flex items-center gap-4 mb-4">
                    <input type="file" name="image" accept="image/*"
                           @change="
                                const f=$event.target.files[0];
                                if(f){ edit.preview = URL.createObjectURL(f); }
                           "
                           class="input-field">

                    <template x-if="edit.preview || edit.image">
                        <img :src="edit.preview ? edit.preview : edit.image"
                             class="w-24 h-24 rounded object-cover border shadow">
                    </template>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="button" @click="showEdit=false"
                        class="btn-secondary px-5 py-2 rounded">
                        Cancel
                    </button>

                    <button class="btn-primary px-6 py-2 rounded shadow">
                        Update
                    </button>
                </div>
            </form>

        </div>

    </div>

</div>

<script>
function deleteRoom(id){
    Swal.fire({
        title:"Delete this room?",
        icon:"warning",
        showCancelButton:true,
        confirmButtonText:"Delete",
        cancelButtonText:"Cancel",
        customClass:{
            confirmButton:"swal-confirm-btn",
            cancelButton:"swal-cancel-btn"
        }
    }).then(res=>{
        if(res.isConfirmed){
            let f=document.createElement('form');
            f.method='POST';
            f.action=`/admin/rooms/${id}`;
            f.innerHTML=`@csrf @method('DELETE')`;
            document.body.appendChild(f);
            f.submit();
        }
    });
}
</script>

@endsection
