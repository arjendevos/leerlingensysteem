@extends('layouts.app')

@section('content')
<div class="card container">
    <div class="row card-header">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All educations: </h2>
            </div>
        </div>
    </div>

        <div class=" card-body container">
            <table class="table table-bordered table-responsive-lg">
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Date Created</th>
                    <th width="280px">Action</th>
                </tr>
            @foreach ($educations as $education)

                <tr>
                    <td>{{ $education->id }}</td>
                    <td>{{ $education->name }}</td>
                    <td>{{ date_format($education->created_at, 'jS M Y') }}</td>
                    <td>
                        <form class="form" action="" method="POST">

                            <a href="{{ route('educations.show', $education->id) }}" title="show">
                                <i class="fas fa-eye text-success  fa-lg"></i>
                            </a>

                            {{-- <a href="{{ route('classes.edit', $singleClass->id) }}" title="edit">
                                <i class="fas fa-edit  fa-lg"></i>
                            </a>
                            <a href="{{ route('classes.show', $singleClass->id) }}" title="classes">
                                <i class="fas fa-file-alt fa-lg"></i>
                            </a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" title="delete project {{$singleClass->class}}" style="border: none; background-color:transparent;">
                                <i class="fas fa-trash fa-lg text-danger"></i>
                            </button> --}}
                        </form>
                    </td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>
</div>
@endsection

<style>
    .form {
        margin-bottom: 0;
    }
</style>
