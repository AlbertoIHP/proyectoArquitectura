<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $payment->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $payment->user_id !!}</p>
</div>

<!-- Mes Field -->
<div class="form-group">
    {!! Form::label('mes', 'Mes:') !!}
    <p>{!! $payment->mes !!}</p>
</div>

<!-- Anio Field -->
<div class="form-group">
    {!! Form::label('anio', 'Anio:') !!}
    <p>{!! $payment->anio !!}</p>
</div>

<!-- Monto Field -->
<div class="form-group">
    {!! Form::label('monto', 'Monto:') !!}
    <p>{!! $payment->monto !!}</p>
</div>

<!-- Pagado Field -->
<div class="form-group">
    {!! Form::label('pagado', 'Pagado:') !!}
    <p>{!! $payment->pagado !!}</p>
</div>

