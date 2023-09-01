<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@extends('templates.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 mb-20">
            <div class="card-box mb-30 shadow">
                <div class="pd-20">
                    @if (count($links) !== 0)
                        <table class="table border-bottom">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    @if (Auth::user()->id === 1) <!-- Display username for user ID '1' -->
            <th>Username</th>
        @endif
                                    <th>S-Link</th>
                                    <th>Link Original</th>
                                    <th>Waktu Pembuatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($links as $link)
    <tr>
        <td>{{ $loop->iteration }}</td>
        @if (Auth::user()->id === 1) <!-- Display username for user ID '1' -->
            <td>{{ $link->user ? $link->user->username : 'User di Hapus' }}</td>
        @endif
        <td>
            <a class='text-primary' href='/{{ $link->shorted_link }}' target="_blank">{{ env('APP_URL') }}/{{ $link->shorted_link }}</a>
        </td>
        <td>{{ $link->original_link }}</td>
        <td>{{ $link->created_at }}</td>
        <td>
            <div class="d-flex">
                <a class="btn btn-outline-info btn-sm mx-1 bg-info" href="{{ route('app.link.edit', $link->id) }}">
                    <i class="text-white">Edit</i>
                </a>
                <a class="btn btn-outline-danger btn-sm mx-1 bg-danger" id='deleteModalBtn'
                    data-url='{{ route('app.link.destroy', $link->id) }}' data-toggle='modal'
                    data-id='{{ $link->id }}' data-target='#deleteModal_{{ $link->id }}'
                    style='cursor: pointer;' onClick='handleDelete(this)'>
                    <i class="text-white">Hapus</i>
                </a>
            </div>
        </td>
    </tr>
@endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="col-12 text-center">
                            <a href="{{ route('home') }}" class="text-info ">Anda belum memiliki Short Link, buat sekarang!</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class='modal fade' id='deleteModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
        aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Hapus</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <form action="" method='POST' id="formDelete">
                    @method('DELETE')
                    @csrf
                    <div class='modal-body'>
                        Apakah Anda yakin untuk Hapus link ini?
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button>
                        <button type='submit' class='btn btn-danger'>Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            async function copyText(text) {
                try {
                    await navigator.clipboard.writeText(text);
                    swal({
                        text: 'Text copied to clipboard',
                        type: 'success',
                    })
                } catch (err) {
                    swal({
                        text: 'Text failed copied to clipboard',
                        type: 'error',
                    })
                }
            }

            function handleDelete(target) {
                let formDelete = document.querySelector("#formDelete");
                let deleteModal = document.querySelector("#deleteModal");
                const deleteModalBtn = document.querySelectorAll("#deleteModalBtn");

                deleteModalBtn.forEach((data) => {
                    data.addEventListener("click", function(e) {
                        deleteModal.setAttribute("id", `deleteModal_${data.dataset.id}`);
                        formDelete.setAttribute("action", data.dataset.url);
                    });
                });
            }
        </script>
    @endpush
@endsection
