@extends('layouts.applayout')

@section('content')

    <div class="row">
        <div class="col">
            <a href="{{route('subjects-create')}}" class="btn btn-primary float-right pb-1">Add New Subject</a>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col">
            <div class="col table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($subjects as $sub)
                        <tr>
                            <td>{{$sub->id}}</td>
                            <td>{{$sub->subject}}</td>
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
                                <a href="{{route('subjects-edit',['id'=>$sub->id])}}" class="btn btn-secondary">Edit</a>
                                <button class="btn btn-danger btn_subject" id="{{$sub->id}}">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Records Found.</td>
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
            <div class="dataTables_info">Showing {{ $subjects->firstItem() }}
                to {{ $subjects->lastItem() }} of {{ $subjects->total() }} entries
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            {{ $subjects->appends($data)->links() }}
        </div>
    </div>

@endsection
