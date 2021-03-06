<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
    <div class="container">
        <!-- logo -->
        <a class="navbar-brand" href="{{ url('/') }}">UE4小论坛</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- 导航左侧 -->
            @include('layouts._nav_list')

            <!-- 导航右侧 -->
            <ul class="navbar-nav navbar-right">
            @guest
                <!-- 登录 -->
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
            @else
                <li class="nav-item">
                    <a class="nav-link mt-1 mr-3 font-weight-bold" href="{{ route('topics.create') }}">
                    <i class="fa fa-plus"></i>
                    </a>
                </li>

                <!-- 未读消息数 -->
                <li class="nav-item notification-badge">
                    <a class="nav-link mr-3 badge badge-pill badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'secondary' }} text-white" href="{{ route('notifications.index') }}">
                    {{ Auth::user()->notification_count }}
                    </a>
                </li>

                <li class="nav-item dropdown"> 
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px" alt=""> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @can('manage_contents')
                        <a class="dropdown-item" href="{{ url(config('administrator.uri')) }}"><i class="fas fa-tachometer-alt mr-2"></i>管理后台</a>
                        <div class="dropdown-divider"></div>
                    @endcan
                        <a class="dropdown-item" href="{{ route('users.show', Auth::id())}}"><i class="far fa-user mr-2"></i>个人中心</a>
                        <a class="dropdown-item" href="{{ route('users.edit', Auth::id())}}"><i class="far fa-edit mr-2"></i>编辑资料</a>
                        <div class="dropdwon-divider"></div>
                        <a class="dropdown-item" id="logout" href="">
                            <form method="post" action="{{ route('logout') }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-block btn-danger" name="button">退出</button>
                            </form>
                        </a>
                    </div>
                </li>
            @endguest
            </ul>
        </div>
    </div>
</nav>