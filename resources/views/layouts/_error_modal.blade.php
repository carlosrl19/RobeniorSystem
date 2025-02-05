<div class="modal fade" id="modal-errors" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header border-danger-top">
                <h5 class="modal-title">Hubo uno o más errores...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ($errors->all() as $error)
                <li class="clamp_text_md">{{$error}}</li>
                @endforeach
            </div>
        </div>
    </div>
</div>