$(document).ready(function () {

    // Then some JavaScript in the browser:
    //var conn = new WebSocket('ws://chat.dev:8123');
    //conn.onmessage = function (e) {
    //    console.log(e.data);
    //};
    //conn.send('Hello Me!');

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
        window.setInterval(function () {
            $.ajax({
                type: "POST",
                url: "/ajax/update",
                data: {username: $('#userName').text()}
            }).done(function (result) {
                var res = JSON.parse(result);
                console.log(res);
                update(res)

            });
        }, 1000);
    });

    $(".send").on("keydown", function (event) {
        if (event.which == 13) {

            $.ajax({
                type: "POST",
                url: "/ajax/send",
                data: {message: $(".send").val(), username: $('#userName').text()}
            }).done(function (result) {
                var res = JSON.parse(result);
                buildNewLi('right', $(".send").val(), res.sender);
                $(".send").val(' ');
            });
        }
    });

    function update(obj) {
        for (id in obj) {
            if (obj[id].sender.length > 0) {
                buildNewLi('left', obj[id].message, obj[id].sender);
            }
        }
    }

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

    function buildNewLi(param, message, name) {

        if (param === 'left') {
            var li = '<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/fff&text=' + name + '" alt="User Avatar" class="img-circle"/></span><div class="chat-body clearfix"><div class="header"><strong class="chatWith primary-font"></strong></div><p>' + message + '</p></div></li>';
        } else if (param === 'right') {
            var li = '  <li class="right clearfix"><span class="chat-img pull-right"><img src="http://placehold.it/50/FA6F57/fff&text=' + name + '" alt="User Avatar" class="img-circle"/></span><div class="chat-body clearfix"><div class="header"><strong class="myUsername pull-right primary-font"></strong></div><p>' + message + '</p></div></li>';
        }
        $('.panel-body ul').append(li);
    }
});