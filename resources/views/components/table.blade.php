<div class="bg-white shadow-md rounded-lg overflow-hidden border border-[var(--table-border)]">

    {{-- Header --}}
    <div class="flex justify-between items-center px-5 py-4 bg-[var(--table-header-bg)] border-b border-[var(--table-border)]">
        <h2 class="text-xl font-semibold text-[var(--text-color)]">
            {{ $title }}
        </h2>

        @isset($action)
            {!! $action !!}
        @endisset
    </div>

    {{-- Filters --}}
    @isset($filters)
        <div class="px-5 py-3 bg-[var(--table-filter-bg)] border-b border-[var(--table-border)]">
            {!! $filters !!}
        </div>
    @endisset

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-[var(--table-header-bg)] text-[var(--text-color)]">
                <tr>
                    @foreach ($columns as $column)
                        <th class="px-4 py-3 text-left font-semibold border-b border-[var(--table-border)]">
                            {{ $column }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            {{-- Rows inserted from parent --}}
            <tbody class="divide-y divide-[var(--table-border)]">
                {{ $slot }}
            </tbody>
        </table>
    </div>

</div>
