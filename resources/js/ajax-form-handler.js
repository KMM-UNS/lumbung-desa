var initFormHandler = function () {
    let form = $('form');

    function hasValue(obj, key, value) {
      return obj.hasOwnProperty(key) && obj[key] === value;
    }

    form.on('submit', e => {
      let tid, data, action, method, target, redirect, backWhenSucceed, ownMethodIndex;
      e.preventDefault();
      target = e.target;
      data = $(target).serializeArray();
      action = $(target).prop('action');
      method = $(target).prop('method');
      redirect = $(target).attr('redirect');
      backWhenSucceed = $(target).attr('redirect-back');
      tid = $(target).attr('id');
      (!tid) ? tid = $(target).attr('name') : 'form.submit';


      ownMethodIndex = data.findIndex(d => {
        return hasValue(d, 'name', '_method')
      })
      if (ownMethodIndex !== -1) {
        method = data[ownMethodIndex].value;
      }

      //remove null or empty value
      data = data.filter(x => {
        if (x.value) return true;
      });

      $.ajax({
        url: action,
        method,
        data,
        dataType: 'json',
        error: function (err) {
          window.location.reload()
          console.error('form submit', err, 'tid:', tid)
          $.event.trigger(`${tid}.error`, err)
        },
        success: function (res) {
          console.info('form submit', res, 'tid:', tid)
          console.info('redirect?', redirect)
          console.info('back?', backWhenSucceed)
          $.event.trigger(`${tid}.success`, res)

          if (redirect) {
            window.location.replace(redirect);
            return
          }
          if (backWhenSucceed && backWhenSucceed !== "false") {
            window.location = document.referrer;
            return
          }
          if (!redirect || !backWhenSucceed || backWhenSucceed == "false") {
            window.location.reload();
            return
          }
        }
      })
    })
  }


  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    initFormHandler();
  });
