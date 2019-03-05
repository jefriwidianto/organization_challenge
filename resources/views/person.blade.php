<html lang="en">
<head>
    <title>Person</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

</head>
      <body>
      <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Printerous') }}
                    </a>
                    @auth
                    <ul class="nav navbar-nav navbar-left">
                        <li><a class="navbar-nav" href="{{ route('organization') }}">Organization</a></li>
                        <li><a class="navbar-nav" href="{{ route('register') }}">Person</a></li>
                    </ul>
                    @endauth
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
      </div>
         <div class="container">
            <div class="row">
               <div class="col-xl-10">

               @if ( Auth::user()->jabatan == 1 )
                  <a href="{{ route('create_person') }}" class="btn btn-primary">Create New Person</a><br /><br />
               @endif

               @if (session('success'))
                  <div class="alert alert-success">
                    {!! session('success') !!}
                  </div>
               @endif

                  <div class="panel panel-default">
                      <div class="panel-heading">List Person</div>

                  <div class="panel-body">
                  <table class="table table-bordered" id="table">
                     <thead>
                        <tr>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Phone</th>
                           <th>Organization</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                  </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
  


       <script>
         $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ route('person/display_data') }}',
               columns: [
                        { data: 'name', name: 'person.name' },
                        { data: 'email', name: 'person.email' },
                        { data: 'phone_person', name: 'person.phone' },
                        { data: 'name_orgz', name: 'name' },
                        { data: 'action', name: 'action' }
                     ]
            });
         });
         </script>
         <script src="{{ asset('js/sweetalert.min.js') }}"></script>
@include('sweet::alert')
    </body>
</html>
