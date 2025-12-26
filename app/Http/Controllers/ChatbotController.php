<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        $user = Auth::user();
        $message = strtolower($request->input('message'));
        
        // Context: User Inventory
        $inventoryContext = $user->inventories->map(function($item) {
            return $item->item_name; 
        })->implode(', ');

        $response = "I see see you are using: " . ($inventoryContext ?: 'no registered devices') . ". ";
        
        // Simple Rule-based AI logic
        if (str_contains($message, 'laptop')) {
            if (str_contains(strtolower($inventoryContext), 'asus')) {
                 $response .= "For your Asus laptop, try holding the power button for 10 seconds to reset. Check the MyASUS app for diagnostics.";
            } else {
                 $response .= "For laptop issues, try restarting. Check if the charger is connected.";
            }
        } elseif (str_contains($message, 'printer') || str_contains($message, 'epson')) {
             $response .= "For Epson printer issues, check if there is a paper jam or if ink levels are low.";
        } elseif (str_contains($message, 'internet') || str_contains($message, 'wifi')) {
             $response .= "Try forgetting the network and reconnecting.";
        } else {
            $response .= "I couldn't find a specific solution in my database. Please Create a Ticket for human assistance.";
        }

        return response()->json([
            'response' => $response,
            'suggest_ticket' => true // logic to suggest ticket button
        ]);
    }
}
