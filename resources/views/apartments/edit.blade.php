@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Apartment
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($apartment, ['route' => ['apartments.update', $apartment->id], 'method' => 'patch']) !!}

                        @include('apartments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection