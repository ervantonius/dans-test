@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Load data error!</strong> {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('home') }}">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="description">Job Description</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Field by title, benefits, companies, expertise" value="{{ \Request::input('description') ?? '' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" name="location" id="location" placeholder="Field by city, state, zip code or country" value="{{ \Request::input('location') ?? '' }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type_time">Job Type</label>
                        <select name="type_time" class="form-control" id="type_time">
                            <option value="">All</option>
                            <option value="full_time" {{ \Request::input('type_time') == 'full_time' ? 'selected=""' : '' }}>Full Time</option>
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="search">&nbsp;</label>
                        <button type="submit" class="form-control btn btn-secondary" id="search">Search</button>
                    </div>
                </div>
            </form>
            @if (!empty($data))
                <div class="row">
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($data as $lowongan)
                        @php
                            $no++;
                        @endphp

                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>{{ $lowongan->title }}</strong>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ $lowongan->company_url ?? '#' }}" target="_blank">{{ $lowongan->company }}</a>
                                            <p>
                                                <small>
                                                    <u>{{ $lowongan->location }}</u> - <strong>{{ $lowongan->type }}</strong>
                                                </small>
                                            </p>
                                        </h5>
                                        <p class="card-text text-right"><small class="text-muted">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($lowongan->created_at))->diffForHumans() }}</small></p>
                                    </div>
                                </div>
                            </div>

                        @if ($no % 3 == 0)
                        <div class="w-100 mb-3"></div>
                        @endif
                    @endforeach
                </div>
            @endif
            @if (!empty($is_able_next_page))
                @php
                    $input = \Request::all();
                    $input['page'] = $is_able_next_page;
                @endphp
                <a href="{{ route('home', $input) }}" class="btn btn-success btn-block mt-4" id="load_mode">Load more</a>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection
