<template>
  <!-- <div class="columns-4 p-3 space-y-3 bg-gray-900 min-h-screen"> -->
  <div class="flex flex-wrap gap-3 bg-gray-900 justify-center">
    <template v-if="!show">
      <div v-for="i in 12" :key="i" class="overflow-hidden">
        <Skeleton />
      </div>
    </template>

    <template v-else>
      <div v-for="tool in data" :key="tool">
        <DashboardCard :id="tool.id" :website="tool.url" :image="tool.image" :description="tool.description"/>
      </div>
    </template>
  </div>
</template>

<script>
import DashboardCard from "./DashboardCard.vue";
import Skeleton from "./Skeleton.vue";

import { Tool } from "../../services/";

export default {
  name: "DashboardContainer",
  components: {
    DashboardCard,
    Skeleton,
  },
  mounted(){
    this.setShow();
    this.getDetails();
  },
  data() {
    return {
      card: {
        url: "",
        image: "",
        description: "",
      },
      data: [],
      show: false,
    };
  },
  methods: {
    setShow(){
      setTimeout(() => {
        this.show = true;
        console.log(this.show);
      }, 3000);
    },
    async getDetails() {
      
      await Tool.get()
        .then((response) => {
          console.log(response);
          if (response.status === 200) {
            console.log("Dashboard Container");
            this.data = response.data;
            this.data = this.data.reverse();
          }
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  }
};
</script>