// cette fonction envoie l'événement socket "login"
function login() {
    socket.emit('login', {
      nom_utilisateur : byId('login_utilisateur').value,
      password : byId('login_password').value
    });
  }
  
  function verifier_enter(event, form, callback) {
    // fonction tirée de  http://stackoverflow.com/questions/14251676/
    var code = (event.keyCode ? event.keyCode : event.which);
    if(code === 13) {
      callback();
    }
  }
  
  // met les zones de texte en rouge et affiche le message d'erreur
  socket.on('erreur_login', function() {
    byId('form_login_utilisateur').className += ' has-error';
    byId('form_login_password').className += ' has-error';
    byId('login_incorrect').style.display = 'inline';
  });
  
  // redirige l'utilisateur vers l'URL indiquée dans l'événement socket
  // (en l'occurence, la page "token")
  socket.on('redirection', function(url) {
    window.location.assign(url);
  });