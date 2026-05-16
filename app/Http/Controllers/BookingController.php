<?php

namespace App\Http\Controllers;

use App\Models\MasterClass;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function confirm(MasterClass $masterClass)
    {
        $existingBooking = Booking::where('user_id', auth()->id())
            ->where('master_class_id', $masterClass->id)
            ->where('status', 'confirmed')
            ->first();
            
        if ($existingBooking) {
            return redirect()
                ->route('categories.show', $masterClass->category)
                ->with('error', 'Вы уже записаны на этот мастер-класс.');
        }
        
        if ($masterClass->available_spots <= 0) {
            return redirect()
                ->route('categories.show', $masterClass->category)
                ->with('error', 'К сожалению, свободных мест нет.');
        }
        
        if ($masterClass->date->isPast()) {
            return redirect()
                ->route('categories.show', $masterClass->category)
                ->with('error', 'Этот мастер-класс уже прошел.');
        }
        
        $masterClass->load('instructor', 'category');
        
        return view('booking.confirm', compact('masterClass'));
    }

    public function store(Request $request, MasterClass $masterClass)
    {
        $existingBooking = Booking::where('user_id', auth()->id())
            ->where('master_class_id', $masterClass->id)
            ->first();
            
        if ($existingBooking) {
            if ($existingBooking->status === 'cancelled') {
                $existingBooking->update(['status' => 'confirmed']);
                return redirect()
                    ->route('categories.show', $masterClass->category)
                    ->with('success', 'Вы успешно записаны на мастер-класс!');
            }
            
            return redirect()
                ->route('categories.show', $masterClass->category)
                ->with('error', 'Вы уже записаны на этот мастер-класс.');
        }
        
        if ($masterClass->available_spots <= 0) {
            return redirect()
                ->route('categories.show', $masterClass->category)
                ->with('error', 'К сожалению, места закончились.');
        }
        
        Booking::create([
            'user_id' => auth()->id(),
            'master_class_id' => $masterClass->id,
            'status' => 'confirmed',
        ]);
        
        return redirect()
            ->route('categories.show', $masterClass->category)
            ->with('success', 'Вы успешно записаны на мастер-класс!');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }
        
        $category = $booking->masterClass->category;
        
        $booking->update(['status' => 'cancelled']);
        
        return redirect()
            ->route('categories.show', $category)
            ->with('info', 'Запись на мастер-класс отменена.');
    }
    
    public function deny(MasterClass $masterClass)
    {
        return redirect()
            ->route('categories.show', $masterClass->category)
            ->with('info', 'Вы отказались от записи на мастер-класс.');
    }
}