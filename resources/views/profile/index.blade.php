@extends('layouts.front')

@section('title', 'プロフィール確認')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        @if (!is_null($headline))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                 <h2>プロフィール確認</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>id</h4>
                            <p class="id">{{ Str::limit($headline->id, 100) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>名前</h4>
                            <p class="name">{{ Str::limit($headline->name, 100) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>性別</h4>
                            <p class="gender">{{ Str::limit($headline->gender, 100) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>趣味</h4>
                            <p class="hobby">{{ Str::limit($headline->hobby, 100) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>自己紹介</h4>
                            <p class="introduction">{{ Str::limit($headline->introduction, 1000) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
