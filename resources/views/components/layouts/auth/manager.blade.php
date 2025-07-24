


{{--<x-layouts.app.manager-sidebar :title="$title ?? null">--}}
{{--    <flux:main>--}}
{{--        {{ $slot }}--}}
{{--    </flux:main>--}}
{{--</x-layouts.app.manager-sidebar>--}}


<x-layouts.app.manager-sidebar :title="$title ?? null">
    <fulx:main>
        {{ $slot }}
    </fulx:main>
</x-layouts.app.manager-sidebar>
