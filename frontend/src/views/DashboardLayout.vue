<template>
    <div class="p-2 bg-gray-900">
        <DashboardContainer />
    </div>
</template>

<script>
import DashboardContainer from '../components/Dashboard/DashboardContainer.vue';

export default {
    name: "DashboardLayout",
    components: {
        DashboardContainer,
    },
}
</script>