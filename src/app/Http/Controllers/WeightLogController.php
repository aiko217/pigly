<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InitialWeightRequest;
use App\Http\Requests\StoreWeightLogRequest;
use App\Http\Requests\UpdateTargetWeightRequest;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class WeightLogController extends Controller
{
    public function admin(Request $request)
    {
        $user = auth()->user();

        $targetWeight = $user->target_weight;
        $latestWeight = $user->weightLogs()->orderBy('date', 'desc')->value('weight');
        $diff = $targetWeight - $latestWeight;

        $searchMode = $request->filled('start_date') || $request->filled('end_date');

        $logsQuery = $user->weightLogs()->orderBy('date', 'desc');

        if ($request->filled('start_date')) {
            $logsQuery->where('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $logsQuery->where('date', '>=', $request->end_date);
        }

        $logs = $logsQuery->paginate(8)->appends($request->query());

        $resultCount = $logsQuery->count();

        return view('admin', [
            'targetWeight' => $targetWeight, 
            'latestWeight'=> $latestWeight, 
            'diff' => $diff,
            'searchMode' => $searchMode,
            'logs' => $logs,
            'resultCount' => $resultCount,
            'request' => $request,
            ]);
    }

    public function editTarget()
    {
        $user = auth()->user();

        $targetWeight = $user->weightTarget ??  new \App\Models\WeightTarget();
        
        return view('edit', compact('targetWeight'));
    }

    public function updateTarget(UpdateTargetWeightRequest $request)
    {
        
        $user = auth()->user();

        if ($user->weightTarget) {
            $user->weightTarget->update([
                'target_weight' => $request->target_weight,
            ]);
        } else {
            $user->weightTarget()->create([
                'target_weight' => $request->target_weight,
            ]);
        }
        return redirect()->route('admin')->with('success', '目標体重を更新しました');
    }

    public function edit($id)
    {
        $Weight = WeightTarget::findOrFail($id);
        return view('edit', compact('targetWeight'));
    }

    public function search(Request $request) {

        $query = WeightLog::query();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
            $searchMode = true;
        } else {
            $searchMode = false;
        }

        $logs = $query->orderBy('date', 'desc')->paginate(8);

        $currentWeight = WeightLog::where('user_id', auth()->id())
        ->orderBy('date', 'desc')
        ->value('current_weight');
        $targetWeight = WeightTarget::where('user_id', auth()->id())
        ->value('target_weight');
    }

    public function store(StoreWeightLogRequest $request)
    {
        try {
        WeightLog::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);
        return redirect()->route('admin')->with('success', '登録しました');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin')
            ->withErrors($e->validator)
            ->withInput()
            ->with('showAddModal', true);
        }
    }

    public function update(UpdateTargetWeightRequest $request, $id)
    {
    $targetWeight = WeightLog::findOrFail($id);
    $targetWeight->update($request->all());
    $targetWeight->sav();

    return redirect()->route('admin')->with('success', '更新しました');
    }

    public function destroy($id)
    { 
    $weight = WeightLog::findOrFail($id);
    $weight->delete();

    return redirect()->route('weights.index')->with('success', '削除しました');
}
}
