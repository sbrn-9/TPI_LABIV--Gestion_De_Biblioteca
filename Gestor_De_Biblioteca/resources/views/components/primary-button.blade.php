<button {{ $attributes->merge(['type' => 'submit', 'class' => 'border-radius-40 border-transparent bg-primary text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 disabled:opacity-50 dark:focus:ring-primary-500 dark:focus:ring-offset-gray-800 dark:bg-primary-600 dark:text-gray-200 dark:hover:bg-primary-700']) }} style="border: none; border-radius: 10px; padding: 7px 15px; font-weight: medium;">
    {{ $slot }}
</button>
