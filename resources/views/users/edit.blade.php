<x-layout>

    <div class="container m-5 mx-auto">
        <div class="row">
            <div class="col col-lg-7 mx-auto">
                <div class="card card-body bg-light">
                    <div>
                        <a href="{{route('users.index')}}" class="btn btn-outline-primary mb-3">Back</a>
                    </div>

                    <form action="{{route('users.edit',$user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <x-form.input name="name" value="{{$user->name}}" />
                        <x-form.input name="email" type="email" value="{{$user->email}}" />
                        <x-form.input name="profile" type="file" option="true" />

                        <div id="preview"></div>

                        <div id="user-profile">
                            @if ($user->profile)
                            <img src="{{asset('storage/'.$user->profile)}}" class="img-thumbnail mb-4 w-50"
                                alt="{{$user->name}}">
                            @endif
                        </div>

                        <x-form.input name="password" type="password" option="true" />

                        <button class="btn btn-primary w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function(e){
                $('#profile').on('change',function(e){
                    e.preventDefault();

                    $('#user-profile').addClass("d-none");

                    var img_length = document.getElementById('profile').files.length;
                    $('#preview').html('');
                    for(var i = 0; i < img_length; i++){
                        $('#preview').append(`<img src="${URL.createObjectURL(e.target.files[i])}" class="img-thumbnail w-50 mb-1" />
                        <br/>
                        <a href="#" class="btn btn-sm btn-danger remove-btn mb-4">Remove</a>`);

                        $('.remove-btn').on('click',function(){
                            $('#profile').val('');
                            $('#preview').html('');
                            $('#user-profile').removeClass("d-none");
                        });
                    }
                });
            });
        </script>
    </x-slot>

</x-layout>