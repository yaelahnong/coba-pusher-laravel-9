@section('head-tag')
@vite(['resources/css/chat.css'])
@endsection

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Chat') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex space-x-5 chat-height overflow-hidden relative rtl:space-x-reverse">
        <div class="flex-none min-w-[260px]">
          <div class="card rounded-md bg-white dark:bg-slate-800 lg:h-full  shadow-base">
            <div class="card-body flex flex-col relative p-0 h-full overflow-hidden">
              <div class="card-text h-full">
                <div class="border-b border-slate-100 dark:border-slate-700 pb-4">
                  <div>
                    <header>
                      <div class="flex px-6 pt-6">
                        <div class="flex-1">
                          <div class="flex space-x-3 rtl:space-x-reverse">
                            <div class="flex-none">
                              <div class="h-10 w-10 rounded-full"><img src="http://localhost:8000/uploader/kandidat/1-1-small.jpeg" alt="" class="w-full h-full object-cover rounded-full"></div>
                            </div>
                            <div class="flex-1 text-start"><span class="block text-slate-800 dark:text-slate-300 text-sm font-medium mb-[2px]">{{ auth()->user()->name }} <span class="status bg-success-500 inline-block h-[10px] w-[10px] rounded-full ml-3"></span></span><span class="block text-slate-500 dark:text-slate-300 text-xs font-normal">Available</span></div>
                          </div>
                        </div>
                        <div class="flex-none"><span distance="1rem"><button class="inline-block">
                              <div class="h-8 w-8 bg-slate-100 dark:bg-slate-900 dark:text-slate-400 flex flex-col justify-center items-center text-xl rounded-full cursor-pointer"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z"></path>
                                  </svg></span></div>
                            </button></span></div>
                      </div>
                    </header>
                  </div>
                </div>
                <div class="border-b border-slate-100 dark:border-slate-700 py-1">
                  <div class="search px-3 mx-6 rounded flex items-center space-x-3 rtl:space-x-reverse">
                    <div class="flex-none text-base text-slate-900 dark:text-slate-400"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" class="iconify iconify--bytesize">
                          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <circle cx="14" cy="14" r="12"></circle>
                            <path d="m23 23l7 7"></path>
                          </g>
                        </svg></span></div><input placeholder="Search..." class="w-full flex-1 block bg-transparent placeholder:font-normal placeholder:text-slate-400 py-2 focus:ring-0 focus:outline-none dark:text-slate-200 dark:placeholder:text-slate-400">
                  </div>
                </div>
                <div class="contact-height" data-simplebar="init">
                  <div class="simplebar-wrapper" style="margin: 0px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                      <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                      <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                          <div class="simplebar-content" style="padding: 0px;">
                            <div class="divide-y divide-slate-100 dark:divide-slate-700">
                              @foreach ($roomList as $row)
                              <a href="{{ route('chat.show', $row['room_id']) }}" class="block w-full py-5 focus:ring-0 outline-none cursor-pointer group transition-all duration-150 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:bg-opacity-70">
                                <div class="flex space-x-3 px-6 rtl:space-x-reverse">
                                  <div class="flex-none">
                                    <div class="h-10 w-10 rounded-full relative"><span class="bg-secondary-500 status ring-1 ring-white inline-block h-[10px] w-[10px] rounded-full absolute -right-0 top-0"></span><img src="{{ uploader($row['foto']) }}" alt="" class="block w-full h-full object-cover rounded-full"></div>
                                  </div>
                                  <div class="flex-1 text-start flex">
                                    <div class="flex-1"><span class="block text-slate-800 dark:text-slate-300 text-sm font-medium mb-[2px]">{{ $row['nama'] }}</span><span class="block text-slate-600 dark:text-slate-300 text-xs font-normal">{{ $row['pesan_terbaru'] }}</span></div>
                                    <div class="flex-none ltr:text-right rtl:text-end"><span class="block text-xs text-slate-400 dark:text-slate-400 font-normal">{{ $row['pesan_updated_at'] }}</span></div>
                                  </div>
                                </div>
                              </a>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: auto; height: 404px;"></div>
                  </div>
                  <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                  </div>
                  <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                    <div class="simplebar-scrollbar" style="height: 25px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @if (request()->routeIs('chat.index'))
        <div class="flex-1">
          <div class="parent flex space-x-5 h-full rtl:space-x-reverse">
            <div class="flex-1">
              <div class="card rounded-md bg-white dark:bg-slate-800 lg:h-full  shadow-base h-full">
                <div class="card-body flex flex-col p-0 h-full">
                  <div class="card-text h-full">
                    <div class="h-full flex flex-col items-center justify-center xl:space-y-2 space-y-6">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="80" height="80">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M6.455 19L2 22.5V4a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H6.455zm-.692-2H20V5H4v13.385L5.763 17zM11 10h2v2h-2v-2zm-4 0h2v2H7v-2zm8 0h2v2h-2v-2z" />
                      </svg>
                      <h4 class="text-2xl text-slate-600 dark:text-slate-300 font-medium"> Contributor Chat </h4>
                      <p class="text-sm text-slate-500 lg:pt-0 pt-4"><span> Kirim pesan ke sesama kontributor</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @if (request()->routeIs('chat.show'))
        <div class="flex-1" data-v-ebbfe379="">
          <div class="parent flex space-x-5 h-full rtl:space-x-reverse" data-v-ebbfe379="">
            <div class="flex-1" data-v-ebbfe379="">
              <div class="card rounded-md bg-white dark:bg-slate-800 lg:h-full  shadow-base h-full" data-v-cda99232="">
                <div class="card-body flex flex-col p-0 h-full" data-v-cda99232="">
                  <div class="card-text h-full" data-v-cda99232="">
                    <div class="h-full" data-v-ebbfe379="">
                      <header class="border-b border-slate-100 dark:border-slate-700">
                        <div class="flex py-6 md:px-6 px-3 items-center">
                          <div class="flex-1">
                            <div class="flex space-x-3 rtl:space-x-reverse">
                              <div class="flex-none">
                                <div class="h-10 w-10 rounded-full relative"><span class="bg-secondary-500 status ring-1 ring-white inline-block h-[10px] w-[10px] rounded-full absolute -right-0 top-0"></span><img src="http://localhost:8000/uploader/kandidat/1-1-small.jpeg" alt="" class="w-full h-full object-cover rounded-full"></div>
                              </div>
                              <div class="flex-1 text-start"><span class="block text-slate-800 dark:text-slate-300 text-sm font-medium mb-[2px] truncate">{{ $activeRoom['nama'] }}</span>
                              <!-- <span class="block text-slate-500 dark:text-slate-300 text-xs font-normal">Active now</span> -->
                            </div>
                            </div>
                          </div>
                          <div class="flex-none flex md:space-x-3 space-x-1 items-center rtl:space-x-reverse">
                            <div class="msg-action-btn"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline">
                                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z"></path>
                                </svg></span></div>
                          </div>
                        </div>
                      </header>
                      <div class="chat-content parent-height">
                        <div id="messageList" class="msgs overflow-y-auto msg-height pt-6 space-y-6">
                         
                        </div>
                      </div>
                      <footer class="md:px-6 px-4 sm:flex md:space-x-4 sm:space-x-2 rtl:space-x-reverse border-t md:pt-6 pt-4 border-slate-100 dark:border-slate-700">
                        <div class="flex-none sm:flex hidden md:space-x-3 space-x-1 rtl:space-x-reverse">
                          <div class="h-8 w-8 cursor-pointer bg-slate-100 dark:bg-slate-900 dark:text-slate-400 flex flex-col justify-center items-center text-xl rounded-full"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 0 0-5.656 0l-4 4a4 4 0 1 0 5.656 5.656l1.102-1.101m-.758-4.899a4 4 0 0 0 5.656 0l4-4a4 4 0 0 0-5.656-5.656l-1.1 1.1"></path>
                              </svg></span></div>
                          <div class="h-8 w-8 cursor-pointer bg-slate-100 dark:bg-slate-900 dark:text-slate-400 flex flex-col justify-center items-center text-xl rounded-full"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 0 1-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 1 1-18 0a9 9 0 0 1 18 0Z"></path>
                              </svg></span></div>
                        </div>
                        <form method="POST" action="{{ route('chat.store', $activeRoom['room_id']) }}" class="flex-1 relative flex space-x-3 rtl:space-x-reverse">
                          @csrf
                          <div class="flex-1"><textarea name="pesan" type="text" placeholder="Type your message..." class="focus:ring-0 focus:outline-0 block w-full bg-transparent border-0 resize-none"></textarea></div>
                          <div class="flex-none md:pr-0 pr-3"><button type="submit" class="h-8 w-8 bg-slate-900 text-white flex flex-col justify-center items-center text-lg rounded-full"><span class="transform rotate-[60deg]"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline">
                                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m12 19l9 2l-9-18l-9 18l9-2Zm0 0v-8"></path>
                                </svg></span></button></div>
                        </form>
                      </footer>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="chat-info-height flex-none w-[285px]" data-v-ebbfe379="">
              <div class="card rounded-md bg-white dark:bg-slate-800 lg:h-full  shadow-base" data-v-cda99232="">
                <div class="card-body flex flex-col p-0 h-full" data-v-cda99232="">
                  <div class="card-text h-full" data-v-cda99232="">
                    <div class="h-full p-6" data-simplebar="init" data-v-ebbfe379="">
                      <div class="simplebar-wrapper" style="margin: -24px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                          <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                          <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                              <div class="simplebar-content" style="padding: 24px;">
                                <h4 class="text-xl text-slate-900 font-medium mb-8">About</h4>
                                <div class="h-[100px] w-[100px] rounded-full mx-auto mb-4"><img src="http://localhost:8000/uploader/kandidat/1-1-small.jpeg" alt="" class="block w-full h-full object-cover rounded-full"></div>
                                <div class="text-center">
                                  <h5 class="text-base text-slate-600 dark:text-slate-300 font-medium mb-1">{{ $activeRoom['nama'] }}</h5>
                                  <h6 class="text-xs text-slate-600 dark:text-slate-300 font-normal">Frontend Developer</h6>
                                </div>
                                <ul class="list-item mt-5 space-y-4 border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                  <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                      <span class="text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em" class="iconify iconify--heroicons-outline">
                                          <path fill="none" d="M0 0h24v24H0z" />
                                          <path d="M3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm17 4.238l-7.928 7.1L4 7.216V19h16V7.238zM4.511 5l7.55 6.662L19.502 5H4.511z" />
                                        </svg>
                                      </span>
                                      <span>Email</span>
                                    </div>
                                    <div class="font-medium">{{ $activeRoom['email'] }}</div>
                                  </li>
                                  <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                      <span class="text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em">
                                          <path fill="none" d="M0 0h24v24H0z" />
                                          <path d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                                        </svg>
                                      </span>
                                      <span>Contributors since</span>
                                    </div>
                                    <div class="font-medium">{{ date('M Y', strtotime($activeRoom['user_created_at'])) }}</div>
                                  </li>
                                  <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse"><span class="text-base"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline">
                                          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 0 1 6.412 9m6.088 9h7M11 21l5-10l5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                        </svg></span><span>Language</span></div>
                                    <div class="font-medium">English</div>
                                  </li>
                                </ul>
                                <ul class="list-item space-y-3 border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6 mt-5">
                                  <li class="text-sm text-slate-600 dark:text-slate-300 leading-[1]"><a aria-current="page" href="/app/chat#" class="router-link-active router-link-exact-active flex space-x-2 rtl:space-x-reverse"><span class="text-base"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16" class="iconify iconify--bi">
                                          <path fill="currentColor" d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131c.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                                        </svg></span><span class="capitalize font-normal text-slate-600 dark:text-slate-300">facebook</span></a></li>
                                  <li class="text-sm text-slate-600 dark:text-slate-300 leading-[1]"><a aria-current="page" href="/app/chat#" class="router-link-active router-link-exact-active flex space-x-2 rtl:space-x-reverse"><span class="text-base"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16" class="iconify iconify--bi">
                                          <path fill="currentColor" d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334c0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518a3.301 3.301 0 0 0 1.447-1.817a6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429a3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218a3.203 3.203 0 0 1-.865.115a3.23 3.23 0 0 1-.614-.057a3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                                        </svg></span><span class="capitalize font-normal text-slate-600 dark:text-slate-300">twitter</span></a></li>
                                  <li class="text-sm text-slate-600 dark:text-slate-300 leading-[1]"><a aria-current="page" href="/app/chat#" class="router-link-active router-link-exact-active flex space-x-2 rtl:space-x-reverse"><span class="text-base"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16" class="iconify iconify--bi">
                                          <path fill="currentColor" d="M8 0C5.829 0 5.556.01 4.703.048C3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7C.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297c.04.852.174 1.433.372 1.942c.205.526.478.972.923 1.417c.444.445.89.719 1.416.923c.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417c.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046c.78.035 1.204.166 1.486.275c.373.145.64.319.92.599c.28.28.453.546.598.92c.11.281.24.705.275 1.485c.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598c-.28.11-.704.24-1.485.276c-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598a2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485c-.038-.843-.046-1.096-.046-3.233c0-2.136.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486c.145-.373.319-.64.599-.92c.28-.28.546-.453.92-.598c.282-.11.705-.24 1.485-.276c.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92a.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217a4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334a2.667 2.667 0 0 1 0-5.334z"></path>
                                        </svg></span><span class="capitalize font-normal text-slate-600 dark:text-slate-300">instagram</span></a></li>
                                </ul>
                                <h4 class="py-4 text-sm text-secondary-500 dark:text-slate-300 font-normal"> Shared documents </h4>
                                <ul class="grid grid-cols-3 gap-2">
                                  <li class="h-[46px]"><img src="data:image/png;base64,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" alt="" class="w-full h-full object-cover rounded-[3px]"></li>
                                  <li class="h-[46px]"><img src="http://localhost:8000/uploader/kandidat/1-1-small.jpeg" alt="" class="w-full h-full object-cover rounded-[3px]"></li>
                                  <li class="h-[46px]"><img src="http://localhost:8000/uploader/kandidat/1-1-small.jpeg" alt="" class="w-full h-full object-cover rounded-[3px]"></li>
                                  <li class="h-[46px]"><img src="http://localhost:8000/uploader/kandidat/1-1-small.jpeg" alt="" class="w-full h-full object-cover rounded-[3px]"></li>
                                  <li class="h-[46px]"><img src="data:image/png;base64,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" alt="" class="w-full h-full object-cover rounded-[3px]"></li>
                                  <li class="h-[46px]"><img src="http://localhost:8000/uploader/kandidat/1-1-small.jpeg" alt="" class="w-full h-full object-cover rounded-[3px]"></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: auto; height: 654px;"></div>
                      </div>
                      <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                      </div>
                      <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                        <div class="simplebar-scrollbar" style="height: 365px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>

  @section('script-tag')
    @if (request()->routeIs('chat.show'))
      <script>
        window.pesan = <?php echo json_encode($messageList); ?>;
        window.roomId = <?php echo json_encode($activeRoom['room_id']); ?>;
        window.userInitial = <?php echo json_encode($currUser['initial']); ?>;
      </script>

      @vite(['resources/js/broadcasting.js'])
    @endif
  @endsection
</x-app-layout>