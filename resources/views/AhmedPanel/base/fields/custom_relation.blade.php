<div class="col-md-12">
    <div class="form-group label-floating">
        <label for="{{$Field['name']}}" class="control-label">{{__('crud.'.$lang.'.'.$Field['name'])}} @if($Field['is_required'])*@endif</label>
        <select name="{{$Field['name']}}" style="margin: 0;padding: 0" id="{{$Field['name']}}" class="form-control">
            <option value="">-</option>
            @foreach($Field['relation']['data']($value) as $Model)
                <option value="{{$Model->id}}" @if(@$value->{$Field['name']} == $Model->id) selected @endif>{{$Field['relation']['custom']($Model)}}</option>
            @endforeach
        </select>
    </div>
    @if ($errors->has($Field['name']))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($Field['name']) }}</strong>
        </span>
    @endif
</div>
