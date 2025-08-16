@extends('layouts/app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css')}}">
@endsection

@section('link')
<a href="{{ route('target_weight.edit') }}" class="btn btn-secondary">目標体重設定</a>
<form action="{{ route('logout') }}" method="post">
  @csrf
  <input class="header__link" type="submit" value="logout">
</form>
@endsection

@section('content')
<div class="edit-form">
<title>目標体重設定</title>
<form method="post" action="{{ route('target_weight.update')}}">
    @csrf
    @method('PUT')
    <input type="number" name="target_weight" id="weight" value="{{ old('target_weight', $targetWeight->target_weight) }}"step="0.1" class="form-control" placeholder="50.0"><span>kg</span>
    <p class="edit-form__error-message">
    @error('target_weight')
    {{ $message }}
    @enderror
    </p>
    <div class="button-content">
        <a href="/admin" class="back">戻る</a>
        <button type="submit" class="btn btn-primary">更新</button>
    </div>
</div>
</div>
@endsection

