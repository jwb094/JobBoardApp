@props(['formdata'])
@props(['fieldname'])
<select {{ $attributes }}>

    @foreach ($formdata as $key => $value)
    <option value="{{ $value }}" @selected(old($fieldname) == $value)>
        {{ $value }} 
    </option>
    @endforeach
</select>
