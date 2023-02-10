$(document).on('ready',function () {

    $("button[name='follow']").on('click', function (e) {
        console.log('click fallow');
        console.log($(this).attr('name'));
        var userFollowerId = $(this).children(".userFollower").val();
        // console.log($(this).text());
        sendRequest($(this).attr('name'), userFollowerId, $(this));
        // ajax()
    });
    $("button[name='unFollow']").on('click', function (e) {
        console.log('click uuuuunnfallow');
        console.log($(this).attr('name'));
        var userFollowerId = $(this).children(".userFollower").val();
        // console.log($(this).text());
        sendRequest($(this).attr('name'), userFollowerId, $(this));
        // console.log(sendRequest());
        // ajax()
    });

    function sendRequest($action, $userFollowerId, $button) {
        $.ajax({
            type: "GET",
            url: window.location.href + 'user/' + $action + '/' + $userFollowerId,
            dataType: "html",   //expect html to be returned
            success: function (response) {
                if (response === '0') {
                    console.log('this is response:' + response);
                } else {
                    console.log(response);
                    console.log(window.location.href + 'user/' + $action + '/' + $userFollowerId);
                    if ($button.children('span').text() === 'follow') {
                        $button.children('span').text('unFollow');
                        $button.attr('name','unFollow');
                        $button.removeClass('btn-success');
                        $button.addClass('btn-danger');
                    } else if ($button.children('span').text() === 'unFollow') {
                        $button.children('span').text('follow');
                        $button.attr('name','follow');
                        $button.removeClass('btn-danger');
                        $button.addClass('btn-success');
                    }
                }
            }
        });
    }

});
