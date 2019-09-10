@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        Error: {{ $error }}
                    </div>
                    @endforeach
                    @endif
                    <form action="{{ route('tasks.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="taskTitle">Task Title</label>
                            <input type="text" class="form-control" id="taskTitle" name="taskTitle" aria-describedby="taskTitle" placeholder="Enter The Task Name">
                        </div>
                        <div class="form-group">
                            <label for="taskDesc">Task Description</label>
                            <textarea class="form-control" id="taskDesc" name="taskDesc" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="taskStatus">Task Status</label>
                            <select class="form-control" id="taskStatus" name="taskStatus">
                                <option value="1">Active</option>
                                <option value="0">Pasive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskPin">Task Pin</label>
                            <select class="form-control" id="taskPin" name="taskPin">
                                <option value="1">Pinned</option>
                                <option value="0" selected>No Pinned</option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save The Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
