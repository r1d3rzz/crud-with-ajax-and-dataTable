<x-layout>

    <div class="container m-5 mx-auto">
        <div class="row">
            <div class="col col-lg-7 mx-auto">
                <div class="card card-body bg-light">
                    <div>
                        <a href="{{route('users.index')}}" class="btn btn-outline-primary mb-3">Back</a>
                    </div>

                    <form action="{{route('users.create')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <x-form.input name="name" />
                        <x-form.input name="email" type="email" />
                        <x-form.input name="profile" type="file" option="true" />
                        <x-form.input name="password" type="password" />

                        <button class="btn btn-primary w-100">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>