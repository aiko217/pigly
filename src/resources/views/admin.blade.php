@extends('layouts/app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css')}}">
@endsection

@section('link')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<a href="{{ route('target_weight.edit') }}" class="btn btn-secondary">目標体重設定</a>
<form action="{{ route('logout') }}" method="post">
  @csrf
  <input class="header__link" type="submit" value="logout">
</form>
@endsection

@section('content')
<div class="admin-container">
    <div class="stats-cards">
        <div class="card">
                <h6>目標体重</h6>
                <h2>{{ number_format($targetWeight, 1) }} <span>kg</span></h2>
        </div>
        <div class="card">
                <h6>目標まで</h6>
                <h2>
                    {{ number_format($diff, 1) }}
                    <span>kg</span>
                </h2>
            </div>
        <div class="card">
                <h6>最新体重</h6>
                <h2>{{ number_format($latestWeight, 1) }} <span>kg</span></h2>
        </div>
    </div>
    <div class="search-form">
    <form method="get" action="{{ route('admin') }}">
        @csrf
     <input type="date" name="start_date" value="{{ request('start_date') }}">
     <span>~</span>
     <input type="date" name="end_date" value="{{ request('end_date') }}">
     <div class="search-form__actions">
     <input class="search-form__search-btn btn" type="submit" value="検索">
      @if($searchMode)
      <input class="search-form__reset-btn btn" type="submit" value="リセット" name="reset">
      @endif
      </form>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">データ追加</button>
    </div>
    <div class="search-info">
    @if($searchMode)
        <p>
            {{ request('start_date') }} ~ {{ request('end_date') }} の検索結果
            {{ $resultCount }}件
        </p>
    @endif
    </div>

    <table class="admin__table">
      <tr class="admin__row">
        <th class="admin__label">日付</th>
        <th class="admin__label">体重</th>
        <th class="admin__label">食事摂取カロリー</th>
        <th class="admin__label">運動時間</th>
        <th class="admin__label"></th>
      </tr>
      @foreach($logs as $log)
      <tr class="admin__row">
        <td class="admin__data">{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
        <td class="admin__data">{{ number_format($log->weight, 1) }}kg</td>
        <td class="admin__data">{{ $log->calories }}cal</td>
        <td class="admin__data">{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}</td>
        <td class="admin__data">
          <a href="{{ route('weights.edit', $log->id) }}">
        <img src="{{ asset('images/pencil-icon.png') }}" alt="編集" class="pencil-icon"></a>
        </td>
      </tr>
      @endforeach
    </table>

    <div class="modal fade @if(session('showAddModal')) show @endif" 
     id="addModal" tabindex="-1" aria-labelledby="addWeightModalLabel" 
     aria-hidden="{{ session('showAddModal') ? 'false' : 'true' }}" 
     style="{{ session('showAddModal') ? 'display:block;' : '' }}">

        <div class="modal-dialog">
            <div class="modal-content">
            <form method="post" action="{{ route('weights.store') }}">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Weight Logを追加</h5>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="date" class="form-label">日付<span class="require">必須</span></label>
                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                <p class="modal-body__error-message">
                @error('date')
                {{ $message }}
                @enderror
                </p>
              </div>
              <div class="mb-3">
              <label for="weight" class="form-label">体重<span class="require">必須</span></label>
                <input type="number" name="weight" id="weight" value="{{ old('weight') }}"step="0.1" class="form-control" placeholder="50.0"><span>kg</span>
                <p class="modal-body__error-message">
                @error('weight')
                {{ $message }}
                @enderror
                </p>
              </div>
              <div class="mb-3">
              <label class="form-label">摂取カロリー<span class="require">必須</span></label>
                <input type="number" name="calories" id="calories" value="{{ old('calories') }}" class="form-control" placeholder="1200"><span>cal</span>
                <p class="modal-body__error-message">
                @error('calories')
                {{ $message }}
                @enderror
                </p>
              </div>
              <div class="mb-3">
              <label class="form-label">運動時間<span class="require">必須</span></label>
                <input type="number" name="exercise_time" id="exercise_time" value="{{ old('exercise_time') }}"  class="form-control" placeholder="00.00">
                <p class="modal-body__error-message">
                @error('exercise_time')
                {{ $message }}
                @enderror
                </p>
              </div>
              <div class="mb-3">
              <label class="form-label">運動内容</label>
                <textarea name="exercise_content" id="exercise_content" class="form-control" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
                <p class="modal-body__error-message">
                @error('exercise_content')
                {{ $message }}
                @enderror
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                <button type="submit" class="btn btn-primary">登録</button>
              </div>
            </form>
        </div>
        </div>
    </div>
    <div class="pagination">
        {{ $logs->links() }}
    </div>
</div>

@if(session('showAddModal'))
<script>
    var addModal = new bootstrap.Modal(document.getElementById('addModal'));
    addModal.show();
</script>
@endif

@endsection