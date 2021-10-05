@extends('layouts.app')

@section('content')
    <div class="card container">
        <div class="row card-header">
            <h2>Create new student</h2>
        </div>

        <div class="card-body container">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('students.store')}}" method="POST" class="card">
                @csrf
                @method('POST')


                <div class="card-body">

                    <div class="input-gr">
                        <label for="name">Name</label>
                        <input type="text" class="form-control"  name="name">
                    </div>
                    <div class="input-gr">
                        <label for="email">Email</label>
                        <input type="email" class="form-control"  name="email">
                    </div>
                    <div class="input-gr">
                        <label for="password">Password</label>
                        <input type="password" class="form-control"  name="password">
                    </div>
                    <div class="input-gr">
                        <label for="street">Street</label>
                        <input type="text" class="form-control" name="street">
                    </div>
                    <div class="input-gr">
                        <label for="postcode">Postcode</label>
                        <input type="text" class="form-control" name="postcode">
                    </div>
                    <div class="input-gr">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city">
                    </div>
                    <div class="input-gr">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" name="country">
                    </div>
                    <div class="input-gr">
                        <label for="education_id">Education</label>
                        <select class="custom-select" name="education_id">
                            @foreach($educations as $education)
                            <option value="{{ $education->id }}">{{ $education->name }}</option>
                            @endforeach
                          </select>
                    </div>


                    <div class="input-gr">
                        <label for="class_id">Class</label>
                        <select class="custom-select" name="class_id">
                            @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->class }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if($classId !== null)
                        <a class="btn btn-outline-dark" href="{{ route('classes.show', $classId) }}">Go back</a>
                    @endif
                    <button class="btn btn-dark">Save student</button>
                </div>
            </form>
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
