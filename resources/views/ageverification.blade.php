@extends('Components.Layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Age Verification</div>
                <div class="card-body">
                    <form action="{{ url('/welcome') }}" method="GET">
                        <div class="mb-3">
                            <label for="age" class="form-label">Enter your age:</label>
                            <input type="number" name="age" id="age" class="form-control" required min="0" max="120">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


