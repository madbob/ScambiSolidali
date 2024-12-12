<x-larastrap::modal :id="sprintf('story-%s', $story ? $story->id : 'new')">
    <x-larastrap::form baseaction="storie" :obj="$story">
        <x-larastrap::text name="title" label="Titolo" required />
        <x-larastrap::textarea name="contents" label="Contenuto" />
        <x-larastrap::file name="file" label="Immagine" />
    </x-larastrap::form>

    @if($story)
        <x-larastrap::form :action="route('storie.update', $story->id)" method="DELETE" :buttons="[['element' => 'larastrap::sbtn', 'label' => 'Elimina', 'attributes' => ['type' => 'submit']]]">
        </x-larastrap::form>
    @endif
</x-larastrap::modal>
