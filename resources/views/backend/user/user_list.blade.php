<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@extends('templates.admin')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 mb-20">
        <div class="card-box mb-30 shadow">
            <div class="pd-20">
                @if (count($users) !== 0)
                    <table class="table border-bottom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if ($user->id !== 1) <!-- Skip user ID '1' from the list -->
                                <tr>
    <td>{{ $loop->iteration - 1 }}</td>
    <td>{{ $user->username }}</td>
    <td>{{ $user->email }}</td>
    <td>
        <div class="d-flex">
            <button type="button" class="btn btn-outline-info btn-sm mx-1 bg-info" data-toggle="modal" data-target="#editModal_{{ $user->id }}">
                <i class="text-white">Edit</i>
            </button>
            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger btn-sm mx-1" data-toggle="modal" data-target="#deleteModal_{{ $user->id }}">
                    Hapus
                </button>
            </form>
        </div>
    </td>
</tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel_{{ $user->id }}">Edit User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="editUsername_{{ $user->id }}">Username</label>
                                                            <input type="text" class="form-control" id="editUsername_{{ $user->id }}" name="username" value="{{ $user->username }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editEmail_{{ $user->id }}">Email</label>
                                                            <input type="email" class="form-control" id="editEmail_{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-info">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Edit Modal -->
                                    

                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="col-12 text-center">
                        <p>No users found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('js')
<!-- Delete Confirmation Modal -->
@foreach ($users as $user)
    <div class="modal fade" id="deleteModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel_{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel_{{ $user->id }}">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteForm" action="{{ route('user.delete', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Apakah Anda yakin menghapus User ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<script>
    function handleDelete(userId) {
        var deleteForm = document.getElementById('deleteForm');
        var deleteModal = document.getElementById('deleteModal');

        // Set the form action to the user delete route
        deleteForm.action = "{{ route('user.delete', '') }}" + '/' + userId;

        // Show the modal
        $(deleteModal).modal('show');
    }
</script>

@endpush
@endsection
