@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
@endsection


@section('content')
  <div class="register-form__inner">
    <form class="register-form__form" action="{{ route('register') }}" method="post">
      @csrf
    <h2 class="register-form__heading content__heading">新規会員登録</h2>
    <h4 class="register-form__heading content__heading">STEP1 アカウント情報の登録</h4>
      <div class="register-form__group">
        <label class="register-form__label" for="name">お名前</label>
        <input class="register-form__input" type="text" name="name" id="name" placeholder="お名前を入力" value="{{ old('name') }}" />
        <p class="register-form__error-message">
          @error('name')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="register-form__group">
        <label class="register-form__label" for="email">メールアドレス</label>
        <input class="register-form__input" type="text" name="email" id="email" placeholder="メールアドレスを入力" value="{{ old('email') }}" />
        <p class="register-form__error-message">
          @error('email')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="register-form__group">
        <label class="register-form__label" for="password">パスワード</label>
        <input class="register-form__input" type="password" name="password" id="password" placeholder="パスワードを入力"
        value="{{ old('password') }}" />
        <p class="register-form__error-message">
          @error('password')
          {{ $message }}
          @enderror
        </p>
      </div>
      <input class="register-form__btn btn" type="submit" value="次に進む">
      <a class="login__button-submit" href="/login">ログインはこちら</a>
    </form>
  </div>
</div>
@endsection('content')