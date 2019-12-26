@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Step Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('step.create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        


                        @for($i=1; $i<=3; $i++)
                        <div class="form-group row">
                            <label for="naiyou0" class="col-md-4 col-form-label text-md-right">{{ __('Naiyou').$i }}</label>

                            <div class="col-md-6">
                                <input id="naiyou{{$i - 1}}" type="text" class="form-control @error('naiyou'.($i - 1)) is-invalid @enderror" name="naiyou{{$i - 1}}" value="{{ old('naiyou'.($i - 1)) }}" autocomplete="naiyou{{$i - 1}}" autofocus>

                                @error('naiyou'.($i - 1))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endfor


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
