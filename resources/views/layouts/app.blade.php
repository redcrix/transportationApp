@include('shared/header');
@include('shared/sidebar');
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
    <!-- /.content-header -->

        <main class="py-4">
            @yield('content')
        </main>
   @include('shared/footer');