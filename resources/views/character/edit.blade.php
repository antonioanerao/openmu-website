@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><b>{{ $character->Name }}</b></div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Level</th>
                                <th scope="col">Resets</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $character->getLevel() }}</td>
                                <td>{{ $character->getReset() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
