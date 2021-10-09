<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=385, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user.css') }}">
    @yield('meta')
    <title>Schedule | POSSE</title>
</head>

<body>
    <header class="h-16 bg-white">
        <div class="flex justify-between items-center w-full h-full mx-auto pl-2 pr-5">
            <div class="h-full">
                <a href="/"><img src="/img/header-logo.png" alt="" class="h-full"></a>
            </div>
            <div>
                @if ((Auth::user()->role_id)==2)
                <a href="{{route('list_event')}}"
                class="text-white bg-blue-400 px-4 py-2 rounded-3xl bg-gradient-to-r from-blue-600 to-blue-200">管理画面へ</a>
                @endif
                <a href="{{route('logout')}}"
                    class="text-white bg-blue-400 px-4 py-2 rounded-3xl bg-gradient-to-r from-blue-600 to-blue-200" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">ログアウト</a>
            </div>
        </div>
        @yield('who_are_you')
    </header>

    <main class="bg-gray-100 h-screen">
        <div class="w-full mx-auto p-5">
            @yield('filter')
            <div id="events-list">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-sm font-bold">一覧</h2>
                </div>
                @yield('event_list')
            </div>
    </main>
    {{-- モーダルエリア --}}
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-black opacity-80"></div>

        <div class="modal-container absolute bottom-0 bg-white w-screen h-4/5 rounded-t-3xl shadow-lg z-50">
            <div class="modal-content text-left py-6 pl-10 pr-6">
                <div class="z-50 text-right mb-5">
                    <svg class="modal-close cursor-pointer inline bg-gray-100 p-1 rounded-full"
                        xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>

                <div id="modalInner"></div>

            </div>
        </div>
    </div>                                    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{asset('/js/main.js')}}"></script>
</body>

</html>
