@extends('layouts.applayout')

@section('content')
    <div class="row">
        <div class="col">
            <form method="POST" action="{{route('students-update')}}">
                @csrf
                <input type="hidden" name="id" value="{{$students->id}}">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" value="{{old('first_name',$students->first_name)}}" class="col-md-6 form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" aria-describedby="first_name" placeholder="First Name">
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" value="{{old('last_name',$students->last_name)}}" class="col-md-6 form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" aria-describedby="last_name" placeholder="Last Name">
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" value="{{old('address',$students->address)}}" class="form-control @error('address') is-invalid @enderror" id="address" name="address" aria-describedby="address" placeholder="Address">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="{{old('email',$students->email)}}" class="col-md-6 form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="email" placeholder="Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="grade_id">Grade</label>
                    <select class="form-control col-md-4" name="grade_id" id="grade_id">
                        @foreach($grades as $g)
                            <option {{$g->id == $students->grade_id ? 'selected' : ''}} value="{{$g->id}}">{{$g->grade}}</option>
                        @endforeach
                    </select>
                    @error('grade_id')
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
