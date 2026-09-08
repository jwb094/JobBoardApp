@props([
    'formdata',
'fieldname',
'recordFieldData' => null,])
<select {{ $attributes }}>

    @foreach ($formdata as $key => $value)

    <option value="{{ strtolower($value) }}" 
        
    @selected(old($fieldname,ucfirst(strtolower($recordFieldData))) == strtolower($value))

    >
        {{ $value }} 
    </option>
    @endforeach
</select>
