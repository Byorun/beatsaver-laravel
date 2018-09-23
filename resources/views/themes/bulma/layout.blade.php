<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="has-navbar-fixed-top">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@yield('og-meta')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.7.1/css/bulma.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Navbar Burger Styles -->
    <style>a.navbar-burger { color: white; } a.navbar-burger:hover { color: rgb(220, 220, 220); }</style>

    <title>Beat Saver @yield('title')</title>
</head>
<body>

<!-- Fixed navbar -->
<nav class="navbar has-shadow is-dark is-fixed-top">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('home') }}"><img src="{{ asset('/themes/default/img/beat_saver_logo_white.png') }}"></a>

            <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-menu" id="navMenu">
            @include('themes.default.nav')
        </div>
    </div>
</nav>

<div class="container" style="padding: 0 15px">
    <hr>
    @if($errors->isNotEmpty())
        <article class="message is-danger">
            <div class="message-body">
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        </article>
    @endif
    @if(session('status-error'))
        <article class="message is-danger">
            <div class="message-body">
                {{ session('status-error') }}
            </div>
        </article>
    @endif
    @if(session('status-warning'))
        <article class="message is-warning">
            <div class="message-body">
                {{ session('status-warning') }}
            </div>
        </article>
    @endif
    @if(session('status-success'))
        <article class="message is-success">
            <div class="message-body">
                {{ session('status-success') }}
            </div>
        </article>
    @endif
    
    @yield('content')
    <hr>
</div> <!-- /container -->
<footer style="margin-bottom: 25px;">
    <div class="content has-text-centered">
        <b><a href="{{ route('legal.dmca') }}">DMCA Copyright Form</a> || <a href="{{ route('legal.privacy') }}">Privacy</a> || <a href="{{ config('beatsaver.githubUrl') }}">GitHub</a></b>
    </div>
    @if( App::environment() == 'production' && config('beatsaver.tracking'))
        <script type="text/javascript">
            var _paq = _paq || [];
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            _paq.push(['setRequestMethod', 'POST']);
            _paq.push(["setRequestMethod", "POST"]);
            (function () {
                var u = "//beatsaver.com/track/";
                _paq.push(['setRequestMethod', 'POST']);
                _paq.push(['setTrackerUrl', u + 'console.php']);
                _paq.push(['setSiteId', '1']);
                var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
                g.type = 'text/javascript';
                g.async = true;
                g.defer = true;
                g.src = u + 'console.js';
                s.parentNode.insertBefore(g, s);
            })();
        </script>
    @endif
</footer>

<script>
    const burgers = document.getElementsByClassName('navbar-burger')

    for (const burger of burgers) {
        burger.addEventListener('click', () => {
            const target = document.getElementById(burger.dataset.target)

            burger.classList.toggle('is-active')
            target.classList.toggle('is-active')
        })
    }
</script>

</body>
</html>