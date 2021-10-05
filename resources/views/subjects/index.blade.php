@extends('layouts.app')

@section('content')
<div class="card container">

    <div class="row card-header justify-content-between">
        <h2>Subjects</h2>
        @if (Auth::user()->student_id === null)
        <div class="actions">
            <button type="button" class="btn modalTriggerAdd" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus  fa-lg"></i></button>
        </div>
        @endif
    </div>

        <div class=" card-body container">
            <table class="table table-bordered table-responsive-lg">
                <tr>
                    <th>id</th>
                    <th>Subject</th>
                    <th>Date Created</th>
                    @if (Auth::user()->student_id === null)
                    <th width="280px">Action</th>
                    @endif
                </tr>
            @foreach ($subjects as $subject)

                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->subject }}</td>
                    <td>{{ date_format($subject->created_at, 'jS M Y') }}</td>
                    @if (Auth::user()->student_id === null)
                    <td>
                        <form class="form" action="{{ route('subjects.destroy', $subject->id) }}" method="POST">


                            <button type="button" class="btn modalTrigger" data-toggle="modal" data-target="#exampleModal" data-id="{{ $subject->id }}" data-subject="{{ $subject->subject }}"><i class="fas fa-edit  fa-lg"></i></button>
                            {{-- <a href="{{ route('classes.show', $singleClass->id) }}" title="classes">
                                <i class="fas fa-file-alt fa-lg"></i>
                            </a> --}}

                            @csrf
                            @method('DELETE')

                            <button type="submit" title="delete {{$subject->subject}}" style="border: none; background-color:transparent;">
                                <i class="fas fa-trash fa-lg text-danger"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New subject name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/subjects/" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="subject" class="col-form-label">Name:</label>
              <input type="text" class="form-control" name="subject" id="updateSubjectName">
            </div>

            <div class="d-flex justify-content-end w-100">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ml-1">Update name</button>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New subject name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/subjects" method="POST">
            @csrf
            @method('POST')

            <div class="form-group">
              <label for="subject" class="col-form-label">Name:</label>
              <input type="text" class="form-control" name="subject" id="updateSubjectName">
            </div>

            <div class="d-flex justify-content-end w-100">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ml-1">Add subject</button>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>

@endsection

<style>
    .form {
        margin-bottom: 0;
    }
</style>
