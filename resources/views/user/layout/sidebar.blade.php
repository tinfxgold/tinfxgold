<nav class="nav-bar">
    <div class="hamburger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
    <a href="{{ route('home') }}" class="nav-branding">TinFXGold</a>


    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Lịch kinh tế</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('complain') }}" class="nav-link">Khiếu nại</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('brokers') }}" class="nav-link">Brokers</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('brokers', ['hero' => 'hero']) }}" class="nav-link">Hero Brokers</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('blogs') }}" class="nav-link">Bài viết</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Hoạt động</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('video') }}" class="nav-link">Video</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Gold ETF</a>
        </li>
        @auth
                <li class="dropdown w-100">
                    <button class="w-100 btn btn-secondary dropdown-toggle d-flex flex-column align-items-center"
                        type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="comment-replay-avatar-box">
                            <img src="https://static.vecteezy.com/system/resources/previews/026/966/960/non_2x/default-avatar-profile-icon-of-social-media-user-vector.jpg"
                                alt="">
                        </div>
                        Tài Khoản
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <a class="dropdown-item" href="{{ route('updateInfo') }}">Thông tin người dùng</a>
                        <a class="dropdown-item" href="#">Bài đăng</a>
                        <a class="dropdown-item" href="#">Tạo bài đăng</a>
                    </div>
                </li>
            <li class="nav-item bg-danger w-100 p-2 text-center">
                <a href="{{ route('login') }}">
                    Đăng Xuất
                </a>
            </li>
        @else
            <li class="nav-item w-100 p-2 bg-primary text-center">
                <a href="{{ route('login') }}">
                    Đăng Nhập
                </a>
            </li>
        @endauth
    </ul>
</nav>
