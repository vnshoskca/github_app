@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>{{__('Step List') }}</h2>
      <div class="row">

        @foreach($steps as $step)

          <div class="col-md-6">
              <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">{{$step->title}}</h3>
                    <a href="{{ route('step.detail', $step->id) }}" class="btn btn-primary">{{__('Look Detail')}}</a>
                    
                  </div>
              </div>
          </div>

        @endforeach

      </div>
  </div>
@endsection
