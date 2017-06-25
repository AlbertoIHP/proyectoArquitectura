<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Building ID SE AGREGO PARA LA CLAVE FORANEA-->
<div class="form-group col-sm-6">
    {!! Form::label('building_id', 'Building Id:') !!}
    {!! Form::select('building_id', $buildings, null, ['class' => 'form-control'] ) !!}
</div>

<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control']) !!}
</div>

<!-- Mes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mes', 'Mes:') !!}
    {!! Form::number('mes', null, ['class' => 'form-control']) !!}
</div>

<!-- Anio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('anio', 'Anio:') !!}
    {!! Form::number('anio', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('expenses.index') !!}" class="btn btn-default">Cancel</a>
</div>
