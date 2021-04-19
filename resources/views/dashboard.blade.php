@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <table class="table">
                        <thead>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date and Time</th>
                        </thead>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description}}</td>
                                <td>{{ $task->created_at}}</td>
                            </tr>
                         @endforeach
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
