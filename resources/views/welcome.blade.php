
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="/favicon.png" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="The best Web based RPG game you are going to find.">
    <meta name="author" content="Hudson Pereira">

    <title>Timongo RPG - Web Based</title>

    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/welcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="{{ url('/login') }}">Sign In</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Timongo RPG</h3>
      </div>

      <div class="jumbotron">
        <h1>Embrace yourselves</h1>
        <p class="lead">Join the army! Build up your character, join a guild, make some trading around the city. In a world full of magic and mysterious creatures, You are the hero.</p>
        <p><a class="btn btn-lg btn-primary" href="{{ url('/login') }}" role="button"> <i class="fa fa-facebook-official" aria-hidden="true"></i> Sign up today</a></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h2>Latest News</h2>

          <hr />

          <h4>Beta version is available!</h4>
          <p>To be a beta tester is to strongly support the game. If you're a beta tester, you'll get a badge on your character that will stand you out from anothers.</p>

          <h4>Enemies are coming</h4>
          <p>Our backs are agains the wall, but this is when we fight harder. Prepare to face the first raid of an age of war.</p>

          <h4>Designers. We need you.</h4>
          <p>Are you an experienced designer? Wanna to contribute? We need you.</p>
        </div>

        <div class="col-lg-6">
          <h2>Newcomers</h2>

          <hr />
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; 2016 Company, Inc.</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
