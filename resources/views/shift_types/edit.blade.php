@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Shift Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($shiftType, ['route' => ['shiftTypes.update', $shiftType->id], 'method' => 'patch']) !!}

                        @include('shift_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection