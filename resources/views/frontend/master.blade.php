
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Evara - @yield('title')</title>
    @include('frontend.includes.meta')
   @include('frontend.includes.style')
</head>

<body>
@include('frontend.includes.header')
<main class="main">
 @yield('body')
</main>
@include('frontend.includes.footer')
<!-- Vendor JS-->
@include('frontend.includes.script')

</body>

</html>
