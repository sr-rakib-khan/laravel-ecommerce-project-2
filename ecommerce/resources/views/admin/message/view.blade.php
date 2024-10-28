<div class="modal-body">
    <div class="card">
        <div class="card-body">
        </div>
        <h3>Message Details</h3>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Name:</strong> {{$message->name}}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Email:</strong> {{$message->email}}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Message:</strong> {{$message->message}}</p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
</div>
</form>