<x-layout>
    <div class="container">
        <div class="row">
            <div class="col col-lg-8 mx-auto mt-5">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>Profile</div>
                        <div><a href="{{route('users.index')}}" class="btn btn-sm btn-primary">Back</a></div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            @if ($user->profile)
                            <img src="{{asset('storage/'.$user->profile)}}" alt="avatar" class="img-thumbnail mx-3"
                                style="width: 300px">
                            @endif
                        </div>
                        <div>
                            <h5 class="my-3">{{$user->name}}</h5>
                            <p class="text-muted mb-1">{{$user->email}}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{route('users.edit',$user->id)}}"
                                    class="btn btn-outline-secondary me-1">Edit</a>
                                <a href="#" class="btn btn-danger delete-btn" data-id="{{$user->id}}">Delete Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-slot name="script">
            <script>
                $(document).on("click",".delete-btn",function(e){
                    e.preventDefault();
                    var id = $(this).data('id');
                    $.ajax({
                        url:`/users/delete/${id}`,
                        type:'DELETE',
                    }).done(function(){
                        window.location.replace("/");
                    });
                });
            </script>
        </x-slot>
</x-layout>