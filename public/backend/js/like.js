< script >
    //hover
    $('.pop').popover({
        html: true,
        trigger: 'manual',
        placement: 'bottom',
        content: function() {
            return $('#popover_content_wrapper').html();
        }
    }) //activating popover with manual trigger
    .on("mouseenter", function() {
        var _this = this;
        $(this).popover("show");
        $(".popover").on("mouseleave", function() {
            $(_this).popover('hide');
        }); //here we made our manual trigger - when your mouse is hovering the button, popover is staying even when you move
        //your mouse on it and hiding when coursor is out of button and popover
    });


//click
$('[data-toggle="popover-click"]').popover({
    html: true,
    trigger: 'click',
    placement: 'bottom',
    content: function() {
        return $('#popover_content_wrapper').html();
    }
}); //choosing element, enabling popover after click with used parameters and returning div with id
//  popover_centent_wrapper as popover


//longpress
var node = document.getElementById("button1"); //choosing element
var longpress = false;
var presstimer = null;
var longtarget = null;
//setting values as false/null

var cancel = function(e) {
    if (presstimer !== null) {
        clearTimeout(presstimer);
        presstimer = null;
    }
}; //if we cancel our click (presstimer is diiferent than null, we're clearing timeout)

var click = function(e) {
    if (presstimer !== null) {
        clearTimeout(presstimer);
        presstimer = null;
    } //same as above

    if (longpress) {
        return false;
    }

    toastr.info('Like!');
}; //if you click once, shortly, you'll get this comunicate

var start = function(e) {


    if (e.type === "click" && e.button !== 0) {
        return;
    }

    longpress = false;



    presstimer = setTimeout(function() {
        $('[data-toggle="popover"]').popover({
            html: true,
            placement: 'bottom',
            content: function() {
                return $('#popover_content_wrapper').html();
            }
        });
        longpress = true;
    }, 1000);

    return false;
}; //we're setting timeout here, if you hold click for 1 second, popover will activate, it's your longpress

node.addEventListener("mousedown", start);
node.addEventListener("touchstart", start);
node.addEventListener("click", click);
node.addEventListener("mouseout", cancel);
node.addEventListener("touchend", cancel);
node.addEventListener("touchleave", cancel);
node.addEventListener("touchcancel", cancel);
//adding some events to our element, where we want long press

//emotes
$(document).on('click', '#angry', function() {
    $('[data-toggle="popover"]').popover("hide");
    $('[data-toggle="popover-click"]').popover("hide");
    toastr.error(
        'Angry!'
    );
    //if you click angry emote, you'll get communicate "Angry!" and popover will hide. I did it to every emoticon
});

$(document).on('click', '#like', function() {
    $('[data-toggle="popover"]').popover("hide");
    $('[data-toggle="popover-click"]').popover("hide");
    toastr.info('Like!');
});

$(document).on('click', '#inlove', function() {
    $('[data-toggle="popover"]').popover("hide");
    $('[data-toggle="popover-click"]').popover("hide");
    toastr.warning('In love!');
});

$(document).on('click', '#cancer', function() {
    $('[data-toggle="popover"]').popover("hide");
    $('[data-toggle="popover-click"]').popover("hide");
    toastr.warning('Haha!');
});

$(document).on('click', '#love', function() {
    $('[data-toggle="popover"]').popover("hide");
    $('[data-toggle="popover-click"]').popover("hide");
    toastr.error('Love!');
});

$(document).on('click', '#surprise', function() {
    $('[data-toggle="popover"]').popover("hide");
    $('[data-toggle="popover-click"]').popover("hide");
    toastr.warning('Surprised!');
}); <
/script>