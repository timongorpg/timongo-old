<div class="panel panel-default">
    <div class="panel-heading">{{ trans('professions.choose-your-profession') }}</div>

    <div class="panel-body profession-panel">
        <form action="{{ url('/profession') }}" method="POST" id="profession-form">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="profession_id">
        </form>

        <div class="col-md-4 text-center" onClick="selectProfession(2)">
            <img src="/img/icons/pointy-sword.png" alt="{{ trans('professions.2') }}">

            <h4>{{ trans('professions.2') }}</h4>
        </div>

        <div class="col-md-4 text-center" onClick="selectProfession(3)">
            <img src="/img/icons/wizard-staff.png" alt="{{ trans('professions.3') }}">

            <h4>{{ trans('professions.3') }}</h4>
        </div>

        <div class="col-md-4 text-center" onClick="selectProfession(4)">
            <img src="/img/icons/pocket-bow.png" alt="{{ trans('professions.4') }}">

            <h4>{{ trans('professions.4') }}</h4>
        </div>

    </div>
</div>

@section('scripts')
    <script>
        function selectProfession(professionId) {
            document.querySelector('[name=profession_id]').value = professionId;
            document.querySelector('#profession-form').submit();
        }
    </script>
@endsection

@section('styles')
    <style>
        .profession-panel > div:hover{
            cursor: pointer;
        }
    </style>
@endsection