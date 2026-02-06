@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? 'HMS') . ' | Add Extra Service')

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
            <h2 class="text-xl font-semibold text-gray-800">Add Extra Service</h2>

            <a href="{{ route('admin.extra-services.index') }}"
               class="btn-primary px-4 py-2 rounded-lg text-sm shadow">
                ← Back to Extra Services
            </a>
        </div>

        {{-- FORM --}}
        <div class="p-6"
             x-data="{
                nameError:'', priceError:'',
                validName:true, validPrice:true
             }">

            <form id="service-form" method="POST" action="{{ route('admin.extra-services.store') }}">
                @csrf


                {{-- SERVICE NAME FIELD --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Service Name</label>

                    <input type="text"
                           name="service_name"
                           id="serviceName"
                           value="{{ old('service_name') }}"
                           placeholder="Enter service name"

                           @input="
                                const regex = /^[A-Za-z\s]+$/;

                                if($event.target.value === ''){
                                    nameError = 'Service name is required.';
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

                    <p x-show="nameError" x-text="nameError" class="text-red-600 text-sm mt-1"></p>

                    @error('service_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- PRICE FIELD --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price (Rs.)</label>

                    <input type="text"
                           name="price"
                           id="servicePrice"
                           value="{{ old('price') }}"
                           placeholder="Enter price"

                           @input="
                                const priceRegex = /^[0-9]+(\.[0-9]{1,2})?$/;

                                if($event.target.value === ''){
                                    priceError = 'Price is required.';
                                    validPrice = false;
                                }
                                else if(!priceRegex.test($event.target.value)){
                                    priceError = 'Enter a valid amount (numbers only).';
                                    validPrice = false;
                                }
                                else{
                                    priceError = '';
                                    validPrice = true;
                                }
                           "

                           :class="validPrice ? 'border-gray-300' : 'border-red-500'"

                           class="w-full border rounded-lg px-3 py-2
                                  focus:ring-1 focus:ring-[var(--primary-color)]
                                  focus:border-[var(--primary-color)]">

                    <p x-show="priceError" x-text="priceError" class="text-red-600 text-sm mt-1"></p>

                    @error('price')
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

                    <a href="{{ route('admin.extra-services.index') }}"
                       class="px-5 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        Cancel
                    </a>

                    <button type="button"
                            id="saveService"
                            class="btn-primary px-5 py-2 rounded-lg shadow">
                        Save Service
                    </button>
                </div>

            </form>
        </div>

    </div>

@endsection


@push('scripts')
<script>
document.getElementById('saveService').addEventListener('click', function () {

    let nameInput  = document.getElementById("serviceName");
    let priceInput = document.getElementById("servicePrice");

    const nameRegex  = /^[A-Za-z\s]+$/;
    const priceRegex = /^[0-9]+(\.[0-9]{1,2})?$/;

    // FINAL VALIDATION CHECK
    if (
        nameInput.value.trim()  === "" || !nameRegex.test(nameInput.value) ||
        priceInput.value.trim() === "" || !priceRegex.test(priceInput.value)
    ) {
        Swal.fire({
            icon: "error",
            title: "Invalid Input",
            text: "Please fix the highlighted errors before submitting.",
        });

        if (!nameRegex.test(nameInput.value)) nameInput.classList.add("border-red-500");
        if (!priceRegex.test(priceInput.value)) priceInput.classList.add("border-red-500");

        return;
    }

    Swal.fire({
        title: "Are you sure?",
        text: "Save this Extra Service?",
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
            document.getElementById('service-form').submit();
        }
    });
});
</script>
@endpush
