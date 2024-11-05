@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Список фильмов</h1>
    <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Добавить новый фильм</a>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Название</th>
                <th>Жанр</th>
                <th>Описание</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
            <tr>
                <td>
                    <a href="#" data-toggle="modal" data-target="#movieModal{{ $movie->id }}">
                        {{ $movie->title }}
                    </a>
                </td>
                <td>{{ $movie->genre->name }}</td>
                <td>{{ Str::limit($movie->description, 50) }}
                    <a href="#" data-toggle="modal" data-target="#movieModal{{ $movie->id }}">Подробнее</a>
                </td>
                <td>
                    <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">Удалить</button>
                    </form>
                </td>
            </tr>


            <div class="modal fade" id="movieModal{{ $movie->id }}" tabindex="-1" aria-labelledby="movieModalLabel{{ $movie->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="movieModalLabel{{ $movie->id }}">{{ $movie->title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Жанр:</strong> {{ $movie->genre->name }}</p>
                            <p><strong>Описание:</strong> {{ $movie->description }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection