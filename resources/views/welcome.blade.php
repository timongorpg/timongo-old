<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head prefix="og: http://ogp.me/ns#">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Timongo RPG is the best Web based RPG game you are going to find. If you like old fashioned browser RPG. Join us.">
    <meta name="author" content="Hudson Pereira">

    <meta property="og:title" content="Timongo RPG é o melhor RPG baseado em browser que você vai encontrar. Se você gosta de RPG. Junte-se a nós." />
    <meta property="og:description" content="" />
    <meta property="og:url" content="https://timongo.com" />
    <meta property="og:image" content="/img/rpg-image.jpg" />

    <link rel="icon" href="/favicon.png" type="image/png">
    <meta name="google-site-verification" content="MBHwyhHzsE2Z2LjDNulm6opKNuRgtYlugEZUo5GdHVQ" />

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
            <li role="presentation" class="active"><a href="{{ url('/login') }}">Entrar</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Timongo RPG</h3>
      </div>

      <div class="jumbotron">
        <h1>Preparem-se</h1>
        <p class="lead">Junte-se ao exército! Construa seu personagem, junte-se a um clã, faça trocas pela cidade. Em um mundo repleto de magia e criaturas misteriosas: Você é o herói.</p>
        <p><a class="btn btn-lg btn-primary" href="{{ url('/login') }}" role="button"> <i class="fa fa-facebook-official" aria-hidden="true"></i> Eu sou o herói</a></p>
      </div>

      <div class="row marketing">
        <div class="col-md-6">
          <h2>Boletins</h2>

          <hr />

          <h4>A versão beta está disponível!</h4>
          <p>Ser um beta tester é contribuir em peso para a construção do game. Se você é um beta tester, você receberá um ícone que te diferenciará dos demais.</p>

          <h4>Os inimigos estão chegando</h4>
          <p>Estamos sem saída, mas agora é quando temos que usar todas as nossas forças. Prepare-se para o primeiro combate de uma era de guerra.</p>

          <h4>Ilustradores. Precisamos de vocês.</h4>
          <p>Você é um designer experiente? Quer contribuir? <a href="mailto:help@timongo.com">Clique aqui para entrar em contato.</a></p>
        </div>

        <div class="col-md-6">
          <h2>Os mais poderosos</h2>

          <hr />

          @foreach($elite as $user)
            <h4>{{ $user->nickname }}</h4><span class="label label-success">{{ $user->getProfessionName() }}</span>
            <p><strong>{{ $user->nickname }}</strong> {{ $user->level > 1 ? 'já' : '' }} está level {{ $user->level }}.</p>
          @endforeach
        </div>
      </div>

      <footer class="footer">
        <div class="col-xs-6 text-left">
          <a href="mailto:help@timongo.com">Envie feedback</a>
        </div>

        <div class="col-xs-6 text-right">
          <a href="/privacy" target="_blank">Políticas de privacidade</a>
        </div>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
