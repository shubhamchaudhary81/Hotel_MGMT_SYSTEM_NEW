@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? 'HMS') . ' | Add Room Type')

@section('contents')

    {{-- BACKEND ERRORS --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="bg-white rounded-xl shadow border border-gray-200 max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-semibold text-gray-800">Add Room Type</h2>

            <a href="{{ route('admin.room-types.index') }}"
               class="btn-primary px-4 py-2 rounded-lg text-sm shadow">
                ← Back to Room Types
            </a>
        </div>

        {{-- FORM --}}
        <div class="p-6" x-data="{nameError:'', validName:true}">
            <form id="room-type-form" method="POST" action="{{ route('admin.room-types.store') }}">
                @csrf

                {{-- NAME FIELD --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Room Type Name</label>

                    <input type="text"
                           name="name"
                           id="roomName"
                           value="{{ old('name') }}"
                           placeholder="Enter room type name"
                           @input="
                                const regex = /^[A-Za-z\s]+$/;

                                if($event.target.value === ''){
                                    nameError = 'Name is required.';
                                    validName = false;
                                }
                                else if(!regex.test($event.target.value)){
                                    nameError = 'Only letters and spaces are allowed.';
                                    validName = false;
                                }
                                else{
                                    nameError = '';
                                    validName = true;
                                }
                           "
                           :class="validName ? 'border-gray-300' : 'border-red-500'"
                           class="w-full border rounded-lg px-3 py-2
                                  focus:ring-1 focus:ring-[var(--primary-color)]
                                  focus:border-[var(--primary-color)]">

                    {{-- LIVE ERROR --}}
                    <p x-show="nameError" x-text="nameError" class="text-red-600 text-sm mt-1"></p>

                    {{-- BACKEND ERROR --}}
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- DESCRIPTION --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>

                    <textarea name="description"
                              rows="4"
                              placeholder="Short description..."
                              class="w-full border border-gray-300 rounded-lg px-3 py-2
                                     focus:ring-1 focus:ring-[var(--primary-color)]
                                     focus:border-[var(--primary-color)]">{{ old('description') }}</textarea>
                </div>


                {{-- BUTTONS --}}
                <div class="flex justify-end gap-3 mt-6">

                    {{-- CANCEL --}}
                    <a href="{{ route('admin.room-types.index') }}"
                       class="px-5 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        Cancel
                    </a>

                    {{-- SAVE --}}
                    <button type="button"
                            id="saveRoomType"
                            class="btn-primary px-5 py-2 rounded-lg shadow">
                        Save Room Type
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection


@push('scripts')
<script>
document.getElementById('saveRoomType').addEventListener('click', function () {

    let nameInput = document.getElementById("roomName");
    const regex = /^[A-Za-z\s]+$/;

    // FINAL VALIDATION BEFORE SUBMIT
    if (nameInput.value.trim() === "" || !regex.test(nameInput.value)) {

        Swal.fire({
            icon: "error",
            title: "Invalid Input",
            text: "Please fix the highlighted errors before submitting.",
        });

        nameInput.classList.add("border-red-500");
        return;
    }

    Swal.fire({
        title: "Are you sure?",
        text: "Save this Room Type?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, Save",
        cancelButtonText: "Cancel",
        buttonsStyling: false,
        customClass: {
            confirmButton: "swal-confirm-btn",
            cancelButton: "swal-cancel-btn"
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('room-type-form').submit();
        }
    });
});
</script>
@endpush
