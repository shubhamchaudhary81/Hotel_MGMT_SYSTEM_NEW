@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? 'HMS') . ' | Add Room Service')

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
            <h2 class="text-xl font-semibold text-gray-800">Add Room Service</h2>

            <a href="{{ route('admin.room-services.index') }}"
               class="btn-primary px-4 py-2 rounded-lg text-sm shadow">
                ← Back to Room Services
            </a>
        </div>

        {{-- FORM --}}
        <div class="p-6"
             x-data="{
                nameError:'',
                validName:true,

                priceError:'',
                validPrice:true
             }">

            <form id="room-service-form" method="POST" action="{{ route('admin.room-services.store') }}">
                @csrf

                {{-- SERVICE NAME --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Service Name</label>

                    <input type="text"
                           name="name"
                           id="serviceName"
                           value="{{ old('name') }}"
                           placeholder="Enter service name"
                           @input="
                                const regex = /^[A-Za-z\s]+$/;

                                if ($event.target.value === '') {
                                    nameError = 'Service name is required.';
                                    validName = false;
                                }
                                else if (!regex.test($event.target.value)) {
                                    nameError = 'Only letters and spaces are allowed.';
                                    validName = false;
                                }
                                else {
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


                {{-- PRICE --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price (Rs.)</label>

                    <input type="text"
                           name="price"
                           id="servicePrice"
                           value="{{ old('price') }}"
                           placeholder="Enter price"
                           @input="
                                const priceRegex = /^[0-9]+(\.[0-9]{1,2})?$/;

                                if ($event.target.value === '') {
                                    priceError = 'Price is required.';
                                    validPrice = false;
                                }
                                else if (!priceRegex.test($event.target.value)) {
                                    priceError = 'Only numbers allowed (2 decimals max).';
                                    validPrice = false;
                                }
                                else {
                                    priceError = '';
                                    validPrice = true;
                                }
                           "
                           :class="validPrice ? 'border-gray-300' : 'border-red-500'"
                           class="w-full border rounded-lg px-3 py-2
                                  focus:ring-1 focus:ring-[var(--primary-color)]
                                  focus:border-[var(--primary-color)]">

                    {{-- LIVE ERROR --}}
                    <p x-show="priceError" x-text="priceError" class="text-red-600 text-sm mt-1"></p>

                    {{-- BACKEND ERROR --}}
                    @error('price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- AVAILABILITY --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Availability Status</label>

                    <select name="availability_status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
                                   focus:ring-1 focus:ring-[var(--primary-color)]
                                   focus:border-[var(--primary-color)]">

                        <option value="available" {{ old('availability_status')=='available'?'selected':'' }}>
                            Available
                        </option>
                        <option value="unavailable" {{ old('availability_status')=='unavailable'?'selected':'' }}>
                            Unavailable
                        </option>
                    </select>
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

                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- BUTTONS --}}
                <div class="flex justify-end gap-3 mt-6">

                    {{-- CANCEL --}}
                    <a href="{{ route('admin.room-services.index') }}"
                       class="px-5 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        Cancel
                    </a>

                    {{-- SAVE --}}
                    <button type="button"
                            id="saveRoomService"
                            class="btn-primary px-5 py-2 rounded-lg shadow">
                        Save Room Service
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection


@push('scripts')
<script>
document.getElementById('saveRoomService').addEventListener('click', function () {

    let nameInput = document.getElementById("serviceName");
    let priceInput = document.getElementById("servicePrice");

    const nameRegex = /^[A-Za-z\s]+$/;
    const priceRegex = /^[0-9]+(\.[0-9]{1,2})?$/;

    // FINAL NAME CHECK
    if (nameInput.value.trim() === "" || !nameRegex.test(nameInput.value)) {
        Swal.fire({
            icon: "error",
            title: "Invalid Input",
            text: "Fix the Service Name field.",
        });
        nameInput.classList.add("border-red-500");
        return;
    }

    // FINAL PRICE CHECK
    if (priceInput.value.trim() === "" || !priceRegex.test(priceInput.value)) {
        Swal.fire({
            icon: "error",
            title: "Invalid Input",
            text: "Fix the Price field.",
        });
        priceInput.classList.add("border-red-500");
        return;
    }

    Swal.fire({
        title: "Are you sure?",
        text: "Save this Room Service?",
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
            document.getElementById('room-service-form').submit();
        }
    });
});
</script>
@endpush
