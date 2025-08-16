@extends('layouts/app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css')}}">
@endsection

@section('link')
<a href="{{ route('target_weight.edit') }}" class="btn btn-secondary">目標体重設定</a>
<form action="{{ route('logout') }}" method="post">
  @csrf
  <input class="header__link" type="submit" value="logout">
</form>
@endsection

    <div class="show-header">
        <h5 class="show-title">Weight Log</h5>
        <form method="post" action="{{ route('weight_logs.update', $log->id) }}">
            @csrf
            @method('PUT')
              <div class="show-form">
                <label class="form-label">日付</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ now()->format('Y-m-d') }}">
                <p class="show-form__error-message">
                @error('date')
                {{ $message }}
                @enderror
                </p>
              </div>
              <div class="show-form">
              <label class="form-label">体重</label>
                <input type="number" name="weight" id="weight" value="{{ old('weight') }}"step="0.1" class="form-control" placeholder="50.0"><span>kg</span>
                <p class="show-form__error-message">
                @error('weight')
                {{ $message }}
                @enderror
                </p>
              </div>
              <div class="show-form">
              <label class="form-label">摂取カロリー</label>
                <input type="number" name="calories" id="calories" value="{{ old('calories') }}" class="form-control" placeholder="1200"><span>cal</span>
                <p class="show-form__error-message">
                @error('calories')
                {{ $message }}
                @enderror
                </p>
              </div>
              <div class="show-form">
              <label class="form-label">運動時間</label>
                <input type="time" name="exercise_time" id="exercise_time" value="{{ old('exercise_time') }}"  class="form-control" placeholder="00.00">
                <p class="show-form__error-message">
                @error('exercise_time')
                {{ $message }}
                @enderror
                </p>
              </div>
              <div class="show-form">
              <label class="form-label">運動内容</label>
                <textarea class="show-form__textarea" name="exercise_content" id="exercise_content" class="form-control" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
                <p class="show-form__error-message">
                @error('exercise_content')
                {{ $message }}
                @enderror
                </p>
              </div>
              <div class="button-content">
              <a href="/admin" class="back">戻る</a>
                <button type="submit" class="btn btn-primary">更新</button>
                <a href="{{ route('weight_logs.delete', $log->id) }}"
                            <img src="{{ asset('/images/trash-can.png') }}" alt="ゴミ箱の画像" class="img-trash-can" />
                        </a>
                    </div>
        </form>
    </div>
        