$(document).ready(function () {

    /**
     * Websockets
     * @type {{socket: null, uri: string, init: Function, onOpen: Function, onClose: Function, onError: Function, onMessage: Function}}
     */
    var sConn = {
        socket: null,
        uri: "ws://chat.dev:8080",

        init: function () {
            this.socket = new WebSocket(this.uri);
            this.socket.onopen = this.onOpen.bind(this);
            this.socket.onclose = this.onClose.bind(this);
            this.socket.onerror = this.onError.bind(this);
            this.socket.onmessage = this.onMessage.bind(this);
        },

        onOpen: function (msg, receiverName) {
            var msgObj = {
                receiverName: receiverName.trim(),
                senderName: localStorage.getItem('thisUser'),
                message: msg
            };

            this.socket.send(JSON.stringify(msgObj));
        },
        onClose: function (event) {
            console.log("Close:", event);
        },
        onError: function (err) {
            console.log("Error:", err);
        },
        onMessage: function (obj) {
            var res = JSON.parse(obj.data);

            //Receiving msg rule
            if (res.receiverName === localStorage.getItem('thisUser')) {
                buildNewLi('left', res.message, res.senderName);
            } else if (res.senderName === localStorage.getItem('thisUser')) {
                buildNewLi('right', res.message, res.senderName);
            }
        }
    }
    sConn.init();

    /**
     * Make ajax rq to get chat history
     */
    $('.userName').click(function () {
        $('.panel-body ul li').remove();
        $('#userName').text(" ");
        $.ajax({
            type: "POST",
            url: "/ajax/history",
            data: {username: $(this).text()}
        }).done(function (result) {
            var res = JSON.parse(result);
            var username = $(this).text();
            if ($('.chatWith').text().length === 0) {
                $('.chatWith').append(username);
            }
            buildHistory(res);
        });
        $('#userName').append($(this).text());
    });

    /**
     * Used to send a new message
     */
    $(".send").on("keydown", function (event) {
        if (event.which == 13) {
            $.ajax({
                type: "POST",
                url: "/ajax/send",
                data: {message: $(".send").val(), username: $('#userName').text()}
            }).done(function (result) {
                var res = JSON.parse(result);
                buildNewLi('right', $(".send").val(), res.sender);
                sConn.onOpen($(".send").val(), $('#userName').text());
                $(".send").val(' ');
            });
        }
    });

    /**
     * Rend the whole chat history
     * @param obj
     */
    function buildHistory(obj) {
        for (id in obj) {
            if (obj[id].sender.length > 0) {
                buildNewLi('right', obj[id].message, obj[id].sender);
            } else if (obj[id].receiver.length > 0) {
                buildNewLi('left', obj[id].message, obj[id].receiver);
            }
        }
        myscroll = $('.panel-body');
        myscroll.scrollTop(myscroll.get(0).scrollHeight);
    }

    /**
     * Rend new message.
     * @param param
     * @param message
     * @param name
     */
    function buildNewLi(param, message, name) {
        if (param === 'left') {
            var li = '<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/fff&text=' + name + '" alt="User Avatar" class="img-circle"/></span><div class="chat-body clearfix"><div class="header"><strong class="chatWith primary-font"></strong></div><p>' + message + '</p></div></li>';
        } else if (param === 'right') {
            var li = '  <li class="right clearfix"><span class="chat-img pull-right"><img src="http://placehold.it/50/FA6F57/fff&text=' + name + '" alt="User Avatar" class="img-circle"/></span><div class="chat-body clearfix"><div class="header"><strong class="myUsername pull-right primary-font"></strong></div><p>' + message + '</p></div></li>';
        }
        $('.panel-body ul').append(li);
    }
});