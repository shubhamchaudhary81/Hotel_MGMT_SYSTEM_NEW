<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">

    {{-- Header --}}
    <div class="flex justify-between items-center px-5 py-4 bg-gray-50 border-b">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ $title }}
        </h2>

        @isset($action)
            {!! $action !!}
        @endisset
    </div>

    {{-- Filters --}}
    @isset($filters)
        <div class="px-5 py-3 bg-gray-100 border-b">
            {!! $filters !!}
        </div>
    @endisset

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-[#f9f6f2] text-gray-700">
                <tr>
                    @foreach ($columns as $column)
                        <th class="px-4 py-3 text-left font-semibold border-b">
                            {{ $column }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            {{-- Rows inserted from parent --}}
            <tbody class="divide-y">
                {{ $slot }}
            </tbody>
        </table>
    </div>

</div>
