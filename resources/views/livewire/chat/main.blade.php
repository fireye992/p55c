<main class="main-content position-relative max-height-vh-100 h-100">
    <div class="chat_container position-relative">
        <div class="chat_list_container">
            @livewire('chat.chat-list')
        </div>
        <div class="chat_box_container">
            @livewire('chat.chatbox')
            @livewire('chat.send-message')
        </div>
    </div>

    <script>
        window.addEventListener('chatSelected', event => {
            if (window.innerWidth < 768) {
                document.querySelector('.chat_list_container').style.display = 'none';
                document.querySelector('.chat_box_container').style.display = 'block';
            }

            document.querySelector('.chatbox_body').scrollTop = document.querySelector('.chatbox_body').scrollHeight;
            let height = document.querySelector('.chatbox_body').scrollHeight;

            @this.dispatch('updateHeight', { height: height });
        });

        window.addEventListener('resize', event => {
            if (window.innerWidth > 768) {
                document.querySelector('.chat_list_container').style.display = 'block';
                document.querySelector('.chat_box_container').style.display = 'block';
            }
        });

        document.querySelector('.return').addEventListener('click', function() {
            document.querySelector('.chat_list_container').style.display = 'block';
            document.querySelector('.chat_box_container').style.display = 'none';
        });

        document.querySelector('#chatBody').addEventListener('scroll', function() {
            let top = this.scrollTop;
            if (top == 0) {
                @this.dispatch('loadmore');
            }
        });
    </script>
</main>
