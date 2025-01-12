<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @routes
    {{-- vite指令：插入一个文件链接，指向resources/js/app.js --}}
    @vite('resources/js/app.js')
    {{-- inertia指令：将添加指向inertia所需的所有内容 --}}
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>
