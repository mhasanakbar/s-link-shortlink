@extends('templates.admin')
@section('content')
    <div class="row mt-4">
        <div class="col-md-12 col-sm-12 ">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <form action="{{ route('app.link.update', $link->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="text" name="id" id="" value="{{ $link->id }}" hidden>
                        <div class="form-group mb-3 row">
                            <label class="col-12  col-form-label"> Tujuan </label>
                            <div class="col-12 ">
                                <div class="input-group mb-0">
                                    <input type="text" class="form-control number-input" name="link[destination]"
                                        placeholder="https://example.com/my-long-url" required
                                        value="{{ $link->original_link }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            
                                <div class="row">
                                    <label class="col-12  col-form-label">Domain</label>
                                    <div class="col-12">
                                        <div class="input-group mb-0">
                                            <input type="text" class="form-control" name=""
                                                placeholder="s-link" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3 row">
                            
                                <div class="row">
                                   
                                    <label class="col-12  col-form-label">Link Kostum</label>
                                    
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="link[shorted]" placeholder=""
                                            value="{{ $link->shorted_link }}">
                                    </div><div class="mt-3">
                            <div class="col-12 mt-2">
                                <button class="btn btn-info" type="submit">
                                    Edit</button>
                            </div>
                                </div>
                        </div>
                            </div>
</div>

</div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    @endpush
@endsection
