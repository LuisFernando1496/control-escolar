 {{-- bottom-0 inset-x-0 --}}
<div class="
    fixed  top-0 right-0 
    px-10
    mt-6 mx-6 py-4 sm:py-5 rounded-lg pointer-events-auto 
    z-10
    {{ $alertTypeClasses[$alertType] }}" role="alert" x-data=" { show : false}"
    @toast-message-show.window="show = true; setTimeout(() => show = false, 5000);" x-show="show" x-cloak>
    <p class="font-bold">{{ $title }}</p>
    {{ $message }}
</div>
