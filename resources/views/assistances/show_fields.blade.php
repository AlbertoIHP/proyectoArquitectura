<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $assistance->id !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{!! $assistance->fecha !!}</p>
</div>

<!-- Hora Entrada Field -->
<div class="form-group">
    {!! Form::label('hora_entrada', 'Hora Entrada:') !!}
    <p>{!! $assistance->hora_entrada !!}</p>
</div>

<!-- Reemplazo Field -->
<div class="form-group">
    {!! Form::label('reemplazo', 'Reemplazo:') !!}
    <p>{!! $assistance->reemplazo !!}</p>
</div>

<!-- Worker Id Field -->
<div class="form-group">
    {!! Form::label('worker_id', 'Worker Id:') !!}
    <p>{!! $assistance->worker_id !!}</p>
</div>

