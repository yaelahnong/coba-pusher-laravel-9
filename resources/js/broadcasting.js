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
});

window.Echo.channel('chat')
.listen('PesanTerkirim', (e) => {
    window.pesan.push(e.pesan)
    renderMessageList();
    let messageListContent = '';
});
renderMessageList();
function renderMessageList() {
    let messageListContent = '';
    console.log('userinitial', window.userInitial)
    
    window.pesan.forEach((item) => {
        if (item.user_initial !== window.userInitial) {
            messageListContent += `
                <div class="block md:px-6 px-4">
                    <div class="flex space-x-2 items-start group rtl:space-x-reverse">
                        <div class="flex-1 flex space-x-4 rtl:space-x-reverse">
                            <div>
                                <div class="text-contrent p-3 bg-slate-100 dark:bg-slate-600 dark:text-slate-300 text-slate-600 text-sm font-normal mb-1 rounded-md flex-1 whitespace-pre-wrap break-all">${item.pesan}</div><span class="font-normal text-xs text-slate-400 dark:text-slate-400">${item.created_at}</span>
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
    
    messageListEl.innerHTML = messageListContent;
    
}


