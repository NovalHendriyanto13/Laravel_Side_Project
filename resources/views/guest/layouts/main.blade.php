<!DOCTYPE html>
<html lang="en">

<head>
    @include('guest.layouts.header')
</head>

<body class="index-page">
    @include('guest.layouts.nav')
    <main class="main">
        @yield('content')  
    </main>

  @include('guest.layouts.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
  @include('guest.layouts.scripts')

</body>

</html>