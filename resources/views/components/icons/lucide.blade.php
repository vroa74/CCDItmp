@props(['name', 'size' => '24', 'class' => '', 'stroke' => '2'])

<i data-lucide="{{ $name }}"
   class="{{ $class }}"
   aria-hidden="true"
   focusable="false"
   style="width: {{ $size }}px; height: {{ $size }}px; stroke-width: {{ $stroke }};">
</i>