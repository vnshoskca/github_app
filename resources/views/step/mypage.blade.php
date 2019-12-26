@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>{{__('Step My List') }}</h2>
      <div class="row">

        @foreach($steps as $step)

          <div class="col-md-6">
              <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">{{$step->title}}</h3>
                    <a href="{{ route('step.detail', $step->id) }}" class="btn btn-primary">{{__('Look Detail')}}</a>

                    <a href="{{ route('step.edit', $step->id) }}" class="btn btn-warning">{{__('Go Edit')}}</a>
                    
                    <form action="{{route('step.delete', $step->id) }}" method="post" class="d-inline">
                      @csrf
                      <button class="btn btn-danger" onclick="return confirm('削除しますか？');">
                        {{__('Go Delete')}}
                      </button>
                    </form>

                  </div>
              </div>
          </div>


        @endforeach

      </div>
  </div>
@endsection
