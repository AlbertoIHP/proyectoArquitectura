<!-- Articulo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('articulo', 'Articulo:') !!}
    {!! Form::text('articulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Calendar ID SE AGREGO PARA LA CLAVE FORANEA-->
<div class="form-group col-sm-6">
    {!! Form::label('calendar_id', 'Calendar Id:') !!}
    {!! Form::select('calendar_id', $calendars, null, ['class' => 'form-control'] ) !!}
</div>

<!-- Maintainer ID SE AGREGO PARA LA CLAVE FORANEA-->
<div class="form-group col-sm-6">
    {!! Form::label('maintainer_id', 'Maintainer Id:') !!}
    {!! Form::select('maintainer_id', $maintainers, null, ['class' => 'form-control'] ) !!}
</div>


<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::date('fecha', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('maintenances.index') !!}" class="btn btn-default">Cancel</a>
</div>
