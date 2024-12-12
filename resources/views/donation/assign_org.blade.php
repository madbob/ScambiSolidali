<x-larastrap::form formview="horizontal" :action="route('donation.assign', $donation->id)" keep_buttons>
    <x-larastrap::hidden name="assignation_type" value="organization" />
    <x-larastrap::text name="receiver-organization" label="Nome" required />
    <x-larastrap::number name="receiver-receivers" label="Numero Beneficiari Potenziali" min="0" max="1000000" step="1" required />
    @include('donation.areaselect', ['label' => 'Zona', 'selected' => null, 'field_name' => 'receiver-area'])
    <x-larastrap::number name="receiver-past" :label="sprintf('Quante volte ha fruito di %s', env('APP_NAME'))" required min="0" max="200" step="1" />
    <x-larastrap::textarea name="notes" label="Note private" help="Quanto scritto qui sarà accessibile solo agli operatori della piattaforma e non sarà pubblicato." />

    @include('donation.shipping_options', ['donation' => $donation])

    @if ($donation->type == 'object')
        <div class="alert alert-info">
            Salvando questa assegnazione, il donatore riceverà una mail di notifica.<br>Ricordati di contattarlo per accordarti sul ritiro!
        </div>
    @endif
</x-larastrap::form>
