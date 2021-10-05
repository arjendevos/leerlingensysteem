@extends('layouts.app')

@section('content')
<div class="card container">
    <div class="row card-header">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All classes: </h2>
            </div>
        </div>
    </div>

        <div class=" card-body container">
            <table class="table table-bordered table-responsive-lg">
                <tr>
                    <th>id</th>
                    <th>Class</th>
                    <th>Date Created</th>
                    <th width="280px">Action</th>
                </tr>
            @foreach ($classes as $singleClass)

                <tr>
                    <td>{{ $singleClass->id }}</td>
                    <td>{{ $singleClass->class }}</td>
                    <td>{{ date_format($singleClass->created_at, 'jS M Y') }}</td>
                    <td>
                        <form class="form" action="" method="POST">

                            <a href="{{ route('classes.show', $singleClass->id) }}" title="show">
                                <i class="fas fa-eye text-success  fa-lg"></i>
                            </a>

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
