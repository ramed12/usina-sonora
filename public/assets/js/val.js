grecaptcha.ready(function() {
    grecaptcha.execute('6LdOIK8cAAAAAMIX8eQnmuP8v1qgIuPZnbxtIj64', {action: 'submit'}).then(function(token) {
        document.getElementById('g_recaptcha_response').value = token;
        return false;
    });
  });