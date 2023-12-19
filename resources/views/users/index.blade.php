<x-layout>

    <div class="container m-5 mx-auto">
        <div class="row">
            <div class="col">
                <div class="card card-body bg-light">
                    <div>
                        <a href="{{route('users.create')}}" class="btn btn-outline-primary mb-3">+ Create</a>
                    </div>

                    <table id="example" class="table table-striped data-table responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="no-sort">Name</th>
                                <th class="no-sort">Email</th>
                                <th class="hidden">Updated_at</th>
                                <th class="actions no-sort">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            $(function () {
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "{{ route('users.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'actions', name: 'actions'},
                    ],
                    order: [[0,"desc"]],
                    columnDefs: [
                        {
                            targets:"hidden",
                            visible:false,
                        },
                        {
                            targets:"no-sort",
                            sortable:false,
                        }
                    ],
                });

                $(document).on('click','.delete-btn',function(e){
                    e.preventDefault();
                    var id = $(this).data('id');

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url:`/users/delete/${id}`,
                                type:'DELETE'
                            }).done(function(){
                                table.ajax.reload();
                            })

                            Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                            });
                        }
                    });
                });
            });
        </script>
    </x-slot>

</x-layout>