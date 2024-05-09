<div>
    @if (session()->has($type))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
            {{ session()->get($type) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    

</div>
