@props(['class' => 'w-6 h-6'])

<svg xmlns="http://www.w3.org/2000/svg" 
     {{ $attributes->merge(['class' => $class]) }} 
     viewBox="0 0 24 24" 
     fill="none" 
     stroke="currentColor" 
     stroke-width="2" 
     stroke-linecap="round" 
     stroke-linejoin="round">
    <path d="m9 18 6-6-6-6"/>
</svg>
