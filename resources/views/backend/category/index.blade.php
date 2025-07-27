@extends('backend.layout.master')

@push('css')
@endpush


@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">

                        <div>
                            <h2 class="mb-0">Categories </h2>
                        </div>

                        <div class="font-22 ms-auto">
                            <button type="button" class="btn btn-warning text-white create-category-btn"
                                data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                                <i class="bx bx-layer-plus"></i> insert
                            </button>
                        </div>

                    </div>
                    <hr>
                    <div class="table-responsive" style="max-height: calc(100vh - 14.5rem); overflow-y: auto;">
                        {{ $dataTable->table() }}
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{--   create Modal --}}
    @include('backend.category.modal')
    {{--   edit Modal --}}
    @include('backend.category.editmodal')

   

    
@endsection


@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script src="{{ asset('assets/category.js') }}"></script>
@endpush