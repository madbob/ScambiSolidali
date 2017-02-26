<div class="modal fade" id="info-{{ $donation->id }}" tabindex="-1" role="dialog" aria-labelledby="info">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ $donation->category->name }} | {{ $donation->title }}</h4>
            </div>
            <div class="modal-body">
                @include('donation.form', ['call' => null, 'donation' => $donation])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
