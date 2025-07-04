<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.header')
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        @yield('auth', $title)
    </div>
    @include('admin.layouts.scripts')
</body>

</html>