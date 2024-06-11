<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Type_subscription;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscribe(SubscriptionRequest $request)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        // Obtiene el usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario ya tiene una suscripción
        if ($user->subscription) {
            return response()->json(['message' => 'User already has a subscription'], 400);
        }
        $planName = $request->input('planName');
        $subscriptionMonths = $request->input('subscriptionMonths');
        $entity = $request->input('entity');
        $accountNumber = $request->input('accountNumber');

        // Calcula el precio total según el plan y los meses seleccionados
        $pricePerMonth = $this->calculatePricePerMonth($planName);
        $totalPrice = $pricePerMonth * $subscriptionMonths;

        // Crea una nueva instancia de Subscription y asigna los valores
        $subscription = new Subscription();
        $subscription->id_user = Auth::id(); // ID del usuario autenticado
        $subscription->id_type = Type_subscription::where('type', $planName)->value('id_type');
        $subscription->account_number = $accountNumber;
        $subscription->entity = $entity;
        $subscription->start_date = now(); // Fecha de inicio actual
        $subscription->expire_date = now()->addMonths($subscriptionMonths); // Fecha de expiración

        // Guarda la suscripción en la base de datos
        $subscription->save();

        // Verifica si se ha guardado correctamente
        if ($subscription->exists) {
            // La suscripción se ha guardado correctamente
            return redirect()->route('profile')->with('success', 'Plan changed successfully');
        } else {
            // Ocurrió un error al guardar la suscripción
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create subscription']);
        }
    }

    private function calculatePricePerMonth($planName)
    {
        $prices = [
            'PLUS' => 9,
            'PRO' => 19
        ];

        return $prices[$planName] ?? 0;
    }
}
