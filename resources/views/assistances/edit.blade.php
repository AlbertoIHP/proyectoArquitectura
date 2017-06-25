@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Assistance
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($assistance, ['route' => ['assistances.update', $assistance->id], 'method' => 'patch']) !!}

                        @include('assistances.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection