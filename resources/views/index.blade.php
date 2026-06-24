<!DOCTYPE html>
<html>
<head>
    <title>Todo Manager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
<div class="container py-5">

    <h2 class="mb-4">Todo Manager</h2>

    <div class="row">

        @foreach($categories as $category)

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm">

                <div class="card-header">

                    <div class="category-name">{{ $category->name }}</div>

                    <form
                        action="{{ route('categories.update',$category) }}"
                        method="POST"
                        class="d-none category-edit-form mt-2">

                        @csrf
                        @method('PUT')

                        <input
                            type="text"
                            name="name"
                            class="form-control mb-2"
                            value="{{ $category->name }}">

                        <button class="btn btn-success btn-sm">
                            Update
                        </button>

                    </form>

                </div>

                <div class="card-body">
                    @if($category->todos->isEmpty())
                        <p class="text-muted">No todos yet. Add one!</p>
                    @else
                    @foreach($category->todos as $todo)

                    <div class="border rounded p-2 mb-2">

                        <div class="todo-title">

                            {{ $todo->title }}

                            <span class="badge bg-{{ $todo->status=='completed' ? 'success' : 'warning' }}">
                                {{ $todo->status }}
                            </span>

                        </div>

                        <form
                            action="{{ route('todos.update',$todo) }}"
                            method="POST"
                            class="d-none todo-edit-form mt-2">

                            @csrf
                            @method('PUT')

                            <input
                                type="text"
                                class="form-control mb-2"
                                name="title"
                                value="{{ $todo->title }}">

                            <button class="btn btn-success btn-sm">
                                Update
                            </button>

                        </form>

                        <div class="mt-2 d-flex gap-2 flex-wrap">

                            <button
                                class="btn btn-primary btn-sm editTodoBtn">
                                Edit
                            </button>

                            <form
                                action="{{ route('todos.toggle',$todo) }}"
                                method="POST">

                                @csrf
                                @method('PATCH')

                                <button class="btn btn-warning btn-sm">
                                    Toggle
                                </button>

                            </form>

                            <form
                                action="{{ route('todos.destroy',$todo) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                    @endforeach
                    @endif
                    <form
                        action="{{ route('todos.store') }}"
                        method="POST"
                        class="d-none addTodoForm mt-3">

                        @csrf

                        <input
                            type="hidden"
                            name="category_id"
                            value="{{ $category->id }}">

                        <input
                            class="form-control mb-2"
                            type="text"
                            name="title"
                            placeholder="Todo Title">

                        <button class="btn btn-success w-100">
                            Save
                        </button>

                    </form>
                    <button
                        class="btn btn-outline-primary w-100 addTodoBtn">
                        Add Todo
                    </button>

                    

                </div>

                <div class="card-footer d-flex gap-2">

                    <button
                        class="btn btn-secondary btn-sm editCategoryBtn">
                        Edit
                    </button>

                    <form
                        action="{{ route('categories.destroy',$category) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <form
        action="{{ route('categories.store') }}"
        method="POST"
        id="categoryForm"
        class="d-none mt-3">

        @csrf

        <input
            type="text"
            class="form-control mb-2"
            name="name"
            placeholder="Category Name">

        <button class="btn btn-primary">
            Save Category
        </button>

    </form>
    <button
        class="btn btn-success mt-3"
        id="showCategoryForm">
        Add Category
    </button>


</div>

<script>

document.getElementById('showCategoryForm').onclick=function(){

    if(this.innerText=='Add Category'){
        this.innerText='Cancel';
    }
    else{
        this.innerText='Add Category';
    }
    document.getElementById('categoryForm').classList.toggle('d-none');

}

document.querySelectorAll('.addTodoBtn').forEach(btn=>{

    btn.onclick=function(){
        if(btn.innerText=='Add Todo'){
            btn.innerText='Cancel';
        }
        else{
            btn.innerText='Add Todo';
        }
        btn.previousElementSibling.classList.toggle('d-none');

    }

})

document.querySelectorAll('.editCategoryBtn').forEach(btn=>{

    btn.onclick=function(){
        if(btn.innerText=='Edit'){
            btn.innerText='Cancel';
        }
        else{
            btn.innerText='Edit';
        }
        let card=btn.closest('.card');

        card.querySelector('.category-name').classList.toggle('d-none');

        card.querySelector('.category-edit-form').classList.toggle('d-none');

    }

})

document.querySelectorAll('.editTodoBtn').forEach(btn=>{

    btn.onclick=function(){
        if(btn.innerText=='Edit'){
            btn.innerText='Cancel';
        }
        else{
            btn.innerText='Edit';
        }
        let box=btn.closest('.border');

        box.querySelector('.todo-title').classList.toggle('d-none');

        box.querySelector('.todo-edit-form').classList.toggle('d-none');

    }

})

</script>

</body>
</html>