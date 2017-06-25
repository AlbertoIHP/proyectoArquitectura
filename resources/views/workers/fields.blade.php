<!-- User ID SE AGREGO PARA LA CLAVE FORANEA-->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control'] ) !!}
</div>

<!-- Shifttype ID SE AGREGO PARA LA CLAVE FORANEA-->
<div class="form-group col-sm-6">
    {!! Form::label('shifttype_id', 'Shifttype Id:') !!}
    {!! Form::select('shifttype_id', $shifttypes, null, ['class' => 'form-control'] ) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('workers.index') !!}" class="btn btn-default">Cancel</a>
</div>
