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
                    <form action="{{ route('tasks.update', [$task->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="taskTitle">Task Title</label>
                            <input type="text" class="form-control" id="taskTitle" name="taskTitle" aria-describedby="taskTitle" placeholder="Enter The Task Name" value="{{ $task->title }}">
                        </div>
                        <div class="form-group">
                            <label for="taskDesc">Task Description</label>
                            <textarea class="form-control" id="taskDesc" name="taskDesc" rows="5">{{ $task->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="taskStatus">Task Status</label>
                            <select class="form-control" id="taskStatus" name="taskStatus">
                                @if ($task->status == 1)
                                    <option value="1" selected>Active</option>
                                    <option value="0">Pasive</option>
                                @else
                                    <option value="1">Active</option>
                                    <option value="0" selected>Pasive</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskPin">Task Pin</label>
                            <select class="form-control" id="taskPin" name="taskPin">
                                @if ($task->pin == 1)
                                    <option value="1" selected>Pinned</option>
                                    <option value="0">No Pinned</option>
                                @else
                                    <option value="1">Pinned</option>
                                    <option value="0" selected>No Pinned</option>
                                @endif
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

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('form').ajaxForm({
                beforeSubmit:function(){

                },
                success:function(response){
                    swal(
                      'Update Successful!',
                      'The changes were saved with success.',
                      'success'
                    )
                },
                error:function(response){
                    var resp = $.parseJSON(response.responseText);
                    var result = "";
                    
                    for(var i in resp) {
                       result = result + resp[i] + "\n";
                    }

                    swal(
                      'Update Failed',
                      result,
                      'error'
                    )
                }
            });
        });
    </script>
@endsection
