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
    @if (!empty($lowongan))
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                <h3>{{ $lowongan->title }}</h3>
                            </strong>
                        </div>
                        <div class="card-body">
                            <img src="{{ $lowongan->company_logo ?? asset('images/na.png') }}" class="img-fluid" alt="Responsive image">
                            <h5 class="card-title">
                                <a href="{{ $lowongan->company_url ?? '#' }}" target="_blank">{{ $lowongan->company }}</a>
                                <p>
                                    <small>
                                        <u>{{ $lowongan->location }}</u> - <strong>{{ $lowongan->type }}</strong>
                                    </small>
                                    <small class="text-muted float-right">
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($lowongan->created_at))->diffForHumans() }}
                                    </small>
                                </p>
                                <br>
                                <div class="container">
                                    {!! $lowongan->description !!}
                                    <br>
                                    <br>
                                    <div class="text-right">
                                        <b>How to Apply :</b>
                                        @guest
                                            <p>
                                                Please login to apply
                                            </p>
                                        @else
                                            {!! $lowongan->how_to_apply !!}
                                        @endguest
                                    </div>
                                </div>
                            </h5>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('home') }}" class="btn btn-secondary float-right">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
