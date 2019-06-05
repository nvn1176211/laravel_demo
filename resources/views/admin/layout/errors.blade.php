@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $er)
            {{$er}}<br>
        @endforeach
    </div>  
@endif