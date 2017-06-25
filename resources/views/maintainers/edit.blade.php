@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Maintainer
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($maintainer, ['route' => ['maintainers.update', $maintainer->id], 'method' => 'patch']) !!}

                        @include('maintainers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection