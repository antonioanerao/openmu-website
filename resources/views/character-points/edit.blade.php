@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-alert></x-alert>
            <div class="card">
                <div class="card-header"><b>{{ $character->Name }}</b></div>

                <div class="card-body">
                    <x-character.status :character="$character"></x-character.status>
                </div>
            </div>


            <div class="card mt-4">
                <div class="card-body">

                    <form method="post" action="{{ route('character-points.update', $character->Id) }}">
                        @csrf @method('PATCH')

                        <table class="table">
                            @foreach(\App\Models\ConfigAttributeDefinition::basePoints($character->Id) as $p)
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        {{ $p->Designation }} ({{ $p->Value}})
                                    </div>
                                    <div class="col-md-6">
                                        <input value="{{ old(str_replace('base-', '', Str::slug($p->Designation)), 0) }}" class="form-control" name="{{ str_replace('base-', '', Str::slug($p->Designation)) }}">
                                        @error(str_replace('base-', '', Str::slug($p->Designation)))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </table>
                    <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
