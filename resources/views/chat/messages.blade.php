@extends('components.'.auth()->user()->type->value.'.layout')

@section('content')
    <main>
        <a href="{{ route('threads.index') }}"
           class="inline-flex justify-center text-sky-600 hover:underline transition ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                 class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Go Back
        </a>

        <div class="bg-white rounded-xl shadow">
            <div class="w-full px-6 py-2 border-b inline-flex items-center">
                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode($thread->participants[0]->user->fullname()) }}&background=0D8ABC&color=fff"
                    width="50px"
                    height="50px" class="rounded-full border" alt="">

                <p class="text-lg font-semibold text-gray-700 ml-2">
                    {{ $thread->participants[0]->user->fullname() }}
                </p>
            </div>

            <div class="relative py-2">
                <section class="h-[525px] overflow-y-auto space-y-4 px-4 pb-12" id="messages--container">
                    @foreach($thread->messages as $m)
                        @if($m->user_id === auth()->id())
                            <div class="grid justify-items-end">
                                <div class="bg-sky-100 px-4 py-2 rounded-t-xl rounded-bl-xl w-fit">
                                    <span class="overflow-auto break-words"> {{ $m->content }}</span>
                                </div>
                                <p class="text-xs text-neutral-400 mt-1">
                                    {{ $m->created_at->format('F j Y, g A') }}
                                </p>
                            </div>
                        @else
                            <div>
                                <div class="bg-gray-100 px-4 py-2 rounded-t-xl rounded-br-xl w-fit">
                                    <span class="overflow-auto break-words"> {{ $m->content }}</span>
                                </div>
                                <p class="text-xs text-neutral-400 mt-1">
                                    {{ $m->created_at->format('F j Y, g A') }}
                                </p>
                            </div>
                        @endif
                    @endforeach

                </section>

                @if($thread->participants[0]->user)
                    <div class="absolute inset-x-0 bottom-0 w-full">
                        <form onsubmit="event.preventDefault()">
                            <div
                                class="flex items-center border-t border-b border-l border-r-0 border-sky-400 rounded-b-xl bg-white"
                                id="chat--container">
                                <input type="hidden" name="t" value="{{ $thread->id }}" id="t--input">

                                <input
                                    class="flex h-10 w-full rounded-bl-xl border border-gray-100 bg-transparent py-2 px-3 text-sm placeholder:text-gray-400 disabled:cursor-not-allowed disabled:opacity-50"
                                    type="text"
                                    id="content--input"
                                    name="content"
                                    placeholder="Type here..."
                                    aria-label="content"
                                />
                                <button
                                    onclick="send()"
                                    type="submit"
                                    class="bg-cyan-600 hover:bg-cyan-500 text-white px-4 py-2 rounded-br-xl disabled:cursor-not-allowed"
                                    id="send-button"
                                >
                                    Send
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

        </div>
    </main>
@endsection

@push('scripts')
    <script>
        const msgCnt = document.getElementById('messages--container')
        msgCnt.scrollTop = msgCnt.scrollHeight

        const disableBtn = () => {
            document.getElementById('send-button').disabled = true
            document.getElementById('send-button').innerText = 'Loading...'
        }

        const enableBtn = () => {
            document.getElementById('send-button').disabled = false
            document.getElementById('send-button').innerText = 'Send'
        }

        const appendMsg = (msg) => {
            let html = ''

            if (msg.user_id === {{ auth()->id() }}) {
                html = `
                        <div class="grid justify-items-end">
                            <div class="bg-sky-100 px-4 py-2 rounded-t-xl rounded-bl-xl w-fit">
                                <span class="overflow-auto break-words"> ${msg.content}</span>
                            </div>
                            <p class="text-xs text-neutral-400 mt-1">
                                ${window.moment(msg.created_at).format("MMMM D YYYY, hA")}
                            </p>
                        </div>
                    `
            } else {
                html = `
                        <div>
                            <div class="bg-gray-100 px-4 py-2 rounded-t-xl rounded-br-xl w-fit">
                                <span class="overflow-auto break-words">${msg.content}</span>
                            </div>
                            <p class="text-xs text-neutral-400 mt-1">
                                ${window.moment(msg.created_at).format("MMMM D YYYY, hA")}
                            </p>
                        </div>
                    `
            }

            msgCnt.innerHTML += html;
            msgCnt.scrollTop = msgCnt.scrollHeight
        }

        const send = async () => {
            const t = document.getElementById('t--input');
            const c = document.getElementById('content--input')


            if (t.value === null || t.value === "") {
                return
            }

            if (c.value === "" || c.value === null) {
                return
            }

            disableBtn()
            try {
                await window.axios.post(`/t/${t.value}/send-message`, {
                    'content': c.value
                })
            } catch (e) {
                console.log(e)
            }
            c.value = ''
            enableBtn()
        }
    </script>
    <script type="module">
        Echo.private('t.{{ $thread->id }}')
            .subscribed(() => {
                console.log('subscribed')
            })
            .listen('.chat-message', (e) => {
                appendMsg(e.message)
            }).error((e) => {
            console.error(e)
        })
    </script>
@endpush
