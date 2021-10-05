@extends('layouts.app')

@section('content')
    <div class="card container">
        <div class="row card-header">
            <h2>{{ $student->name }}</h2>
        </div>

        <div class="row card-body">
            <div class="col-xs-12 col-md-6">
                {{-- <h4>Students:</h4> --}}
                <form action="{{ route('students.update', $student->id)}}" method="POST" class="card">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="input-gr">
                            <label for="id">Id</label>
                            <input readonly type="text" class="form-control" value="{{ $student->id }}" name="id">
                        </div>
                        @if ($student->user !== null)
                        <div class="input-gr">
                            <label for="email">Email</label>
                            <input readonly type="text" class="form-control" value="{{ $student->user->email }}" name="email">
                        </div>
                        @endif
                        <div class="input-gr">
                            <label for="name">Name</label>
                            <input {{Auth::user()->student_id !== null ? 'readonly' : ''}} type="text" class="form-control" value="{{ $student->name }}" name="name">
                        </div>
                        <div class="input-gr">
                            <label for="street">Street</label>
                            <input {{Auth::user()->student_id !== null ? 'readonly' : ''}}  type="text" class="form-control" value="{{ $student->street }}" name="street">
                        </div>
                        <div class="input-gr">
                            <label for="postcode">Postcode</label>
                            <input {{Auth::user()->student_id !== null ? 'readonly' : ''}}  type="text" class="form-control" value="{{ $student->postcode }}" name="postcode">
                        </div>
                        <div class="input-gr">
                            <label for="city">City</label>
                            <input {{Auth::user()->student_id !== null ? 'readonly' : ''}}  type="text" class="form-control" value="{{ $student->city }}" name="city">
                        </div>
                        <div class="input-gr">
                            <label for="country">Country</label>
                            <input {{Auth::user()->student_id !== null ? 'readonly' : ''}}  type="text" class="form-control" value="{{ $student->country }}" name="country">
                        </div>
                        <div class="input-gr">
                            <label for="education_id">Education</label>
                            <select {{Auth::user()->student_id !== null ? 'disabled' : ''}}  class="custom-select" name="education_id">
                                @foreach($educations as $education)
                                <option {{ $education->id === $student->education_id ? 'selected': ''}} value="{{ $education->id }}">{{ $education->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-gr">
                            <label for="class_id">Class</label>
                            <select {{Auth::user()->student_id !== null ? 'disabled' : ''}} class="custom-select" name="class_id">
                                @foreach($classes as $class)
                                <option {{ $class->id === $student->class_id ? 'selected': ''}} value="{{ $class->id }}">{{ $class->class }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a class="btn btn-outline-dark" href="{{ route('classes.show', $student->class_id) }}">Go back</a>
                        @if (Auth::user()->student_id === null)
                            <button class="btn btn-dark">Save student</button>
                        @endif
                    </div>
                </form>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="w-100 d-flex justify-content-between">
                            <label for="">Results</label>
                        </div>
                        <table class="table table-bordered table-responsive-lg">
                            <tr>
                                <th>Subject</th>
                                <th>Result</th>
                                <th>Action</th>
                            </tr>
                        @foreach ($student->results as $result)
                            <?php $subject = \App\Models\Subject::where(['id' => $result->subject_id])->pluck('subject')->first() ?>

                            <tr>
                                <td>{{ $subject }}</td>
                                <td>{{ $result->result }}</td>
                                <td>
                                    <form class="form" action="{{ route('results.destroy', $result->id)}}" method="POST">

                                        @if (Auth::user()->student_id === null)
                                        <button type="button" class="btn modalTriggerEditResult" data-toggle="modal" data-target="#modalToEditResult"
                                            data-id="{{ $result->id }}"
                                            data-result="{{ $result->result }}"
                                            data-date="{{ date_format($result->created_at, 'jS M Y') }}"
                                            data-subject="{{ $subject }}">
                                            <i class="fas fa-edit  fa-lg"></i>
                                        </button>
                                        @endif

                                        @csrf
                                        @method('DELETE')

                                        @if (Auth::user()->student_id === null)
                                        <button type="submit" title="delete {{$result->result}} from {{ $subject }} " style="border: none; background-color:transparent;">
                                            <i class="fas fa-trash fa-lg text-danger"></i>
                                        </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </table>
                        @if (Auth::user()->student_id === null)
                            <button type="button" class="btn btn-dark modalAddResult" data-toggle="modal" data-target="#modalAddResult" data-student="{{ $student->id }}">
                                New result
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalToEditResult" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit result</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="col-form-label">Date:</label>
                    <input readonly class="form-control" id="dateResult">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Subject:</label>
                    <input readonly class="form-control" id="subjectResult">
                </div>

                <div class="form-group">
                  <label for="result" class="col-form-label">Result:</label>
                  <input type="text" class="form-control" name="result" id="updateResult">
                </div>

                <div class="d-flex justify-content-end w-100">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ml-1">Update result</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="modalAddResult" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add new result</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="/results">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="subject_id" class="col-form-label">Subject:</label>
                    <select class="custom-select" name="subject_id">
                        @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" class="form-control" name="student_id" id="student_id_input">

                <div class="form-group">
                  <label for="result" class="col-form-label">Result:</label>
                  <input type="text" class="form-control" name="result" id="updateResult">
                </div>

                <div class="d-flex justify-content-end w-100">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ml-1">Update result</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>



@endsection

<style>
    .input-gr label {
        margin-bottom: 5px;
    }

    .input-gr {
        margin-bottom: 10px;
    }
</style>
