@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? 'HMS') . ' | Add Menu Item')

@section('contents')

    <div x-data="{
            categoryModal:false,
            createModal:false,
            editCategoryModal:false,
            deleteCategoryId:null,

            newCategoryName:'',
            newCategoryType:'1',

            editCategory:{ id:'', name:'', item_type:'1' },

            previewImage:null,

            // live validation
            itemNameError:'',
            validItemName:true,
        }">

        {{-- ====================== BACKEND ERRORS ====================== --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- ====================== MAIN FORM CARD ====================== --}}
        <div class="bg-white max-w-7xl mx-auto rounded-xl shadow border border-gray-200">

            {{-- HEADER --}}
            <div class="flex justify-between items-center px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Add Menu Item</h2>

                <a href="{{ route('admin.menu-items.index') }}" class="px-4 py-2 rounded-lg shadow btn-primary text-sm">
                    ← Back to Menu Items
                </a>
            </div>


            {{-- ====================== FORM ====================== --}}
            <div class="p-6">
                <form id="menu-item-form" method="POST" action="{{ route('admin.menu-items.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- HIDDEN AVAILABILITY STATUS --}}
                    <input type="hidden" name="is_available" value="1">

                    <div class="grid md:grid-cols-2 gap-6">

                        {{-- ITEM NAME --}}
                        <div x-data>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>

                            <input type="text" name="item_name" id="item_name" placeholder="Enter item name"
                                value="{{ old('item_name') }}" 
                                @input="
                                    const value = $event.target.value;
                                    const hasLetter = /[A-Za-z]/.test(value);

                                    if(value.trim() === ''){
                                        itemNameError='Item name is required.';
                                        validItemName=false;
                                    }
                                    else if(!hasLetter){
                                        itemNameError='Item name must contain at least one alphabet.';
                                        validItemName=false;
                                    }
                                    else{
                                        itemNameError='';
                                        validItemName=true;
                                    }
                               "

                                   :class="validItemName ? 'border-gray-300' : 'border-red-500'"
                                class="w-full border rounded-lg px-3 py-2 focus:ring-primary focus:border-primary">

                            <p x-show="itemNameError" x-text="itemNameError" class="text-red-600 text-sm mt-1"></p>
                        </div>


                        {{-- PRICE --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Price (Rs.)</label>
                            <input type="number" step="0.01" name="price" placeholder="Enter price"
                                value="{{ old('price') }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring-primary focus:border-primary">
                        </div>


                        {{-- CATEGORY --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Select Category</label>

                            <div class="flex gap-3">

                                <select name="category_id"
                                    class="w-full border rounded-lg px-3 py-2 focus:ring-primary focus:border-primary">
                                    <option value="" disabled selected>Select category</option>

                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>

                                {{-- MANAGE BTN --}}
                                <button type="button" @click="categoryModal = true"
                                    class="px-3 py-2 rounded-lg border hover:bg-gray-100 text-gray-700">
                                    <i class="fa fa-cog"></i>
                                </button>

                            </div>
                        </div>


                        {{-- IMAGE UPLOAD --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Menu Image</label>

                            <input type="file" name="menu_image" accept="image/*" @change="
                                        const file = $event.target.files[0];
                                        if(file){
                                            previewImage = URL.createObjectURL(file);
                                        }
                                   " class="w-full border rounded-lg px-3 py-2 focus:ring-primary focus:border-primary">

                            <template x-if="previewImage">
                                <img :src="previewImage" class="w-20 h-20 mt-2 rounded object-cover border">
                            </template>
                        </div>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="mt-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="item_description" rows="4"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-primary focus:border-primary"
                            placeholder="Short description...">{{ old('item_description') }}</textarea>
                    </div>


                    {{-- BUTTONS --}}
                    <div class="flex justify-end gap-3 mt-6">

                        <a href="{{ route('admin.menu-items.index') }}"
                            class="px-5 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                            Cancel
                        </a>

                        <button type="button" id="saveBtn" class="btn-primary px-5 py-2 rounded-lg shadow">
                            Save Menu Item
                        </button>
                    </div>

                </form>
            </div>
        </div>



        {{-- ===================================================== --}}
        {{-- CATEGORY MANAGEMENT MODAL --}}
        {{-- ===================================================== --}}
        <div x-show="categoryModal" x-cloak class="fixed inset-0 bg-black/60 z-50 flex justify-center items-center">

            <div x-transition.scale class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-lg relative">

                {{-- CLOSE --}}
                <button @click="categoryModal=false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-xl">
                    <i class="fa fa-times"></i>
                </button>

                <h2 class="text-xl font-bold mb-4">Manage Categories</h2>

                {{-- CATEGORY LIST --}}
                <ul class="divide-y">
                    @foreach($categories as $cat)
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <p class="font-medium">{{ $cat->name }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ $cat->item_type == 1 ? 'Food' : ($cat->item_type == 2 ? 'Drink' : 'Dessert') }}
                                </p>
                            </div>

                            <div class="flex gap-3">
                                {{-- EDIT --}}
                                <button @click="
                                        editCategory = {
                                            id:'{{ $cat->id }}',
                                            name:'{{ $cat->name }}',
                                            item_type:'{{ $cat->item_type }}'
                                        };
                                        categoryModal=false;
                                        editCategoryModal=true;
                                    " class="text-blue-600 hover:text-blue-800">
                                    <i class="fa fa-edit"></i>
                                </button>

                                {{-- DELETE --}}
                                <button onclick="deleteCategory({{ $cat->id }})" class="text-red-600 hover:text-red-800">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>

                {{-- ADD BTN --}}
                <div class="mt-5 flex justify-end">
                    <button @click="categoryModal=false; createModal=true" class="btn-primary px-4 py-2 rounded shadow">
                        + Add Category
                    </button>
                </div>

            </div>
        </div>



        {{-- ===================================================== --}}
        {{-- ADD CATEGORY MODAL --}}
        {{-- ===================================================== --}}
        <div x-show="createModal" x-cloak class="fixed inset-0 bg-black/60 z-50 flex justify-center items-center">

            <div x-transition.scale class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md relative">

                <button @click="createModal=false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-xl">
                    <i class="fa fa-times"></i>
                </button>

                <h2 class="text-xl font-bold mb-4">Add New Category</h2>

                <form method="POST" action="{{ route('admin.menu-categories.store') }}">
                    @csrf

                    {{-- NAME --}}
                    <div class="mb-4">
                        <label class="text-sm font-medium">Category Name</label>
                        <input type="text" name="name" x-model="newCategoryName" class="w-full border rounded-lg px-3 py-2">
                    </div>

                    {{-- TYPE --}}
                    <div class="mb-4">
                        <label class="text-sm font-medium">Item Type</label>
                        <select name="item_type" x-model="newCategoryType" class="w-full border rounded-lg px-3 py-2">
                            <option value="1">Food</option>
                            <option value="2">Drink</option>
                            <option value="3">Dessert</option>
                        </select>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button class="btn-primary px-4 py-2 rounded-lg shadow">
                            Save Category
                        </button>
                    </div>

                </form>

            </div>
        </div>



        {{-- ===================================================== --}}
        {{-- EDIT CATEGORY MODAL --}}
        {{-- ===================================================== --}}
        <div x-show="editCategoryModal" x-cloak class="fixed inset-0 bg-black/60 z-50 flex justify-center items-center">

            <div x-transition.scale class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md relative">

                <button @click="editCategoryModal=false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-xl">
                    <i class="fa fa-times"></i>
                </button>

                <h2 class="text-xl font-bold mb-4">Edit Category</h2>

                <form method="POST" :action="`/admin/menu-categories/${editCategory.id}`">
                    @csrf
                    @method('PUT')

                    {{-- NAME --}}
                    <div class="mb-4">
                        <label class="text-sm font-medium">Category Name</label>
                        <input type="text" name="name" x-model="editCategory.name"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    {{-- TYPE --}}
                    <div class="mb-4">
                        <label class="text-sm font-medium">Item Type</label>
                        <select name="item_type" x-model="editCategory.item_type"
                            class="w-full border rounded-lg px-3 py-2">
                            <option value="1">Food</option>
                            <option value="2">Drink</option>
                            <option value="3">Dessert</option>
                        </select>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button class="btn-primary px-4 py-2 rounded-lg shadow">
                            Update Category
                        </button>
                    </div>

                </form>

            </div>
        </div>



    </div>



    {{-- ================= DELETE CATEGORY SCRIPT ================= --}}
    <script>
        function deleteCategory(id) {
            Swal.fire({
                title: "Delete Category?",
                text: "This will remove the category permanently.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                customClass: {
                    confirmButton: "swal-confirm-btn",
                    cancelButton: "swal-cancel-btn"
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    let f = document.createElement('form');
                    f.method = 'POST';
                    f.action = `/admin/menu-categories/${id}`;
                    f.innerHTML = `@csrf @method('DELETE')`;
                    document.body.appendChild(f);
                    f.submit();
                }
            });
        }



        // ================= FORM SUBMIT VALIDATION =================
        document.getElementById('saveBtn').addEventListener('click', function () {

            const itemName = document.getElementById('item_name');
            const regex = /^[A-Za-z0-9\s]+$/;

            if (itemName.value.trim() === '' || !regex.test(itemName.value)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                    text: 'Fix the highlighted errors before submitting.'
                });
                itemName.classList.add("border-red-500");
                return;
            }

            Swal.fire({
                title: "Save Menu Item?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Save",
                cancelButtonText: "Cancel",
                buttonsStyling: false,
                customClass: {
                    confirmButton: "swal-confirm-btn",
                    cancelButton: "swal-cancel-btn"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('menu-item-form').submit();
                }
            });

        });
    </script>

@endsection