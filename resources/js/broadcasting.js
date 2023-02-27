import axios from 'axios';
window.axios = axios;

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
// window.Pusher = Pusher;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    authorizer: (channel, options) => {
        return {
            authorize: (socketId, callback) => {
                axios.post('/broadcasting/auth', {
                    socket_id: socketId,
                    channel_name: channel.name
                })
                .then(response => {
                    callback(false, response.data);
                })
                .catch(error => {
                    callback(true, error);
                });
            }
        };
    },
});

window.Echo.private('chat.'+window.userId)
.listen('PesanTerkirim', (e) => {
    console.log('successfully listen')
    if (window.inboxId === e.pesan.inbox_uid) {
        window.pesan.push(e.pesan)
    }
    renderMessageList();
    renderRoomList();
});

function renderRoomList(newNotification = 0) {
  let roomListContent = '';

  console.log('newnotification', newNotification);

  console.log('window roomlist', window.inbox)
  console.log('roomcontent', roomListContent)

  window.inbox.forEach((item) => {
    roomListContent += `
      <a href="${'/chat/'+item.inbox_uid}" class="block w-full py-5 focus:ring-0 outline-none cursor-pointer group transition-all duration-150 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:bg-opacity-70">
        <div class="flex space-x-3 px-6 rtl:space-x-reverse">
          <div class="flex-none">
            <div class="h-10 w-10 rounded-full relative"><span class="bg-secondary-500 status ring-1 ring-white inline-block h-[10px] w-[10px] rounded-full absolute -right-0 top-0"></span><img src="${uploader(item.foto)}" alt="" class="block w-full h-full object-cover rounded-full"></div>
          </div>
          <div class="flex-1 text-start flex">
            <div class="flex-1"><span class="block text-slate-800 dark:text-slate-300 text-sm font-medium mb-[2px]">${item.nama}</span><span class="block text-slate-600 dark:text-slate-300 text-xs font-normal">${newNotification === item.inbox_uid ? (`<b>${item.pesan_terbaru || ''}</b>`) : (item.pesan_terbaru || '')}</span></div>
            <div class="flex-none ltr:text-right rtl:text-end"><span class="block text-xs text-slate-400 dark:text-slate-400 font-normal">${item.pesan_updated_at}</span></div>
          </div>
        </div>
      </a>
    `;
  })

  const el = document.getElementById('roomList');

  el.innerHTML = roomListContent;
}

function uploader(filename = '') {
  return 'http://localhost/pemilu-2024/public/uploader/'+filename;
}

renderMessageList();

function renderMessageList() {
    let messageListContent = '';
    window.pesan.forEach((item) => {
        if (item.user_id !== window.userId) {
            messageListContent += `
                <div class="block md:px-6 px-4">
                    <div class="flex space-x-2 items-start group rtl:space-x-reverse">
                        <div class="flex-1 flex space-x-4 rtl:space-x-reverse">
                            <div>
                                <div class="text-contrent p-3 bg-slate-100 dark:bg-slate-600 dark:text-slate-300 text-slate-600 text-sm font-normal mb-1 rounded-md flex-1 whitespace-pre-wrap break-all">${item.pesan}</div><span class="font-normal text-xs text-slate-400 dark:text-slate-400">${item.pesan_created_at}</span>
                            </div>
                            <div class="opacity-0 invisible group-hover:opacity-100 group-hover:visible">
                            <div data-headlessui-state="" class="relative inline-block"><button id="headlessui-menu-button-63" type="button" aria-haspopup="true" aria-expanded="false" data-headlessui-state="" class="block w-full">
                                <div class="h-8 w-8 bg-slate-100 dark:bg-slate-600 dark:text-slate-300 text-slate-900 flex flex-col justify-center items-center text-xl rounded-full"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z"></path>
                                    </svg></span></div>
                                </button></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } else {
            messageListContent += `
                <div class="block md:px-6 px-4">
                    <div class="flex space-x-2 items-start justify-end group w-full rtl:space-x-reverse">
                    <div class="no flex space-x-4 rtl:space-x-reverse">
                        <div class="opacity-0 invisible group-hover:opacity-100 group-hover:visible">
                        <div data-headlessui-state="" class="relative inline-block"><button id="headlessui-menu-button-109" type="button" aria-haspopup="true" aria-expanded="false" data-headlessui-state="" class="block w-full">
                            <div class="h-8 w-8 bg-slate-300 dark:bg-slate-900 dark:text-slate-400 flex flex-col justify-center items-center text-xl rounded-full text-slate-900"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z"></path>
                                </svg></span></div>
                            </button></div>
                        </div>
                        <div class="flex flex-col justify-center whitespace-pre-wrap break-all">
                        <div class="text-contrent p-3 bg-slate-300 dark:bg-slate-900 dark:text-slate-300 text-slate-800 text-sm font-normal rounded-md flex-1 mb-1">${item.pesan}</div><span class="font-normal text-xs text-slate-400">${item.pesan_created_at}</span>
                        </div>
                    </div>
                    </div>
                </div>
            `;
        }
    })

    const messageListEl = document.getElementById('messageList');
    const messageInputEl = document.getElementById('messageInput');
    
    messageListEl.innerHTML = messageListContent;

    messageListEl.scrollTo(0, messageListEl.scrollHeight)

    messageInputEl.focus();
    
}