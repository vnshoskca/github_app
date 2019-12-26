
<html>
    <head>
        <title>Laravel | @yield('title','Home')</title>
    </head>
    <body>
      @section('sidebar')
        <p>メインのサイドバー(共通部分)</p>
      @show

      <div id='countainer'>
        @yield('content')
      </div>

      @section('footer')
        <script src="app.js"></script>
      @show
    </body>
</html>
