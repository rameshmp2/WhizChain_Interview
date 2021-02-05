@extends('layouts.applayout')

@section('content')

    <div class="row">
        <div class="col">
            <a href="{{route('students-create')}}" class="btn btn-primary float-right pb-1">Add New Student</a>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col">
            <div class="col table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Grade</th>
                        <th>Register Date</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($students as $sub)
                        <tr>
                            <td>{{$sub->id}}</td>
                            <td>{{$sub->first_name}}</td>
                            <td>{{$sub->last_name}}</td>
                            <td>{{$sub->address}}</td>
                            <td>{{$sub->email}}</td>
                            <td>{{$sub->grade->grade}}</td>
                            <td>{{$sub->register_date}}</td>
                            <td>
                                @if($sub->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Deleted</span>
                                @endif
                            </td>
                            <td>{{$sub->created_at}}</td>
                            <td>{{$sub->updated_at}}</td>
                            <td>
                                @if($sub->status == 1)
                                <a href="{{route('students-edit',['id'=>$sub->id])}}" class="btn btn-secondary">Edit</a>
                                <button class="btn btn-danger btn_studetns" id="{{$sub->id}}">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11">No Records Found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="dataTables_info">Showing {{ $students->firstItem() }}
                to {{ $students->lastItem() }} of {{ $students->total() }} entries
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            {{ $students->appends($data)->links() }}
        </div>
    </div>

@endsection
