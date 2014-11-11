<div role="alert" id="{{ $id }}" class="alert alert-{{ $class }}"@if (empty($messages)) style="display: none"@endif>
    @if (!empty($messages))
        <ul>
            @foreach ($messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @endif
</div>
