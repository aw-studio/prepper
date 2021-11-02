@php
$html = null;
if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot")){
    try {
        $html = Http::post('http://localhost:8080/render?url='.request()->fullUrl());
    } catch (Exception $e) {
        $html = null;
    }
}
@endphp

@if ($html)
    {!! $html !!}
@else
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ mix('/js/app.js') }}" defer></script>
    </head>
    <body>
        @inertia
    </body>
</html>
@endif