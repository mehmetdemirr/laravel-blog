@extends('layouts.admin')

@section('title')
Kategori
@endsection

@section('css')
<style>
    .table-hover>tbody>tr:hover {
    --bs-table-hover-bg: transparent;
    background: #a8ccf1;
    color:#fff,
}
</style>
@endsection

@section('content')
{{-- <x-admin.page-description>
    Kategori Listesi
</x-admin.page-description> --}}
<x-bootstrap.card>
    <x-slot:header>
        <h2>Kategori Listesi</h2>
    </x-slot:header>
    <x-slot:body>
        <x-bootstrap.table>
            <x-slot:headings>
                <th scope="col">Name</th>
                <th scope="col">Slug </th>
                <th scope="col">Status</th> 
                <th scope="col">Feature Status</th>
                <th scope="col">Description</th>
                <th scope="col">Order</th>
                <th scope="col">Parent Category</th>
                <th scope="col">User</th>
                <th scope="col">Actions</th>
            </x-slot:headings>
            <x-slot:rows>
                @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->name}}</th>
                    <td>{{ $category->slug}}</td>
                    <td>
                        @if($category->status)
                        <a href="javascript:void(0)" data-id="{{ $category->id }}" class="btn btn-success btn-sm btnChangeStatus">
                            Aktif
                        </a>
                        @else
                        <a href="javascript:void(0)" data-id="{{ $category->id }}" class="btn btn-danger btn-sm btnChangeStatus">
                            Pasif
                        </a>
                        @endif
                    </td>
                    <td>
                        @if($category->feature_status)
                        <a href="javascript:void(0)"  data-id="{{$category->id}}" class="btn btn-success btn-sm btnChangeFeatureStatus">
                            Aktif
                        </a>
                        @else
                        <a href="javascript:void(0)" data-id="{{$category->id}}" class="btn btn-danger btn-sm btnChangeFeatureStatus">
                        Pasif
                        </a>
                        @endif
                    </td>
                    <td>{{ $category->desciption}}</td>
                    <td>{{ $category->order}}</td>
                    <td>{{ $category->parentCategory->name ?? "-"}}</td>
                    <td>{{ $category->user->name ?? "-"}}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route("category.edit",['id'=> $category->id]) }}" data-id="{{$category->id }}" class="btn btn-warning btn-sm btnEdit">
                                <i class="material-icons ms-0">edit</i>
                            </a>
                            <a href="javascript:void(0)" data-id="{{$category->id }}" class="btn btn-danger btn-sm btnDelete">
                                <i class="material-icons ms-0">delete</i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </x-slot:rows>
        </x-bootstrap.table>
        {{
            $categories->links()
        }}
    </x-slot:body>
    
</x-bootstrap.card>
<form action="" method="POST" id="statusChangeForm">
    @csrf
    <input type="hidden" name="id" id="inputStatus" value="">
</form>

@endsection

@section('js')
<script>
    $(document).ready(
        function (){
            $('.btnChangeStatus').click(function(){
                let categoryId= $(this).data('id');
                // console.log("category id :" + categoryId);
                //burada formdaki inputa değeri verdik
                $('#inputStatus').val(categoryId);

                Swal.fire({
                    title: "Statusu değiştirmek istediğinizden emin misiniz ?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Evet",
                    denyButtonText: `Hayır`
                    // cancelButtonText: "iptal"
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed)
                    {
                        //burada ise formu göndereceğiz
                        $('#statusChangeForm').attr("action","{{ route('category.changeStatus') }}");
                        $('#statusChangeForm').submit();
                        // Swal.fire("Saved!", "", "success");
                    } else if (result.isDenied) 
                    {
                        Swal.fire("İşlem yapılmadı", "", "info");
                    }
                });
            });

            $('.btnChangeFeatureStatus').click(function(){
                let categoryId= $(this).data('id');
                // console.log("category id :" + categoryId);
                //burada formdaki inputa değeri verdik
                $('#inputStatus').val(categoryId);

                Swal.fire({
                    title: "Feature Statusu değiştirmek istediğinizden emin misiniz ?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Evet",
                    denyButtonText: `Hayır`
                    // cancelButtonText: "iptal"
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed)
                    {
                        //burada ise formu göndereceğiz
                        $('#statusChangeForm').attr("action","{{ route('category.changeFeatureStatus') }}");
                        $('#statusChangeForm').submit();
                        // Swal.fire("Saved!", "", "success");
                    } else if (result.isDenied) 
                    {
                        Swal.fire("İşlem yapılmadı", "", "info");
                    }
                });
            });

            $('.btnDelete').click(function(){
                let categoryId= $(this).data('id');
                // console.log("category id :" + categoryId);
                //burada formdaki inputa değeri verdik
                $('#inputStatus').val(categoryId);

                Swal.fire({
                    title: "Kategoriyi silmek istediğinizden emin misiniz ?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Evet",
                    denyButtonText: `Hayır`
                    // cancelButtonText: "iptal"
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed)
                    {
                        //burada ise formu göndereceğiz
                        $('#statusChangeForm').attr("action","{{ route('category.delete') }}");
                        $('#statusChangeForm').submit();
                        // Swal.fire("Saved!", "", "success");
                    } else if (result.isDenied) 
                    {
                        Swal.fire("İşlem yapılmadı", "", "info");
                    }
                });
            });

            // $('.btnEdit').click(function(){
            //     let categoryId= $(this).data('id');
            //     // console.log("category id :" + categoryId);
            //     //burada formdaki inputa değeri verdik
            //     $('#inputStatus').val(categoryId);

            //     Swal.fire({
            //         title: "Kategoriyi düzenlemek istediğinizden emin misiniz ?",
            //         showDenyButton: true,
            //         showCancelButton: true,
            //         confirmButtonText: "Evet",
            //         denyButtonText: `Hayır`
            //         // cancelButtonText: "iptal"
            //         }).then((result) => {
            //         /* Read more about isConfirmed, isDenied below */
            //         if (result.isConfirmed)
            //         {
            //             //burada ise formu göndereceğiz
            //             $('#statusChangeForm').attr("action","{{ route('category.edit',['id'=> "categoryId"]) }}");
            //             $('#statusChangeForm').submit();
            //             // Swal.fire("Saved!", "", "success");
            //         } else if (result.isDenied) 
            //         {
            //             Swal.fire("İşlem yapılmadı", "", "info");
            //         }
            //     });
            // });
    });
</script> 
@endsection