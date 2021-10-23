<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chat App Socket.io</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <style>
            .chat-row {
                margin: 50px;
            }


             ul {
                 margin: 0;
                 padding: 0;
                 list-style: none;

             }


             ul li {
                 padding:8px;
                 background: #928787;
                 margin-bottom:20px;
             }


             ul li:nth-child(2n-2) {
                background: #c3c5c5;
             }


             .chat-input {
                 border: 1px soild lightgray;
                 border-top-right-radius: 10px;
                 border-top-left-radius: 10px;
                 padding: 8px 10px;
                 color:#fff;
             }
             #chatInput{
                position: fixed;
                bottom: 14px;
                width: 70%;

             }
             .sender{
                margin-left: 80%;
             }
             .receiver{
                margin-right: 80%;
             }
        </style>
    </head>
    <body>

        <div class="container">
            <input type="hidden" id="from-id" value="{{$chatUserFrom->id}}">
            <input type="hidden" id="to-id" value="{{$chatUserTo->id}}">
            <input type="hidden" id="from-name" value="{{$chatUserFrom->name}}">
            <input type="hidden" id="to-name" value="{{$chatUserTo->name}}">

            <div class="row chat-row">
                <div class="chat-content">
                    <ul style="overflow-wrap: break-word;">

                    </ul>

                </div>

                <div class="chat-section">
                    <div class="chat-box">
                        <div class="chat-input bg-primary" id="chatInput" contenteditable="">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>


        <script>
            $(function() {
                let ip_address = '127.0.0.1';
                let socket_port = '3000';
                let socket = io(ip_address + ':' + socket_port);

                let chatInput = $('#chatInput');
                let fromId = $('#from-id').val();
                let toId = $('#to-id').val();
                let fromName = $('#from-name').val();
                let toName = $('#to-name').val();


                chatInput.keypress(function(e) {
                    let message =
                     {
                        msg:$(this).html(),
                        fromId: fromId,
                        toId: toId,
                    };
                    // console.log(message);
                    if(e.which === 13 && !e.shiftKey) {
                        socket.emit('sendChatToServer', message);
                        $('.chat-content ul').append(`<div class="sender">`+fromName+':'+`<li>${message.msg}</li></div>`);
                        chatInput.html('');
                        return false;
                    }
                });

                socket.on('sendChatToClient', (message) => {
                    $('.chat-content ul').append(`<div class="receiver">`+toName+':'+`<li>${message.msg}</li></div>`);
                });
            });
        </script>
    </body>
</html>
