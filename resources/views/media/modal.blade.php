<x-larastrap::modal :id="sprintf('media-%s', $media ? $media->id : 'new')" classes="primary-1" size="xl">
    <x-larastrap::form :obj="$media" baseaction="parlano-di-noi">
        <x-larastrap::text name="channel" label="Testata" required />
        <x-larastrap::date name="date" label="Data" required />
        <x-larastrap::text name="link" label="Link" />
        <x-larastrap::file name="file" label="File" />
        <x-larastrap::hidden name="context" :value="$media ? $media->context : 'media'" />
    </x-larastrap::form>

    @if($media)
        <x-larastrap::form :action="route('parlano-di-noi.destroy', $media->id)" method="DELETE" :buttons="[['element' => 'larastrap::sbtn', 'label' => 'Elimina', 'attributes' => ['type' => 'submit']]]">
        </x-larastrap::form>
    @endif
</x-larastrap::modal>
