@extends('app')
@section('head')
{{ $head }}
@endsection
@section('content')
<x-layouts.navbar />
<div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

    <x-layouts.sidebar />

    <div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop">

    </div>
    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
            {{ $slot }}
        </main>
        <x-layouts.footer />
    </div>
</div>
@endsection

@section('js')

{{ $js }}
@endsection


