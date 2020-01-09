function varticalCenterStuff() {
    var windowHeight = $(window).height();
    var loginBoxHeight = $('.login-box').innerHeight();
    var registerBoxHeight = $('.register-box').innerHeight();
    var welcomeTextHeight = $('.welcome-text').innerHeight();
    var loggedIn = $('.logged-in').innerHeight();

    var mathLogin = (windowHeight / 2) - (loginBoxHeight / 2);
    var mathRegister = (windowHeight / 2) - (registerBoxHeight / 2);
    var mathWelcomeText = (windowHeight / 2) - (welcomeTextHeight / 2);
    var mathLoggedIn = (windowHeight / 2) - (loggedIn / 2);
    $('.login-box').css('margin-top', mathLogin);
    $('.register-box').css('margin-top', mathRegister);
    $('.welcome-text').css('margin-top', mathWelcomeText);
    $('.logged-in').css('margin-top', mathLoggedIn);
}
$(window).resize(function () {
    varticalCenterStuff();
});
varticalCenterStuff();

// awesomeness
$('.btn-login').click(function(){
    $(this).parent().fadeOut(function(){
        $('.login-box').fadeIn();
    })
});

$('.btn-register').click(function(){
    $(this).parent().fadeOut(function(){
        $('.register-box').fadeIn();
    })
});

$('.btn-cancel-action').click(function(e){
    e.preventDefault();
    $(this).parent().parent().parent().fadeOut(function(){
        $('.welcome-text').fadeIn();
    })
});

$('.btn-register-submit').click(function (e) {
    e.preventDefault();


    var username = $('#usernamereg').val().trim();
    var password = $('#passwordreg').val().trim();
    var name = $('#name').val().trim();
    var family = $('#family').val().trim();
    var phone = $('#phone').val().trim();
    var address = $('#address').val().trim();
    var email = $('#email').val().trim();
    var element = $(this).parent().parent().parent();

    if (username === "" || password === "" || name === "" || family === "" || phone === "" || address === "" || email === "") {
        // wigle and show notification
        // Wigle
        $(element).addClass('animated rubberBand');
        $(element).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(element).removeClass('animated rubberBand');
        });

        // Notification
        // reset
        $('.notification.register-alert').removeClass('bounceOutRight notification-show animated bounceInRight');
        // show notification
        $('.notification.register-alert').addClass('notification-show animated bounceInRight');

        $('.notification.register-alert').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            setTimeout(function(){
                $('.notification.register-alert').addClass('animated bounceOutRight');
            }, 2000);
        });
    }
    else {
        $.ajax({
            url: "Register.php",
            type: 'POST',
            data:
                {
                    username:username,
                    password:password,
                    name:name,
                    family:family,
                    email:email,
                    phone:phone,
                    address:address,
                    action: 'register'
                },
            success: function (response) {
                if (response === "success") {
                    $('.notification.success-data').removeClass('bounceOutRight notification-show animated bounceInRight');
                    // show notification
                    $('.notification.success-data').addClass('notification-show animated bounceInRight');

                    $('.notification.success-data').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        setTimeout(function(){
                            $('.notification.success-data').addClass('animated bounceOutRight');
                        }, 2000);
                    });
                }
                else {
                    $('.notification.submit-err').removeClass('bounceOutRight notification-show animated bounceInRight');
                    // show notification
                    $('.notification.submit-err').addClass('notification-show animated bounceInRight');

                    $('.notification.submit-err').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        setTimeout(function(){
                            $('.notification.submit-err').addClass('animated bounceOutRight');
                        }, 4000);
                    });
                }
            }
        });
    }



});

$('.btn-login-submit').click(function(e){
    e.preventDefault();

    var element = $(this).parent().parent().parent();

    var username = $('#username').val().trim();
    var password = $('#password').val().trim();


    if(username === '' || password === ''){

        // wigle and show notification
        // Wigle
        $(element).addClass('animated rubberBand');
        $(element).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(element).removeClass('animated rubberBand');
        });

        // Notification
        // reset
        $('.notification.login-alert').removeClass('bounceOutRight notification-show animated bounceInRight');
        // show notification
        $('.notification.login-alert').addClass('notification-show animated bounceInRight');

        $('.notification.login-alert').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            setTimeout(function(){
                $('.notification.login-alert').addClass('animated bounceOutRight');
            }, 2000);
        });
    }
    else{

        $.ajax({
            type: 'POST',
            data: {username: username, password: password},
            url: "login.php",
            success: function(result){
                if (result === "1") {
                    $(element).fadeOut(function(){
                        $('.logged-in').fadeIn();
                    });
                }
                else {
                    $('.notification.login-err').removeClass('bounceOutRight notification-show animated bounceInRight');
                    // show notification
                    $('.notification.login-err').addClass('notification-show animated bounceInRight');

                    $('.notification.login-err').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        setTimeout(function(){
                            $('.notification.login-err').addClass('animated bounceOutRight');
                        }, 2000);
                    });
                }
            }});

    }//endif
});


$('.btn-logout').click(function(){
    $.ajax({
        url: "logout.php",
        type: 'POST',
        data: {action:'logout'},
        success: function (response) {
            if (response === "success") {
                $('.logged-in').fadeOut(function(){

                    $('.welcome-text').fadeIn();
                    // Notification
                    $('.notification.logged-out').removeClass('bounceOutRight notification-show animated bounceInRight');
                    // show notification
                    $('.notification.logged-out').addClass('notification-show animated bounceInRight');

                    $('.notification.logged-out').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        setTimeout(function(){
                            $('.notification.logged-out').addClass('animated bounceOutRight');
                        }, 2000);
                    });

                });
            }
        }
    });

});