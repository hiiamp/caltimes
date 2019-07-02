<!-- notification dialog -->
<dialog id="notif_dialog">
    <form>
        @if(session('notif'))
            <span class="alert alert-warning help-block">
                <strong>{{session('notif')}}</strong>
            </span>
        @endif
        <div class="form-group">
            <input id="notifok" type="reset" value="Ok" class="btn btn-primary">
        </div>
    </form>
</dialog>
@if(session('notif'))
    <script>
        var dialog_notif = document.querySelector('#notif_dialog');
        dialog_notif.showModal();
        document.querySelector('#notifok').onclick = function () {
            dialog_notif.close();
        };
    </script>
@endif
