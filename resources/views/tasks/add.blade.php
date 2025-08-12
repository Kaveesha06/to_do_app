@extends("layouts.default")

@section("content")

<div class="d-flex align-items-center">

    <div class="container card shadow-sm" style="margin-top:100px; max-width: 500px">

    <div class="fs-3 fw-bold text-center mt-4">Add new task</div>
        <form class="p-3 mt-4" method="POST" action="{{ route("task.add.post") }}">
            @csrf

            <div class="mb-3">
                <input type="text" name="title" class="form-control">
            </div>

            <div>
                <input type="datetime-local" class="form-control" name="deadline">
            </div>

            <div class="mb-3">
                <textarea name="description" class="form-control" rows="3"> </textarea>
            </div>
            <button type="submit" class="btn btn-primary rounded-pill">Confirm</button>
        </form>
    </div>
</div>

@endsection