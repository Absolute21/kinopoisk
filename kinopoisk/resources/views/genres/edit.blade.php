@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Редактировать жанр</h2>

    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Название жанра</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $genre->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection