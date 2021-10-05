@extends('layouts.app')

@section('content')
    <div class="card container">
        <div class="row card-header justify-content-between">
            <h2>Education: {{ $educations->name }}</h2>
        </div>

        <div class="card-body container">
            <h4>Students:</h4>
            @if(count($students) > 0)
                <table class="table table-bordered table-responsive-lg">
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Street</th>
                        <th>Postcode</th>
                        <th>City</th>
                        <th>Country</th>
                        <th width="280px">Action</th>
                    </tr>
                @foreach ($students as $student)

                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->classes->class }}</td>
                        <td>{{ $student->street }}</td>
                        <td>{{ $student->postcode }}</td>
                        <td>{{ $student->city }}</td>
                        <td>{{ $student->country }}</td>

                        <td>
                            <form class="form" action="{{ route('students.destroy', $student->id)}}" method="POST">

                                <a href="{{ route('students.show', $student->id) }}" title="show">
                                    <i class="fas fa-eye text-success  fa-lg"></i>
                                </a>

                                {{-- <a href="{{ route('classes.edit', $student->id) }}" title="edit">
                                    <i class="fas fa-edit  fa-lg"></i>
                                </a> --}}

                                @if (Auth::user()->student_id === null)
                                @csrf
                                @method('DELETE')

                                <button type="submit" title="delete {{$student->name}}" style="border: none; background-color:transparent;">
                                    <i class="fas fa-trash fa-lg text-danger"></i>
                                </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
                </table>
            @endif
        </div>
    </div>



@endsection
