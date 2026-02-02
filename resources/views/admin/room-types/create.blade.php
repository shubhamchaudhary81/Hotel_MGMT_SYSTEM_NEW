@extends('layouts.admin.app')
@section('title', 'Add Room Type | Admin Panel')

@section('contents')

    {{-- ERRORS --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow border border-gray-200 max-w-5xl mx-auto">

        {{-- HEADER --}}
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-semibold text-gray-800">Add Room Type</h2>

            <a href="{{ route('admin.room-types.index') }}"
               class="bg-[#6B4C2B] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#5a3f20] shadow">
                ← Back to Room Types
            </a>
        </div>

        {{-- FORM --}}
        <div class="p-6">
            <form id="room-type-form" method="POST" action="{{ route('admin.room-types.store') }}">
                @csrf

                {{-- NAME --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Room Type Name</label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Enter room type name"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#6B4C2B] focus:border-[#6B4C2B]"
                           required>
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description"
                              rows="4"
                              placeholder="Short description..."
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#6B4C2B] focus:border-[#6B4C2B]">{{ old('description') }}</textarea>
                </div>

                {{-- BUTTONS --}}
                <div class="flex justify-end gap-3 mt-6">

                    {{-- BACK --}}
                    <a href="{{ route('admin.room-types.index') }}"
                       class="px-5 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        Cancel
                    </a>

                    {{-- SAVE --}}
                    <button type="button"
                            id="saveRoomType"
                            class="bg-[#6B4C2B] text-white px-5 py-2 rounded-lg hover:bg-[#5a3f20] shadow">
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
