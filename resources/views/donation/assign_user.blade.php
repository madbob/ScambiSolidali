<x-larastrap::form formview="horizontal" :action="route('donation.assign', $donation->id)" keep_buttons>
    <x-larastrap::hidden name="assignation_type" value="individual" />
    <x-larastrap::number name="receiver-age" label="Età" min="0" max="200" step="1" required />
    <x-larastrap::radiolist name="receiver-gender" label="Sesso" :options="['M' => 'Maschile', 'F' => 'Femminile']" required />
    <x-larastrap::radiolist name="receiver-status" label="Stato" :options="['student' => 'Studente', 'employed' => 'Occupato', 'unemployed' => 'Non occupato']" required />
    <x-larastrap::radiolist name="receiver-children" label="Famiglia" :options="['children' => 'Ha figli', 'nochildren' => 'Non ha figli']" required />

    <x-larastrap::field label="Residenza">
        @include('donation.areaselect', ['selected' => null, 'field_name' => 'receiver-area'])
    </x-larastrap::field>

    <x-larastrap::radiolist name="receiver-country" label="Cittadinanza" :options="['italian' => 'Italiana', 'nonitalian' => 'Straniera']" required />

    <x-larastrap::number name="receiver-past" :label="sprintf('Quante volte ha fruito di %s', env('APP_NAME'))" min="0" max="200" step="1" required />
    <x-larastrap::textarea name="notes" label="Note private" help="Quanto scritto qui sarà accessibile solo agli operatori della piattaforma e non sarà pubblicato." />

    @include('donation.shipping_options', ['donation' => $donation])

    @if ($donation->type == 'object')
        <div class="alert alert-info">
            Salvando questa assegnazione, il donatore riceverà una mail di notifica.<br>Ricordati di contattarlo per accordarti sul ritiro!
        </div>
    @endif
</x-larastrap::form>
