@props(['class' => 'w-6 h-6'])

<svg xmlns="http://www.w3.org/2000/svg" 
     {{ $attributes->merge(['class' => $class]) }} 
     viewBox="0 0 24 24" 
     fill="none" 
     stroke="currentColor" 
     stroke-width="2" 
     stroke-linecap="round" 
     stroke-linejoin="round">
    <path d="M5 12h14"/>
    <path d="m12 5 7 7-7 7"/>
</svg>
