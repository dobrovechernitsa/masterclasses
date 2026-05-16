<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MasterClass;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MasterClassController extends Controller
{
    private function checkInstructor()
    {
        if (!auth()->user()->isInstructor()) {
            abort(403);
        }
    }

    public function create()
    {
        $this->checkInstructor();
        
        $categories = Category::all();
        
        $bookedSlots = auth()->user()->masterClasses()
            ->where('date', '>=', now()->toDateString())
            ->get()
            ->groupBy(function($class) {
                return $class->date->format('Y-m-d');
            })
            ->map(function($slots) {
                return $slots->pluck('time_slot')->toArray();
            })
            ->toArray();
            
        return view('instructor.master-classes.create', compact('categories', 'bookedSlots'));
    }

    public function store(Request $request)
    {
        $this->checkInstructor();
        
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => [
                'required',
                'date',
                'after:today',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isPast()) {
                        $fail('Дата мастер-класса не может быть в прошлом.');
                    }
                },
            ],
            'time_slot' => 'required|in:9-11,11-13,13-15,15-17',
            'max_participants' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ], [
            'category_id.required' => 'Выберите вид творчества',
            'title.required' => 'Введите название мастер-класса',
            'description.required' => 'Введите описание мастер-класса',
            'date.required' => 'Выберите дату',
            'date.after' => 'Дата должна быть в будущем',
            'time_slot.required' => 'Выберите время',
            'time_slot.in' => 'Недопустимое время',
            'max_participants.required' => 'Укажите количество человек',
            'max_participants.integer' => 'Количество человек должно быть целым числом',
            'max_participants.min' => 'Минимальное количество участников: 1',
            'price.required' => 'Укажите стоимость',
            'price.numeric' => 'Стоимость должна быть числом',
            'price.min' => 'Стоимость не может быть отрицательной',
        ]);

        $existingClass = auth()->user()->masterClasses()
            ->where('date', $validated['date'])
            ->where('time_slot', $validated['time_slot'])
            ->exists();

        if ($existingClass) {
            return back()
                ->withInput()
                ->withErrors(['time_slot' => 'Это время уже занято другим вашим мастер-классом.']);
        }

        $validated['instructor_id'] = auth()->id();
        MasterClass::create($validated);

        return redirect()
            ->route('instructor.cabinet')
            ->with('success', 'Мастер-класс успешно создан!');
    }

    public function edit(MasterClass $masterClass)
    {
        $this->checkInstructor();
        
        if ($masterClass->instructor_id !== auth()->id()) {
            abort(403);
        }
        
        $categories = Category::all();
        
        return view('instructor.master-classes.edit', compact('masterClass', 'categories'));
    }

    public function update(Request $request, MasterClass $masterClass)
    {
        $this->checkInstructor();
        
        if ($masterClass->instructor_id !== auth()->id()) {
            abort(403);
        }
        
        $validated = $request->validate([
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ], [
            'description.required' => 'Описание обязательно для заполнения',
            'price.required' => 'Укажите стоимость',
            'price.numeric' => 'Стоимость должна быть числом',
            'price.min' => 'Стоимость не может быть отрицательной',
        ]);

        $masterClass->update($validated);

        return redirect()
            ->route('instructor.cabinet')
            ->with('success', 'Мастер-класс успешно обновлен!');
    }

}