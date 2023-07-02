@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ $character->Name }}</b></div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Class</th>
                                <th scope="col">Level</th>
                                <th scope="col">Resets</th>
                                <th scope="col">Points</th>
                                <th scope="col">M. Level Points</th>
                                <th scope="col">Kill Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $character->characterClass->Name }}</td>
                                <td>{{ $character->getLevel() }}</td>
                                <td>{{ $character->getReset() }}</td>
                                <td>{{ $character->MasterLevelUpPoints }}</td>
                                <td>{{ $character->LevelUpPoints }}</td>
                                <td>{{ $character->PlayerKillCount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
