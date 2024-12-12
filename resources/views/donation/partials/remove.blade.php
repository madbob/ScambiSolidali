<x-larastrap::form formview="horizontal" method="DELETE" :action="route('celo.destroy', $donation->id)" :buttons="[['element' => 'larastrap::sbtn', 'label' => 'Elimina', 'attributes' => ['type' => 'submit']]]" keep_buttons>
    @php

    $reasons = [];
    foreach(App\Donation::declineReasons() as $identifier => $reas) {
        $reasons[$identifier] = $reas->text;
    }

    @endphp

    <x-larastrap::select name="reason" label="Motivo" :options="$reasons" />
</x-larastrap::form>
