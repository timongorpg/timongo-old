<div id="ask-name-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">Welcome {{ $user->name}}, let's build your character</h4>
      </div>
      <div class="modal-body">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        <form action="{{ url('/pick-nickname') }}" method="POST" id="nickname-form">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="PATCH">

          <div class="form-group">
            <label for="recipient-name" class="control-label">Pick a name for your character:</label>
            <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname', '') }}" placeholder="Make it special" maxlength="16">
          </div>

          <div class="alert alert-info"><strong>Be creative!</strong> A strong character name makes all the difference.</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onClick="document.querySelector('#nickname-form').submit()" class="btn btn-primary">Let's do this</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->