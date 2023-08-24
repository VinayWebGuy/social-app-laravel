$('.hamburger').on('click',function(){
    $('body').addClass('sidebar-open');
})
$('.close-sidebar').on('click',function(){
    $('body').removeClass('sidebar-open');
})

$('.notification').on('click',function(){
    $(this).fadeOut();
});

$('.select-file').on('click',function(){
    $('.hidden-select-file').click();
})

$('.three-dots').on('click',function(){
    $('.chat-action').toggleClass('active')
})
$('.chat-box').on('click',function(){
    $('.chat-action').removeClass('active')
})

// $(function() {
//     $(".three-dots").on("click", function(a) {
//       $(".chat-action").addClass("active");
//       a.stopPropagation()
//     });
//     $(document).on("click", function(a) {
//       if ($(a.target).is(".chat-action") === false) {
//         $(".chat-action").removeClass("active");
//       }
//     });
//   });


$('#post').on('keyup', function(){
    let val = $('#post').val();
    let len = val.trim().length;
    $('.characters span').html(len);
    if(len>500){
        $('.characters span').addClass('error');
        $('#make-post').prop('disabled', true);
    }
    else{
        $('.characters span').removeClass('error');
        $('#make-post').prop('disabled', false);
    }
})

$('.post-image').on('click', function(){
    let src = $(this).attr('src');
    $('.image-modal').attr('src', src);
    $('.view-img').addClass('on');
})
$('.close-img').on('click', function(){
    $('.image-modal').attr('src', 'src');
    $('.view-img').removeClass('on');
})

$('.like-post').on('click', function(){
    $(this).toggleClass('fa-regular');
    $(this).toggleClass('fa-solid');
    let id = $(this).attr('like-id');
    $.ajax({
        type: 'GET',
        cache : false,
        data: {id:id},
        url: 'like-post',
        success:function(response){
            getLikes(id);
        }
    })


})

$('.open-comments').on('click', function(){
    $('.post-comments').addClass('on')
    let id = $(this).attr('comment-id');
    $('#comment_id').val(id);
    $('.comment_area').focus()
    recentComments(id);
})
$('.close-comments').on('click', function(){
    $('.post-comments').removeClass('on')
    $('#comment_id').val('')
})

$('#add-comment').on('click', function(){
    let id = $('#comment_id').val();
    let comment = $('.comment_area').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'add-comment',
        data: {
            id: id,
            comment: comment
        },
        success: function(response){
            $('.comment_area').val('');
            $('.post-comments').removeClass('on')
            $('#comment_id').val('')
            getComments(id)
        },
        error: function(error) {
            console.log(error);
        }
    });
});


function getLikes(id){
    $.ajax({
        type: 'GET',
        cache : false,
        data: {id:id},
        url: 'get-likes',
        success:function(response){
            $(`#like-${id}`).html(`${response} like(s)`)
        }
    })
}
function getComments(id){
    $.ajax({
        type: 'GET',
        cache : false,
        data: {id:id},
        url: 'get-comments',
        success:function(response){
            $(`#comment-${id}`).html(`${response} comment(s)`)
        }
    })
}


function recentComments(id){
    $.ajax({
        type: 'GET',
        cache : false,
        data: {id:id},
        url: 'get-recent-comments',
        success:function(response){
            let cmnts = '';
            for(let i = 0; i < response.length; i++){
                cmnts += ` <div class="recent-single-comment">
                <div class="recent-comment-username"><a target="_blank" href="profile/${response[i].user_name}">@${response[i].user_name}</a> <span class="time">${formatTimeAgo(response[i].created_at)}</span></div>
                <div class="recent-comment">${response[i].comment}</div>
            </div>`
            }
            $('.recent-single-comment').html(cmnts)
        }
    })
}
function formatTimeAgo(timestamp) {
    const currentDate = new Date();
    const providedDate = new Date(timestamp);

    const timeDifference = currentDate.getTime() - providedDate.getTime();
    const seconds = Math.floor(timeDifference / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);

    if (days > 0) {
        return `${days} day${days > 1 ? 's' : ''} ago`;
    } else if (hours > 0) {
        return `${hours} hour${hours > 1 ? 's' : ''} ago`;
    } else if (minutes > 0) {
        return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
    } else {
        return 'Just now';
    }
}
$('.no_comments').on('click', function(){
    $('.post-comments').addClass('on')
    let id = $(this).attr('cmnt-id');
    $('#comment_id').val(id);
    recentComments(id);
})

function scrollToBottom(){
    $(".chat-body").animate({ scrollTop: $('.chat-body').prop("scrollHeight")}, 1000);
}
function getMessages(other_id){
    $.ajax({
        type: 'GET',
        cache : false,
        data: {other_id:other_id},
        url: '../get-messages',
        success:function(response){
            $('.chat-body').html(response);
        }
    })
}

$('#send-msg').on('click', function(){
    let msg = $('#msg').val();
    let other_id = $('#other_id').val();
    let fileInput = document.getElementById('files');
    let files = fileInput.files;

    let formData = new FormData();
    formData.append('msg', msg);
    formData.append('other_id', other_id);

    for (let i = 0; i < files.length; i++) {
        formData.append('files[]', files[i]);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '../send-msg',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            // getMessages(other_id);
            $('#msg').val('');
            let imgs = '';
            let url = 'http://192.168.1.8/assets/chat';
            if(response.filenames.length>0){
                for(let i = 0; i < response.filenames.length; i++){
                    imgs+=  `<img src="${url}/${response.filenames[i]}" alt=""></img>`
                }
            }
            console.log(imgs);
            let msgBody = `<div class="msgg outgoing-msg"> <div class="chat-images">${imgs}</div>${response.msg}</div>`;
            $('.chat-body').append(msgBody);
            scrollToBottom();
        },
        error: function(error) {
            console.log(error);
        }
    });
});




scrollToBottom();

