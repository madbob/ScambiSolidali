<x-larastrap::form formview="horizontal" :action="route('donation.assign', $donation->id)" keep_buttons>
    <x-larastrap::hidden name="assignation_type" value="self" />
    <x-larastrap::number name="receiver-age" label="Età" min="0" max="200" step="1" />
    <x-larastrap::radiolist name="receiver-gender" label="Sesso" :options="['M' => 'Maschile', 'F' => 'Femminile']" />
    <x-larastrap::radiolist name="receiver-status" label="Stato" :options="['student' => 'Studente', 'employed' => 'Occupato', 'unemployed' => 'Non occupato']" />
    <x-larastrap::radiolist name="receiver-children" label="Con chi abiti" :options="'alone' => 'Solo', 'roommate' => 'Coinquilini', 'couple' => 'In coppia', 'family' => 'In famiglia'" required />

    <x-larastrap::field label="Residenza">
        @include('donation.areaselect', ['selected' => null, 'field_name' => 'receiver-area'])
    </x-larastrap::field>

    <x-larastrap::radiolist name="receiver-country" label="Cittadinanza" :options="['italian' => 'Italiana', 'nonitalian' => 'Straniera']" required />
    <x-larastrap::number name="receiver-past" :label="sprintf('Quante volte ha fruito di %s', env('APP_NAME'))" min="0" max="200" step="1" required />

    <div class="alert alert-info">
        Scrivi qui un messaggio destinato al donatore, per accordarvi sulla consegna. Il donatore riceverà i tuoi dati di contatto (ma non le informazioni riportate qui sopra, che restano agli amministratori della piattaforma a scopo statistico). Inviando questo form la donazione sarà marcata come "Assegnata".
    </div>

    <x-larastrap::textarea name="message" label="Messaggio" required />
</x-larastrap::form>
