@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="description">Job Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Field by title, benefits, companies, expertise">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" placeholder="Field by city, state, zip code or country">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type_time">Job Type</label>
                        <select name="type_time" class="form-control" id="type_time">
                            <option value="">All</option>
                            <option value="full_time">Full Time</option>
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="search">&nbsp;</label>
                        <button type="submit" class="form-control btn btn-secondary" id="search">Search</button>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
