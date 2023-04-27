function show(param) {
  if(param == 'info') {
    if($('.popup-information').hasClass('show-off')) {
      $('.popup-information').removeClass('show-off');
    } else {
      $('.popup-information').addClass('show-off');
    }
    
  }
  if(param == 'notification') {
    if($('.popup-notification').hasClass('show-off')) {
      $('.popup-notification').removeClass('show-off');
    } else {
      $('.popup-notification').addClass('show-off');
    }
    
  }
  if(param == 'login') {
    $('#modal-login').css('display', 'flex');
  }
}

$(document).keydown(function(e) {
  if (e.keyCode === 27) {
    e.stopPropagation();
    $('#modal-login').fadeOut();
  }
});

$('.overlay').click(function(e) {
  $('#modal-login').fadeOut();
});	

function close(param) {
  $('#modal-login').css('display', 'none');

}
// $('#list-information').hover(function() {
//   if($('.popup-information').hasClass('show-off')) {
//     $('.popup-information').removeClass('show-off');
//   } else {
//     $('.popup-information').addClass('show-off');
//   }
// })


function href(link) {
    window.location.href = link;
}

function like_topic(topic_id) {
  $.ajax({
    url: '/core/topic/like-topic.php', 
    type: 'POST',
    data: {
      topic_id: topic_id
    },
    success: function(response) {
      console.log(response)
      
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert('Ошибка при отправке данных на сервер!');
    }
  });
}

function like_comment(comment_id) {
  $.ajax({
    url: '/core/comment/like-comment.php', 
    type: 'POST',
    data: {
      comment_id: comment_id
    },
    success: function(response) {
      console.log(response)
      
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert('Ошибка при отправке данных на сервер!');
    }
  });
}

function login() {
  const username = $('#auth-login').val();
  const password = $('#auth-password').val();

  if(username.length < 2 || password.length < 6) {
      alert('[js] заполните все поля');
      return;
  }

  $.ajax({
    url: 'core/auth/login.php', 
    type: 'POST',
    data: {
      username: username,
      password: password
    },
    success: function(response) {
      console.log(response)
      if(response == '[login] ok') {
        href('/')
      }
      
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert('Ошибка при отправке данных на сервер!');
    }
  });
}

function register() {
    const username = $('#auth-login').val();
    const email = $('#auth-email').val();
    const password = $('#auth-password').val();
    const rePassword = $('#auth-re-password').val();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(username.length < 2 || email.length == 0 || password.length < 6 || password !== rePassword || !emailRegex.test(email)) {
        alert('[js] заполните все поля');
        return;
    }
  
    $.ajax({
      url: 'core/auth/register.php', 
      type: 'POST',
      data: {
        username: username,
        email: email,
        password: password
      },
      success: function(response) {
        console.log(response)
        alert(response);
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        alert('Ошибка при отправке данных на сервер!');
      }
    });
}

function filterAuthLogin() {
    const loginValue = $('#auth-login').val();
    const filteredValue = loginValue.replace(/[^a-zA-Z0-9]/g, '');
    if(loginValue.length > 2) {
        $('#auth-login').css('border', '1px solid rgba(0,0,0,.1)');
    } else {
        $('#auth-login').css('border', '1px solid red');
    }
    if (loginValue !== filteredValue) {
        $('#auth-login').val(filteredValue);
    }
}
function filterAuthPassword() {
    const passwordInput = $('#auth-password');
    const passwordValue = $('#auth-password').val();
    if(passwordValue.length < 6) {
        passwordInput.css('border', '1px solid red');
    } else {
        passwordInput.css('border', '1px solid rgba(0,0,0,.1)');
    }
}

function filterAuthEmail() {
    const emailValue = $("#auth-email").val();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    if (!emailRegex.test(emailValue)) {
      
      $("#auth-email").css('border', '1px solid red');
    } else {
      
      $("#auth-email").css('border', '1px solid rgba(0,0,0,.1)');
    }
}

function filterTopicTags () {
  // const tags = $('#create-topic-tags').val();
  // const char = tags.substr(-1, 1);
  // if(char == ' ') {
  //   if(tags != '') {
  //     $('.tags').append('<div class="tag">' + tags + '</div>')
  //     $('#create-topic-tags').val(' ');
  //   }
    
  // }
}

function createTopic(forum_id) {
  const title = $('#create-topic-title').val();
  const description = $('#create-topic-description').val();
  const tags = $('#create-topic-tags').val();

  // if(title.length == 0 && title.length > 20 || description)

  $.ajax({
    url: '/core/topic/create-topic.php', 
    type: 'POST',
    data: {
      title: title,
      description: description,
      tags: tags,
      forum_id: forum_id
    },
    success: function(response) {
      console.log(response)     
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert('Ошибка при отправке данных на сервер!');
    }
  });
}

function createComments(topic_id) {
  updateComments(topic_id)
  message = $('#comment-message').val();
  $('#comment-message').val('')
  if(message.length <= 1) {
      console.log('[js] заполните поля');
      return;
  }

  $.ajax({
      url: '/core/comment/create-comment.php', 
      type: 'POST',
      data: {
      topic_id: topic_id,
      message: message
      },
      success: function(response) {
      
      },
      error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert('Ошибка при отправке данных на сервер!');
      }
  });

}

function updateComments(topic_id) {
$.ajax({
url: '/core/comment/get-comment.php', 
type: 'GET',
data: {
topic_id: topic_id
},
success: function(response) {
$('#up-com').html(response);
},
error: function(jqXHR, textStatus, errorThrown) {
console.log(textStatus, errorThrown);
alert('Ошибка при отправке данных на сервер!');
}
});
}