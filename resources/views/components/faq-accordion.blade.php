<!-- resources/views/components/faq-accordion.blade.php -->
@props(['faqs'])

<div class="max-w-3xl mx-auto p-8">
    <h2 class="text-3xl font-bold text-stone-900 mb-8 font-lora italic">FAQ</h2>

    <div class="divide-y divide-stone-500">
        @foreach ($faqs as $index => $faq)
            <div x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }" class="py-4">
                <button
                    @click="open = !open"
                    class="flex justify-between items-center w-full text-left py-2 focus:outline-none"
                >
                    <span class="text-lg font-medium text-stone-900">{{ $faq['question'] }}</span>
                    <span x-show="!open" class="text-2xl text-stone-500">+</span>
                    <span x-show="open" class="text-2xl text-stone-500">−</span>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="mt-2 text-stone-700">
                    {{ $faq['answer'] }}
                </div>
            </div>
        @endforeach
    </div>
</div>
