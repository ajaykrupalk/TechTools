<template>
    <div class="flex flex-row gap-1 bg-red-100 p-3 rounded w-max-80 w-fit">
        <ExclamationCircleIcon class="h-6 w-6 text-red-600"/>

        <div class="text-wrap">
            <h3 class="text-xs text-red-600 font-semibold">Whoops! Something went wrong</h3>
            <ul class="text-xs text-red-500 list-disc pl-3">
                <li v-for="(error, key) in Object.values(errors).flat()" :key="key">{{ error }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
import { ExclamationCircleIcon } from '@heroicons/vue/24/outline';

export default {
    name: "Validation",
    props: {
        errors: Object,
    },
    components: {
        ExclamationCircleIcon,
    }
}
</script>