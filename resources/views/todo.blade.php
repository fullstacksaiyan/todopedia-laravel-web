<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todopedia - Kerjain aja dulu</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <h1 class="text-white text-center mt-4">Todopedia</h1>
                <div class="card">
                    <div class="card-body">
                        @if (session("info"))
                            <div class="alert alert-success">{{ session("info") }}</div>
                        @endif
                        <form action="{{route("todo.store")}}" method="POST" autocomplete="off">
                            @csrf
                            <div class="input-group has-validation">
                                <input type="text" class="form-control @error("descriptions") is-invalid @enderror" name="descriptions" id="" placeholder="Input Todo" autofocus>
                                <button type="submit" class="btn btn-success">Add</button>
                                @error('descriptions')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </form>
                        <div class="div">
                            @foreach ($todoItems as $todo)
                                <div class="input-group mb-3">
                                    <label for="" class="form-control
                                        {{$todo->status==="COMPLETED"?"border-success text-success text-decoration-line-through":"bg-light"}}">{{ $todo->descriptions }}</label>
                                    @unless ($todo->status === "COMPLETED")
                                        <button class="btn btn-outline-success" type="button"
                                            onclick="document.getElementById('updateTodo-{{$todo->id}}').submit()">Complete</button>
                                        <form  id="updateTodo-{{$todo->id}}" action="{{route("todo.update",$todo)}}" method="POST">
                                            @csrf
                                            @method("PUT")
                                        </form>
                                    @endunless
                                    <button class="btn btn-danger" type="button"
                                        onclick="document.getElementById('deleteTodo-{{$todo->id}}').submit()">Delete</button>
                                    <form id="deleteTodo-{{$todo->id}}" action="{{ route("todo.destroy",$todo) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        @isset($todo)
                            <p>You have <strong>{{ $todo->where("status","pending")->count() }}</strong> pending todo</p>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
