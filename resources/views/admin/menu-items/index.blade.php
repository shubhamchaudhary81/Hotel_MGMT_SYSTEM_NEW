@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? 'HMS') . ' | Menu Items')

@section('contents')

    <div x-data="{
                        showView:false,
                        showEdit:false,
                        view:{},
                        edit:{}
                    }">

        <x-table title="Menu Items" :columns="['S.N', 'Item Name', 'Category', 'Price', 'Availability', 'Actions']">

            {{-- ACTION BUTTON --}}
            <x-slot name="action">
                <a href="{{ route('admin.menu-items.create') }}"
                    class="btn-primary px-4 py-2 rounded-lg shadow text-sm flex items-center gap-2">
                    <i class="fa fa-plus"></i> Add Menu Item
                </a>
            </x-slot>

            {{-- FILTER --}}
            <x-slot name="filters">
                <form method="GET" class="flex gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" class="border px-3 py-2 rounded w-48"
                        placeholder="Search...">

                    <button class="btn-primary px-4 py-2 rounded shadow">Apply</button>
                </form>
            </x-slot>

            {{-- TABLE ROWS --}}
            @foreach($menuItems as $index => $item)
                <tr class="hover:bg-gray-50">

                    {{-- SN --}}
                    <td class="px-4 py-3">{{ $menuItems->firstItem() + $index }}</td>

                    {{-- IMAGE --}}
                    <!-- <td class="px-4 py-3">
                                                                @if($item->menu_image)
                                                                    <img src="{{ asset($item->menu_image) }}" class="w-12 h-12 rounded object-cover border">
                                                                @else
                                                                    <span class="text-gray-400 text-sm">No Image</span>
                                                                @endif
                                                            </td> -->

                    {{-- NAME --}}
                    <td class="px-4 py-3 font-semibold">{{ $item->item_name }}</td>

                    {{-- CATEGORY --}}
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs font-semibold bg-gray-100">
                            {{ $item->category->name }}
                        </span>
                    </td>

                    {{-- PRICE --}}
                    <td class="px-4 py-3 font-semibold">Rs. {{ number_format($item->price, 2) }}</td>

                    {{-- STATUS --}}
                    <td class="px-4 py-3">

                        <form method="POST" action="{{ route('admin.menu-items.update-status', $item->id) }}" x-data
                            @change="$event.target.form.submit()">

                            @csrf
                            @method('PUT')


                            <select name="is_available" class="text-xs font-semibold rounded px-2 py-1 border cursor-pointer
                        {{ $item->is_available
                ? 'bg-green-100 text-green-700 border-green-200'
                : 'bg-red-100 text-red-700 border-red-200'
                        }}">

                                <option value="1" {{ $item->is_available ? 'selected' : '' }}>
                                    Available
                                </option>

                                <option value="0" {{ !$item->is_available ? 'selected' : '' }}>
                                    Unavailable
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
                                                                        image: '{{ $item->menu_image ? asset($item->menu_image) : '' }}',
                                                                        name: '{{ $item->item_name }}',
                                                                        category: '{{ $item->category->name }}',
                                                                        price: '{{ number_format($item->price, 2) }}',
                                                                        description: `{{ $item->item_description }}`,
                                                                        availability: '{{ $item->is_available ? 'Available' : 'Unavailable' }}'
                                                                    };
                                                                " class="text-green-600 hover:text-green-800 text-mg">
                            <i class="fa fa-eye"></i>
                        </button>

                        {{-- EDIT --}}
                        {{-- EDIT --}}
                        <button @click="
                                                    showEdit = true;
                                                    edit = {
                                                        id: '{{ $item->id }}',
                                                        name: '{{ $item->item_name }}',
                                                        category_id: '{{ $item->category_id }}',
                                                        price: '{{ $item->price }}',
                                                        description:`{{ $item->item_description }}`,

                                                        // FIXED — USE 'image' instead of 'img'
                                                        image: '{{ $item->menu_image ? asset($item->menu_image) : '' }}',
                                                        preview: null,

                                                        availability:'{{ $item->is_available }}'
                                                    };
                                                " class="text-blue-600 hover:text-blue-800 text-mg">
                            <i class="fa fa-edit"></i>
                        </button>


                        {{-- DELETE --}}
                        <button onclick="deleteMenuItem({{ $item->id }})" class="text-red-600 hover:text-red-800 text-mg">
                            <i class="fa fa-trash"></i>
                        </button>

                    </td>

                </tr>
            @endforeach

        </x-table>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $menuItems->links() }}
        </div>


        {{-- ================= VIEW MODAL ================= --}}
        <div x-show="showView" x-cloak class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center"
            x-transition.opacity>

            <div x-transition.scale class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-lg relative">

                <button @click="showView = false"
                    class="absolute top-3 right-4 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <i class="fa fa-info-circle text-primary"></i> Menu Item Details
                </h2>

                <div class="space-y-3 text-gray-700">

                    {{-- IMAGE --}}
                    <template x-if="view.image">
                        <img :src="view.image" class="w-32 h-32 rounded object-cover border mx-auto mb-3">
                    </template>

                    <p><strong>Name:</strong> <span x-text="view.name"></span></p>
                    <p><strong>Category:</strong> <span x-text="view.category"></span></p>
                    <p><strong>Price:</strong> Rs. <span x-text="view.price"></span></p>
                    <p><strong>Status:</strong> <span x-text="view.availability"></span></p>
                    <p><strong>Description:</strong> <span x-text="view.description"></span></p>
                </div>

                <div class="flex justify-end mt-6">
                    <button @click="showView=false" class="btn-secondary px-4 py-2 rounded">Close</button>
                </div>
            </div>

        </div>


        {{-- ===================== EDIT MODAL (MENU ITEMS) ===================== --}}
        <div x-show="showEdit" x-cloak class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center"
            x-transition.opacity>

            <div x-transition.scale class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-lg relative">

                {{-- CLOSE BUTTON --}}
                <button @click="showEdit=false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">
                    <i class="fa fa-times"></i>
                </button>

                {{-- TITLE --}}
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Edit Menu Item
                </h2>

                <form method="POST" :action="`/admin/menu-items/${edit.id}`" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- ITEM NAME --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Item Name</label>
                        <input type="text" name="item_name" x-model="edit.name" class="w-full border border-gray-300 rounded-lg px-4 py-2
                                                  focus:ring-[var(--primary-color)]
                                                  focus:border-[var(--primary-color)] transition">
                    </div>

                    {{-- CATEGORY --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>

                        <select name="category_id" x-model="edit.category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2
                               focus:ring-[var(--primary-color)]
                               focus:border-[var(--primary-color)] transition">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    {{-- PRICE --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Price (Rs.)</label>
                        <input type="text" name="price" x-model="edit.price" class="w-full border border-gray-300 rounded-lg px-4 py-2
                                                  focus:ring-[var(--primary-color)]
                                                  focus:border-[var(--primary-color)] transition">
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                        <textarea name="item_description" rows="4" x-model="edit.description" class="w-full border border-gray-300 rounded-lg px-4 py-2
                                                     focus:ring-[var(--primary-color)]
                                                     focus:border-[var(--primary-color)] transition"></textarea>
                    </div>

                    {{-- IMAGE FIELD + PREVIEW SIDE BY SIDE --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Menu Image</label>

                        <div class="flex items-center gap-4">
                            <input type="file" name="menu_image" accept="image/*" @change="
                                                    const file = $event.target.files[0];
                                                    if(file){
                                                        edit.preview = URL.createObjectURL(file);
                                                    }
                                               " class="w-full border border-gray-300 rounded-lg px-4 py-2
                                                      focus:ring-[var(--primary-color)]
                                                      focus:border-[var(--primary-color)] transition">

                            {{-- IMAGE PREVIEW (MEDIUM SIZE) --}}
                            <template x-if="edit.preview || edit.image">
                                <img :src="edit.preview ? edit.preview : edit.image"
                                    class="w-25 h-12 rounded object-cover border shadow">
                            </template>
                        </div>

                    </div>

                    {{-- AVAILABILITY --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Availability</label>
                        <select name="is_available" x-model="edit.availability" class="w-full border border-gray-300 rounded-lg px-4 py-2
                                                   focus:ring-[var(--primary-color)]
                                                   focus:border-[var(--primary-color)] transition">
                            <option value="1">Available</option>
                            <option value="0">Unavailable</option>
                        </select>
                    </div>

                    {{-- BUTTONS --}}
                    <div class="flex justify-end gap-4 mt-6">
                        <button type="button" @click="showEdit=false" class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700
                                                   hover:bg-gray-100 transition font-medium">
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


    {{-- DELETE SCRIPT --}}
    <script>
        function deleteMenuItem(id) {
            Swal.fire({
                title: "Delete this menu item?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                customClass: {
                    confirmButton: "swal-confirm-btn",
                    cancelButton: "swal-cancel-btn"
                }
            }).then(res => {
                if (res.isConfirmed) {
                    let f = document.createElement("form");
                    f.method = "POST";
                    f.action = `/admin/menu-items/${id}`;
                    f.innerHTML = `@csrf @method('DELETE')`;
                    document.body.appendChild(f);
                    f.submit();
                }
            });
        }
    </script>

@endsection