<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
<link rel="stylesheet" href="{{asset('bootstrap/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap/font-awesome.min.css')}}">
@yield('css');
</head>
<body style="background-color: #dddddd">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top ">
        <a class="navbar-brand" href="#">TeleShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse  " id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item {{request()->is('dashboard') ? 'active':''}}">
            <a class="nav-link" href="{{route('dashboard')}}">Dashboard </a>
            </li>

            <li class="nav-item {{request()->is('dashboard/product*') ? 'active':''}}">
            <a class="nav-link" href="{{route('product.index')}}">Products</a>
            </li>

            <li class="nav-item {{request()->is('dashboard/settings*') ? 'active':''}}">
              <a class="nav-link" href="{{route('settings.edit')}}">Settings</a>
              </li>

            @if(Auth::user()->role == 0)
            <li class="nav-item  {{request()->is('dashboard/company*') ? 'active':''}}">
              <a class="nav-link" href="{{route('company.index')}}">Companies</a>
            </li>
            <li class="nav-item  {{request()->is('dashboard/user*') ? 'active':''}}">
              <a class="nav-link" href="{{route('user.index')}}">Users</a>
            </li>
            @endif
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                    </a>
    
                    <a class="dropdown-item" href="#">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>
                  
                </div>
              </li>
          </ul>
        </div>
        
      </nav>
      <div class="container">
        <div class="row" style="margin-top: 65px">
            <div class="col-sm-12 pb-5">
              @yield('content')  
            </div >    
        </div>    
    </div> 
    

<script src="{{asset('bootstrap/jquery.min.js')}}"></script>

<script src="{{asset('bootstrap/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/bootstrap.min.js')}}"></script>

@yield('script')
</body>
</html>