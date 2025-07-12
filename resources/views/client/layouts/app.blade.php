<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog cá nhân')</title>
    @yield('head')
    @stack('styles')
</head>
<body>
<!-- header -->
@include("clients.layouts.header")
<!-- end header -->

<!-- navbar -->
@include("clients.layouts.navbar")
<!-- end navbar -->

<!-- Main Sidebar Container -->
@include("clients.layouts.sidebar")

<!-- Content Wrapper. Contains page content -->
@yield("content")

<!-- Footer -->
@include("client.layouts.footer")

<!-- Page specific script -->
@stack("scripts")
</body>
</html>