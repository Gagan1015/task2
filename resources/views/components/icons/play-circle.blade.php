@props(['class' => 'w-6 h-6'])

<svg xmlns="http://www.w3.org/2000/svg" 
     {{ $attributes->merge(['class' => $class]) }} 
     viewBox="0 0 24 24" 
     fill="none" 
     stroke="currentColor" 
     stroke-width="2" 
     stroke-linecap="round" 
     stroke-linejoin="round">
    <circle cx="12" cy="12" r="10"/>
    <polygon points="10 8 16 12 10 16 10 8"/>
</svg>
