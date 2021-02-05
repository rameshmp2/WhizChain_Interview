@extends('layouts.applayout')

@section('content')
    <div class="row">
        <div class="col">
            <form method="POST" action="{{route('marks-store')}}">
                @csrf

                <div class="form-group">
                    <label for="student_id">Student</label>
                    <select class="form-control col-md-4" name="student_id" id="student_id">
                        @foreach($students as $g)
                            <option value="{{$g->id}}">{{'STID'.$g->id.' : '.$g->first_name.' ',$g->last_name}}</option>
                        @endforeach
                    </select>
                    @error('student_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="marks">Marks</label>
                    <input type="number" min="0" max="100" value="{{old('marks')}}" class="col-md-6 form-control @error('marks') is-invalid @enderror" id="marks" name="marks" aria-describedby="marks" placeholder="Marks">
                    @error('marks')
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
