function fb_login()
{
    FB.login(function(response) {
       if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function(response) {
                console.log('Good to see you, ' + response.name + '.');
                if ($("#reg").is(":visible"))
                {
                    //$("#email1").val(response.email);
                    $("#thx-txt").html("Required account verification info sent to " + response.email);
                    $.post('post_register.php',{email1:response.email},
                        function (html)
                        {
                            if (html != 1)
                            {
                                close_popups();
                                $("#error-txt").html(html);
                                $("#error").show("fade", {}, 600);
                            }
                            else
                            {
                                $("#reg").hide("fade", {}, 600);
                                $("#thanks").show("fade", {}, 600);
                            }
                        }
                    );
                }
                else
                {
                    $.post('post_login.php',{},
                        function (html)
                        {
                            if (html != 1)
                            {
                                close_popups();
                                $("#error-txt").html(html);
                                $("#error").show("fade", {}, 600);
                            }
                            else
                            {
                                window.location.href="index.php";
                            }
                        }
                    );
                }
            });
       } else {
         console.log('User cancelled login or did not fully authorize.');
       }
    }, { scope: 'email', display: 'popup' });
}
function def_signup()
{
    $.post('post_register.php',{email1:$("#email1").val()},
        function (html)
        {
            if (html != 1)
            {
                close_popups();
                $("#error-txt").html(html);
                $("#error").show("fade", {}, 600);
            }
            else
            {
                $("#reg").hide("fade", {}, 600);
                $("#thanks").show("fade", {}, 600);
            }
        }
    );
}
function do_login()
{
    $.post('post_login.php',{username:$("#in-user").val(),password:$("#in-pass").val()},
        function (html)
        {
            if (html != 1)
            {
                close_popups();
                $("#error-txt").html(html);
                $("#error").show("fade", {}, 600);
            }
            else
            {
                window.location.href="index.php";
            }
        }
    );
}
function noenter(f) {
    if (window.event && window.event.keyCode == 13)
    {
        f();
    }
    return !(window.event && window.event.keyCode == 13);
}
function show_signup()
{
    close_popups();
    $("html,body").animate({scrollTop:0},500);
    $("#reg").show("fade",{},600);
    $("#reg-bg").show("fade",{},600);
}
function show_signin()
{
    close_popups()
    $("html,body").animate({scrollTop:0},500);
    $("#in").show("fade",{},600);
    $("#reg-bg").show("fade",{},600);
}
function show_verify()
{
    close_popups()
    $("html,body").animate({scrollTop:0},500);
    $("#verify").show("fade",{},600);
    $("#reg-bg").show("fade",{},600);
}
function toggle_email()
{
    toggle("#email");
}
function toggle_signin()
{
    toggle("#username");
}
function toggle(field)
{
    if ($(field).is(":visible"))
    {
        $(field).hide("fade",{},600);
    }
    else
    {
        $(field).show("fade",{},600);
    }
}
function reverify()
{
    $.post('post_reverify.php',{},
        function (html)
        {
            if (html != 1)
            {
                close_popups();
                $("#error-txt").html(html);
                $("#error").show("fade", {}, 600);
            }
            else
            {
                close_popups();
                $("#thanks").show("fade", {}, 600);
            }
        }
    );
}
function forgotpw()
{
    $.post('post_forgot.php',{},
        function (html)
        {
            if (html != 1)
            {
                close_popups();
                $("#error-txt").html(html);
                $("#error").show("fade", {}, 600);
            }
            else
            {
                close_popups();
                $("#notice-title").html("Reset PW");
                $("#notice-txt").html("You have been e-mailed a new temporary password.");
                $("#notice").show("fade", {}, 600);
            }
        }
    );
}
function close_popups()
{
    $("#reg-top").hide("fade", {}, 600);
    $("#reg").hide("fade", {}, 600);
    $("#in").hide("fade", {}, 600);
    $("#thanks").hide("fade", {}, 600);
    $("#verify").hide("fade", {}, 600);
    $("#error").hide("fade", {}, 600);
    $("#notice").hide("fade", {}, 600);
    $("#account").hide("fade", {}, 600);
    $("#reg-bg").hide("fade", {}, 600);
}
$(document).ready(function() {
    $("#reg-close").mousedown(close_popups);
    $("#thx-close").mousedown(close_popups);
    $("#in-close").mousedown(close_popups);
    $("#error-close").mousedown(close_popups);
    $("#verify-close").mousedown(close_popups);
    $("#notice-close").mousedown(close_popups);
    $("#account-close").mousedown(close_popups);
    $("#signup-fb").mousedown(fb_login);
    $("#login-fb").mousedown(fb_login);
    $("#signin-fb").mousedown(fb_login);
    $("#signup-in").mousedown(show_signin);
    $("#verify-in").mousedown(show_signin);
    $("#signin-up").mousedown(show_signup);
    $("#signin").mousedown(do_login);
    $("#signup").mousedown(def_signup);
    $("#error-up").mousedown(show_signup);
    $("#login-def").mousedown(show_signin);
    $("#login-join").mousedown(show_signup);
    $("#join-purchase").mousedown(show_signup);
    $("#email-join").mousedown(toggle_email);
    $("#email-sign").mousedown(toggle_signin);
});

