<template>
    <div class="border border-gray-600 dark:border-white rounded-md p-4 shadow-md text-gray-600 dark:text-gray-300 ">
        <div class="font-medium text-gray-400">
            <slot name="header"></slot>
        </div>
        <slot></slot>
    </div>
</template>