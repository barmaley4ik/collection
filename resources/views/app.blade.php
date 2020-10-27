<!DOCTYPE html>
<html class="h-full bg-gray-200">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=smoothscroll,NodeList.prototype.forEach,Promise,Object.values,Object.assign" defer></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=String.prototype.startsWith" defer></script>
    <script>
        window.langs = @json(Helpme::languages());
        window.deflocale = @json(Helpme::defaultLanguage());
    </script> 
    <script src="{{ asset('node_modules/tinymce/tinymce.min.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @routes
</head>
<body class="font-sans leading-none text-gray-700 antialiased">

@inertia

</body>
</html>
