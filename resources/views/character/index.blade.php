@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Character List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Resets</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Points</th>
                                    <th scope="col">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(auth()->user()->characters as $character)
                                    <tr>
                                        <td>{{ $character->Name }}</td>
                                        <td>{{ $character->getReset() }}</td>
                                        <td>{{ $character->getLevel() }}</td>
                                        <td>{{ $character->LevelUpPoints }}</td>
                                        <td><a href="{{ route('character.edit', $character->Id) }}">View</a>
                                    </tr>
                                @empty
                                    <div class="alert alert-info">
                                        You don't have any character yet!
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
