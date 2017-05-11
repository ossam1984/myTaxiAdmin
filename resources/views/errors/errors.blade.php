@if(count($errors))
    <div class="form-group">
        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach($errors->all() as $error)
                <li class="list-group-item">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif