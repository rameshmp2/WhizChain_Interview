@extends('layouts.applayout')

@section('content')
    <div class="row">
        <div class="col">
            <form method="POST" action="{{route('subjects-store')}}">
                @csrf
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" value="{{old('subject')}}" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" aria-describedby="subject" placeholder="Subject">
                    @error('subject')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
