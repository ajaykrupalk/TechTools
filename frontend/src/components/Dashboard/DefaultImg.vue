<template>
  <div class="flex justify-center items-center bg-gray-900 h-36 w-full rounded">
    <PhotoIcon class="h-6 w-6 text-gray-600" />
  </div>
</template>

<script>
import { PhotoIcon } from '@heroicons/vue/20/solid';

export default {
    name: 'Card',
    components: {
        PhotoIcon
    }
}
</script>