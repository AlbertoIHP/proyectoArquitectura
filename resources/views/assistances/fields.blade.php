<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::date('fecha', null, ['class' => 'form-control']) !!}
</div>

<!-- Hora Entrada Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hora_entrada', 'Hora Entrada:') !!}
    {!! Form::number('hora_entrada', null, ['class' => 'form-control']) !!}
</div>

<!-- Reemplazo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reemplazo', 'Reemplazo:') !!}
    {!! Form::text('reemplazo', null, ['class' => 'form-control']) !!}
</div>


<!-- Workers ID SE AGREGO PARA LA CLAVE FORANEA-->
<div class="form-group col-sm-6">
    {!! Form::label('worker_id', 'Worker Id:') !!}
    {!! Form::select('worker_id', $workers, null, ['class' => 'form-control'] ) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('assistances.index') !!}" class="btn btn-default">Cancel</a>
</div>
