@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($tasks) > 0)
                        <table class="table">
                            <thead>
                                <th width="10%">ID</th>
                                <th width="50%">Name</th>
                                <th width="10%">Status</th>
                                <th width="10%">Change Status</th>
                                <th width="10%">Delete</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th>{{ $task->id }}</th>
                                        <td><a href="{{ route('tasks.show', [$task->id]) }}">{{ $task->title }}</a></td>
                                        <td>
                                            @if ($task->status == '1')
                                                <font color='green'><b>Active</b></font>
                                            @else
                                                <font color='red'><b>Pasive</b></font>
                                            @endif
                                        </td>
                                        <td>
                                            <b>
                                                <form action="{{ route('tasks.status', $task->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                    <input type="submit" value="Change Status" class="btn btn-secondary">
                                                </form>
                                            </b>
                                        </td>
                                        <td>
                                             <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" id="deleteForm">
                                                 {{ csrf_field() }}
                                                 {{ method_field('DELETE') }}
                                                 <input type="submit" value="Delete" class="btn btn-danger">
                                             </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $tasks->links() }}
                    @else
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Change Status</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4">Tasks Not Found</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
