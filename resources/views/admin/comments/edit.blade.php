@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header grad1">
  <h4> {{ trans('global.edit') }} {{ trans('cruds.comment.title_singular') }} </h4>
    </div>

    <div class="card-body">
        <form action="{{ route("admin.comments.update", [$comment->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('reclamation_id') ? 'has-error' : '' }}">
                <label for="reclamation">{{ trans('cruds.comment.fields.reclamation') }}</label>
                <select name="reclamation_id" id="reclamation" class="form-control select2">
                    @foreach($reclamations as $id => $reclamation)
                        <option value="{{ $id }}" {{ (isset($comment) && $comment->reclamation ? $comment->reclamation->id : old('reclamation_id')) == $id ? 'selected' : '' }}>{{ $reclamation }}</option>
                    @endforeach
                </select>
                @if($errors->has('reclamation_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('reclamation_id') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('author_name') ? 'has-error' : '' }}">
                <label for="author_name">{{ trans('cruds.comment.fields.author_name') }}<span class="spa">*</span></label>
                <input type="text" id="author_name" name="author_name" class="form-control" value="{{ old('author_name', isset($comment) ? $comment->author_name : '') }}" required>
                @if($errors->has('author_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('author_name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.comment.fields.author_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('author_email') ? 'has-error' : '' }}">
                <label for="author_email">{{ trans('cruds.comment.fields.author_email') }}<span class="spa">*</span></label>
                <input type="text" id="author_email" name="author_email" class="form-control" value="{{ old('author_email', isset($comment) ? $comment->author_email : '') }}" required>
                @if($errors->has('author_email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('author_email') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.comment.fields.author_email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                <label for="user">{{ trans('cruds.comment.fields.user') }}</label>
                <select name="user_id" id="user" class="form-control select2">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (isset($comment) && $comment->user ? $comment->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('user_id') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('comment_text') ? 'has-error' : '' }}">
                <label for="comment_text">{{ trans('cruds.comment.fields.comment_text') }}<span class="spa">*</span></label>
                <textarea id="comment_text" name="comment_text" class="form-control " required>{{ old('comment_text', isset($comment) ? $comment->comment_text : '') }}</textarea>
                @if($errors->has('comment_text'))
                    <em class="invalid-feedback">
                        {{ $errors->first('comment_text') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.comment.fields.comment_text_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                <a  class="btn btn-warning" href="{{ route('admin.comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                
            </div>
        </form>


    </div>
</div>
@endsection