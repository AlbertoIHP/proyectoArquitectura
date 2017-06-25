@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Worker
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($worker, ['route' => ['workers.update', $worker->id], 'method' => 'patch']) !!}

                        @include('workers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection