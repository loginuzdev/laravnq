<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="icon" type="image/svg+xml" href="{{URL::asset("favicon.svg")}}">
    <link rel="icon" type="image/png" href="{{URL::asset("favicon.png")}}">
    <title>Random Visual Novel Quote</title>
</head>
<body x-data="__states({{$quoteObject->toJson()}}, `{{URL::full()}}`)"
      class="bg-gradient-to-t from-zinc-900 via-zinc-900 to-zinc-800 w-full h-screen flex flex-col justify-between">
<div class="w-full p-4 flex items-center justify-between md:justify-around text-sky-700">
    <div class="text-lg font-semibold select-none">
        LaraVNQ
    </div>
    <div>
        @if(!Auth::user())
            <button x-on:click="modal_open = true;" class="hover:text-sky-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                          d="M8 1a3.5 3.5 0 0 0-3.5 3.5V7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7V4.5A3.5 3.5 0 0 0 8 1Zm2 6V4.5a2 2 0 1 0-4 0V7h4Z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
        @else
            <div class="flex items-center justify-center gap-2">

                <div>
                    <div>
                        <a href="{{URL::route("dashboard")}}" class="hover:text-sky-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <div>
                        <form action="{{URL::route("logout")}}" method="post">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9"/>
                                </svg>
                            </button>
                        </form>

                    </div>
                </div>


            </div>
        @endif
    </div>
</div>
<div class="w-full flex items-center justify-center">
    <div class="border-l-4 border-sky-800 italic my-8 pl-4 md:pl-8 py-4 mx-4 md:mx-10 max-w-md text-sky-50">
        <p class="font-mono text-lg font-medium" x-transition x-show="error.length == 0" x-text="quoteObject.quote"></p>
        <p class="font-mono text-lg font-medium text-red-500" x-show="error.length !== 0" x-transition
           x-text="error"></p>
        <div class="text-right mt-4 text-sky-800 flex items-center justify-between space-x-2">
            <div x-show="initMe" x-transition x-transition:enter.duration.500ms x-on:click="getNewOne"
                 class="hover:cursor-pointer transition-all">
                <svg :class="is_loading ? 'animate-spin text-sky-500':''" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 16 16" fill="currentColor"
                     class="size-5 hover:text-sky-500">
                    <path fill-rule="evenodd"
                          d="M13.836 2.477a.75.75 0 0 1 .75.75v3.182a.75.75 0 0 1-.75.75h-3.182a.75.75 0 0 1 0-1.5h1.37l-.84-.841a4.5 4.5 0 0 0-7.08.932.75.75 0 0 1-1.3-.75 6 6 0 0 1 9.44-1.242l.842.84V3.227a.75.75 0 0 1 .75-.75Zm-.911 7.5A.75.75 0 0 1 13.199 11a6 6 0 0 1-9.44 1.241l-.84-.84v1.371a.75.75 0 0 1-1.5 0V9.591a.75.75 0 0 1 .75-.75H5.35a.75.75 0 0 1 0 1.5H3.98l.841.841a4.5 4.5 0 0 0 7.08-.932.75.75 0 0 1 1.025-.273Z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
            <div></div>
            @if($quoteObject->vn_id != 696969)
                <div>
                    <a :href="quoteObject.vn_url" target="_blank"
                       class="text-sm underline select-none hover:text-sky-500" x-text="`v${quoteObject.vn_id}`"></a>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="text-xs w-full text-center py-4 text-sky-900 hover:text-sky-700 select-none">
    {{date("Y")}} • Adhe K
</div>

@include('modal.login_modal')

</body>
@vite('resources/js/app.js')
</html>
