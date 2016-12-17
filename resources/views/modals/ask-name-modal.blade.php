<div id="ask-name-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">Seja bem vindo <strong>{{ $user->name}}</strong>, vamos construir seu personagem</h4>
      </div>
      <div class="modal-body">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        <form action="{{ url('/pick-nickname') }}" method="POST" id="nickname-form">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="PATCH">

          <div class="form-group">
            <label for="recipient-name" class="control-label">Escolha um nome para o seu personagem:</label>
            <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname', '') }}" placeholder="Escolha algo especial" maxlength="16">
          </div>

          <div class="alert alert-info"><strong>Seja criativo!</strong> Um bom nome de personagem faz toda diferença.</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onClick="document.querySelector('#nickname-form').submit()" class="btn btn-primary">Eu escolho este</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->