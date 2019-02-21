@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-center w-full">
            <p class="text-grey text-sm font-normal">
                <a href="/projects" class="text-grey text-sm font-normal no-underline">My Projects</a> / {{$project->title}}
            </p>
            <a href="/projects/create" class="button">New Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-grey font-normal text-lg mb-2">Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="post" action="{{$project->path() . '/tasks/' . $task->id}}">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                   <input class="w-full {{$task->completed? 'text-grey' : ''}}" name="body" value="{{$task->body}}">
                                   <input {{$task->completed? 'checked' : ''}} type="checkbox" name="completed" onchange="this.form.submit()">
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{$project->path() . '/tasks'}}" method="post">
                            @csrf
                            <input placeholder="Add a new task" name="body" class="w-full">
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-grey font-normal text-lg mb-2">General notes</h2>
                    <form action="{{$project->path()}}" method="post">
                        @csrf
                        @method('PATCH')
                        <textarea name="notes" class="card w-full mb-4" style="min-height: 200px" placeholder="Write some notes">{{$project->notes}}</textarea>
                        <button type="Submit" class="button">Submit</button>
                    </form>
                </div>
            </div>

            <div class="lg:w-1/4 px-3">
                @include('projects.card')
                @include('projects.activity.card')
            </div>
        </div>
    </main>
@endsection