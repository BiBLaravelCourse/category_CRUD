<!-- Nav Code -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-sm">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(request()->url() == route('home')) active @endif" aria-current="page" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->url() == route('posts.index')) active @endif" href="{{route('posts.index')}}">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->url() == route('categories.index')) active @endif" href="{{route('categories.index')}}">Categories</a>
                </li>
            </ul>

            <!-- Right-Side Nav -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                @if(Auth::check())
                <li class="nav-item">
                    <a class="nav-link @if(request()->url() == route('posts.create')) active @endif" href="{{route('posts.create')}}">Create A Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->url() == route('my-posts.index')) active @endif" href="{{route('my-posts.index')}}">My Post</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link fw-bold dropdown-toggle @if(request()->url() == route('profile',Auth::id())) active @endif" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                        <img src="/storage/images/profile_avater_small.png" class="img-fluid ms-1" style="width:32px; height:32px;" alt="Profile Avater">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('profile', Auth::id() )}}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{route('logout')}}" method="POST" onclick="return confirm('Logout Your Account! Are you sure?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                            
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login.create')}}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register.create')}}">Register</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>