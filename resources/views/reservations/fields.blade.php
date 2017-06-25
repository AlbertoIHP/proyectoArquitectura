<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- User ID SE AGREGO PARA LA CLAVE FORANEA-->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control'] ) !!}
</div>


<!-- Space ID SE AGREGO PARA LA CLAVE FORANEA-->
<div class="form-group col-sm-6">
    {!! Form::label('space_id', 'Space Id:') !!}
    {!! Form::select('space_id', $spaces, null, ['class' => 'form-control'] ) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::date('fecha', null, ['class' => 'form-control']) !!}
</div>

<!-- Pagado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pagado', 'Pagado:') !!}
    {!! Form::text('pagado', null, ['class' => 'form-control']) !!}
</div>

<!-- Cliente Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cliente', 'Cliente:') !!}
    {!! Form::text('cliente', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('reservations.index') !!}" class="btn btn-default">Cancel</a>
</div>
