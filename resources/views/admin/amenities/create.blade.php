@extends('layouts.admin.app')
@section('title','Add Amenity')

@section('contents')

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
        <h2 class="text-xl font-semibold text-gray-800">Add Amenity</h2>

        <a href="{{ route('admin.amenities.index') }}"
           class="btn-primary px-4 py-2 rounded-lg text-sm shadow">
            ← Back to Amenities
        </a>
    </div>

    {{-- FORM --}}
    <div class="p-6">
        <form id="amenity-form" method="POST" action="{{ route('admin.amenities.store') }}">
            @csrf

            {{-- NAME --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Amenity Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border @error('name') border-red-500 @else border-gray-300 @enderror
                           rounded-lg px-3 py-2 focus:ring-1 focus:ring-[var(--primary-color)]"
                    placeholder="Swimming Pool" required>

                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description"
                    class="w-full border @error('description') border-red-500 @else border-gray-300 @enderror
                           rounded-lg px-3 py-2 focus:ring-1 focus:ring-[var(--primary-color)]"
                    rows="4"
                    placeholder="Short description...">{{ old('description') }}</textarea>

                @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.amenities.index') }}"
                   class="px-5 py-2 border rounded-lg hover:bg-gray-100">
                    Cancel
                </a>

                <button type="button" id="saveAmenity"
                    class="btn-primary px-5 py-2 rounded-lg shadow">
                    Save Amenity
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('saveAmenity').addEventListener('click', function () {
    Swal.fire({
        title: "Save Amenity?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Save",
        cancelButtonText: "Cancel",
        buttonsStyling: false,
        customClass: {
            confirmButton: "swal-confirm-btn",
            cancelButton: "swal-cancel-btn"
        }
    }).then((res)=>{
        if(res.isConfirmed){
            document.getElementById('amenity-form').submit();
        }
    });
});
</script>
@endpush
