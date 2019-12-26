@extends('layouts.app')

@section('content')

<div id="app">
    
      <example-component
        title="{{ __('Detail STEP').'「'.$step->title.'」'}}"
        :step="{{$step}}" 
        >

      </example-component>
      
</div>



@endsection
