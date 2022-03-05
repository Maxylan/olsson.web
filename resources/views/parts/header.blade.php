<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta httpequiv="X-UA-Compatible" content="ie=edge">
    <!-- Use optional header until I figure this one out. -->
    <title>{{ $title }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c56f5ee86e.js" crossorigin="anonymous"></script>
    <style>
        .dynamic-background {
            background: no-repeat center/100% url("{{ $backgroundImagePath }}");
        }
    </style>
    @livewireStyles
</head>