<nav>
    <div class="uplnehore">
        <div class="company">
            <img src="{{asset('image/logo.svg')}}" alt="Company Logo" class="company-logo">
            <p class="company-name">Smoke</p>
        </div>
        
        <form action="{{ route('store') }}" method="GET" class="header-search-form">
            <input type="text" name="search" placeholder="Search games..." class="header-search-input" value="{{ request('search') }}">
            <button type="submit" class="header-search-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </form>
        
        <div class="discordLink">
            <p class="vedlabuttontxt">If you have any questions, come and ask them here</p>
            <a href="https://sk.wikipedia.org/wiki/Balada" class="link">
                <button type="button" class="button">
                    <span class="buttontxt">Comunity</span>
                    <svg class="dslogo" width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.2112 1.43874C14.1185 0.927171 12.9469 0.550269 11.7218 0.334402C11.6995 0.330235 11.6772 0.340647 11.6657 0.36147C11.5151 0.634947 11.3482 0.99172 11.2313 1.27214C9.91365 1.07086 8.6028 1.07086 7.31221 1.27214C7.1953 0.985487 7.02233 0.634947 6.87097 0.36147C6.85947 0.341342 6.83719 0.33093 6.81488 0.334402C5.59051 0.549579 4.41885 0.926481 3.32556 1.43874C3.3161 1.4429 3.30798 1.44985 3.3026 1.45887C1.08021 4.84685 0.471401 8.15155 0.770061 11.4153C0.771412 11.4312 0.780196 11.4465 0.792359 11.4562C2.25863 12.555 3.67896 13.2221 5.07292 13.6642C5.09523 13.6711 5.11887 13.6628 5.13307 13.6441C5.46281 13.1846 5.75674 12.7001 6.00876 12.1906C6.02364 12.1608 6.00944 12.1254 5.97904 12.1136C5.51281 11.9331 5.06887 11.713 4.64182 11.4632C4.60805 11.443 4.60534 11.3937 4.63642 11.3701C4.72628 11.3014 4.81617 11.2299 4.90198 11.1577C4.91751 11.1446 4.93914 11.1418 4.95739 11.1501C7.76289 12.4571 10.8002 12.4571 13.5726 11.1501C13.5908 11.1411 13.6124 11.1439 13.6286 11.1571C13.7145 11.2292 13.8043 11.3014 13.8949 11.3701C13.926 11.3937 13.9239 11.443 13.8902 11.4632C13.4631 11.7179 13.0192 11.9331 12.5523 12.1129C12.5219 12.1247 12.5083 12.1608 12.5232 12.1906C12.7806 12.6994 13.0746 13.1839 13.3982 13.6434C13.4118 13.6628 13.4361 13.6711 13.4584 13.6642C14.8591 13.2221 16.2794 12.555 17.7457 11.4562C17.7585 11.4465 17.7667 11.4319 17.768 11.416C18.1254 7.64274 17.1693 4.36514 15.2334 1.45956C15.2287 1.44985 15.2206 1.4429 15.2112 1.43874ZM6.42772 9.42801C5.58307 9.42801 4.88711 8.63673 4.88711 7.66496C4.88711 6.69319 5.56958 5.90191 6.42772 5.90191C7.2926 5.90191 7.98183 6.70014 7.96831 7.66496C7.96831 8.63673 7.28584 9.42801 6.42772 9.42801ZM12.1239 9.42801C11.2792 9.42801 10.5833 8.63673 10.5833 7.66496C10.5833 6.69319 11.2657 5.90191 12.1239 5.90191C12.9888 5.90191 13.678 6.70014 13.6645 7.66496C13.6645 8.63673 12.9888 9.42801 12.1239 9.42801Z" fill="#5865F2"/>
                    </svg>
                </button>
            </a>
        </div>
    </div>

    <div class="nav">
        <a href={{route('home')}}>Home</a>
        <div class="dropdown">
            <a href="#">Trending</a>
            <div class="dropdown-content">
                <a href="#">Project Zomboid</a>
                <a href="#">Player Unknown Battlegrounds</a>
                <a href="#">Ready Or Not</a>
                <a href="#">Lethal Company</a>
            </div>
        </div>
        <a href="{{ route('library') }}">Library</a>
        <a href="{{ route('store') }}">Store</a>
        <a href="{{ route('qa') }}">Q&A</a>
        
        <div class="dropdown">
            <button class="dropbtn">
                @if(Auth::check())
                    {{ Auth::user()->name }}
                @else
                    Sign In
                @endif
            </button>
            <div class="dropdown-content">
                @if(Auth::check())
                    <a href="{{ route('profile') }}">Profile</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="dropbtn" style="width: 100%; text-align: left;">Sign Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>