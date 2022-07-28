<style>    
    .chat-row {
        margin: 50px;
    }

    .chat-content-container {
        margin: 0;
        padding: 0;
        list-style: none;

    }

    .chat-content-container li {
        padding:8px;
        background:#FFF8DC;
        margin-bottom:20px;
        padding-left:1rem;
        border-radius: 12px;
    }
/* 
    .chat-content-container li:nth-child(2n-2) {
        border-radius: 12px;
        background: #B0E0E6;
    } */

    .chat-input {
        border: black;
        border-radius: 12px;
        background-color:#e9e9e9;
        border-top-right-radius:10px;
        border-top-left-radius:10px;
        padding:8px 10px;
    }

    .offcanvas-end {
        top: 0;
        right: 0;
        width: 270px;
        background-color: white;
        border-left: 1px solid rgba(0, 0, 0, 0.2);
    }
/* 
    .grey {
        background-color: gainsboro;
    } */

</style>

<div class="offcanvas offcanvas-end" tabindex="-1" id="msgslide_nav_bar" aria-labelledby="msgslide_nav_bar">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <ul class="list-group list-group-flush px-7 ">
        <a href="" class="list-group-item list-group-item-action text-blue fw-bold">
            @auth
            {{ Auth::user()->name }}
            @endauth
        </a>
        <div class="container">
            <div class="row">
                <div class="chat-content mt-3">
                    <ul class="chat-content-container">
                        
                    </ul>
                </div>
                <div class="chat-session">
                    <div class="chat-box mt-3">
                        <div class="chat-input" id="chatInput" contenteditable="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </ul>
</div>
<script>
    $(function(){
        let ip_address = '127.0.0.1';
        let socket_port = '3000';
        let socket = io(ip_address + ':' + socket_port);

        let chatInput = $('#chatInput');

        chatInput.keypress(function(e){
            let message = $(this).html();
            console.log(message);

            if(e.which === 13 && !e.shiftKey){
                socket.emit('chatToServer', message);
                chatInput.html('');
                return false;
            }
        });

        socket.on('sendChatToClient',(message)=>{
            $('.chat-content ul').append(`<li>${message}</li>`);
        });
    });

    
</script>