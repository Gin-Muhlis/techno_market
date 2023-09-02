@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-12 text-left">
                @can('create', App\Models\Barang::class)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form-modal"
                        data-mode="add">
                        <i class="icon ion-md-add"></i> Tambah
                    </button>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.ketentuan.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.ketentuan.inputs.nama_ketentuan')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ketentuans as $ketentuan)
                        <tr>
                            <td>{{ $ketentuan->nama_ketentuan ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $ketentuan)
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#form-modal" data-mode="edit" data-id="{{ $ketentuan->id }}">
                                    <i class="icon ion-md-create"></i>
                                </button>
                                    @endcan @can('delete', $ketentuan)
                                    <form
                                        action="{{ route('ketentuans.destroy', $ketentuan) }}"
                                        method="POST"
                                      
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger delete-btn"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('app.ketentuans.form-inputs')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const object = JSON.stringify(@json($ketentuans))
            const data = JSON.parse(object)
            $("#form-modal").on("show.bs.modal", event => {
                    const btn = $(event.relatedTarget)
                    const modal = $(this)
                    let mode = $(btn).data("mode")
                    switch (mode) {
                        case "add":
                            modal.find(".modal-title").text("Tambah Data Ketentuan")
                            modal.find("#method").html("")

                            setValue("tambah")

                    modal.find(".modal-body form").attr("action", `{{ url('ketentuans') }}`)
                    break;
                    case "edit":

                    const idKetentuan = btn.data("id")

                    const ketentuan = data.find(item => item.id == idKetentuan)
                        
                    setValue(ketentuan.nama_ketentuan)

                    modal.find(".modal-title").text("Edit Data Ketentuan")
                    modal.find("#method").html(`@method('PUT')`)


                    modal.find(".modal-body form").attr("action", `{{ url('ketentuans') }}/${idKetentuan}`);
                    default:
                    break;
                }
            })

        $(".delete-btn").on("click", event => {
            event.preventDefault()
            const nama = $(this).data("nama")
            Swal.fire({
                title: `Apakah data <span style="color: red;"></span> akan dihapus?`,
                text: "Data tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#dd3333",
                confirmButtonText: "Ya, hapus data ini"
            }).then(result => {
                if (result.isConfirmed)
                    $(event.target).closest("form").submit()
                else Swal.close()
            })
        })

        function setValue(namaKetentuan) {
            console.log(namaKetentuan)
            const modalFOrm = $("#form-modal")

            modalFOrm.find("#nama_ketentuan").val(namaKetentuan)

            return true
        }
        })
    </script>
@endpush
