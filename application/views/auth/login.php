<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Login</title>

        <!-- css's -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- <link href="<?php //echo base_url(); ?>assets/main.css" rel="stylesheet"> -->
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <!-- css's -->
    </head>

  <body>
  <style>
    body {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }
  </style>
    <nav role="navigation">
      <div class="nav-wrapper container"><a id="logo-container" href="<?php echo base_url(); ?>" class="brand-logo">SINILAI AL-ISHLAH</a></div>
    </nav>
        
    <main>
      <div class="container login-box">
        <div class="card z-depth-5">
          <div class="card-content">
            <span class="card-title">Login</span>
            <div class="row">
              <form class="col s12" id="login-form" method="post" action="<?php echo base_url('auth/login'); ?>">
                <div class="row">
                  <?php if(validation_errors()): ?>
                  <div class="col s12">
                    <div class="card-panel red">
                      <span class="white-text"><?php echo validation_errors('<p>', '</p>'); ?></span>
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="input-field col m12">
                    <input id="username" type="text" class="validate" name="username">
                    <label for="username">Username</label>
                  </div>
                  <div class="input-field col m12">
                    <input id="password" type="password" class="validate" name="password">
                    <label for="password" data-error="Password yang anda masukkan salah">Password</label>
                  </div>
                  <div class="input-field col m12 right-align">
                    <button class="btn waves-effect waves-light btn-login amber" type="submit" name="submit" value="login">
                      Submit <i class="material-icons right">send</i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>

    <footer class="page-footer">
      <div class="footer-copyright">
        <div class="container center-align">
          <a class="white-text text-lighten-3" href="https://fityanrahman.me">Made With 	&hearts; Madrasah Diniyyah Al-Ishlah 2018</a>
        </div>
      </div>
    </footer>
  <!-- js's -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/side.js"></script>
  <!-- js's -->

  </body> <!-- menutup body dari header-->
</html> <!-- menutup html dari header-->