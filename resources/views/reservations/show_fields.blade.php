<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $reservation->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $reservation->name !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $reservation->user_id !!}</p>
</div>

<!-- Space Id Field -->
<div class="form-group">
    {!! Form::label('space_id', 'Space Id:') !!}
    <p>{!! $reservation->space_id !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{!! $reservation->fecha !!}</p>
</div>

<!-- Pagado Field -->
<div class="form-group">
    {!! Form::label('pagado', 'Pagado:') !!}
    <p>{!! $reservation->pagado !!}</p>
</div>

<!-- Cliente Field -->
<div class="form-group">
    {!! Form::label('cliente', 'Cliente:') !!}
    <p>{!! $reservation->cliente !!}</p>
</div>

