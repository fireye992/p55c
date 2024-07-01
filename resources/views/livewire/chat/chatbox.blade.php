<div>
    <x-app.navbar/>
    {{-- Stop trying to control. --}}

    @if ($selectedConversation)
        <div class="chatbox_header">
            <div class="return">
                <i class="bi bi-arrow-left"></i>
            </div>
            <div class="img_container">
                <img src="https://ui-avatars.com/api/?name={{ $receiverInstance->name }}" alt="">
            </div>
            <div class="name">
                {{ $receiverInstance->name }}
            </div>
            <div class="info">
                <div class="info_item">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <div class="info_item">
                    <i class="bi bi-image"></i>
                </div>
                <div class="info_item">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
            </div>
        </div>

        <div class="chatbox_body">
            @foreach ($messages as $message)
                <div class="msg_body {{ auth()->id() == $message->sender_id ? 'msg_body_me' : 'msg_body_receiver' }}"
                    style="width:80%;max-width:80%;max-width:max-content">
                    {{ $message->body }}
                    <div class="msg_body_footer">
                        <div class="date">
                            {{ $message->created_at->format('h:i a') }}
                        </div>
                        <div class="read">
                            @if($message->sender_id === auth()->id())
                                @if($message->read == 0)
                                    <i class="bi bi-check2 status_tick"></i>
                                @else
                                    <i class="bi bi-check2-all text-primary"></i>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <script>
            document.querySelector('.chatbox_body').addEventListener('scroll', function() {
                var top = this.scrollTop;
                if (top == 0) {
                    @this.dispatch('loadmore');
                }
            });
        </script>

        <script>
            window.addEventListener('updatedHeight', event => {
                let old = event.detail.height;
                let newHeight = document.querySelector('.chatbox_body').scrollHeight;
                let height = document.querySelector('.chatbox_body').scrollTop = newHeight - old;
                @this.dispatch('updateHeight', { height });
            });
        </script>
    @else
        <div class="fs-4 text-center text-primary mt-5">
            No conversation selected
        </div>
    @endif

    <script>
        window.addEventListener('rowChatToBottom', event => {
            document.querySelector('.chatbox_body').scrollTop = document.querySelector('.chatbox_body').scrollHeight;
        });
    </script>

    <script>
        document.querySelector('.return').addEventListener('click', function() {
            @this.dispatch('resetComponent');
        });
    </script>

    <script>
        window.addEventListener('markMessageAsRead', event => {
            let ticks = document.querySelectorAll('.status_tick');
            ticks.forEach(element => {
                element.classList.remove('bi-check2');
                element.classList.add('bi-check2-all', 'text-primary');
            });
        });
    </script>
</div>
