@extends('layout.admin.main')

@section('styles')
    <link rel="stylesheet" href="/admin/wysiwyg/dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="/admin/css/tags.css">
    <style>
        input[name=title]{
            border: 0px;
            outline: none;
            width: 100%;
        }
        .trumbowyg-box{
            width: 100%;
        }
    </style>
@stop

@section('content')

@include('layout.errors')

{!! Form::model($post, ['route'=>['admin.post.update', $post->id] ,'method' => 'put', 'files'=>true]) !!}
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {!! Form::text('title', null, ['placeholder'=>'Title of the post']) !!}
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="form-group">
                {!! Form::textarea('content', null) !!}
            </div>
            <div class="form-group">
                {!! Form::label('tags', 'Tags') !!}
                {!! Form::text('tags', json_encode($post->tags->lists('name')), ['class' => 'form-control', 'placeholder'=>'Add tags']) !!}
            </div>
        </div>
        <div class="col-lg-3">
            <div class="well">
                <div class="form-group">
                    {!! Form::label('category_id', 'Categories') !!}
                    @foreach ($categories as $category)
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('category_id[]', $category->id, $post->categories->contains($category->id)) !!} {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', Config::get('post_status'), null, ['class'=>'form-control']) !!}
                </div>
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('allow_comments') !!} Allow Comments
                    </label>
                </div>
                <div class="form-group">
                    {!! Form::label('image', 'Select an Image') !!}
                    <div class="fileUpload">
                        {!! Form::file('image', ['class'=>'upload', 'id'=>'image_file_upload']) !!}
                        <img src="{{$post->picture}}" alt="">
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('created_at', 'Date of Creation') !!}
                    {!! Form::input('datetime', 'created_at', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! link_to_route('admin.post.delete', 'Delete this post', $post->id, ['class'=>'btn btn-danger confirm-delete btn-sm pull-right']) !!}
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@stop

@section('scripts')
    <script src="/admin/wysiwyg/dist/trumbowyg.min.js"></script>
    <script src="/admin/js/jquery.tags.js"></script>
    <script>
        $('textarea').trumbowyg({
            autogrow: true,
            btnsAdd: ['base64']
        });
        jQuery(document).ready(function($) {
            // Avatar Upload and preview
            function readURL(input, id) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#'+id).next('img').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $(".fileUpload .upload").change(function() {
                var val = $(this).val();

                switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
                    case 'gif': case 'jpg': case 'png':
                        var id = $(this).attr('id');
                        readURL(this, id);
                        break;
                    default:
                        $(this).val('');
                        // error message here
                        alert("not an image");
                        break;
                }
                
            });

            $('#tags').magicSuggest({
                cls: 'form-control',
                data: {!!$tags!!},
            });
        });
    </script>
@stop