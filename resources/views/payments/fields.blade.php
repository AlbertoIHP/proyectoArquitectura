
<!-- User ID SE AGREGO PARA LA CLAVE FORANEA-->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control'] ) !!}
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

<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control']) !!}
</div>

<!-- Pagado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pagado', 'Pagado:') !!}
    {!! Form::text('pagado', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('payments.index') !!}" class="btn btn-default">Cancel</a>
</div>
