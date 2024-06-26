Pusher.logToConsole = true;
const pusher = new Pusher("985ecd7309715048a253", {
    wsHost: "127.0.0.1",
    wsPort: 6001,
    wssPort: 6001,
    disableStats: true,
    enabledTransports: ["ws", "wss"],
    cluster: "ap1",
});
$("#messageForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        url: "/chattle/post-message",
        data: {
            message: $("#message").val(),
            chat_id: $.cookie("ch"),
            sender: "customer",
        },
        cache: false,
        success: function (response) {
            $("#message").val("");

            $("#messagesContainer")
                .finish()
                .animate(
                    {
                        scrollTop: $("#messagesContainer").prop("scrollHeight"),
                    },
                    250
                );
        },
    });
});

$(".chat-button").on("click", function (e) {
    $(this).parent().css("width", "30%").css("height", "70%");
    if ($(this).attr("username")) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: "/chattle/create-chat",
            data: {
                name: $(this).attr("username"),
                email: $(this).attr("useremail"),
            },
            cache: false,
            success: function (response) {
                console.log(response);
                $.cookie("ch", response[0].id, { expires: 1 });
                $.cookie("nm", response[0].name, { expires: 1 });
                var channel = pusher.subscribe("chat" + response[0].id);
                channel.bind("my-messages", function (response) {
                    if (response.message.sender == "admin") {
                        $("#messagesContainer").append(
                            '<div class="message-wrapper"><div class="profile-picture"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div><div class="message-content"><p class="name">Admin</p><div class="message">' +
                                response.message.message +
                                "</div></div></div>"
                        );
                    } else {
                        $("#messagesContainer").append(
                            '<div class="message-wrapper reverse"><div class="profile-picture"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div><div class="message-content"><p class="name">' +
                                $.cookie("nm") +
                                '</p><div class="message">' +
                                response.message.message +
                                "</div></div></div>"
                        );
                    }
                    $("#messagesContainer")
                        .finish()
                        .animate(
                            {
                                scrollTop:
                                    $("#messagesContainer").prop(
                                        "scrollHeight"
                                    ),
                            },
                            250
                        );
                });
                $("#chatContactContainer").css("display", "none");
                $("#messagesContainer").css("display", "block");
                $("#inputContainer").css("display", "block");
                $(".chat-button").css("display", "none");
                $(".chat-container").css("display", "flex");
            },
        });

        // end
    }
});

$(document).ready(function () {
    var ch = $.cookie("ch");
    if (ch == null) {
        $(".close-button").on("click", function () {
            $(this)
                .parent()
                .parent()
                .parent()
                .parent()
                .css("width", "10px")
                .css("height", "10px");

            $(".chat-container").css("display", "none");
            $(".chat-button").css("display", "block");
        });
        $(".chat-button").on("click", function () {
            if ($.cookie("ch") == null) {
                $("#messagesContainer").css("display", "none");
                $("#inputContainer").css("display", "none");
                $("#chatContactContainer").css("display", "block");
                $(".chat-button").css("display", "none");
                $(".chat-container").css("display", "flex");
                $("#contactForm").on("submit", function (e) {
                    e.preventDefault();
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        type: "POST",
                        url: "/chattle/create-chat",
                        data: {
                            name: $("#name").val(),
                            email: $("#email").val(),
                        },
                        cache: false,
                        success: function (response) {
                            $.cookie("ch", response.id, { expires: 1 });
                            $.cookie("nm", response.name, { expires: 1 });
                            var channel = pusher.subscribe(
                                "chat" + response.id
                            );
                            channel.bind("my-messages", function (response) {
                                if (response.message.sender == "admin") {
                                    $("#messagesContainer").append(
                                        '<div class="message-wrapper"><div class="profile-picture"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div><div class="message-content"><p class="name">Admin</p><div class="message">' +
                                            response.message.message +
                                            "</div></div></div>"
                                    );
                                } else {
                                    $("#messagesContainer").append(
                                        '<div class="message-wrapper reverse"><div class="profile-picture"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div><div class="message-content"><p class="name">' +
                                            $.cookie("nm") +
                                            '</p><div class="message">' +
                                            response.message.message +
                                            "</div></div></div>"
                                    );
                                }
                                $("#messagesContainer")
                                    .finish()
                                    .animate(
                                        {
                                            scrollTop:
                                                $("#messagesContainer").prop(
                                                    "scrollHeight"
                                                ),
                                        },
                                        250
                                    );
                            });
                            $("#chatContactContainer").css("display", "none");
                            $("#messagesContainer").css("display", "block");
                            $("#inputContainer").css("display", "block");
                            $(".chat-button").css("display", "none");
                            $(".chat-container").css("display", "flex");
                        },
                    });
                });
            } else {
                $("#chatContactContainer").css("display", "none");
                $("#messagesContainer").css("display", "block");
                $("#inputContainer").css("display", "block");
                $(".chat-button").css("display", "none");
                $(".chat-container").css("display", "flex");
            }
        });
    } else {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "GET",
            url: "/chattle/get-messages",
            data: {
                chat_id: $.cookie("ch"),
            },
            cache: false,
            success: function (response) {
                console.log("sent ajax form");
                console.log(response);
                for (var i = 0; i < response.length; i++) {
                    if (response[i].sender == "admin") {
                        $("#messagesContainer").append(
                            '<div class="message-wrapper"><div class="profile-picture"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div><div class="message-content"><p class="name">Admin</p><div class="message">' +
                                response[i].message +
                                "</div></div></div>"
                        );
                    } else {
                        $("#messagesContainer").append(
                            '<div class="message-wrapper reverse"><div class="profile-picture"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div><div class="message-content"><p class="name">' +
                                $.cookie("nm") +
                                '</p><div class="message">' +
                                response[i].message +
                                "</div></div></div>"
                        );
                    }
                }
                $("#messagesContainer")
                    .finish()
                    .animate(
                        {
                            scrollTop:
                                $("#messagesContainer").prop("scrollHeight"),
                        },
                        250
                    );
            },
        });
        var channel = pusher.subscribe("chat" + $.cookie("ch"));
        channel.bind("my-messages", function (response) {
            console.log(response);
            if (response.message.sender == "admin") {
                $("#messagesContainer").append(
                    '<div class="message-wrapper"><div class="profile-picture"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div><div class="message-content"><p class="name">Admin</p><div class="message">' +
                        response.message.message +
                        "</div></div></div>"
                );
            } else {
                $("#messagesContainer").append(
                    '<div class="message-wrapper reverse"><div class="profile-picture"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div><div class="message-content"><p class="name">' +
                        $.cookie("nm") +
                        '</p><div class="message">' +
                        response.message.message +
                        "</div></div></div>"
                );
            }
            $("#messagesContainer")
                .finish()
                .animate(
                    {
                        scrollTop: $("#messagesContainer").prop("scrollHeight"),
                    },
                    250
                );
        });
        $(".close-button").on("click", function () {
            $(".chat-container").css("display", "none");
            $(".chat-button").css("display", "block");
        });

        $(".chat-button").on("click", function (e) {
            console.log("click");
            $("#chatContactContainer").css("display", "none");
            $("#messagesContainer").css("display", "block");
            $("#inputContainer").css("display", "block");
            $(".chat-button").css("display", "none");
            $(".chat-container").css("display", "flex");
            $("#messagesContainer")
                .finish()
                .animate(
                    {
                        scrollTop: $("#messagesContainer").prop("scrollHeight"),
                    },
                    250
                );
        });
    }
});
