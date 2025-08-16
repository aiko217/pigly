@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/initial_weight.css')}}">
@endsection


@section('content')

  <div class="initial_weight-form__inner">
  <div class="initial_weight-form">
  <h2 class="initial_weight-form__heading content__heading">新規会員登録</h2>
  <h4 class="initial_weight-form__heading content__heading">STEP2 体重データの入力</h4>
    <form class="initial_weight-form__form" action="{{ route('admin') }}" method="post">
      @csrf
      <div class="initial_weight-form__group">
        <label class="initial_weight-form__label" for="current_weight">現在の体重</label>
        <input class="initial_weight-form__input" type="number" name="current_weight" id="current_weight" step="0.1" placeholder="現在の体重を入力" value="{{ old('current_weight') }}">
        <span>kg</span>
        <p class="initial_weight-form__error-message">
          @error('current_weight')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="initial_weight-form__group">
        <label class="initial_weight-form__label" for="target_weight">目標の体重</label>
        <input class="initial_weight-form__input" type="number" name="target_weight" id="target_weight" step="0.1" placeholder="目標の体重を入力" value="{{ old('target_weight') }}">
        <span>kg</span>
        <p class="initial_weight-form__error-message">
          @error('target_weight')
          {{ $message }}
          @enderror
        </p>
      </div>
      <input class="initial_weight-form__btn btn" type="submit" value="アカウント作成">
    </form>
  </div>
</div>
@endsection('content')