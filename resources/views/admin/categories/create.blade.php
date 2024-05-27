@extends('layouts.admin')

@section('title')
{{isset($category) ? "Kategori Güncelle" : "Kategori Ekle"}}
@endsection

@section('css')

@endsection

@section('content')
    <x-bootstrap.card>
        <x-slot:header>
            <h2 class="card-title">{{isset($category) ? "Kategori Güncelle" : "Kategori Ekle"}}</h2> 
        </x-slot:header>
        <x-slot:body>
            {{-- @if($errors->any())
                @foreach($errors->all() as $key => $value)
                    <div class="alert alert-danger">{{ $value }}</div>
                @endforeach
            @endif --}}
            <form action="{{ isset($category) ? route("category.update",['id'=> $category->id]) : route("category.store") }}" method="POST">
                @csrf
                {{-- @method(isset($category) ? 'put' : 'post') --}}
                <input type="text" 
                        class="form-control form-control-solid-bordered m-b-sm
                        @if($errors->has("name"))
                        border-dangers
                        @endif
                        " 
                        id="name" 
                        name="name"
                        placeholder="Kategori Adı" 
                        value="{{ isset($category) ? $category->name :old("name") }}"
                >
                @if($errors->has("name"))
                <label class="text-danger">
                    {{ $errors->first("name") }}
                </label>
                @endif
                <input type="text" 
                        class="form-control form-control-solid-bordered m-b-sm" 
                        id="slug" 
                        name="slug"
                        placeholder="Kategori Slug"
                        value="{{ isset($category) ?  $category->slug : old("slug") }}"
                >
                @if($errors->has("slug"))
                <label class="text-danger" for="">
                    {{ $errors->first("slug") }}
                </label> 
                @endif
                <textarea 
                name="desciption" 
                id="desciption" 
                class="form-control form-control-solid-bordered m-b-sm"
                cols="30" 
                rows="4"
                placeholder="Kategori Açıklama Alanı"
                style="resize: none"
                >{{ isset($category) ? $category->desciption : old("desciption") }}</textarea>
                @if($errors->has("desciption"))
                <label class="text-danger" for="">
                    {{ $errors->first("desciption") }}
                </label> 
                @endif
                <input type="number" 
                        class="form-control for m-control-solid-bordered m-b-sm" 
                        id="order" 
                        name="order"
                        placeholder="Kategori Sıralama"
                        value="{{ isset($category) ? $category->order : old("order") }}"
                >
                @if($errors->has("order"))
                <label class="text-danger" for="">
                    {{ $errors->first("order") }}
                </label> 
                @endif
                <select name="parent_id"
                        id="parent_id"
                        class="form-select form-control form-control-solid-bordered m-b-sm"
                        aria-label="Üst Katagori Seçimi"
                >
                    <option value="0">Üst Kategori Seçiniz</option>
                    @foreach($categories as $key => $value)     
                        <option value="{{ $value->id }}" {{ (isset($category) && $category->id == $value->id) ? 'selected' : !''}}>{{$value->name}}</option>                   
                    @endforeach
                </select>
                @if($errors->has("parent_id"))
                    <label class="text-danger">
                        <label class="text-danger" for="">
                            {{ $errors->first("parent_id") }}
                        </label> 
                    </label>
                @endif
                <textarea 
                id="seo_keywords" 
                name="seo_keywords"
                class="form-control form-control-solid-bordered m-b-sm"
                cols="30" 
                rows="4"
                placeholder="Seo kelimeleri"
                style="resize: none"
                >{{ isset($category) ?  $category->seo_keywords : old("seo_keywords") }}</textarea>
                @if($errors->has("seo_keywords"))
                <label class="text-danger" for="">
                    {{ $errors->first("seo_keywords") }}
                </label> 
                @endif
                <textarea 
                id="seo_desciption" 
                name="seo_desciption"
                class="form-control form-control-solid-bordered m-b-sm"
                cols="30" 
                rows="4"
                placeholder="Seo açıklama"
                style="resize: none"
                >{{ isset($category) ? $category->seo_desciption : old("seo_desciption") }}</textarea>
                @if($errors->has("seo_desciption"))
                <label class="text-danger" for="">
                    {{ $errors->first("seo_desciption") }}
                </label> 
                @endif
                <div class="form-check m-b-sm">
                    <input class="form-check-input form-control" 
                            type="checkbox" 
                            value="1"
                            id="status" 
                            name="status"
                            {{ isset($category) && $category->status ? "checked" : ''}}>
                    <label class="form-check-label" for="status">
                      Status
                    </label>
                </div> 
                @if($errors->has("status"))
                <label class="text-danger" for="">
                    {{ $errors->first("status") }}
                </label> 
                @endif                
                <div class="form-check m-b-sm">
                    <input class="form-check-input form-control" 
                            type="checkbox" 
                            value="1"
                            id="feature_status"  
                            name="feature_status"
                            {{isset($category) && $category->feature_status ? 'checked' : ''}}>
                    <label class="form-check-label" for="feature_status">
                      Feature Status
                    </label>
                </div>
                @if($errors->has("feature_status"))
                <label class="text-danger" for="">
                    {{ $errors->first("feature_status") }}
                </label> 
                @endif     
                <hr>
                <div class="col-6 mx-auto mt-2">
                    <button type="submit" class="btn btn-success w-100">{{ isset($category) ? "Güncelle" : "Kaydet"}}</button> 
                </div>
            </form>
        </x-slot:body>
    </x-bootstrap.card>
@endsection

@section('js')

<script>
    function generateSlug() {
    var nameInput = document.getElementById('name');
    var slugInput = document.getElementById('slug');

    // Kategori adını al
    var name = nameInput.value;

    // Türkçe karakterleri İngilizce karakterlere dönüştürme
    var charMap = {
        'ç': 'c', 'ğ': 'g', 'ı': 'i', 'ö': 'o', 'ş': 's', 'ü': 'u',
        'Ç': 'C', 'Ğ': 'G', 'İ': 'I', 'Ö': 'O', 'Ş': 'S', 'Ü': 'U'
    };

    var slug = name.split('').map(function(char) {
        return charMap[char] || char;
    }).join('');

    // Boşlukları ve özel karakterleri dönüştür
    slug = slug.toLowerCase()
               .trim()
               .replace(/\s+/g, '-') // Boşlukları alt çizgi ile değiştir
               .replace(/[^\w\-]+/g, '-') // Diğer özel karakterleri tire ile değiştir
               .replace(/\_\-+|\-+\_/g, '-') // Alt çizgi ve tire birleşimlerini tire ile değiştir
               .replace(/\-+/g, '-') // Birden fazla tireyi tek tireye indir
               .replace(/^\-+|\-+$/g, ''); // Baştaki ve sondaki tireleri kaldır

    // Slug alanına otomatik olarak yaz
    slugInput.value = slug;
}

// Slug alanının kullanıcı tarafından düzenlenebilmesini sağlamak için
document.getElementById('name').addEventListener('input', generateSlug);
</script>

@endsection