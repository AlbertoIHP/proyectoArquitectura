<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<!-- Space ID SE AGREGO PARA LA CLAVE FORANEA-->
<div class="form-group col-sm-6">
    {!! Form::label('space_id', 'Space Id:') !!}
    {!! Form::select('space_id', $spaces, null, ['class' => 'form-control'] ) !!}
</div>

<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Capacidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('capacidad', 'Capacidad:') !!}
    {!! Form::number('capacidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('spaceTypes.index') !!}" class="btn btn-default">Cancel</a>
</div>
