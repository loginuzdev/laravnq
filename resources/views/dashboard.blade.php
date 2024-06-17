<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <link rel="icon" type="image/svg+xml" href="{{URL::asset("favicon.svg")}}">
    <link rel="icon" type="image/png" href="{{URL::asset("favicon.png")}}">
</head>
<body x-data="__states({{Auth::user()}}, `{{URL::route("landing")}}`)" x-cloak
      class="text-slate-200 bg-gradient-to-t from-zinc-900 via-zinc-900 to-zinc-800 w-full h-screen flex flex-col justify-between">
<div class="flex  w-full">
    <aside class="min-w-14 min-h-screen bg-slate-800 flex flex-col items-center justify-center px-4 max-w-14 gap-4">
        <div>
            <a href="{{URL::route("landing")}}" class="hover:text-sky-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                </svg>

            </a>
        </div>
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
    </aside>
    <div class="w-full pb-8">

        <div class="w-full flex gap-4 items-center justify-center py-4">
            <button x-on:click="current_page--;" :class="current_page == 1 ?'collapse':''" type="button"
                    class="rounded border hover:bg-sky-500 hover:border-sky-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                          d="M9.78 4.22a.75.75 0 0 1 0 1.06L7.06 8l2.72 2.72a.75.75 0 1 1-1.06 1.06L5.47 8.53a.75.75 0 0 1 0-1.06l3.25-3.25a.75.75 0 0 1 1.06 0Z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
            <select class="rounded border bg-zinc-800 px-2 ring-0 outline-none py-0.5 hover:border-sky-500"
                    x-model="current_page">
                <template x-for="s in pages">
                    <option x-text="s" :value="s"
                            :selected="s == current_page"
                    ></option>
                </template>
            </select>
            <button x-on:click="current_page++;" :class="current_page == pages.length ?'collapse':''" type="button"
                    class="rounded border hover:bg-sky-500 hover:border-sky-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                          d="M6.22 4.22a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06L8.94 8 6.22 5.28a.75.75 0 0 1 0-1.06Z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="px-2 w-full">


            <div class="rounded-lg border overflow-hidden">
                <table class="table-fixed w-full text-sm bg-zinc-800 px-12 shadow shadow-zinc-600">
                    <thead>
                    <tr>
                        <th class="py-2.5 text-left px-4 w-12">_</th>
                        <th class="py-2.5 text-center px-4 w-20">#</th>
                        <th class="py-2.5 text-center">Quote</th>
                        <th class="py-2.5 text-center w-16">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template x-for="(row,i) in rows">
                        <tr class="group">
                            <td class="group-hover:bg-slate-800 border-y border-y-slate-700 py-2 px-4 font-mono font-light italic"
                                x-text="i+1"></td>
                            <td class="group-hover:bg-slate-800 border-y border-y-slate-700 py-2 px-4">
                                <a :href="`https://vndb.org/v${row.vn_id}`"
                                   class="font-semibold text-xs hover:underline rounded-full bg-sky-500 px-2 py-0.5 text-white"
                                   x-text="`/v${row.vn_id}`"></a>
                            </td>
                            <td class="group-hover:bg-slate-800 border-y border-y-slate-700 py-2 px-4 font-mono font-light italic"
                            >
                                <p x-text="row.quote" class="truncate overflow-hidden"></p>
                            </td>
                            <td class="group-hover:bg-slate-800 border-y border-y-slate-700 py-2 px-4">
                                <div class="flex items-center justify-center gap-4">
                                    <div>
                                        <button type="button" x-on:click="alert(`Not yet implemented.`)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <div>
                                        <button type="button" x-on:click="alert(`Not yet implemented.`)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="error.length > 0">
                        <td colspan="4"
                            class="text-center text-red-500 hover:underline select-none border-y border-y-slate-700 py-2 px-4 font-mono font-light italic"
                            x-text="error"></td>
                    </tr>
                    <tr x-show="is_loading">
                        <td colspan="4"
                            class="text-center text-red-500 hover:underline select-none border-y border-y-slate-700 py-2 px-4 font-mono font-light italic">
                            <div class="flex items-center justify-center py-2">
                                <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="uppercase font-semibold text-xs select-none py-4 px-4 text-slate-600" colspan="4"
                            x-text="`Viewing ${current_page} of ${pages.length} (${count} Total)`"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
@vite('resources/js/dashboard.js')

</html>
