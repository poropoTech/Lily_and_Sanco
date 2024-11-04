<div class="modal fade modal-y-fix response-new-modal" id="response-new-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <x-forms.post id="response-new-modal-form" :action="route('frontend.responses.store')" enctype="multipart/form-data">
                    <input type="hidden" name="activity_id" id="response-new-modal-activity-id">
                    @yield('content')
                </x-forms.post>
            </div>
            <div class="modal-footer">
                <button type="button" id="response-new-modal-cancel-btn" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban"></i></button>
                <button type="button" id="response-new-modal-send-btn" class="btn btn-primary image-selector-crop-btn"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
