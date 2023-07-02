@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ $character->Name }}</b></div>

                <div class="card-body">
                    <x-character.status :character="$character"></x-character.status>
                </div>
            </div>


            <div class="card mt-4">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Str</th>
                                <th scope="col">Agi</th>
                                <th scope="col">Vit</th>
                                <th scope="col">Ene {{ $character->getTotalEnergy() }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="form-control" name="str"></td>
                                <td><input class="form-control" name="str"></td>
                                <td><input class="form-control" name="str"></td>
                                <td><input class="form-control" name="str"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
