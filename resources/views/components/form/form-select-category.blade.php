<select {{ $attributes->merge(['id' => '','name' => '','class' => '']) }}>
                     <option value="">All Categories</option>
                     @foreach ($categories as $category)
                     <option value="{{ $category->id }}" @selected(request('category')==$category->id)>
                         {{ $category->name }}
                     </option>
                     @endforeach
</select>
