@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Space
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($space, ['route' => ['spaces.update', $space->id], 'method' => 'patch']) !!}

                        @include('spaces.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection