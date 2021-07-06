@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.Advertisement.add_advertisement')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <form method="post" action="{{url('advertisements/store')}}" class="new-ads container-fluid" enctype="multipart/form-data" style="min-height: 25vh">
        <div class="row">
            @csrf
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="category_id">{{__('web.Advertisement.Add.category')}}</label>
                    <select id="category_id" name="category_id" required class="form-control @error('category_id') is-invalid @enderror">
                        <option disabled selected value="">{{__('web.Advertisement.Add.choose_category')}}</option>
                        @foreach(\App\Models\Category::whereNull('parent_id')->get() as $category)
                            <option value="{{$category->getId()}}" @if(old('category_id') == $category->getId()) selected @endif>{{(app()->getLocale()=='ar')?$category->getNameAr():$category->getName()}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="sub_category_id_1">{{__('web.Advertisement.Add.sub_category')}}</label>
                    <select id="sub_category_id_1" required name="sub_category_id_1" class="form-control @error('sub_category_id_1') is-invalid @enderror">
                        <option disabled selected value="">{{__('web.Advertisement.Add.choose_category')}}</option>
                    </select>
                    @error('sub_category_id_1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4" id="sub_category_id_2_div" style="display: none">
                <div class="form-group">
                    <label for="sub_category_id_2">{{__('web.Advertisement.Add.sub_category')}}</label>
                    <select id="sub_category_id_2" name="sub_category_id_2" class="form-control @error('sub_category_id_2') is-invalid @enderror">
                        <option disabled selected value="">{{__('web.Advertisement.Add.choose_category')}}</option>
                    </select>
                    @error('sub_category_id_2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="city_id">{{__('web.Advertisement.Add.city')}}</label>
                    <select id="city_id" required name="city_id" class="form-control @error('sub_category_id_2') is-invalid @enderror">
                        <option disabled selected value="">{{__('web.Advertisement.Add.choose_city')}}</option>
                        @foreach(\App\Models\City::all() as $city)
                            <option value="{{$city->getId()}}" @if(old('city_id') == $city->getId()) selected @endif>{{(app()->getLocale()=='ar')?$city->getNameAr():$city->getName()}}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <div class="row">
                        <label for="contact" class="text-info col-lg-7 pr-0">{{__('web.Advertisement.Add.contact')}}</label>
                        <div class="form-group form-check checkbox col-lg-5 pl-0 pr-0">
                            <input id="hide_contact" name="hide_contact" type="checkbox" class="form-check-input  @error('hide_contact') is-invalid @enderror col-lg-1 k-checkbox" @if(old('hide_contact')) checked @endif>
                            <label class="form-check-label col-lg-11 k-checkbox-label" for="hide_contact">{{__('web.Advertisement.Add.hide_contact')}}</label>
                            @error('hide_contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <input type="text" name="contact" value="{{old('contact')}}" required id="contact" placeholder="{{__('')}}" class="form-control @error('hide_contact') is-invalid @enderror">
                    @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="price">{{__('web.Advertisement.Add.has_price')}}</label>
                    <div class="choos-price row">
                        <span class="radio-item radio-color col-lg-5">
                            <input type="radio" id="no" name="has_price" class="true" @if(old('has_price') == 0) checked @endif value="0">
                            <label for="no">{{__('web.Advertisement.Add.no')}}</label>
                        </span>
                        <span class="radio-item col-lg-3">
                            <input type="radio" id="yes" name="has_price" class="false" value="1" @if(old('has_price') == 1) checked @endif>
                            <label for="yes">{{__('web.Advertisement.Add.yes')}}</label>
                        </span>
                        @error('has_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-group col-lg-4 pr-0">
                            <input type="text" value="{{old('price')}}" name="price" id="price" placeholder="{{__('web.Advertisement.Add.price')}}" class="form-control @error('hide_contact') is-invalid @enderror">
                        </div>
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="media">{{__('web.Advertisement.Add.upload_images')}}</label>
                    <input type="file" required class="form-control-file @error('media') is-invalid @enderror" name="media[]" multiple id="media">
                    @error('media')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <label for="title" class="text-info">{{__('web.Advertisement.Add.title')}}</label>
                <input type="text" required name="title" id="title" value="{{old('title')}}" placeholder="" class="form-control @error('hide_contact') is-invalid @enderror">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <label for="content" class="text-info">{{__('web.Advertisement.Add.content')}}</label>
                <textarea required class="form-control @error('hide_contact') is-invalid @enderror" id="content" name="details" rows="3" placeholder="">{{old('details')}}</textarea>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group form-check checkbox col-lg-5 pl-0 pr-0 m-0">
                <input type="checkbox" required class="form-check-input col-lg-1 k-checkbox" id="commission_agreement">
                <label class="form-check-label col-lg-11 k-checkbox-label" for="commission_agreement">{{__('web.Advertisement.Add.commission_agreement')}}</label>
            </div>
        </div>
        <div class="row">
            <div class="form-group form-check checkbox col-lg-2 pl-0 pr-0 m-0">
                <input type="checkbox" required class="form-check-input col-lg-1 k-checkbox" id="checkbox-2">
                <label class="form-check-label col-lg-11 k-checkbox-label" for="checkbox-2">{{__('web.Advertisement.Add.terms_agreement')}}</label>
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-lg-9"></div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info btn-md  contact-btn" value="{{__('admin.save')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $('#category_id').on('change',function (){
            $.get( "{{url('response/categories')}}",{category_id:$(this).val()}, function( response ) {
                if (response.status.status === 'success'){
                    let selected = '';
                    let options = '';
                    let has_selected = 0;
                    response.data.Categories.forEach(category =>{
                        if (category['id']+'' === '{{old('sub_category_id_1')}}'){
                            selected = 'selected';
                            has_selected = 1;
                        }else{
                            selected = '';
                        }
                        options +='<option value="'+category['id']+'" '+selected+'>'+category['name']+'</option>';
                    });
                    if(has_selected){
                        options = '<option disabled value=""> {{__('web.Advertisement.Add.choose_category')}} </option>'+options;
                    }else{
                        options = '<option disabled selected value=""> {{__('web.Advertisement.Add.choose_category')}} </option>'+options;
                    }
                    $("#sub_category_id_1").find('option').remove().end().append(options);
                    @if(old('sub_category_id_1'))
                        $('#sub_category_id_1').trigger('change');
                    @endif
                }
            });
        });
        $('#sub_category_id_1').on('change',function (){
            $.get( "{{url('response/categories')}}",{category_id:$(this).val()}, function( response ) {
                if (response.status.status === 'success'){
                    if(response.data.Count > 0){
                        let selected = '';
                        let options = '';
                        let has_selected = 0;
                        response.data.Categories.forEach(category =>{
                            if (category['id']+'' === '{{old('sub_category_id_2')}}'){
                                selected = 'selected';
                                has_selected = 1;
                            }else{
                                selected = '';
                            }
                            options +='<option value="'+category['id']+'" '+selected+'>'+category['name']+'</option>';
                        });
                        if(has_selected){
                            options = '<option disabled value=""> {{__('web.Advertisement.Add.choose_category')}} </option>'+options;
                        }else{
                            options = '<option disabled selected value=""> {{__('web.Advertisement.Add.choose_category')}} </option>'+options;
                        }
                        $("#sub_category_id_2").find('option').remove().end().append(options);
                        $("#sub_category_id_2_div").show();
                    }else{
                        $("#sub_category_id_2_div").hide();
                    }
                }
            });
        });
        $("input[name=has_price]").on('change',function (){
            if($(this).val() === '1'){
                $('#price').show();
            }else{
                $('#price').hide();
            }
        });
        @if(old('category_id'))
            $('#category_id').trigger('change');
        @endif
        @if(old('has_price') == 0)
            $('#price').hide();
        @endif
    </script>
    <script>
        CKEDITOR.config.devtools_styles =
            '#cke_11,#cke_19,#cke_21,#cke_25,#cke_30,#cke_32,#cke_47 { display: none }' +
            '#cke_tooltip h2 { font-size: 14px; border-bottom: 1px solid; margin: 0; padding: 1px; }' +
            '#cke_tooltip ul { padding: 0pt; list-style-type: none; }';

        CKEDITOR.replace('content', {
            height: 250,
            extraPlugins: 'devtools',
        });
    </script>
@endsection
