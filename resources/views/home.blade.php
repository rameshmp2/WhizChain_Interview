@extends('layouts.applayout')

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">{{$total_students}}</h5>
                    <p class="card-text">Total Students</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">{{$total_subjects}}</h5>
                    <p class="card-text">Total Subjects</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body bg-primary text-white">
                    <h5 class="card-title">0</h5>
                    <p class="card-text">Total Exams</p>
                </div>
            </div>
        </div>
    </div>
@endsection
